<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @OA\Schema(@OA\Xml(name="RecipeIngredient"))
 */
class RecipeIngredient extends Model
{
    use HasFactory;

    protected $fillable = ['recipe_id', 'ingredient_id', 'amount', 'amount_measure'];

    /**
     * @OA\Property(example=1)
     *
     * @var int
     */
    private $ingredient_id;

     /**
     * @OA\Property(example=20)
     *
     * @var int
     */
    private $amount;
}
