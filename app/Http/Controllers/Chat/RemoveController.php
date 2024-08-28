<?php

namespace App\Http\Controllers\Chat;

class RemoveController extends BaseController
{
    public function __invoke($id)
    {
        $entity = $this->messages->get('id', $id);

        if ($entity->user_id != auth()->user()->id) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $this->messages->remove('id', $id);
    }
}
