<?php
namespace MageStore\CustomWidget\Block;
use MageStore\CustomWidget\Model\ResourceModel\City\CollectionFactory;
class Weather extends \Magento\Framework\View\Element\Template
{
    protected $_template = 'MageStore_CustomWidget::widget/weather.phtml';
    protected $cityCollectionFactory;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        CollectionFactory $cityCollectionFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->cityCollectionFactory = $cityCollectionFactory;
    }

    public function getApiKey()
    {
        return $this->_scopeConfig->getValue('widget/weather/api_key');
    }

    public function getDefaultUnit()
    {
        return $this->_scopeConfig->getValue('widget/weather/unit');
    }

    public function getDefaultCityId()
    {
        return $this->_scopeConfig->getValue('widget/weather/city');
    }

    public function getWidgetScript()
    {
        return $this->_scopeConfig->getValue('widget/weather/script');
    }

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
