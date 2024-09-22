<?php


namespace App\Components\Clients;

use App\Components\Abstract\AbstractValuteHttpClient;

class ExpoClient extends AbstractValuteHttpClient
{
    public function __construct()
    {
        parent::__construct();
        $this->options["base_uri"] = "https://exp.host/--/api/v2/push/send";
    }
}
