<?php

namespace MageStore\CustomWidget\Block;

use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Theme\Block\Html\Pager;
use MageStore\CustomWidget\Model\ResourceModel\News\CollectionFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;

/**
 * Currency rates block
 */
class News extends Template
{
    protected $_template = 'MageStore_CustomWidget::widget/news.phtml';
    /**
     * @var CollectionFactory
     */
    protected $businessNews;
    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @param Context $context
     * @param Registry $registry
     * @param array $data
     */
    public function __construct(
        Context $context,
        CollectionFactory                                $businessNews,
        ScopeConfigInterface                             $scopeConfig,
        array                                            $data = []
    )
    {
        $this->businessNews = $businessNews;
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context, $data);
    }

    /**
     * @return $this|News
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        if ($this->getNews()) {
            $pager = $this->getLayout()->createBlock(
                Pager::class,
                'business.news.pager'
            )->setCollection(
                $this->getNews()
            )->setShowPerPage(
                false
            )->setShowAmounts(false);
            $this->setChild('pager', $pager);
            $this->getNews()->load();
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNews()
    {
        $curPage = $this->getRequest()->getParam('p') ? $this->getRequest()->getParam('p') : 1;
        $pageSize = $this->scopeConfig->getValue('widget/news/limit');
        $collection = $this->businessNews->create();
        if ($curPage && $pageSize) {
            $collection->setPageSize($pageSize);
            $collection->setCurPage($curPage);
        }
        return $collection;
    }

    /**
     * @return string
     */
    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }
}
