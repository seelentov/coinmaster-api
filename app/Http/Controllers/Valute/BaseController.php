<?php

namespace App\Http\Controllers\Valute;

use App\Http\Controllers\Controller;
use App\Services\ValuteService;

class BaseController extends Controller
{
    public function __construct(
        protected readonly ValuteService $valuteService
    ) {}
}
