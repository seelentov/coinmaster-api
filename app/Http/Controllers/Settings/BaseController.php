<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Repositories\Settings\SettingsRepository;

class BaseController extends Controller
{
    public function __construct(
        protected readonly SettingsRepository $settings
    ) {}
}
