<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;
    
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
    
    public function commentreports()
    {
        return $this->belongsToMany(Comment_report::class, 'comment_reports', 'comment_id','u_id');
    }
}
