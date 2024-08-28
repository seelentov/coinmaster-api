<?php

namespace App\Services\Interfaces;

interface IValuteService
{
    public function getDaily();
    public function getValute($code, $start_date, $end_date);
}
