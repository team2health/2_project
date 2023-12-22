<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hashtag extends Model
{
    use HasFactory;
    protected $primaryKey = "hashtag_id";
    protected $fillable = [
        'hashtag_name',
        'hashtag_id'
    ];
    protected $table = 'hashtags';
    public function boards()
    {
        return $this->belongsToMany(Board::class, 'hashtag_id', 'hashtag_id');
    }
}
