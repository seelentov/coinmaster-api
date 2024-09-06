<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Message;
use Illuminate\Database\Eloquent\Model;
use MoonShine\Resources\ModelResource;
use MoonShine\Fields\Field;
use MoonShine\Fields\Relationships\HasOne;
use MoonShine\Fields\Text;
use MoonShine\Fields\Date;
use MoonShine\Fields\Email;
use MoonShine\Fields\Password;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<Message>
 */
class MessageResource extends ModelResource
{
    protected string $model = Message::class;

    protected string $title = 'Messages';
    protected string $column = 'id';

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return parent::fields() + [
            HasOne::make('User')
                ->fields([
                    Text::make('name')->sortable(),
                    Email::make('email')->sortable(),
                    Text::make('phone')->sortable(),
                    Date::make('user_verified_at')->sortable(),
                    Password::make('password')->sortable(),
                    Text::make('expo_token'),
                    Date::make('sub_date')->sortable(),
                ])
        ];
    }

    /**
     * @param Message $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
