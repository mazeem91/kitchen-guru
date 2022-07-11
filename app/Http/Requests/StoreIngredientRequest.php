<?php

namespace App\Http\Requests;

use App\Models\Ingredient;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreIngredientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'supplier' => ['required', 'string'],
            'measure' => ['required', Rule::in(Ingredient::MEASURE_VALUES)],
        ];
    }
}
