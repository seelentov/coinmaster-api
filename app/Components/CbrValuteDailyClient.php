<?php


namespace App\Components;

use App\Components\Abstract\AbstractValuteHttpClient;

class CbrValuteDailyClient extends AbstractValuteHttpClient
{
    public function __construct()
    {
        parent::__construct();
        $this->options["base_uri"] = "https://www.cbr-xml-daily.ru/daily_json.js";
    }

    public function addQuery($date)
    {
        $date = implode("/", (array_reverse(explode("/", $date))));


        $this->options["base_uri"] = "https://www.cbr-xml-daily.ru/archive/" . $date . "/daily_json.js";
    }
}
