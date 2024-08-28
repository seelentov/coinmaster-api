<?php


namespace App\Components;

use App\Components\Abstract\AbstractValuteHttpClient;

class CbrValuteInfo extends AbstractValuteHttpClient
{
    public function __construct()
    {
        parent::__construct();
        $this->options["base_uri"] = "https://www.cbr.ru/scripts/XML_valFull.asp";
    }
}
