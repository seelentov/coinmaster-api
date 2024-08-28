<?php

namespace App\Services\Interfaces;

interface IQueryHelper
{
    public function getHelp($model, $search, $searchBy, $value);
}
