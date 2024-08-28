<?php

namespace App\Components\Abstract;

use GuzzleHttp\Client;

abstract class AbstractHttpClient
{
    protected $options;
    protected $baseUri;

    public function __construct()
    {
        $this->options = [
            "timeout" => 10.0,
            'verify' => base_path() . '/cacert.pem'
        ];
    }

    public function getClient()
    {
        return new Client($this->options);
    }
}
