<?php


namespace yk\core;


/**
 * Class Template
 * @package yk\models
 */
class Template
{
    /**
     * @var string
     */
    protected $dirPath;

    /**
     * Template constructor.
     * @param $tplDirPath string - relative template directory path
     */
    public function __construct($tplDirPath)
    {
        $this->dirPath = $tplDirPath;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->dirPath . '/template.php';
    }

    /**
     * @return string
     */
    public function getDir()
    {
        return $this->dirPath;
    }

    /**
     * include current app template
     */
    public function render()
    {
        include $_SERVER['DOCUMENT_ROOT'] . $this->getPath();
    }
}