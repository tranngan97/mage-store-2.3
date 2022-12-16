<?php
/**
 * Product Media Attribute Write Service
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace MageStore\CustomWidget\Api\Data;

/**
 * Get weather by location.
 * @api
 * @since 100.0.2
 */
interface WeatherStateDataInterface
{
    /**
     * @return mixed
     */
    public function getTemp();

    /**
     * @param $temp
     * @return mixed
     */
    public function setTemp($temp);

    /**
     * @return mixed
     */
    public function getFeelLikeTemp();

    /**
     * @param $temp
     * @return mixed
     */
    public function setFeelLikeTemp($temp);

    /**
     * @return mixed
     */
    public function getMinTemp();

    /**
     * @param $temp
     * @return mixed
     */
    public function setMinTemp($temp);

    /**
     * @return mixed
     */
    public function getMaxTemp();

    /**
     * @param $temp
     * @return mixed
     */
    public function setMaxTemp($temp);

    /**
     * @return mixed
     */
    public function getPressure();

    /**
     * @param $temp
     * @return mixed
     */
    public function setPressure($temp);

    /**
     * @return mixed
     */
    public function getHumidity();

    /**
     * @param $humidity
     * @return mixed
     */
    public function setHumidity($humidity);
}
