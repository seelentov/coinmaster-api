<?php

namespace App\Http\Resources\Valute;

use App\Http\Resources\AbstractResource;
use App\Http\Resources\AbstractValuteResource;
use App\Http\Resources\Position\PositionResource;
use Illuminate\Http\Request;

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
            "name" =>  $data["name"],
            "char_code" =>  $data["char_code"],
            "code" =>  $data["code"],
        ];

        if (isset($data['positions'])) {
            $res["positions"] = PositionResource::collection($data['positions']);
        } else {
            $this->getValute($res, $data);
        }

        return $res;
    }
}
