<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MailVerify extends Model
{
    protected $table = 'mail_verification';

    use HasFactory;
    use SoftDeletes;
    
    protected $primaryKey = "mail_id";

    protected $fillable = [
        'user_email',
        'verification_code',
    ];

}
