<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Record extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $timestamps = ["created_at"]; //only want to used created_at column
	const UPDATED_AT = null; //and updated by default null set

    protected $fillable = [
        'u_id',
        'part_symptom_id',
    ];
    
    protected $primaryKey = 'record_id';
}
