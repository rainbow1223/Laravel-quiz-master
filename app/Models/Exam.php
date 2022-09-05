<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $table = 'exams';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'description', 'author_id', 'attempt_number', 'status', 'passing_score', 'screen_height', 'screen_width', 'stuff_emails', 'downloaded', 'published', 'email_from', 'email_subject', 'email_comment', 'exam_icon'];

    public function exam_groups()
    {
        return $this->hasMany(ExamGroup::class, 'exam_id', 'id');
    }

    public function get_all_questions() {
        $questions = [];

        foreach ($this->exam_groups as $item) {
            array_push($questions, $item->quizes);
        }

        return $questions;
    }

    public function results()
    {
        return $this->hasMany(Result::class, 'exam_id', 'id');
    }
}
