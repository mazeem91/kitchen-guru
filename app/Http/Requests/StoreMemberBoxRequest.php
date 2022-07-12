<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMemberBoxRequest extends FormRequest
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
            'delivery_date' => ['required', 'date', 'after:+2 days'],
            'recipe_ids' => ['required', 'array', 'max:4'],
            'recipe_ids.*' => ['exists:App\Models\Recipe,id']
        ];
    }
}
