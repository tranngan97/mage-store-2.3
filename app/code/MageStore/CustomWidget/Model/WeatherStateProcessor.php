<?php
/**
 * Product Media Attribute Write Service
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace MageStore\CustomWidget\Model;
use MageStore\CustomWidget\Model\Api\Weather;
/**
 * Get weather by location.
 */
class WeatherStateProcessor implements \MageStore\CustomWidget\Api\WeatherStateInterface
{
    protected $weatherApi;

    public function __construct(
        Weather $weatherApi
    ) {
        $this->weatherApi = $weatherApi;
    }

    /**
     * Create new gallery entry
     *
     * @param string $lat
     * @param string $long
     * @param string $apiKey
     * @return bool
     */
    public function getByLatLong(
        $lat,
        $long,
        $metric
    ) {
        return $this->weatherApi->getWeatherByLocation($lat, $long, $metric);
    }
}
