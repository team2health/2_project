<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board_report extends Model
{
    use HasFactory;

    protected $primaryKey = 'board_report_id';

    public function boardidreport()
    {
        return $this->belongsTo(Board::class, 'board_id','board_id');
    }
    public function boarduseridreport()
    {
        return $this->belongsTo(User::class, 'u_id','u_id');
    }
    protected $fillable = ['board_id', 'u_id', 'board_reason_flg'];

}
