<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board_tag extends Model
{
    use HasFactory;
    public function board()
    {
        return $this->belongsTo(Board::class, 'board_id', 'board_id');
    }

    public function hashtag()
    {
        return $this->belongsTo(Hashtag::class, 'hashtag_id', 'hashtag_id');
    }

    protected $fillable = ['board_id', 'hashtag_id'];

    public $timestamps = false;
}
