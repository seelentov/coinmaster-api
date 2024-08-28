<?php

namespace App\Http\Resources\Position;

use App\Http\Resources\AbstractValuteResource;
use Illuminate\Http\Request;

class PositionResource extends AbstractValuteResource
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
            "date" =>  $data["@attributes"]["Date"],
        ];

        $this->getValute($res, $data);

        return $res;
    }
}
