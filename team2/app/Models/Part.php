<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    use HasFactory;
    public function symptoms()
    {
        return $this->belongsToMany(Symptom::class, 'part_symptoms', 'part_id', 'symptom_id')
        ->select('parts.part_name', 'parts.part_id'); 
    }
    protected $primaryKey = 'part_id';
}
