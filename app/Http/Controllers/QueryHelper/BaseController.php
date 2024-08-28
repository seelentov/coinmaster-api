<?php

namespace App\Http\Controllers\QueryHelper;

use App\Http\Controllers\Controller;
use App\Services\QueryHelper;

class BaseController extends Controller
{
    public function __construct(
        protected readonly QueryHelper $queryHelper
    ) {}
}
