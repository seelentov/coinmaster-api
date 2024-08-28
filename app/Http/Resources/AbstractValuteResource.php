<?php

namespace App\Http\Resources;

abstract class AbstractValuteResource extends AbstractResource
{
    protected function getValute(&$res, $data)
    {
        $res["value"] = floatval(str_replace(",", ".", $data["Value"])) * intval($data["Nominal"]);

        $res["prev_value"] = floatval(str_replace(",", ".", $data["Previous"])) * intval($data["Nominal"]);

        $res["rise"] = $res["value"] - $res["prev_value"];

        if ($res["prev_value"] != 0) {
            $res["rise_percent"] = ($res["rise"] / $res["prev_value"]) * 100;
        } else {
            $res["rise_percent"] = 0;
        }

        $res["rise"] = round($res["rise"], 4);
        $res["rise_percent"] = round($res["rise_percent"], 4);
    }
}
