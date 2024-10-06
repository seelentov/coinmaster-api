<?php

namespace App\Http\Controllers;

use App\Jobs\TestBigJob;
use App\Jobs\TestJob;

class TestController extends Controller
{
    public function __invoke()
    {
        TestBigJob::dispatch();
        TestJob::dispatch();
    }
}
