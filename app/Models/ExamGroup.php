<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamGroup extends Model
{
    use HasFactory;

    protected $table = 'exam_groups';
    protected $primaryKey = 'id';
    protected $fillable = ['group_name', 'exam_id'];

    public function quizes()
    {
        return $this->hasMany(Quiz::class, 'exam_group_id', 'id')->orderBy('order');
    }

    public function exam() {
        return $this->belongsTo(Exam::class, 'exam_id', 'id');
    }
}
