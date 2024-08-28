<?php

namespace App\Http\Controllers\FavoriteOption;

use App\Http\Controllers\Controller;
use App\Repositories\Favorite\FavoriteRepository;
use App\Repositories\FavoriteOption\FavoriteOptionRepository;

class BaseController extends Controller
{
    public function __construct(
        protected readonly FavoriteOptionRepository $favoriteOptions,
        protected readonly FavoriteRepository $favorites
    ) {}
}
