<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    // Whenever Changing Measure values, an update migration for measure enum column should be created
    const MEASURE_VALUES = ['kg', 'g', 'pieces'];

    protected $fillable = ['name', 'supplier', 'measure'];
}
