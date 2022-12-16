<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace MageStore\CustomWidget\Controller\Adminhtml\Index;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\ResourceConnection;

class SyncRates extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    protected $scopeConfig;

    /**
     * @var ResourceConnection
     */
    protected $resourceConnection;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        ScopeConfigInterface $scopeConfig,
        ResourceConnection $resourceConnection
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->scopeConfig = $scopeConfig;
        $this->resourceConnection = $resourceConnection;
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $ctx = stream_context_create(['ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false
        ]]);
        $xmlContent = file_get_contents(
            $this->scopeConfig->getValue('widget/currency/url'),
            false,
            $ctx
        );
        $content = json_encode(simplexml_load_string($xmlContent));
        $xmlArray = json_decode($content, true);
        $currencyDataArray = [];
        foreach ($xmlArray['Exrate'] as $currencyData) {
            foreach ($currencyData as $data) {
                $currencyDataArray[] = [
                    'code' => $data['CurrencyCode'],
                    'name' => trim($data['CurrencyName']),
                    'buy' => $data['Buy'],
                    'transfer' => $data['Transfer'],
                    'sell' => $data['Sell'],
                ];
            }
        }

        try {
            $this->resourceConnection->getConnection()->insertMultiple(
                'exchange_currency_rates',
                [],
                $currencyDataArray
            );
            $this->messageManager->addSuccessMessage(__('Exchange rates update successful.'));
        } catch (\Exception $exception) {
            $this->messageManager->addErrorMessage(__($exception->getMessage()));
        }

        return $this->resultRedirectFactory->create()->setPath('*');
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('MageStore_CustomWidget::exchange_currency');
    }
}
