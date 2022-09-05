<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Exam;
use App\Models\Result;
use Validator;

//use App\Http\Resources\Product as ProductResource;

class ExamController extends BaseController
{
    public function get_all_index()
    {
        $quizzes = Exam::all();

        $quizzes_index = [];
        foreach ($quizzes as $quiz) {
            array_push($quizzes_index, $quiz->id);
        }

        $success['data'] = $quizzes_index;

        return $this->sendResponse($success, 'success');
    }

    public function get_downloading_quizzes_index(Request $request)
    {
//        $quizzes = Exam::where('downloaded', 0)->get();

        $quizzes = Exam::all();

        $user = $request->user();
        $role = $user->roles[0]->id;

        if ($role == 1) {

            $quizzes_index = [];
            foreach ($quizzes as $quiz) {
                array_push($quizzes_index, strval($quiz->id));
            }

            $success['data'] = $quizzes_index;

            return $this->sendResponse($success, 'success');
        } else {
            $approved_exams = $user->approved_exams;
            $quizzes_index = explode('@', $approved_exams);
            array_pop($quizzes_index);

            $success['data'] = $quizzes_index;

            return $this->sendResponse($success, 'success');
        }
    }

    public function get_quiz($id)
    {
        $user = auth('api')->user();

        $quiz = Exam::find($id);

        $results = Result::where('exam_id', $id)->get();

        $result_list = [];
        foreach ($results as $result) {
            if ($result->user_id == $user->id) {

                $data = json_decode($result->result);

                $tmp = new \stdClass();

                $tmp->result = $data->result;
                $tmp->exam_user_score = $data->exam_user_score;
                array_push($result_list, $tmp);
            }
        }

        if (count($result_list) > 0) {
            $quiz->result = $result_list[count($result_list) - 1]->result;
            $quiz->exam_user_score = $result_list[count($result_list) - 1]->exam_user_score;
        }

        $success['data'] = $quiz;
        return $this->sendResponse($success, 'success');
    }

    // public function get_quiz_assets_url($id)
    // {
    //     $url_list = [];

    //     $quiz = Exam::find($id);

    //     if (isset($quiz->theme_style)) array_push($url_list, explode('"); background-size:', explode('background-image:url("', $quiz->theme_style)[1])[0]);

    //     $questions = $quiz->get_all_questions();

    //     foreach ($questions as $question) {
    //         if (isset($question[0]->media)) array_push($url_list, $question[0]->media);
    //         if (isset($question[0]->video)) array_push($url_list, $question[0]->video);
    //         if (isset($question[0]->audio)) array_push($url_list, $question[0]->audio);
    //         if (isset($question[0]->background_img)) array_push($url_list, explode('")', explode('url("', $question[0]->background_img)[1])[0]);

    //         if (isset($question[0]->other_elements)) {
    //             $tmp_array = explode('src="', $question[0]->other_elements);
    //             array_shift($tmp_array);

    //             foreach ($tmp_array as $tmp) {
    //                 array_push($url_list, explode('"', $tmp)[0]);
    //             }
    //         }
    //     }

    //     $success['data'] = $url_list;
    //     return $this->sendResponse($success, 'success');
    // }

    public function get_quiz_html(string $id)
    {
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

        $html = view('preview', ['quizzes' => $quizzes, 'title' => $title, 'is_quiz' => $is_quiz]);
        $preview_container = '<div id="preview_container">' . explode('<script', explode('<div id="preview_container">', $html)[1])[0];
        $preview_container = trim(preg_replace('/\s+</', '<', $preview_container));
        $preview_container = str_replace("\r\n", '', $preview_container);

        $image_url_array = $this->get_image_url_array($preview_container);
        $base64_preview_container = $this->replace_url_image_base64($preview_container, $image_url_array);
        $success['data'] = $base64_preview_container;
        // $success['data'] = $preview_container;
        return $this->sendResponse($success, 'success');
    }

    public function get_image_url_array(string $string)
    {
        preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $string, $url_array);

        $result = [];

        foreach ($url_array[0] as $url) {
            $url = str_replace('&quot', '', $url);
            if ($this->isImage($url)) array_push($result, $url);
        }

        return array_unique($result);
    }

    public function get_video_audio_url_array(Request $request)
    {
        preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $request->quizContent, $url_array);

        $result = [];

        foreach ($url_array[0] as $url) {
            $url = str_replace('&quot', '', $url);
            if (!$this->isImage($url)) array_push($result, $url);
        }

        $success['data'] = array_unique($result);
        return $this->sendResponse($success, 'success');
    }

    public function isImage(string $url)
    {
        $pos = strrpos($url, ".");
        if ($pos === false)
            return false;
        $ext = strtolower(trim(substr($url, $pos)));
        $imgExts = array(".gif", ".jpg", ".jpeg", ".png", ".tiff", ".tif", ".bmp"); // this is far from complete but that's always going to be the case...
        if (in_array($ext, $imgExts))
            return true;
        return false;
    }

    public function image_base64(string $url)
    {
        $type = pathinfo($url, PATHINFO_EXTENSION);
        $data = file_get_contents($url);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

         return $base64;
    }

    public function replace_url_image_base64(string $str, array $url_array)
    {
        foreach ($url_array as $url) {
            $str = str_replace($url, $this->image_base64($url), $str);
        }

        return $str;
    }

    public function send_email(Request $str)
    {
        $request = json_decode($str->json);

        $details = [
            'data' => $request,
            'exam_date_time' => date("Y/m/d") . ' ' . date("h:i:sa"),
        ];

        \Mail::to($request->user_email)->send(new \App\Mail\QuizResultMail($details));

        $stuff_emails = explode(',', $request->stuff_emails);

        try {
            foreach ($stuff_emails as $stuff_email) {
                \Mail::to($stuff_email)->send(new \App\Mail\QuizResultMail($details));
            }
            return $this->sendResponse('success', 'success');
        } catch (Exception $err) {
            return $this->sendResponse('success', 'failed');
        }
    }

    public function save_result(Request $request)
    {
        $result = Result::create([
            'user_id' => $request->user_id,
            'exam_id' => $request->exam_id,
            'result' => $request->json,
        ]);

        $success['data'] = $result;
        return $this->sendResponse($success, 'success');
    }
}
