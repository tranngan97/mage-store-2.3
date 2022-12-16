<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace MageStore\CustomWidget\Model\Config\Source\Weather;
use Magento\Framework\Option\ArrayInterface;

class Unit implements ArrayInterface
{
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [['value' => 'metric', 'label' => __('°C')], ['value' => 'imperial', 'label' => __('°F')]];
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        return ['metric' => __('°C'), 'imperial' => __('°F')];
    }
}
