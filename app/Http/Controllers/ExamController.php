<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamGroup;
use App\Models\Quiz;
use App\Models\User;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $exams = Exam::latest()->paginate(25);
        $user = Auth::user();
        $role = $user->roles[0]->id;

        if ($role == 1) {
            $exams = Exam::all();
            return view('exams.index', compact('exams'));
        } else {
            $exams = [];
            $approved_exams = $user->approved_exams;
            $exams_index = explode('@', $approved_exams);
            array_pop($exams_index);

            foreach ($exams_index as $exam_id) {
                $exam = Exam::find($exam_id);
                array_push($exams, $exam);
            }
            return view('exams.index', compact('exams'));
        }

//            ->with('i', (request()->input('page', 1) - 1) * 25);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('exams.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'attempt_number' => 'required',
            'passing_score' => 'required',
            'screen_height' => 'required',
            'screen_width' => 'required',
        ]);

        $exam = Exam::create([
            'name' => $request->name,
            'description' => $request->description,
            'author_id' => Auth::user()->id,
            'status' => true,
            'attempt_number' => $request->attempt_number,
            'stuff_emails' => $request->stuff_emails,
            'passing_score' => $request->passing_score,
            'screen_height' => $request->screen_height,
            'screen_width' => $request->screen_width,
            'email_from' => $request->email_from,
            'email_subject' => $request->email_subject,
            'email_comment' => $request->email_comment,
            'exam_icon' => $request->exam_icon,
            'downloaded' => 0,
            'published' => 1,
        ]);

        $intro_group = ExamGroup::create([
            'group_name' => 'Intro Group',
            'exam_id' => $exam->id,
        ]);

        ExamGroup::create([
            'group_name' => 'Question Group',
            'exam_id' => $exam->id,
        ]);

        //create results group
        $results = ExamGroup::create([
            'group_name' => 'Results',
            'exam_id' => $exam->id,
        ]);

        //create user info form
        Quiz::create([
            'exam_group_id' => $intro_group->id,
            'type_id' => 16,
            'question_element' => '<div class="slide_view_question_element slide_view_group" style="height: 70px;width: 80%;left: 10%;z-index: 3;overflow: hidden;padding:10px;position:absolute;"><div contenteditable="true" class="cancel_drag">Enter Your Details</div></div>',
            'answer' => '[{"field_name": "First Name", "condition": "mandatory", "field_type": "text", "choice_field": [], "value": "", "variable": "FIRST_NAME"}, {"field_name": "Last Name", "condition": "mandatory", "field_type": "text", "choice_field": [], "value": "", "variable": "LAST_NAME"}, {"field_name": "Course Type", "condition": "mandatory", "field_type": "choice", "choice_field": ["Full Course", "Refresher", "VOC", "RPL"], "value": "", "variable": "COURSE_TYPE"}, {"field_name": "Email", "condition": "mandatory", "field_type": "email", "choice_field": [], "value": "", "variable": "EMAIL"}, {"field_name": "Location", "condition": "mandatory", "field_type": "choice", "choice_field": ["Gold Coast", "Cairns", "Moranbah", "Mackay", "Townsville", "Weipa", "Gladstone"], "value": "", "variable": "LOCATION"}, {"field_name": "Company", "condition": "optional", "field_type": "text", "choice_field": [], "value": "", "variable": "COMPANY"}, {"field_name": "Date", "condition": "mandatory", "field_type": "text", "choice_field": [], "value": "", "variable": "DATE"}]',
            'feedback_correct' => 'That\'s right! You chose the correct response.',
            'feedback_incorrect' => 'You did not choose the correct response.',
            'feedback_try_again' => 'You did not choose the correct response. Try again.',
            'media' => null,
            'order' => 0,
            'answer_element' => '<div class="slide_view_answer_element slide_view_group" style="width: 80%;top: 100px;left: 10%;z-index: 2;padding: 10px;position:absolute;overflow: hidden;"><div class="col-md-12"><form id="user_info"><div id="user_first_name_container"><input type="text" id="user_FIRST_NAME" placeholder="First Name*" required></div><div id="user_last_name_container"><input type="text" id="user_LAST_NAME" placeholder="Last Name*" required></div><div id="user_email_container"><input type="email" id="user_EMAIL" placeholder="Email*" required></div><div id="user_course_type_container"><select id="user_COURSE_TYPE" required><option value="" selected disabled>Course Type*</option><option value="full_course">Full Course</option><option value="refresher">Refresher</option><option value="voc">VOC</option><option value="rpl">RPL</option></select></div><div id="user_location_container"><select id="user_LOCATION" required><option value="" selected disabled>Location*</option><option value="gold_coast">Gold Coast</option><option value="cairns">Cairns</option><option value="moranbah">Moranbah</option><option value="mackay">Mackay</option><option value="townsville">Townsville</option><option value="weipa">Weipa</option><option value="gladstone">Gladstone</option></select></div><div id="user_company_container"><input type="text" id="user_COMPANY" placeholder="Company"></div><div id="user_date_container"><input type="text" id="user_DATE" placeholder="Date*" required></div></form></div></div>',
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


        //create passed page
        Quiz::create([
            'exam_group_id' => $results->id,
            'type_id' => 14,
            'question_element' => '<div class="slide_view_question_element slide_view_group" style="height: 70px;width: 80%;left: 10%;z-index: 3;overflow: hidden;padding:10px;position:absolute;"><div contenteditable="true" class="cancel_drag">Congratulations, you passed!</div></div>',
            'answer' => '',
            'feedback_correct' => 'That\'s right! You chose the correct response.',
            'feedback_incorrect' => 'You did not choose the correct response.',
            'feedback_try_again' => 'You did not choose the correct response. Try again.',
            'media' => null,
            'order' => 0,
            'answer_element' => '<div class="slide_view_answer_element slide_view_group" style="width: 80%;top: 100px;left: 10%;z-index: 2;padding: 10px;position:absolute;overflow: hidden;"><div class="col-md-12"><div contenteditable="true"><div class="cancel_drag">Your Score: %%</div><div class="cancel_drag">Passing Score: ##</div></div></div></div>',
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

        //create failed page
        Quiz::create([
            'exam_group_id' => $results->id,
            'type_id' => 15,
            'question_element' => '<div class="slide_view_question_element slide_view_group" style="height: 70px;width: 80%;left: 10%;z-index: 3;overflow: hidden;padding:10px;position:absolute;"><div contenteditable="true" class="cancel_drag">You did not pass.</div></div>',
            'answer' => '',
            'feedback_correct' => 'That\'s right! You chose the correct response.',
            'feedback_incorrect' => 'You did not choose the correct response.',
            'feedback_try_again' => 'You did not choose the correct response. Try again.',
            'media' => null,
            'order' => 1,
            'answer_element' => '<div class="slide_view_answer_element slide_view_group" style="width: 80%;top: 100px;left: 10%;z-index: 2;padding: 10px;position:absolute;overflow: hidden;"><div class="col-md-12"><div contenteditable="true"><div class="cancel_drag">Your Score: %%</div><div class="cancel_drag">Passing Score: ##</div></div></div></div>',
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

//        return redirect()->route('exams.index')
//            ->with('success', 'Exam created successfully.');
        return redirect('/exams/' . $exam->id)->with('success', 'Exam created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Exam $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $exam)
    {
        $exam['quizes'] = $exam->quizes;
        // foreach($exam->quizes as $quiz) {
        //     var_dump($quiz->Quiz_type->name);die;
        // }
        return view('exams.show', compact('exam'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Exam $exam
     * @return \Illuminate\Http\Response
     */
    public function edit(Exam $exam)
    {
        return view('exams.update', ['exam' => $exam]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Exam $exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exam $exam)
    {
        $exam->update($request->all());
        $exam->downloaded = 0;
        $exam->save();

        return redirect('/exams/' . $exam->id)->with('success', 'Exam updated successfully.');

//        return redirect()->route('exams.index')
//            ->with('success', 'Exam updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Exam $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam)
    {
        $exam->delete();

        $exam_groups = $exam->exam_groups;

        foreach ($exam_groups as $exam_group) {
            $quizes= $exam_group->quizes;
            foreach ($quizes as $quiz) {
                $quiz->delete();
            }
            $exam_group->delete();
        }

        $results = $exam->results;
        foreach ($results as $result) {
            $result->delete();
        }

        $users = User::all();
        foreach ($users as $user) {

            $approved_exams = str_replace(strval($exam->id) . '@', '', $user->approved_exams);

            $user->approved_exams = $approved_exams;
            $user->save();
        }

        return redirect()->route('exams.index')
            ->with('success', 'Exam deleted successfully');
    }

    public function duplicate_exam(Request $request) {
        $input = $request->all();

        $id = $input['exam_id'];
        $name = $input['name'];
        $rule = [
            'name' => 'required|unique:exams',
        ];
        $messages = [
            'name:unique' => 'Exam name already exists.',
        ];
        $validator = Validator::make($input, $rule, $messages);
        if($validator->fails()){
            return redirect()->back()
                ->withInput($input)
                ->withErrors($validator)
                ->with('status', 'returnWithError')
                ->with('id', $id)
                ->with('name', $name);
        }
        $source_exam = Exam::find($id);

        $exam = Exam::create([
            'name' => $name,
            'description' => $source_exam->description,
            'author_id' => $source_exam->author_id,
            'status' => 1,
            'attempt_number' => $source_exam->attempt_number,
            'stuff_emails' => $source_exam->stuff_emails,
            'passing_score' => $source_exam->passing_score,
            'screen_height' => $source_exam->screen_height,
            'screen_width' => $source_exam->screen_width,
            'theme_style' => $source_exam->theme_style,
            'email_from' => $source_exam->email_from,
            'email_subject' => $source_exam->email_subject,
            'email_comment' => $source_exam->email_comment,
            'downloaded' => 0,
            'published' => 1,
        ]);

        $exam_groups = ExamGroup::where('exam_id', $id)->get();
        foreach ($exam_groups as $exam_group) {
            $new_exam_group = ExamGroup::create([
                'group_name' => $exam_group->group_name,
                'exam_id' => $exam->id,
            ]);

            $quizes = Quiz::where('exam_group_id', $exam_group->id)->get();
            foreach ($quizes as $quiz) {
                $new_quiz = Quiz::create([
                    'exam_group_id' => $new_exam_group->id,
                    'type_id' => $quiz->type_id,
                    'question_element' => $quiz->question_element,
                    'answer' => $quiz->answer,
                    'feedback_correct' => $quiz->feedback_correct,
                    'feedback_incorrect' => $quiz->feedback_incorrect,
                    'feedback_try_again' => $quiz->feedback_try_again,
                    'media' => $quiz->media,
                    'media_element' => $quiz->media_element,
                    'video_element' => $quiz->video_element,
                    'audio_element' => $quiz->audio_element,
                    'other_elements' => $quiz->other_elements,
                    'background_img' => $quiz->background_img,
                    'order' => $quiz->order,
                    'answer_element' => $quiz->answer_element,
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
            }
        }
        return redirect('/exams');
    }
}
