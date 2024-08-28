<?php

namespace App\Services\Interfaces;

interface IValuteService
{
    public function getDaily($query);
    public function getValute($code, $start_date, $end_date);
}
