<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Services\NewsService;
use App\Services\ValuteService;

class BaseController extends Controller
{
    public function __construct(
        protected readonly NewsService $news
    ) {}
}
