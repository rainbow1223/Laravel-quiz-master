<?php

namespace App\Http\Controllers;

use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResultController extends Controller
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
    public function show(int $exam_id)
    {
        $results = Result::where('exam_id', $exam_id)->orderBy('id', 'desc')->get();

        // $result_list = [];
        // foreach ($results as $result) {
        //     $result->data = json_decode($result->result);
        //     array_push($result_list, $result);
        // }


        return view('results.show', ['results' => $results]);
    }
}