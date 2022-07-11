<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRecipeRequest extends FormRequest
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
            'description' => ['required', 'string'],
            'recipe_ingredients' => ['required', 'array'],
            'recipe_ingredients.*.ingredient_id' => ['required', 'exists:App\Models\Ingredient,id'],
            'recipe_ingredients.*.amount' => ['required', 'integer'],
        ];
    }
}
