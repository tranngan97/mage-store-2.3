<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace MageStore\CustomWidget\Model\Config\Source\Weather;
use Magento\Framework\Option\ArrayInterface;

/**
 *
 */
class Exclude implements ArrayInterface
{
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => 'daily', 'label' => __('Daily')],
            ['value' => 'hourly', 'label' => __('Hourly')],
            ['value' => 'minutely', 'label' => __('Minutely')]
        ];
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        return ['daily' => __('Daily'), 'hourly' => __('Hourly'), 'minutely' => __('Minutely')];
    }
}
