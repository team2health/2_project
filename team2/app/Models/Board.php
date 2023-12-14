<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    use HasFactory;
    protected $primaryKey = 'board_id';
    protected $fillable =[
        'board_title'
        ,'board_content'
        ,'u_id'
        ,'category_id'
        
    ];
}
