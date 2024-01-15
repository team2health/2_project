<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hashtag extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $primaryKey = "hashtag_id";
    
    protected $fillable = [
        'hashtag_name',
    ];

    public function boards()
    {
        return $this->belongsToMany(Board::class, 'board_tags', 'hashtag_id', 'board_id');
    }
    public $incrementing = true;
    protected static function boot()
    {
        parent::boot();

        // static::creating(function ($model) {
        //     if (empty($model->hashtag_id)) {
        //         $model->hashtag_id = 0; // 또는 다른 기본값 설정
        //     }
        // });
    }
}
