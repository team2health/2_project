<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hashtag extends Model
{
    use HasFactory;

    protected $table = 'hashtags';
    public function boards()
    {
        return $this->belongsToMany(Board::class, 'board_tags', 'hashtag_id', 'board_id');
    }
}
