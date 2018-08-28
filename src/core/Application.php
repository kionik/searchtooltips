<?php

namespace yk\core;

use yk\models\SearchResult;
use yk\models\Tooltip;

/**
 * Class Application
 * @package yk
 */
class Application
{
    /**
     * @var Template
     */
    private $template;
    /**
     * @var string - path to template
     */
    protected $templateDirectoryPath;
    /**
     * @var string - full geodata service uri with all params include search=
     */
    protected $serviceUri;
    /**
     * @var string - provider class name
     */
    protected $geolocationDriverClassName;
    /**
     * @var array - service request headers
     */
    protected $requestHeaders;


    /**
     * Application constructor.
     * @param string $pathToConfig
     */
    public function __construct(string $pathToConfig)
    {
        $this->setProperties($pathToConfig);
        $this->template = new Template($this->templateDirectoryPath);
    }

    /**
     * Initialize config params, set db connection
     * @param $pathToConfig
     */
    protected function setProperties($pathToConfig)
    {
        $config = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . $pathToConfig), true);
        foreach ($config as $prop => $vale) {
            if (property_exists($this, $prop)) {
                $this->$prop = $vale;
            }
        }
        DB::configuration($config['dbConnection']['dsn'], $config['dbConnection']['login'],$config['dbConnection']['password']);
    }

    /**
     * Application entry point, check if AJAX request, send to search results, else include template
     * @throws \Exception
     */
    public function start()
    {
        if ($this->isAjax()) {
            $locations = (new Tooltip($this->serviceUri, $this->geolocationDriverClassName))->getData($this->getAjaxData(), $this->requestHeaders);
            if (is_array($locations)) {
                foreach ($locations as $location) {
                    (new SearchResult())->add($location);
                }
            } else {
                (new SearchResult())->add($locations);
            }
            echo json_encode($locations);
            
        } else {
            $this->template->render();
        }
    }

    /**
     * Return client request
     * @return string
     */
    protected function getAjaxData()
    {
        return $_POST['text'];
    }

    /**
     * Check is ajax current request
     * @return bool
     */
    protected function isAjax()
    {
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' )
            return true;
        return false;
    }
}