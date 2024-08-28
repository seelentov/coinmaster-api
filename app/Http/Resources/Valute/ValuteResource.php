<?php

namespace App\Http\Resources\Valute;

use Illuminate\Http\Request;
use App\Http\Resources\AbstractValuteResource;
use App\Http\Resources\Position\PositionResource;

class ValuteResource extends AbstractValuteResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = $this->resource;

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
            $res["positions"] = PositionResource::collection($data["positions"]);
        } else {
            $this->getValute($res, $data);
        }


        return $res;
    }
}
