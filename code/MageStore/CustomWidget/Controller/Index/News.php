<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace MageStore\CustomWidget\Controller\Index;

use Magento\Framework\Controller\ResultFactory;

/**
 * Catalog index page controller.
 */
class News extends \Magento\Framework\App\Action\Action
{
    /**
     * Index action
     *
     * @return \Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->prepend(__('Business News'));
        return $resultPage;
    }
}
