<?php

namespace App\Repositories\Favorite;

use App\Models\Favorite;
use App\Repositories\Base\Abstract\AbstractRepository;
use App\Repositories\Base\Traits\HasCreate;
use App\Repositories\Base\Traits\HasGet;
use App\Repositories\Base\Traits\HasGetCollection;
use App\Repositories\Base\Traits\HasRemove;

class FavoriteRepository extends AbstractRepository
{
    private $with = "favorite_options";
    public function __construct()
    {
        $this->model = new Favorite();
    }

    use HasGet;
    use HasGetCollection;
    use HasCreate;
    use HasRemove;
}
