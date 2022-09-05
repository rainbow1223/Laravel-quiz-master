<?php

namespace App\Http\Controllers;

use App\Models\ExamGroup;
use Illuminate\Http\Request;

class ExamGroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function default_store(Request $request) {
        $exam_group = ExamGroup::create([
            'group_name' => 'Question Group',
            'exam_id' => $request->exam_id,
        ]);

        return $exam_group->id;
    }

    public function destroy(ExamGroup $exam_group)
    {

        $quizzes_id_array = [];

        $quizzes = $exam_group->quizes;

        foreach ($quizzes as $quiz) {
            array_push($quizzes_id_array, $quiz->id);
            $quiz->delete();
        }

        $exam_group->delete();

        return $quizzes_id_array;
    }
}
