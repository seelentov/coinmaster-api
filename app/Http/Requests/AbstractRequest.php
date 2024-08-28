<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class AbstractRequest extends FormRequest
{
    public $baseGetter = [
        'perPage' => "string"
    ];

    public function authorize(): bool
    {
        return true;
    }
}
