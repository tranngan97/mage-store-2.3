<?php
namespace MageStore\CustomWidget\Model\Api;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\HTTP\Adapter\CurlFactory;

class Weather
{
    const XML_API_URL_PATH = 'widget/weather/api_url';
    const XML_API_KEY_PATH = 'widget/weather/api_key';
    const XML_API_EXCLUDE_MODE_PATH = 'widget/weather/exclude';
    protected $curlFactory;
    protected $scopeConfig;

    public function __construct(
        CurlFactory $curlFactory,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->curlFactory = $curlFactory;
        $this->scopeConfig = $scopeConfig;
    }

    public function getWeatherByLocation($lat, $long, $metric = null)
    {
        $apiUrl = $this->scopeConfig->getValue(self::XML_API_URL_PATH);
        $apiKey = $this->scopeConfig->getValue(self::XML_API_KEY_PATH);
        $exclude = $this->scopeConfig->getValue(self::XML_API_EXCLUDE_MODE_PATH);

        $queryString = 'lat=' . $lat . '&lon=' . $long . '&exclude=' . $exclude . '&appid=' . $apiKey;
        if ($metric) {
            $queryString = $queryString . '&units=' . $metric;
        }

        $curl = $this->curlFactory->create();
        $curl->write('GET', $apiUrl, '1.1', '', $queryString);
        $responseBody = $curl->read();
        $responseCode = \Zend_Http_Response::extractCode($responseBody);
        $responseMessage = \Zend_Http_Response::extractMessage($responseBody);
        $curl->close();
        if ($responseCode == 200) {
            $weatherArray = json_decode($responseMessage, true);
        } else {
            throw new \Exception('Can find weather for your location.');
        }

        return $weatherArray;
    }
}
