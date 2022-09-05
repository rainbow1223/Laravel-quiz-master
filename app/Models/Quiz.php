<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $table = 'quizes';
    protected $primaryKey = 'id';

    protected $fillable = ['exam_group_id', 'type_id', 'question_element', 'answer', 'feedback_correct', 'feedback_incorrect', 'feedback_try_again', 'media', 'answer_element', 'order', 'question_type', 'feedback_type', 'branching', 'score', 'attempts', 'is_limit_time', 'limit_time', 'shuffle_answers', 'partially_correct', 'limit_number_response', 'case_sensitive', 'correct_score', 'incorrect_score', 'try_again_score', 'media_element', 'other_elements', 'background_img', 'video', 'audio', 'video_element', 'audio_element'];


    public function Quiz_type()
    {
        return $this->belongsTo(QuizType::class, 'type_id', 'id');
    }

    public function exam_group()
    {
        return $this->belongsTo(ExamGroup::class, 'exam_group_id', 'id');
    }

}
