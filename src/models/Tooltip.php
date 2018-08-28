<?php
namespace yk\models;

/**
 * Class Tooltip
 * @package yk\models
 */
class Tooltip
{
    /**
     * @var string
     */
    protected $serviceUri;
    /**
     * @var YandexTooltip
     */
    protected $geoProviderClass;

    /**
     * Tooltip constructor.
     * @param string $serviceUri - full geodata service uri with all params include search=
     * @param string $geolocationDriver - provider class name
     */
    public function __construct(string $serviceUri, string $geolocationDriver)
    {
        $this->serviceUri = $serviceUri;
        $this->geoProviderClass = 'yk\\models\\' . $geolocationDriver;
    }

    /**
     * @param string $request
     * @param array $headers
     * @return mixed
     */
    protected function getResponse(string $request, array $headers)
    {
        $ch = curl_init($this->serviceUri . $request);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response);
    }

    /**
     * Get data from geolocation service and prepare data by provider
     * @param string $request
     * @param array $headers
     * @return array
     */
    public function getData(string $request, array $headers = [])
    {
        $resp = $this->getResponse($request, $headers);
        $this->geoProviderClass = new $this->geoProviderClass($resp);
        return $this->geoProviderClass->getLocations();
    }
}