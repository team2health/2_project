<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment_report extends Model
{
    use HasFactory;
    public function commentidreports()
    {
        return $this->belongsTo(Comment::class, 'comment_id','comment_id');
    }
    public function commentuserreports()
    {
        return $this->belongsTo(User::class, 'u_id','u_id');
    }
    protected $fillable =['comment_id','u_id', 'comment_reason_flg'];
}
