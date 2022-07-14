<?php

namespace App\Http\Requests;

use App\Models\Ingredient;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      title="Store Ingredient request",
 *      description="Store Ingredient request body data",
 *      type="object",
 *      required={"name", "supplier", "measure"}
 * )
 */
class StoreIngredientRequest extends FormRequest
{
    /**
     * @OA\Property
     *
     * @var string
     */
    private $name;

     /**
     * @OA\Property
     *
     * @var string
     */
    private $supplier;

     /**
     * @OA\Property(enum={"kg", "g", "pieces"})
     *
     * @var string
     */
    private $measure;

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
