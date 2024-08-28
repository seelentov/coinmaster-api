<?php

namespace App\Http\Resources;

abstract class AbstractValuteResource extends AbstractResource
{
    protected function getValute(&$res, $data)
    {
        $res["value"] = $data["value"];
        $res["prev_value"] = $data["prev_value"];
        $res["rise"] = $data["rise"];
        $res["rise_percent"] = $data["rise_percent"];
    }
}
