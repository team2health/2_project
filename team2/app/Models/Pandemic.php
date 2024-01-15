<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pandemic extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = "pandemic_id";

    protected $fillable = [
        'pandemic_name',
        'pandemic_symptoms',
    ];

}
