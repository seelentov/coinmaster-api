<?php

namespace App\Repositories\Chat;

use App\Models\Chat;
use App\Repositories\Base\Abstract\AbstractRepository;

class ChatRepository extends AbstractRepository
{
    public function __construct()
    {
        $this->model = new Chat();
    }

    public function getOrCreate($identifier, $data)
    {
        $entity = $this->model::firstOrCreate(["identifier" => $identifier], $data);

        $entity->load(['messages' => function ($query) {
            $query->orderBy('created_at', 'asc')->with('user');
        }]);

        return $entity;
    }
}
