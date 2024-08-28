<?php

namespace App\Repositories\Settings;

use App\Models\Settings;
use App\Repositories\Base\Abstract\AbstractRepository;
use App\Repositories\Base\Traits\HasGet;
use App\Repositories\Base\Traits\HasUpdate;

class SettingsRepository extends AbstractRepository
{
    private $with = "messages";

    public function __construct()
    {
        $this->model = new Settings();
    }

    use HasGet;
    use HasUpdate;
}
