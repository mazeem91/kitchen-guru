<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(@OA\Xml(name="Recipe"))
 */
class Recipe extends Model
{
    use HasFactory;

    protected $with = ['recipe_ingredients'];
    protected $fillable = ['name', 'description'];

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

    public function recipe_ingredients()
    {
        return $this->hasMany(RecipeIngredient::class);
    }
}
