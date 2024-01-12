<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Board extends Model
{
    use HasFactory;
    protected $primaryKey = 'board_id';
    protected $fillable =[
        'board_title'
        ,'board_content'
        ,'u_id'
        ,'category_id'
        ,'img_address'
        ,'hashtag_id'
        ,'updated_at'
        , 'created_at'
        
    ];
    public $timestamps = true;
    use SoftDeletes;
    
    public function images()
    {
        return $this->hasMany(Board_img::class, 'board_id', 'board_id');
    }

    public function hashtags()
    {
        return $this->belongsToMany(Hashtag::class, 'board_tags', 'board_id', 'hashtag_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'u_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'board_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }
    
    public function boardreports()
    {
        return $this->belongsToMany(Board_report::class, 'board_reports', 'board_id','u_id');
    }
   
    
}


