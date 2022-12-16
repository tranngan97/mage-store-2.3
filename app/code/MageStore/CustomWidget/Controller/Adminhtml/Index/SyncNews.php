<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace MageStore\CustomWidget\Controller\Adminhtml\Index;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\ResourceConnection;

class SyncNews extends \Magento\Backend\App\Action
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
            $this->scopeConfig->getValue('widget/news/url'),
            false,
            $ctx
        );
        $content = json_encode(simplexml_load_string($xmlContent));
        $xmlArray = json_decode($content, true);
        $newsArray = $xmlArray['channel']['item'];
        $connection = $this->resourceConnection->getConnection();
        $connection->truncateTable('business_news');
        $connection->beginTransaction();
        try {
            foreach ($newsArray as $news) {
                $news['description'] = !empty($news['description']) ? $news['description'] : '';
                $connection->insert(
                    'business_news',
                    $news
                );
            }
            $connection->commit();
            $this->messageManager->addSuccessMessage(__('Business news update successful.'));
        } catch (\Exception $exception) {
            $this->messageManager->addErrorMessage(__($exception->getMessage()));
        }

        return $this->resultRedirectFactory->create()->setPath('*');
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('MageStore_CustomWidget::business_news');
    }
}
