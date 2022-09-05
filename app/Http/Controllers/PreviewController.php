<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Exam;
use App\Models\ExamGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;
use File;

class PreviewController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    public function index()
    {
        return view('preview');
    }

    public function preview_slide(string $id)
    {
        $quizzes = Quiz::where('id', $id)->get();
        $user = Auth::user();
        $is_quiz = 0;

        return view('preview', ['quizzes' => $quizzes, 'user' => $user, 'is_quiz' => $is_quiz]);
    }


    public function preview_group(string $id)
    {
        $user = Auth::user();
        $exam_groups = ExamGroup::where('id', $id)->get();
        $is_quiz = 0;

        $quizzes = [];
        foreach ($exam_groups as $exam_group) {
            foreach ($exam_group->quizes as $quiz) {
                array_push($quizzes, $quiz);
            }
        }

        return view('preview', ['quizzes' => $quizzes, 'user' => $user, 'is_quiz' => $is_quiz]);
    }

    public function preview_exam(string $id)
    {
        if (isset(Auth::user()->id)) {
            $user = Auth::user();
            $name = $user->name;
            $email = $user->email;
        }
        if (session('name')) {
            $name = session('name');
            $email = session('email');
        }

        $exams = Exam::where('id', $id)->get();
        $title = $exams[0]->name;
        $is_quiz = 1;

        $exam_groups = $exams[0]->exam_groups;
        $quizzes = [];
        foreach ($exam_groups as $exam_group) {
            foreach ($exam_group->quizes as $quiz) {
                array_push($quizzes, $quiz);
            }
        }

        return view('preview', ['quizzes' => $quizzes, 'title' => $title, 'name' => $name, 'email' => $email, 'is_quiz' => $is_quiz]);
    }

    public function exam($name)
    {
        return view('examRegister', [
            'name' => $name,
        ]);
    }

    public function startExam(Request $request)
    {
        $input = $request->all();
        $firstName = $input['firstName'];
        $lastName = $input['lastName'];
        $email = $input['email'];
        $name = $input['name'];
        $exam = Exam::where('name', $name)->first();
        $id = $exam->id;

        $userName = $firstName . ' ' . $lastName;
        $rule = [
            'firstName' => 'required|string|max:20|regex:/^[a-zA-Z]+$/',
            'lastName' => 'required|string|max:20|regex:/^[a-zA-Z]+$/',
            'company' => 'required|string|max:20|regex:/^[a-z A-Z]+$/',
        ];

        $messages = [
            'fistName.required' => 'First Name is a required field.',
            'lastName.required' => 'Last Name is a required field.',
            'email.required' => 'Email is a required field.',
            'company.required' => 'Company is a required field.',
            'firstName.regex' => 'First Name can contains only letters',
            'lastName.regex' => 'Last Name can contains only letters',
            'company.regex' => 'Company Name can contains only letters',
        ];

        $validator = Validator::make($input, $rule, $messages);
        if ($validator->fails()) {
            return redirect()->route('exam', ['name' => $name])
                ->withInput($input)
                ->withErrors($validator->errors());
        }

        return redirect()->route('preview_exam', [
            'id' => $id,
        ])->with('name', $userName)->with('email', $email)->with('student', true);
    }

    // public function get_quiz_html(string $id)
    // {
    //     $exams = Exam::where('id', $id)->get();
    //     $title = $exams[0]->name;
    //     $is_quiz = 1;

    //     $exam_groups = $exams[0]->exam_groups;
    //     $quizzes = [];
    //     foreach ($exam_groups as $exam_group) {
    //         foreach ($exam_group->quizes as $quiz) {
    //             array_push($quizzes, $quiz);
    //         }
    //     }

    //     $html = view('preview', ['quizzes' => $quizzes, 'title' => $title, 'is_quiz' => $is_quiz]);
    //     $preview_container = '<div id="preview_container">' . explode('<script', explode('<div id="preview_container">', $html)[1])[0];
    //     $preview_container = trim(preg_replace('/\s\s+/', '', $preview_container));

    //     $image_url_array = $this->get_image_url_array($preview_container);
    //     $base64_preview_container = $this->replace_url_image_base64($preview_container, $image_url_array);
    //     File::put(('quiz_html/' . $id . '.txt'), $base64_preview_container);
    //     return $base64_preview_container;
    // }

    // public function get_image_url_array(string $string)
    // {
    //     preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $string, $url_array);

    //     $result = [];

    //     foreach ($url_array[0] as $url) {
    //         $url = str_replace('&quot', '', $url);
    //         if ($this->isImage($url)) array_push($result, $url);
    //     }

    //     return array_unique($result);
    // }

    // public function isImage(string $url)
    // {
    //     $pos = strrpos($url, ".");
    //     if ($pos === false)
    //         return false;
    //     $ext = strtolower(trim(substr($url, $pos)));
    //     $imgExts = array(".gif", ".jpg", ".jpeg", ".png", ".tiff", ".tif", ".bmp"); // this is far from complete but that's always going to be the case...
    //     if (in_array($ext, $imgExts))
    //         return true;
    //     return false;
    // }

    // public function image_base64(string $url)
    // {
    //     $type = pathinfo($url, PATHINFO_EXTENSION);
    //     $data = $this->curl_get_contents($url);
    //     $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

    //     return $base64;
    // }

    // public function replace_url_image_base64(string $str, array $url_array)
    // {
    //     foreach ($url_array as $url) {
    //         $str = str_replace($url, $this->image_base64($url), $str);
    //     }

    //     return $str;
    // }

    // function curl_get_contents($url)
    // {
    //     $ch = curl_init();

    //     curl_setopt($ch, CURLOPT_HEADER, 0);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //     curl_setopt($ch, CURLOPT_URL, $url);

    //     $data = curl_exec($ch);
    //     curl_close($ch);

    //     return $data;
    // }
}
