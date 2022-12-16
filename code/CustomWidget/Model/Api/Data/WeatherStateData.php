<?php

namespace MageStore\CustomWidget\Model\Api\Data;

use Magento\Framework\DataObject;
use MageStore\CustomWidget\Api\Data\WeatherStateDataInterface;

/**
 *
 */
class WeatherStateData extends DataObject implements WeatherStateDataInterface
{
    /**
     * @return array|mixed|null
     */
    public function getTemp()
    {
        return $this->getData('temp');
    }

    /**
     * @param $temp
     * @return WeatherStateData|mixed
     */
    public function setTemp($temp)
    {
        return $this->setData('temp', $temp);
    }

    /**
     * @return array|mixed|null
     */
    public function getFeelLikeTemp()
    {
        return $this->getData('feels_like');
    }

    /**
     * @param $temp
     * @return WeatherStateData|mixed
     */
    public function setFeelLikeTemp($temp)
    {
        return $this->setData('feels_like', $temp);
    }

    /**
     * @return array|mixed|null
     */
    public function getMinTemp()
    {
        return $this->getData('temp_min');
    }

    /**
     * @param $temp
     * @return WeatherStateData|mixed
     */
    public function setMinTemp($temp)
    {
        return $this->setData('temp_min', $temp);
    }

    /**
     * @return array|mixed|null
     */
    public function getMaxTemp()
    {
        return $this->getData('temp_max');
    }

    /**
     * @param $temp
     * @return WeatherStateData|mixed
     */
    public function setMaxTemp($temp)
    {
        return $this->setData('temp_max', $temp);
    }

    /**
     * @return array|mixed|null
     */
    public function getPressure()
    {
        return $this->getData('pressure');
    }

    /**
     * @param $presure
     * @return WeatherStateData|mixed
     */
    public function setPressure($presure)
    {
        return $this->setData('pressure', $presure);
    }

    /**
     * @return array|mixed|null
     */
    public function getHumidity()
    {
        return $this->getData('humidity');
    }

    /**
     * @param $humidity
     * @return WeatherStateData|mixed
     */
    public function setHumidity($humidity)
    {
        return $this->setData('humidity', $humidity);
    }
}
