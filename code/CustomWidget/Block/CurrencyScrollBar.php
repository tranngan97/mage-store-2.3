<?php

namespace MageStore\CustomWidget\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use MageStore\CustomWidget\Model\ResourceModel\Rates\CollectionFactory;

/**
 * Currency rates block
 */
class CurrencyScrollBar extends Template
{
    protected $_template = 'MageStore_CustomWidget::widget/currency_scroll_bar.phtml';
    /**
     * @var CollectionFactory
     */
    protected $rateFactory;

    /**
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        Context                  $context,
        CollectionFactory        $rateFactory,
        array                    $data = []
    )
    {
        $this->rateFactory = $rateFactory;
        parent::__construct($context, $data);
    }

    /**
     * @return mixed
     */
    public function getCurrencyRates()
    {
        return $this->rateFactory->create();
    }

    public function getRatesHtml()
    {
        $html = '';
        foreach ($this->getCurrencyRates() as $rate) {
            $html = $html. ' '. $rate['code'] . ':' . ' Sell/Buy ' . $rate['sell'] . '/' . $rate['buy'];
        }
        return $html;
    }
}
