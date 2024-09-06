<?php

namespace App\Http\Controllers\Favorite;

class RemoveController extends BaseController
{
    public function __invoke($id)
    {
        $entity = $this->favorites->get('id', $id);

        if ($entity->user_id != auth()->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $this->favorites->remove('id', $id);
    }
}
