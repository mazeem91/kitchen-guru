<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(@OA\Xml(name="Ingredient"))
 */
class Ingredient extends Model
{
    use HasFactory;

    // Whenever Changing Measure values, an update migration for measure enum column should be created
    const MEASURE_VALUES = ['kg', 'g', 'pieces'];

    protected $fillable = ['name', 'supplier', 'measure'];

    /**
     * @OA\Property(example="new ingredient")
     *
     * @var string
     */
    private $name;

     /**
     * @OA\Property(example="new ingredient supplier")
     *
     * @var string
     */
    private $supplier;

     /**
     * @OA\Property(enum={"kg", "g", "pieces"}, example="g")
     *
     * @var string
     */
    private $measure;

}
