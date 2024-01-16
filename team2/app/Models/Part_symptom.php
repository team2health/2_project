<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Part_symptom extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'part_symptom_id';
    public function connectparts()
    {
        return $this->belongsTo(Part::class, 'part_id','part_id');
    }
    public function connectsymptoms()
    {
        return $this->belongsTo(Symptom::class, 'symptom_id','symptom_id');
    }
    protected $fillable = ['symptom_id', 'part_id'];
    // use SoftDeletes;
}
