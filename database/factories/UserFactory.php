<?php

namespace Database\Factories;

use App\Models\Settings;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected static ?string $password;

    /**
     * Определение состояния по умолчанию модели.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'avatar_url' => $this->faker->imageUrl(640, 640),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->unique()->phoneNumber(),
            'user_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            "expo_token" => $this->faker->name(),
            "sub_date" => now()->addYear(1),
        ];
    }

    protected static function newFactory(): static
    {
        return parent::newFactory()->afterCreating(function (User $user) {
            Settings::create(['user_id' => $user->id]);
        });
    }
}
