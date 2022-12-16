<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace MageStore\CustomWidget\Model\Config\Source\Weather;

use Magento\Framework\Option\ArrayInterface;
use MageStore\CustomWidget\Model\ResourceModel\City\CollectionFactory;

/**
 *
 */
class City implements ArrayInterface
{
    /**
     * @var CollectionFactory
     */
    protected $cityCollection;

    /**
     * @param CollectionFactory $cityCollection
     */
    public function __construct(
        CollectionFactory $cityCollection
    )
    {
        $this->cityCollection = $cityCollection;
    }

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options = [];
        $collection = $this->getCities();
        foreach ($collection->getData() as $city) {
            $options[] = [
                'value' => $city['city_id'],
                'label' => $city['city_name']
            ];
        }
        return $options;
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        $options = [];
        $collection = $this->getCities();
        foreach ($collection->getData() as $city) {
            $options[] = [
                $city['city_id'] => $city['city_name']
            ];
        }
        return $options;
    }

    /**
     * @return mixed
     */
    protected function getCities()
    {
        return $this->cityCollection->create()->addFieldToFilter('country_id', 'VN');
    }
}
