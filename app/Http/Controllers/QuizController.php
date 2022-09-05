<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Exam;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Integer;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(string $quiz_type, string $exam_id)
    {
        return view('quizes.create', ['exam_id' => $exam_id, 'quiz_type' => $quiz_type]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $order_updating_quizzes = Quiz::where('order', '>=', $request->order)->get();
        foreach ($order_updating_quizzes as $item) {
            if (isset($item->exam_group)) {
                if ($item->exam_group->id == $request->exam_group_id) {
                    $item->order = $item->order + 1;
                    $item->save();
                }
            }
        }

        switch ($request->type_id) {
            case "1":
                $quiz = Quiz::create([
                    'exam_group_id' => $request->exam_group_id,
                    'type_id' => $request->type_id,
                    'question_element' => '<div class="slide_view_question_element slide_view_group" style="height: 70px;width: 80%;left: 10%;z-index: 3;overflow: hidden;padding:10px;position:absolute;"><div contenteditable="true" class="cancel_drag">Select the correct answer option:</div></div>',
                    'answer' => '1',
                    'feedback_correct' => 'That\'s right! You chose the correct response.',
                    'feedback_incorrect' => 'You did not choose the correct response.',
                    'feedback_try_again' => 'You did not choose the correct response. Try again.',
                    'media' => null,
                    'order' => $request->order,
                    'answer_element' => '<div class="slide_view_answer_element slide_view_group" style="width: 80%;top: 100px;left: 10%;z-index: 2;position:absolute;overflow:hidden;"><div class="col-md-12"><div class="choice_item"><input type="radio" id="1" name="answer" value="1" style="padding-right: 10px;"><label for="1">Option 1</label></div><div class="choice_item"><input type="radio" id="2" name="answer" value="2" style="padding-right: 10px;"><label for="2">Option 2</label></div><div class="choice_item"><input type="radio" id="3" name="answer" value="3" style="padding-right: 10px;"><label for="3">Option 3</label></div></div></div>',
                    'question_type' => 'graded',
                    'feedback_type' => 'by_result',
                    'branching' => 'by_result',
                    'score' => 'by_result',
                    'attempts' => '1',
                    'is_limit_time' => false,
                    'limit_time' => null,
                    'shuffle_answers' => true,
                    'partially_correct' => null,
                    'limit_number_response' => null,
                    'case_sensitive' => null,
                    'correct_score' => 10,
                    'incorrect_score' => 0,
                    'try_again_score' => 0,
                ]);

                break;

            case "2":
                $quiz = Quiz::create([
                    'exam_group_id' => $request->exam_group_id,
                    'type_id' => $request->type_id,
                    'question_element' => '<div class="slide_view_question_element slide_view_group" style="height: 70px;width: 80%;left: 10%;z-index: 3;overflow: hidden;padding:10px;position:absolute;"><div contenteditable="true" class="cancel_drag">Select one or more correct answers:</div></div>',
                    'answer' => '1;',
                    'feedback_correct' => 'That\'s right! You chose the correct response.',
                    'feedback_incorrect' => 'You did not choose the correct response.',
                    'feedback_try_again' => 'You did not choose the correct response. Try again.',
                    'media' => null,
                    'order' => $request->order,
                    'answer_element' => '<div class="slide_view_answer_element slide_view_group" style="width: 80%;top: 100px;left: 10%;z-index: 2;position:absolute;overflow:hidden;"><div class="col-md-12"><div class="response_item"><input type="checkbox" id="1" name="answer" value="1" style="padding-right: 10px;"><label for="1">Option 1</label></div><div class="response_item"><input type="checkbox" id="2" name="answer" value="2" style="padding-right: 10px;"><label for="2">Option 2</label></div><div class="response_item"><input type="checkbox" id="3" name="answer" value="3" style="padding-right: 10px;"><label for="3">Option 3</label></div></div></div>',
                    'question_type' => 'graded',
                    'feedback_type' => 'by_result',
                    'branching' => null,
                    'score' => 'by_result',
                    'attempts' => '1',
                    'is_limit_time' => false,
                    'limit_time' => null,
                    'shuffle_answers' => true,
                    'partially_correct' => false,
                    'limit_number_response' => false,
                    'case_sensitive' => null,
                    'correct_score' => 10,
                    'incorrect_score' => 0,
                    'try_again_score' => 0,
                ]);

                break;

            case "3":
                $quiz = Quiz::create([
                    'exam_group_id' => $request->exam_group_id,
                    'type_id' => $request->type_id,
                    'question_element' => '<div class="slide_view_question_element slide_view_group" style="height: 70px;width: 80%;left: 10%;z-index: 3;overflow: hidden;padding:10px;position:absolute;"><div contenteditable="true" class="cancel_drag">Choose whether the statement is true or false:</div></div>',
                    'answer' => '1',
                    'feedback_correct' => 'That\'s right! You chose the correct response.',
                    'feedback_incorrect' => 'You did not choose the correct response.',
                    'feedback_try_again' => 'You did not choose the correct response. Try again.',
                    'media' => null,
                    'order' => $request->order,
                    'answer_element' => '<div class="slide_view_answer_element slide_view_group" style="width: 80%;top: 100px;left: 10%;z-index: 2;position:absolute;overflow:hidden;"><div class="col-md-12"><div class="choice_item"><input type="radio" id="true" name="answer" value="1" style="padding-right: 10px;"><label for="true">True</label></div><div class="choice_item"><input type="radio" id="false" name="answer" value="0" style="padding-right: 10px;"><label for="false">False</label></div></div></div>',
                    'question_type' => 'graded',
                    'feedback_type' => 'by_result',
                    'branching' => null,
                    'score' => null,
                    'attempts' => '1',
                    'is_limit_time' => false,
                    'limit_time' => null,
                    'shuffle_answers' => null,
                    'partially_correct' => null,
                    'limit_number_response' => null,
                    'case_sensitive' => null,
                    'correct_score' => 10,
                    'incorrect_score' => 0,
                    'try_again_score' => 0,
                ]);

                break;

            case "4":
                $quiz = Quiz::create([
                    'exam_group_id' => $request->exam_group_id,
                    'type_id' => $request->type_id,
                    'question_element' => '<div class="slide_view_question_element slide_view_group" style="height: 70px;width: 80%;left: 10%;z-index: 3;overflow: hidden;padding:10px;position:absolute;"><div contenteditable="true" class="cancel_drag">Type your response:</div></div>',
                    'answer' => 'Correct Answer 1',
                    'feedback_correct' => 'That\'s right! You chose the correct response.',
                    'feedback_incorrect' => 'You did not choose the correct response.',
                    'feedback_try_again' => 'You did not choose the correct response. Try again.',
                    'media' => null,
                    'order' => $request->order,
                    'answer_element' => '<div class="slide_view_answer_element slide_view_group" style="width: 80%;top: 100px;left: 10%;z-index: 2;position:absolute;overflow:hidden;"><div class="col-md-12"><input id="answer" type="text" class="form-control" name="answer" autocomplete="answer"></div></div>',
                    'question_type' => 'graded',
                    'feedback_type' => 'by_result',
                    'branching' => null,
                    'score' => null,
                    'attempts' => '1',
                    'is_limit_time' => false,
                    'limit_time' => null,
                    'shuffle_answers' => null,
                    'partially_correct' => null,
                    'limit_number_response' => null,
                    'case_sensitive' => false,
                    'correct_score' => 10,
                    'incorrect_score' => 0,
                    'try_again_score' => 0,
                ]);

                break;

            case "5":
                $quiz = Quiz::create([
                    'exam_group_id' => $request->exam_group_id,
                    'type_id' => $request->type_id,
                    'question_element' => '<div class="slide_view_question_element slide_view_group" style="height: 70px;width: 80%;left: 10%;z-index: 3;overflow: hidden;padding:10px;position:absolute;"><div contenteditable="true" class="cancel_drag">Type your response:</div></div>',
                    'answer' => '==;0;@',
                    'feedback_correct' => 'That\'s right! You chose the correct response.',
                    'feedback_incorrect' => 'You did not choose the correct response.',
                    'feedback_try_again' => 'You did not choose the correct response. Try again.',
                    'media' => null,
                    'order' => $request->order,
                    'answer_element' => '<div class="slide_view_answer_element slide_view_group" style="width: 80%;top: 100px;left: 10%;z-index: 2;position:absolute;overflow:hidden;"><div class="col-md-12"><input id="answer" type="number" class="form-control" name="answer" autocomplete="answer"></div></div>',
                    'question_type' => 'graded',
                    'feedback_type' => 'by_result',
                    'branching' => null,
                    'score' => null,
                    'attempts' => '1',
                    'is_limit_time' => false,
                    'limit_time' => null,
                    'shuffle_answers' => null,
                    'partially_correct' => null,
                    'limit_number_response' => null,
                    'case_sensitive' => null,
                    'correct_score' => 10,
                    'incorrect_score' => 0,
                    'try_again_score' => 0,
                ]);

                break;

            case "6":
                $quiz = Quiz::create([
                    'exam_group_id' => $request->exam_group_id,
                    'type_id' => $request->type_id,
                    'question_element' => '<div class="slide_view_question_element slide_view_group" style="height: 70px;width: 80%;left: 10%;z-index: 3;overflow: hidden;padding:10px;position:absolute;"><div contenteditable="true" class="cancel_drag">Arrange the following items in the correct order:</div></div>',
                    'answer' => 'Option 1;Option 2;Option 3;Option 4;',
                    'feedback_correct' => 'That\'s right! You chose the correct response.',
                    'feedback_incorrect' => 'You did not choose the correct response.',
                    'feedback_try_again' => 'You did not choose the correct response. Try again.',
                    'media' => null,
                    'order' => $request->order,
                    'answer_element' => '<div class="slide_view_answer_element slide_view_group" style="width: 80%;top: 100px;left: 10%;z-index: 2;position:absolute;overflow:hidden;"><div class="col-md-12"><ul id="sortable"><li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><label class="sequence_label" data-editable>Option 1</label></li><li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><label class="sequence_label" data-editable>Option 2</label></li><li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><label class="sequence_label" data-editable>Option 3</label></li><li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span><label class="sequence_label" data-editable>Option 4</label></li></ul></div></div>',
                    'question_type' => 'graded',
                    'feedback_type' => 'by_result',
                    'branching' => null,
                    'score' => null,
                    'attempts' => '1',
                    'is_limit_time' => false,
                    'limit_time' => null,
                    'shuffle_answers' => null,
                    'partially_correct' => false,
                    'limit_number_response' => null,
                    'case_sensitive' => null,
                    'correct_score' => 10,
                    'incorrect_score' => 0,
                    'try_again_score' => 0,
                ]);

                break;

            case "7":
                $quiz = Quiz::create([
                    'exam_group_id' => $request->exam_group_id,
                    'type_id' => $request->type_id,
                    'question_element' => '<div class="slide_view_question_element slide_view_group" style="height: 70px;width: 80%;left: 10%;z-index: 3;overflow: hidden;padding:10px;position:absolute;"><div contenteditable="true" class="cancel_drag">Match the following items with their descriptions:</div></div>',
                    'answer' => 'Item 1;Match 1@Item 2;Match 2@Item 3;Match 3@',
                    'feedback_correct' => 'That\'s right! You chose the correct response.',
                    'feedback_incorrect' => 'You did not choose the correct response.',
                    'feedback_try_again' => 'You did not choose the correct response. Try again.',
                    'media' => null,
                    'order' => $request->order,
                    'answer_element' => '<div class="slide_view_answer_element slide_view_group" style="width: 80%;top: 100px;left: 10%;z-index: 2;position:absolute;overflow:hidden;"><div class="col-md-12"><div style="display: flex;justify-content: space-around;padding-bottom: 10px;"><div class="ui-widget-header droppable" style="width: 40%"><p>Item 1</p></div><div class="ui-widget-content draggable" style="width: 40%" isdropped=false><p>Match 1</p></div></div><div style="display: flex;justify-content: space-around;padding-bottom: 10px;"><div class="ui-widget-header droppable" style="width: 40%"><p>Item 2</p></div><div class="ui-widget-content draggable" style="width: 40%" isdropped=false><p>Match 2</p></div></div><div style="display: flex;justify-content: space-around;padding-bottom: 10px;"><div class="ui-widget-header droppable" style="width: 40%"><p>Item 3</p></div><div class="ui-widget-content draggable" style="width: 40%" isdropped=false><p>Match 3</p></div></div></div></div>',
                    'question_type' => 'graded',
                    'feedback_type' => 'by_result',
                    'branching' => null,
                    'score' => null,
                    'attempts' => '1',
                    'is_limit_time' => false,
                    'limit_time' => null,
                    'shuffle_answers' => true,
                    'partially_correct' => false,
                    'limit_number_response' => null,
                    'case_sensitive' => null,
                    'correct_score' => 10,
                    'incorrect_score' => 0,
                    'try_again_score' => 0,
                ]);

                break;

            case "8":
                $quiz = Quiz::create([
                    'exam_group_id' => $request->exam_group_id,
                    'type_id' => $request->type_id,
                    'question_element' => '<div class="slide_view_question_element slide_view_group" style="height: 70px;width: 80%;left: 10%;z-index: 3;overflow: hidden;padding:10px;position:absolute;"><div contenteditable="true" class="cancel_drag">Fill in the blank fields in this text:</div></div>',
                    'answer' => 'blanks;@',
                    'feedback_correct' => 'That\'s right! You chose the correct response.',
                    'feedback_incorrect' => 'You did not choose the correct response.',
                    'feedback_try_again' => 'You did not choose the correct response. Try again.',
                    'media' => null,
                    'order' => $request->order,
                    'answer_element' => '<div class="slide_view_answer_element slide_view_group" style="width: 80%;top: 100px;left: 10%;z-index: 2;position:absolute;overflow:hidden;"><div class="col-md-12">Fill in the <div class="fill_blanks_dropdown" contenteditable="true" style="display: inline;"><div class="fill_blanks_dropdown_body" contenteditable="false"  style="display: inline;"><input id="0" type="text" style="max-width: 100px;"></div></div></div></div>',
                    'question_type' => 'graded',
                    'feedback_type' => 'by_result',
                    'branching' => null,
                    'score' => null,
                    'attempts' => '1',
                    'is_limit_time' => false,
                    'limit_time' => null,
                    'shuffle_answers' => null,
                    'partially_correct' => false,
                    'limit_number_response' => null,
                    'case_sensitive' => false,
                    'correct_score' => 10,
                    'incorrect_score' => 0,
                    'try_again_score' => 0,
                ]);

                break;

            case "9":
                $quiz = Quiz::create([
                    'exam_group_id' => $request->exam_group_id,
                    'type_id' => $request->type_id,
                    'question_element' => '<div class="slide_view_question_element slide_view_group" style="height: 70px;width: 80%;left: 10%;z-index: 3;overflow: hidden;padding:10px;position:absolute;"><div contenteditable="true" class="cancel_drag">Choose the correct answer in each drop-down list:</div></div>',
                    'answer' => 'answer 1;',
                    'feedback_correct' => 'That\'s right! You chose the correct response.',
                    'feedback_incorrect' => 'You did not choose the correct response.',
                    'feedback_try_again' => 'You did not choose the correct response. Try again.',
                    'media' => null,
                    'order' => $request->order,
                    'answer_element' => '<div class="slide_view_answer_element slide_view_group" style="width: 80%;top: 100px;left: 10%;z-index: 2;position:absolute;overflow:hidden;"><div class="col-md-12">Choose the correct <div class="select_lists_dropdown" contenteditable="true" style="display: inline;"><div class="select_lists_dropdown_body" contenteditable="false"  style="display: inline;"><select id="0"><option value="none">- Select -</option><option value="answer 1">Answer 1</option><option value="answer 2">Answer 2</option></select></div></div></div></div>',
                    'question_type' => 'graded',
                    'feedback_type' => 'by_result',
                    'branching' => null,
                    'score' => null,
                    'attempts' => '1',
                    'is_limit_time' => false,
                    'limit_time' => null,
                    'shuffle_answers' => false,
                    'partially_correct' => false,
                    'limit_number_response' => null,
                    'case_sensitive' => null,
                    'correct_score' => 10,
                    'incorrect_score' => 0,
                    'try_again_score' => 0,
                ]);

                break;

            case "10":
                $quiz = Quiz::create([
                    'exam_group_id' => $request->exam_group_id,
                    'type_id' => $request->type_id,
                    'question_element' => '<div class="slide_view_question_element slide_view_group" style="height: 70px;width: 80%;left: 10%;z-index: 3;overflow: hidden;padding:10px;position:absolute;"><div contenteditable="true" class="cancel_drag">Drag and drop the words to their places:</div></div>',
                    'answer' => 'words;places;',
                    'feedback_correct' => 'That\'s right! You chose the correct response.',
                    'feedback_incorrect' => 'You did not choose the correct response.',
                    'feedback_try_again' => 'You did not choose the correct response. Try again.',
                    'media' => null,
                    'order' => $request->order,
                    'answer_element' => '<div class="slide_view_answer_element slide_view_group" style="width: 80%;top: 100px;left: 10%;z-index: 2;position:absolute;overflow:hidden;"><div class="col-md-12"><div id="slide_drag_words_question">Drag the <div class="blank" style="display:inline;width: 70px;height: 100%;border: 1px solid grey;background: white;"></div> and drop them to the appropriate <div class="blank" style="display:inline;width: 70px;height: 100%;border: 1px solid grey;background: white;"></div> .</div><div id="slide_drag_words_answer"><span style="border: 1px solid gray;background: white;color: black;">words</span><span style="border: 1px solid gray;background: white;color:black;">places</span></div></div></div>',
                    'question_type' => 'graded',
                    'feedback_type' => 'by_result',
                    'branching' => null,
                    'score' => null,
                    'attempts' => '1',
                    'is_limit_time' => false,
                    'limit_time' => null,
                    'shuffle_answers' => null,
                    'partially_correct' => false,
                    'limit_number_response' => null,
                    'case_sensitive' => null,
                    'correct_score' => 10,
                    'incorrect_score' => 0,
                    'try_again_score' => 0,
                ]);

                break;

            case "11":
                $quiz = Quiz::create([
                    'exam_group_id' => $request->exam_group_id,
                    'type_id' => $request->type_id,
                    'question_element' => '<div class="slide_view_question_element slide_view_group" style="height: 70px;width: 80%;left: 10%;z-index: 3;overflow: hidden;padding:10px;position:absolute;"><div contenteditable="true" class="cancel_drag">Click on the correct area in the image.</div></div>',
                    'answer' => '',
                    'feedback_correct' => 'That\'s right! You chose the correct response.',
                    'feedback_incorrect' => 'You did not choose the correct response.',
                    'feedback_try_again' => 'You did not choose the correct response. Try again.',
                    'media' => null,
                    'order' => $request->order,
                    'answer_element' => '<div class="slide_view_answer_element slide_view_group" style="width: 80%;top: 100px;left: 10%;z-index: 2;position:absolute;overflow:hidden;"><div class="col-md-12"><canvas id="slide_view_hotspots_canvas" height="214"></canvas></div></div>',
                    'question_type' => 'graded',
                    'feedback_type' => 'by_result',
                    'branching' => null,
                    'score' => null,
                    'attempts' => '1',
                    'is_limit_time' => false,
                    'limit_time' => null,
                    'shuffle_answers' => null,
                    'partially_correct' => false,
                    'limit_number_response' => null,
                    'case_sensitive' => null,
                    'correct_score' => 10,
                    'incorrect_score' => 0,
                    'try_again_score' => 0,
                ]);

                break;

            case "12":
                $quiz = Quiz::create([
                    'exam_group_id' => $request->exam_group_id,
                    'type_id' => $request->type_id,
                    'question_element' => '<div class="slide_view_question_element slide_view_group" style="height: 70px;width: 80%;left: 10%;z-index: 3;overflow: hidden;padding:10px;position:absolute;"><div contenteditable="true" class="cancel_drag">Title</div></div>',
                    'answer' => '',
                    'feedback_correct' => 'That\'s right! You chose the correct response.',
                    'feedback_incorrect' => 'You did not choose the correct response.',
                    'feedback_try_again' => 'You did not choose the correct response. Try again.',
                    'media' => null,
                    'order' => $request->order,
                    'answer_element' => '<div class="slide_view_answer_element slide_view_group" style="width: 80%;top: 100px;left: 10%;z-index: 2;padding: 10px;position:absolute;"><div class="col-md-12"><div contenteditable="true" class="cancel_drag">Description text</div></div></div>',
                    'question_type' => 'graded',
                    'feedback_type' => 'by_result',
                    'branching' => null,
                    'score' => null,
                    'attempts' => '1',
                    'is_limit_time' => false,
                    'limit_time' => null,
                    'shuffle_answers' => null,
                    'partially_correct' => false,
                    'limit_number_response' => null,
                    'case_sensitive' => null,
                    'correct_score' => 0,
                    'incorrect_score' => 0,
                    'try_again_score' => 0,
                ]);

                break;

            case "13":
                $quiz = Quiz::create([
                    'exam_group_id' => $request->exam_group_id,
                    'type_id' => $request->type_id,
                    'question_element' => '<div class="slide_view_question_element slide_view_group" style="height: 70px;width: 80%;left: 10%;z-index: 3;overflow: hidden;padding:10px;position:absolute;"><div contenteditable="true" class="cancel_drag">Quiz Instructions</div></div>',
                    'answer' => '',
                    'feedback_correct' => 'That\'s right! You chose the correct response.',
                    'feedback_incorrect' => 'You did not choose the correct response.',
                    'feedback_try_again' => 'You did not choose the correct response. Try again.',
                    'media' => null,
                    'order' => $request->order,
                    'answer_element' => '<div class="slide_view_answer_element slide_view_group" style="width: 80%;top: 100px;left: 10%;z-index: 2;padding: 10px;position:absolute;"><div class="col-md-12"><div contenteditable="true" class="cancel_drag"><div>Before attempting, carefully read the question text.</div><div>Then choose the correct answer.</div><div>Click on “Submit” to confirm your answer.</div><div>Use the Question List in the upper left corner to jump to a certain question.</div></div></div></div>',
                    'question_type' => 'graded',
                    'feedback_type' => 'by_result',
                    'branching' => null,
                    'score' => null,
                    'attempts' => '1',
                    'is_limit_time' => false,
                    'limit_time' => null,
                    'shuffle_answers' => null,
                    'partially_correct' => false,
                    'limit_number_response' => null,
                    'case_sensitive' => null,
                    'correct_score' => 0,
                    'incorrect_score' => 0,
                    'try_again_score' => 0,
                ]);

                break;

            default:
        }

        $exam = Exam::find($request->exam_id);
        $exam->downloaded = 0;
        $exam->save();
        $exam->touch();

        return $quiz->id;

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Quiz $quiz
     * @return \Illuminate\Http\Response
     */
    public function show(Quiz $quiz)
    {
        if ($quiz->type_id == 6) {
            $sequence_array = explode(';', $quiz->answer);
            array_pop($sequence_array);
            $quiz->sequence_array = $sequence_array;
        }
        if ($quiz->type_id == 7) {
            $matching = explode('@', $quiz->answer);
            array_pop($matching);

            $matching_array = [];
            $item_array = [];

            foreach ($matching as $item) {
                array_push($item_array, explode(';', $item)[0]);
                array_push($matching_array, explode(';', $item)[1]);
            }

            shuffle($matching_array);

            $quiz->item_array = $item_array;
            $quiz->matching_array = $matching_array;
        }
        return view('quizes.show', ['quiz' => $quiz]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Quiz $quiz
     * @return \Illuminate\Http\Response
     */
    public function edit(Quiz $quiz)
    {
        if ($quiz->type_id == 16) {
            $user_info = json_decode($quiz->answer);
            $quiz->user_info = $user_info;
        }
        return view('quizes.update', ['quiz' => $quiz]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Quiz $quiz
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quiz $quiz)
    {
        $quiz->question_element = $request->question_element;
        $quiz->answer = $request->answer;
        $quiz->feedback_correct = $request->feedback_correct;
        $quiz->feedback_incorrect = $request->feedback_incorrect;
        $quiz->feedback_try_again = $request->feedback_try_again;
        $quiz->media = $request->media;
        $quiz->video = $request->video;
        $quiz->audio = $request->audio;
        $quiz->media_element = $request->media_element;
        $quiz->video_element = $request->video_element;
        $quiz->background_img = $request->background_img;
//        $quiz->order = $request->order;
        $quiz->answer_element = $request->answer_element;
        $quiz->question_type = $request->question_type;
        $quiz->feedback_type = $request->feedback_type;
        $quiz->branching = $request->branching;
        $quiz->score = $request->score;
        $quiz->attempts = $request->attempts;
        $quiz->is_limit_time = $request->is_limit_time;
        $quiz->limit_time = $request->limit_time;
        $quiz->shuffle_answers = $request->shuffle_answers;
        $quiz->partially_correct = $request->partially_correct;
        $quiz->limit_number_response = $request->limit_number_response;
        $quiz->case_sensitive = $request->case_sensitive;
        $quiz->correct_score = $request->correct_score;
        $quiz->incorrect_score = $request->incorrect_score;
        $quiz->try_again_score = $request->try_again_score;
        $quiz->other_elements = $request->other_elements;

        $quiz->save();

        $exam_id = $quiz->exam_group->exam_id;
        $exam = Exam::find($exam_id);
        $exam->downloaded = 0;
        $exam->save();
        $exam->touch();

        return $quiz->id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Quiz $quiz
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quiz $quiz)
    {

        if ($quiz->type_id > 13) return false;

        $order = $quiz->order;
        $exam_id = $quiz->exam_group->exam_id;
        $exam_group_id = $quiz->exam_group_id;
        $quiz->delete();

        $order_updating_quizzes = Quiz::where('order', '>', $order)->get();
        foreach ($order_updating_quizzes as $item) {
            if (isset($item->exam_group)) {
                if ($item->exam_group->id == $exam_group_id) {
                    $item->order = $item->order - 1;
                    $item->save();
                }
            }
        }

        $exam = Exam::find($exam_id);
        $exam->touch();

        return true;
    }

    public function update_theme_style(Request $request)
    {

        $exam = Exam::where('id', $request->exam_id)
            ->update(['theme_style' => $request->style, 'downloaded' => 0]);

        return true;
    }

    public function hotspots_image_upload(Request $request)
    {

        $folderPath = "images/upload/";

        $image_parts = explode(";base64,", $request->image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $file = $folderPath . uniqid() . '.' . $image_type;

        file_put_contents($file, $image_base64);

        return $file;
    }

    public function update_quiz_index(Request $request)
    {

        $fromIndex = $request->fromIndex;
        $toIndex = $request->toIndex;

        $index = 0;

        $quizzes = Quiz::where('order', $fromIndex)->get();

        foreach ($quizzes as $item) {
            if (isset($item->exam_group)) {
                if ($item->exam_group->id == $request->exam_group_id) {
                    $item->order = -1;
                    $item->save();
                }
            }
        }

        if ($fromIndex > $toIndex) {
            $quizzes = Quiz::where('order', '<', $fromIndex)->where('order', '>=', $toIndex)->get();
            foreach ($quizzes as $item) {
                if (isset($item->exam_group)) {
                    if ($item->exam_group->id == $request->exam_group_id) {
                        $item->order ++;
                        echo $item->order;
                        echo '<br>';
                        $item->save();
                    }
                }
            }
        }

        if ($fromIndex < $toIndex) {
            $quizzes = Quiz::where('order', '>', $fromIndex)->where('order', '<=', $toIndex)->get();
            foreach ($quizzes as $item) {
                if (isset($item->exam_group)) {
                    if ($item->exam_group->id == $request->exam_group_id) {
                        $item->order --;
                        $item->save();
                    }
                }
            }
        }

        $quizzes = Quiz::where('order', -1)->get();

        foreach ($quizzes as $item) {
            if (isset($item->exam_group)) {
                if ($item->exam_group->id == $request->exam_group_id) {
                    $item->order = $toIndex;
                    $item->save();
                    $index = $item->id;
                }
            }
        }

        $exam = Exam::find($request->exam_id);
        $exam->downloaded = 0;
        $exam->save();
        $exam->touch();

        return $index;
    }

    public function duplicate_quiz(Request $request)
    {
        $quiz = Quiz::find($request->id);

        $order_updating_quizzes = Quiz::where('order', '>=', $request->order)->get();
        foreach ($order_updating_quizzes as $item) {
            if (isset($item->exam_group)) {
                if ($item->exam_group->exam_id == $quiz->exam_group->exam_id) {
                    $item->order = $item->order + 1;
                    $item->save();
                }
            }
        }

        $replicate = $quiz->replicate();
        $replicate->order = $request->order;
        $replicate->save();

        $exam = Exam::find($quiz->exam_group->exam_id);
        $exam->downloaded = 0;
        $exam->save();
        $exam->touch();

        return $replicate->id;
    }

    public function bg_apply_all(Request $request)
    {
        $exam_groups = Exam::find($request->exam_id)->exam_groups;

        foreach ($exam_groups as $exam_group) {
            $quizzes = $exam_group->quizes;
            foreach ($quizzes as $quiz) {
                $quiz->background_img = $request->background_img;
                $quiz->save();
            }
        }

        $exam = Exam::find($request->exam_id);
        $exam->downloaded = 0;
        $exam->save();
        $exam->touch();

        return $quizzes;
    }
}
