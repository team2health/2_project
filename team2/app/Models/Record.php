<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;

    public $timestamps = ["created_at"]; //only want to used created_at column
	const UPDATED_AT = null; //and updated by default null set
}
