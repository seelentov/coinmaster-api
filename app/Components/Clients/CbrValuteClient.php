<?php


namespace App\Components\Clients;

use App\Components\Abstract\AbstractValuteHttpClient;

class CbrValuteClient extends AbstractValuteHttpClient
{
    public function __construct()
    {
        parent::__construct();
        $this->options["base_uri"] = "https://www.cbr.ru/scripts/XML_dynamic.asp";
    }

    public function addQuery($code, $start_date, $end_date)
    {
        $this->options["base_uri"] = "https://www.cbr.ru/scripts/XML_dynamic.asp?date_req1=" . $start_date . "&date_req2=" . $end_date . "&VAL_NM_RQ=" . $code;
    }
}
