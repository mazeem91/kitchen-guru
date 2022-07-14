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

}
