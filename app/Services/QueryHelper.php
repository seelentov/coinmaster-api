<?php

// namespace App\Services;

// use App\Services\Abstract\AbstractService;
// use App\Services\Interfaces\IQueryHelper;

// class QueryHelper extends AbstractService implements IQueryHelper
// {
//     public function getHelp($model, $search, $searchBy, $value)
//     {
//         $value = strtolower($value);

//         $matches = $model::whereRaw('lower(' . $searchBy . ') like ?', ["%{$value}%"])
//             ->select($search)
//             ->get()
//             ->pluck($search)
//             ->toArray();

//         uasort($matches, function ($a, $b) use ($value) {
//             $aCount = substr_count(strtolower($a), $value);
//             $bCount = substr_count(strtolower($b), $value);
//             return $bCount <=> $aCount;
//         });

//         return array_slice(array_values($matches), 0, 10);
//     }

//     public function flatten(array $array)
//     {
//         $return = array();
//         array_walk_recursive($array, function ($a) use (&$return) {
//             $return[] = $a;
//         });
//         return $return;
//     }
// }
