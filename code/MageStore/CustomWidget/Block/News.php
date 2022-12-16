<?php
namespace MageStore\CustomWidget\Block;
use Magento\Theme\Block\Html\Pager;
use MageStore\CustomWidget\Model\ResourceModel\News\CollectionFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;
/**
 * Currency rates block
 */
class News extends \Magento\Framework\View\Element\Template
{
    protected $businessNews;
    protected $scopeConfig;
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        CollectionFactory $businessNews,
        ScopeConfigInterface $scopeConfig,
        array $data = []
    ) {
        $this->businessNews = $businessNews;
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context, $data);
    }

    public function getNews()
    {
        return $this->businessNews->create();
    }

    public function getPagerHtml()
    {
        $pager = $this->getLayout()->createBlock(
            Pager::class,
            'business-news-pager'
        );
        $pager->setUseContainer(true)
            ->setShowAmounts(false)
            ->setShowPerPage(false)
            ->setCollection($this->getNews())
            ->setLimit($this->scopeConfig->getValue('widget/news/limit'));
        return $pager->toHtml();
    }
}
