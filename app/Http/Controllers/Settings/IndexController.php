<?php

namespace App\Http\Controllers\Settings;

class IndexController extends BaseController
{
    public function __invoke()
    {
        $data = $this->settings->get('user_id', auth()->user()->id);
        return $data;
    }
}
