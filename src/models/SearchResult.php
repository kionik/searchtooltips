<?php
namespace yk\models;

use yk\core\DB;

/**
 * Class SearchResult
 * @package yk\models
 */
class SearchResult
{
    /**
     * @param string $location
     * @return mixed
     * @throws \Exception
     */
    public function add(string $location)
    {
        $sql = "INSERT INTO search_results (name) VALUES ('{$location}')";
        return DB::getInstance()->execute($sql);
    }
}