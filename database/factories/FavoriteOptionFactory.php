<?php

namespace Database\Factories;

use App\Models\Favorite;
use App\Models\FavoriteOption;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class FavoriteOptionFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'time_type' => $this->faker->randomElement(FavoriteOption::getTimeTypes()),
            'time_count' => $this->faker->numberBetween(1, 12),
            'value_count' => $this->faker->numberBetween(0, 100),
            'value_type' => $this->faker->randomElement(FavoriteOption::getValueTypes()),
            'option_type' => $this->faker->randomElement(FavoriteOption::getOptionTypes()),
            'favorite_id' => Favorite::inRandomOrder()->first()->id,
            'name' => fake()->name(),
        ];
    }
}
