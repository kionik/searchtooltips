<?php


namespace yk\models;

use yk\interfaces\TooltipProvider;

/**
 * Class YandexTooltip
 * @package yk\models
 */
class YandexTooltip implements TooltipProvider
{
    /**
     * @var - response from yandex geolocation service
     */
    protected $serviceResponse;

    /**
     * YandexTooltip constructor.
     * @param $serviceResponse
     */
    public function __construct($serviceResponse)
    {
        $this->serviceResponse = $serviceResponse;
    }

    /**
     * @return array
     */
    public function getLocations()
    {
        $locations = [];
        foreach ($this->serviceResponse->response->GeoObjectCollection->featureMember as $location) {
            $locations[] = $location->GeoObject->metaDataProperty->GeocoderMetaData->text;
        }
        return $locations;
    }
}