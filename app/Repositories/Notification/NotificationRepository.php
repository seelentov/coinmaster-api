<?php

namespace App\Repositories\Notification;

use App\Models\Message;
use App\Models\Notification;
use App\Models\UserNotification;
use App\Repositories\Base\Abstract\AbstractRepository;
use App\Repositories\Base\Traits\HasCreate;
use App\Repositories\Base\Traits\HasGetCollection;

class NotificationRepository extends AbstractRepository
{
    public function __construct()
    {
        $this->model = new UserNotification();
    }

    use HasGetCollection;
    use HasCreate;

    public function checkUpdates($userId)
    {
        $this->model::where("user_id", $userId)->where("is_checked", true)->where("created_at", ">", now()->addDays(1))->delete();
        $this->model::where("user_id", $userId)->update(["is_checked" => true]);
    }
}
