<?php


namespace yk\interfaces;


interface TooltipProvider
{
    public function __construct($serviceResponse);
    public function getLocations();
}