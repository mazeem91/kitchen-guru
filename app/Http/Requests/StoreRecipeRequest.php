<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      title="Store Recipe request",
 *      description="Store Recipe request body data",
 *      type="object",
 *      required={"name", "description", "recipe_ingredients"}
 * )
 */
class StoreRecipeRequest extends FormRequest
{
    /**
     * @OA\Property(example="new recipe")
     *
     * @var string
     */
    private $name;

     /**
     * @OA\Property(example="new recipe description")
     *
     * @var string
     */
    private $description;

     /**
     * @OA\Property
     *
     * @var \App\Models\RecipeIngredient[]
     */
    private $recipe_ingredients;

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
            'recipe_ingredients.*.ingredient_id' => ['required', 'distinct', 'exists:App\Models\Ingredient,id'],
            'recipe_ingredients.*.amount' => ['required', 'integer'],
        ];
    }
}
