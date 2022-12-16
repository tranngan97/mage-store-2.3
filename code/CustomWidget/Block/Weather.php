<?php

namespace MageStore\CustomWidget\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use MageStore\CustomWidget\Model\ResourceModel\City\CollectionFactory;

/**
 *
 */
class Weather extends Template
{
    /**
     * @var string
     */
    protected $_template = 'MageStore_CustomWidget::widget/weather.phtml';
    /**
     * @var CollectionFactory
     */
    protected $cityCollectionFactory;

    /**
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        Context $context,
        CollectionFactory                                $cityCollectionFactory,
        array                                            $data = []
    )
    {
        parent::__construct($context, $data);
        $this->cityCollectionFactory = $cityCollectionFactory;
    }

    /**
     * @return mixed
     */
    public function getApiKey()
    {
        return $this->_scopeConfig->getValue('widget/weather/api_key');
    }

    /**
     * @return mixed
     */
    public function getDefaultUnit()
    {
        return $this->_scopeConfig->getValue('widget/weather/unit');
    }

    /**
     * @return mixed
     */
    public function getDefaultCityId()
    {
        return $this->_scopeConfig->getValue('widget/weather/city');
    }

    /**
     * @return mixed
     */
    public function getWidgetScript()
    {
        return $this->_scopeConfig->getValue('widget/weather/script');
    }

    /**
     * @return array
     */
    public function getCitySelectData()
    {
        $collection = $this->cityCollectionFactory->create();
        $options = [];
        foreach ($collection->getData() as $cityData) {
            $options[] = [
                'id' => $cityData['city_id'],
                'name' => $cityData['city_name'],
                'lat' => $cityData['lat'],
                'lon' => $cityData['lon']
            ];
        }

        return $options;
    }
}
