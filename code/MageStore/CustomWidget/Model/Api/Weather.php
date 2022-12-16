<?php

namespace MageStore\CustomWidget\Model\Api;

use Exception;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\HTTP\Adapter\CurlFactory;
use Magento\Framework\HTTP\ResponseFactory;
use MageStore\CustomWidget\Api\Data\WeatherStateDataInterface;

/**
 *
 */
class Weather
{
    /**
     *
     */
    const XML_API_URL_PATH = 'widget/weather/api_url';
    /**
     *
     */
    const XML_API_KEY_PATH = 'widget/weather/api_key';
    /**
     *
     */
    const XML_API_EXCLUDE_MODE_PATH = 'widget/weather/exclude';
    /**
     * @var CurlFactory
     */
    protected $curlFactory;
    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;
    /**
     * @var WeatherStateDataInterface
     */
    protected $weatherData;

    /**
     * @var ResponseFactory
     */
    protected $responseFactory;

    /**
     * @param CurlFactory $curlFactory
     * @param ScopeConfigInterface $scopeConfig
     * @param ResponseFactory $responseFactory
     * @param WeatherStateDataInterface $weatherData
     */
    public function __construct(
        CurlFactory               $curlFactory,
        ScopeConfigInterface      $scopeConfig,
        ResponseFactory           $responseFactory,
        WeatherStateDataInterface $weatherData
    )
    {
        $this->curlFactory = $curlFactory;
        $this->scopeConfig = $scopeConfig;
        $this->responseFactory = $responseFactory;
        $this->weatherData = $weatherData;
    }

    /**
     * @param $lat
     * @param $long
     * @param $metric
     * @return WeatherStateDataInterface
     * @throws Exception
     */
    public function getWeatherByLocation($lat, $long, $metric = null)
    {
        $apiUrl = $this->scopeConfig->getValue(self::XML_API_URL_PATH);
        $apiKey = $this->scopeConfig->getValue(self::XML_API_KEY_PATH);
        $exclude = $this->scopeConfig->getValue(self::XML_API_EXCLUDE_MODE_PATH);

        $queryString = 'lat=' . $lat . '&lon=' . $long . '&appid=' . $apiKey;
        if ($metric) {
            $queryString = $queryString . '&units=' . $metric;
        }

        $curl = $this->curlFactory->create();
        $curl->write('GET', $apiUrl . $queryString, '1.1', '', '');
        $responseBody = $curl->read();
        $curl->close();
        $result = $this->responseFactory->create($responseBody);
        if ($result->getStatus() == 200) {
            $responseArray = json_decode($result->getBody(), true);
            $this->weatherData->setTemp($responseArray['main']['temp']);
            $this->weatherData->setFeelLikeTemp($responseArray['main']['feels_like']);
            $this->weatherData->setMinTemp($responseArray['main']['temp_min']);
            $this->weatherData->setMaxTemp($responseArray['main']['temp_max']);
            $this->weatherData->setPressure($responseArray['main']['pressure']);
            $this->weatherData->setHumidity($responseArray['main']['humidity']);
            return $this->weatherData;
        } else {
            throw new Exception('Can find weather for your location.');
        }
    }
}
