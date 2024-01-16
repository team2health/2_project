<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Symptom extends Model
{
    use HasFactory;
    public function parts()
    {
        return $this->belongsToMany(Part::class, 'part_symptoms', 'symptom_id', 'part_id');
    }
    protected $fillable = ['symptom_id', 'symptom_name'];
    protected $primaryKey = 'symptom_id';
    // use SoftDeletes;
}
