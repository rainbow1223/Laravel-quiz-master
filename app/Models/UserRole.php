<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;

    protected $table = 'users_roles';
    protected $fillable = ['user_id', 'role_id'];
    public $timestamps = false;
    protected $primaryKey = null;
    public $incrementing = false;
}
