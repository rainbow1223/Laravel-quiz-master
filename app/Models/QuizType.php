<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizType extends Model
{
    use HasFactory;

    protected $table = 'quiz_type';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'description'];
}
