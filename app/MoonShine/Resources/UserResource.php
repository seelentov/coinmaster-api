<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use MoonShine\Attributes\Icon;
use MoonShine\Resources\ModelResource;
use MoonShine\Fields\Text;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Fields\Date;
use MoonShine\Fields\Email;
use MoonShine\Fields\Password;

/**
 * @extends ModelResource<User>
 */
#[Icon('heroicons.outline.user')]
class UserResource extends ModelResource
{
    protected string $model = User::class;

    protected string $title = 'Пользователи';
    protected string $column = 'id';

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return parent::fields() + [
            Text::make('name')->sortable(),
            Email::make('email')->sortable(),
            Text::make('phone')->sortable(),
            Date::make('user_verified_at')->sortable(),
            Password::make('password')->sortable(),
            Text::make('expo_token'),
            Date::make('sub_date')->sortable(),
        ];
    }

    /**
     * @param User $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
