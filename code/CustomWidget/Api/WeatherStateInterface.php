<?php
/**
 * Product Media Attribute Write Service
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace MageStore\CustomWidget\Api;

use MageStore\CustomWidget\Api\Data\WeatherStateDataInterface;

/**
 * Get weather by location.
 * @api
 * @since 100.0.2
 */
interface WeatherStateInterface
{
    /**
     * Create new gallery entry
     *
     * @param string $lat
     * @param string $long
     * @param string $metric
     * @return WeatherStateDataInterface
     */
    public function getByLatLong(
        $lat,
        $long,
        $metric
    );
}
