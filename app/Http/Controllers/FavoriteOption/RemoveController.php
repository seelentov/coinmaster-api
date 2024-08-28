<?php

namespace App\Http\Controllers\FavoriteOption;

class RemoveController extends BaseController
{
    public function __invoke($id)
    {
        $entity = $this->favoriteOptions->get('id', $id);

        if ($entity->favorite->user_id != auth()->user()->id) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $this->favoriteOptions->remove('id', $id);
    }
}
