<?php

namespace App\Http\Controllers\FavoriteOption;

use App\Http\Requests\FavoriteOption\StoreRequest;

class StoreController extends BaseController
{
    public function __invoke($favoriteId, StoreRequest $request)
    {
        $favorite = $this->favorites->get('id', $favoriteId);

        if ($favorite != null && ($favorite->user_id != auth()->user()->id)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $body = $request->validated();

        $body["favorite_id"] = $favoriteId;

        $this->favoriteOptions->updateOrCreate([
            'name' => $body["name"],
            'favorite_id' => $favoriteId,
        ], $body);
    }
}
