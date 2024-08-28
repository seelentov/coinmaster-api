<?php

namespace App\Http\Controllers\Favorite;

use App\Http\Controllers\Controller;
use App\Repositories\Favorite\FavoriteRepository;
use App\Services\ValuteService;

class BaseController extends Controller
{
    public function __construct(
        protected readonly FavoriteRepository $favorites
    ) {}
}
