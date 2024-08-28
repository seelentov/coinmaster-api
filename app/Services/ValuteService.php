<?php

namespace App\Services;

use App\Components\CbrValuteClient;
use App\Components\CbrValuteDailyClient;
use App\Components\CbrValuteInfo;
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

    public function getDaily($data = null)
    {
        if (!is_null($data)) {
            $this->dailyClient->addQuery($data);
        }

        $res = $this->dailyClient->getClient()->request("GET");

        $data = json_decode($res->getBody()->getContents());

        $valutes = $data->Valute;

        $result = array_map(function ($valute) {
            return (array)$valute;
        }, (array)$valutes);

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

        return $data;
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

    private function xmlToJson($res)
    {
        $xmlString = $res->getBody();
        $xmlObject = simplexml_load_string($xmlString);
        $jsonArray = json_decode(json_encode($xmlObject), true);

        return $jsonArray;
    }
}
