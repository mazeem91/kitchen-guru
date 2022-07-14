<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(@OA\Xml(name="MemberBox"))
 */
class MemberBox extends Model
{
    use HasFactory;
    protected $with = ['recipes'];
    protected $fillable = ['user_id', 'delivery_date'];

    /**
     * @OA\Property(example=1)
     *
     * @var int
     */
    private $user_id;

     /**
     * @OA\Property(example="2022-07-20")
     *
     * @var date
     */
    private $delivery_date;

     /**
     * @OA\Property
     *
     * @var \App\Models\Recipe[]
     */
    private $recipes;

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class, MemberBoxRecipe::class);
    }
}
