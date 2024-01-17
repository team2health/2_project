<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Illuminate\Auth\Middleware\Admin;

class Admin extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;

    public function isAdmin()
    {
        return $this->admin_id === 'admin'; 
    }

    protected $primaryKey = 'id';


    protected $fillable = [
        'admin_id',
        'admin_name',
        'admin_password',
    ];

    protected $hidden = [
        'admin_password',
        'remember_token',
    ];
    
}
