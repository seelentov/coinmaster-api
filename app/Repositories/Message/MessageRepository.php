<?php

namespace App\Repositories\Message;

use App\Models\Message;
use App\Repositories\Base\Abstract\AbstractRepository;
use App\Repositories\Base\Traits\HasCreate;
use App\Repositories\Base\Traits\HasGet;
use App\Repositories\Base\Traits\HasGetOrCreate;
use App\Repositories\Base\Traits\HasRemove;

class MessageRepository extends AbstractRepository
{
    private $with = "messages";

    public function __construct()
    {
        $this->model = new Message();
    }

    use HasGet;
    use HasRemove;
    use HasCreate;
}
