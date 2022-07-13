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
     * @OA\Property
     *
     * @var int
     */
    private $ingredient_id;

     /**
     * @OA\Property
     *
     * @var int
     */
    private $amount;

     /**
     * @OA\Property(enum={"kg", "g", "pieces"})
     *
     * @var string
     */
    private $amount_measure;
}
