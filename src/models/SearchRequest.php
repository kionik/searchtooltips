<?php
namespace yk\models;

use yk\core\DB;

/**
 * Class SearchRequest
 * @package yk\models
 */
class SearchRequest
{
    /**
     * @param string $request
     * @return int
     * @throws \Exception
     */
    public function add(string $request)
    {
        $sql = "INSERT INTO search_requests (name) VALUES ('{$request}')";
        if(DB::getInstance()->execute($sql)) {
            return DB::getInstance()->getLastInsertId();
        }
        return 0;
    }
}