<?php
namespace MageStore\CustomWidget\Block;
use Magento\Framework\View\Element\Template\Context;
use MageStore\CustomWidget\Model\CurrencyConvertProcessor;
use MageStore\CustomWidget\Model\ResourceModel\Rates\CollectionFactory;

/**
 * Currency rates block
 */
class Currency extends \Magento\Framework\View\Element\Template
{
    protected $currencyConvertProcessor;
    protected $rateFactory;

    /**
     * @param Context $context
     * @param CurrencyConvertProcessor $currencyConvertProcessor
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        CurrencyConvertProcessor                         $currencyConvertProcessor,
        CollectionFactory $rateFactory,
        array                                            $data = []
    ) {
        $this->currencyConvertProcessor = $currencyConvertProcessor;
        $this->rateFactory = $rateFactory;
        parent::__construct($context, $data);
    }

    public function getCurrencyRates()
    {
        return $this->rateFactory->create();
    }
}
