<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board_img extends Model
{
    use HasFactory;
    protected $fillable = [
        'board_id', 'img_address'
    ];
    public function boardImgs()
{
    return $this->hasMany(BoardImg::class);
}
}

