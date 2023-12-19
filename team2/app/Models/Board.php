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
    public function images()
    {
        return $this->hasMany(Board_img::class, 'board_id', 'board_id');
    }
     public function tags()
     {
         return $this->belongsToMany(Board_tag::class, 'boardtag_id', 'board_id', 'hash_id');
     }
     public function usersid(){
        return $this->belongsTo(user::class,);        
    }
   public function comments()
    {
        return $this->hasMany(Comment::class, 'board_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    
}
