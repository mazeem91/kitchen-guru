<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      title="Store MemberBox request",
 *      description="Store MemberBox request body data",
 *      type="object",
 *      required={"delivery_date", "recipe_ids"}
 * )
 */
class StoreMemberBoxRequest extends FormRequest
{
    /**
     * @OA\Property(example="2022-07-10")
     *
     * @var date
     */
    private $delivery_date;

     /**
     * @OA\Property
     *
     * @var int[]
     */
    private $recipe_ids;

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
