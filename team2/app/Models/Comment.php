<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;

    

    public $timestamps = ["created_at"]; //only want to used created_at column
	// const UPDATED_AT = null; //and updated by default null set
    protected $fillable = ['u_id', 'board_id', 'comment_id', 'comment_content'];

    public function user()
    {
        return $this->belongsTo(User::class, 'u_id','id')->withDefault();
    }
    public function board()
    {
        return $this->belongsTo(Board::class, 'board_id');
    }

    protected $primaryKey = 'comment_id';
    use SoftDeletes;
    

}
