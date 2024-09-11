<?php

namespace App\Http\Resources\News;

use App\Http\Resources\AbstractResource;
use Illuminate\Http\Request;

class NewsResource extends AbstractResource
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
            "title" =>  $data["title"],
            "link" =>  $data["link"],
            "date" =>  $data["date"],
            "description" =>  $data["description"],
        ];

        return $res;
    }
}
