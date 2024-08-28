<?php

namespace Database\Seeders;

use App\Models\Chat;
use App\Models\User;
use App\Models\Favorite;
use App\Models\FavoriteOption;
use App\Models\Message;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(2)->create();
        Favorite::factory(10)->create();
        FavoriteOption::factory(20)->create();
        Chat::factory(3)->create();
        Message::factory(20)->create();
    }
}
