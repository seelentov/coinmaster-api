<?php

namespace App\Repositories\FavoriteOption;

use App\Models\FavoriteOption;
use App\Repositories\Base\Abstract\AbstractRepository;
use App\Repositories\Base\Traits\HasGet;
use App\Repositories\Base\Traits\HasGetCollection;
use App\Repositories\Base\Traits\HasRemove;
use App\Repositories\Base\Traits\HasUpdateOrCreate;

class FavoriteOptionRepository extends AbstractRepository
{
    public function __construct()
    {
        $this->model = new FavoriteOption();
    }

    use HasGet;
    use HasRemove;
    use HasUpdateOrCreate;
}
