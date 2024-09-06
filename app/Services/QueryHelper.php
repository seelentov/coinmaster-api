<?php

namespace App\Services;

use App\Components\CbrValuteInfo;
use App\Services\Abstract\AbstractService;
use App\Services\Interfaces\IQueryHelper;

class QueryHelper extends AbstractService implements IQueryHelper
{
    private $searchAttributes = [
        "Name",
        "EngName",
        "ParentCode"
    ];

    private $resAttribute = "Name";

    public function __construct(
        protected readonly ValuteService $valuteService
    ) {}
    public function getHelp($query)
    {
        $search = strtolower($query["search"]);

        $res = $this->valuteService->getInfoList();
        $valuteList = $res["Item"];

        $result = [];

        foreach ($valuteList as $valuteItem) {
            if ($this->checkBysearchAttributes($valuteItem, $search)) {
                $result[] = $valuteItem[$this->resAttribute];
            }
        }

        return $result;
    }

    private function checkBysearchAttributes($valuteItem, $search)
    {
        $search = mb_strtolower($search);

        foreach ($this->searchAttributes as $attribute) {
            $attrValue = mb_strtolower($valuteItem[$attribute]);

            if (str_contains($attrValue, $search)) {
                return true;
            }
        }

        return false;
    }

    private function flatten(array $array)
    {
        $return = array();
        array_walk_recursive($array, function ($a) use (&$return) {
            $return[] = $a;
        });
        return $return;
    }
}
