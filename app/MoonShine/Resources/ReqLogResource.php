<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\ReqLog;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use MoonShine\Attributes\Icon;
use MoonShine\Resources\ModelResource;
use MoonShine\Fields\Text;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Fields\Date;
use MoonShine\Fields\Markdown;

/**
 * @extends ModelResource<User>
 */
#[Icon('heroicons.outline.exclamation-triangle')]
class ReqLogResource extends ModelResource
{
    protected string $model = ReqLog::class;

    protected string $title = 'Request logs';
    protected string $column = 'id';

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return parent::fields() + [
            Text::make('method'),
            Text::make('path'),
            Markdown::make('query_string', null, fn($item) => json_encode($item->query_string)),
            Markdown::make('body', null, fn($item) => json_encode($item->body)),
            Markdown::make('headers', null, fn($item) => json_encode($item->headers)),
            Text::make('ip'),
            Text::make('user_agent'),
            Text::make('res_status_code'),
            Markdown::make('res_headers', null, fn($item) => json_encode($item->res_headers)),
            Markdown::make('res_body', null, fn($item) => json_encode($item->res_body)),
            Date::make('created_at')->sortable(),
        ];
    }

    /**
     * @param ReqLog $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }

    public function getActiveActions(): array
    {
        return ['view'];
    }
}
