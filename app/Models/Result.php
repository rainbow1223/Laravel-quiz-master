<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $table = 'results';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'exam_id', 'result'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // public function exam() {
    //     return $this->belongsTo(Exam::class, 'exam_id', 'id');
    // }
}
