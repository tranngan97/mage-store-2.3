<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace MageStore\CustomWidget\Controller\Adminhtml\Index;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\PageFactory;

/**
 *
 */
class SyncNews extends Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var ResourceConnection
     */
    protected $resourceConnection;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context        $context,
        PageFactory $resultPageFactory,
        ScopeConfigInterface                       $scopeConfig,
        ResourceConnection                         $resourceConnection
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->scopeConfig = $scopeConfig;
        $this->resourceConnection = $resourceConnection;
    }

    /**
     * @return ResultInterface
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
        } catch (Exception $exception) {
            $this->messageManager->addErrorMessage(__($exception->getMessage()));
        }

        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/*');
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('MageStore_CustomWidget::business_news');
    }
}
