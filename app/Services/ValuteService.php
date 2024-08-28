<?php

namespace App\Services;

use App\Components\CbrValuteClient;
use App\Components\CbrValuteDailyClient;
use App\Components\CbrValuteInfo;
use App\Http\Resources\Valute\ValuteResource;
use App\Services\Abstract\AbstractService;
use App\Services\Interfaces\IValuteService;

use function PHPUnit\Framework\isNull;

class ValuteService extends AbstractService implements IValuteService
{
    public function __construct(
        protected readonly CbrValuteDailyClient $dailyClient,
        protected readonly CbrValuteClient $client,
        protected readonly CbrValuteInfo $infoClient
    ) {}

    public function getDaily($query)
    {
        if (!empty($query['date'])) {
            $this->dailyClient->addQuery($query['date']);
        }

        $res = $this->dailyClient->getClient()->request("GET");

        $data = json_decode($res->getBody()->getContents());

        $valutes = $data->Valute;

        $result = array_map(function ($valute) {
            return $this->serializeValute((array)$valute);
        }, (array)$valutes);

        if (!empty($query['name'])) {
            $result = array_filter($result, function ($valute) use ($query) {
                return str_contains(strtolower($valute['name']), strtolower($query['name']));
            });
        }

        if (!empty($query['orderBy']) && !empty($query['orderDir'])) {
            usort($result, function ($a, $b) use ($query) {
                $field = $query['orderBy'];
                if ($query['orderDir'] === 'asc') {
                    return $a[$field] <=> $b[$field];
                } else {
                    return $b[$field] <=> $a[$field];
                }
            });
        }

        return array_values($result);
    }

    public function getValute($code, $start_date, $end_date)
    {
        $this->client->addQuery($code, $start_date, $end_date);
        $res = $this->client->getClient()->request("GET");
        $posRes = $this->xmlToJson($res);
        $posArray = $posRes["Record"];
        $data = $this->getValuteInfo("R01010");

        $positions = [];

        for ($i = 1; $i < count($posArray); $i++) {
            $posArray[$i]["Previous"] = $posArray[$i - 1]["Value"];
            $positions[] = $posArray[$i];
        }

        $data["positions"] = $positions;
        $data["ID"] = $code;

        return $this->serializeValute($data);
    }

    private function getValuteInfo($code)
    {
        $res = $this->infoClient->getClient()->request("GET");
        $data = $this->xmlToJson($res);

        foreach ($data["Item"] as $item) {
            if ($item["@attributes"]["ID"] == $code) {
                return $item;
            }
        }

        return null;
    }

    public function getInfoList()
    {
        $res = $this->infoClient->getClient()->request("GET");
        $data = $this->xmlToJson($res);

        return $data;
    }

    private function getCounts(&$res, $data)
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

    private function serializeValute($data)
    {
        $res = [
            "name" =>  $data["Name"],
        ];

        if (isset($data["CharCode"])) {
            $res["char_code"] = $data["CharCode"];
        } else if (isset($data["ISO_Char_Code"])) {
            $res["char_code"] = $data["ISO_Char_Code"];
        }

        $res["code"] = $data["ID"];

        if (isset($data["positions"])) {
            $res["positions"] = [];

            foreach ($data["positions"] as $position) {
                $res["positions"][] = $this->serializePosition($position);
            }
        } else {
            $this->getCounts($res, $data);
        }


        return $res;
    }
    private function serializePosition($data)
    {
        $res = [
            "date" =>  $data["@attributes"]["Date"],
        ];

        $this->getCounts($res, $data);

        return $res;
    }

    private function xmlToJson($res)
    {
        $xmlString = $res->getBody();
        $xmlObject = simplexml_load_string($xmlString);
        $jsonArray = json_decode(json_encode($xmlObject), true);

        return $jsonArray;
    }
}
