@extends('layouts.preview')

@section('title')
    @if (session('student'))
        {{ $title }}
    @else
        {{ Auth::user()->roles[0]->id == '1' ? 'Quiz Preview' : $title }}
    @endif
@endsection

@section('content')
    <div id="question_list_modal">
        <span id="question_list_modal_close">&times;</span>
        <div id="question_list_modal_content">
            <div class="row" id="question_list_header">
                <div class="col-9">Question</div>
                <div class="col-1">Awarded</div>
                <div class="col-1">Points</div>
                <div class="col-1">Result</div>
            </div>
            <div id="question_list_content" style="overflow-y: scroll;height: 340px;">
                @foreach($quizzes as $quiz)
                    @if ($quiz->type_id < 13)
                        <div class="row question_list_body" id="question_list-{{ $quiz->id }}">
                            <div class="col-9 question_content">{{ strip_tags($quiz->question_element) }}
                            </div>
                            <div class="col-1 question_awarded">-</div>
                            <div
                                class="col-1 question_points">{{ $quiz->type_id > 11 ? '-' : $quiz->correct_score }}</div>
                            <div class="col-1 question_result">
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <div id="is_quiz" style="display: none;">{{ $is_quiz }}</div>
    {{--    @if(isset($name))--}}
    {{--        <div id="user_name" style="display: none;">{{ $name }}</div>--}}
    {{--    @else--}}
    {{--        <div id="user_name" style="display: none;">{{ $user->name }}</div>--}}
    {{--    @endif--}}
    {{--    @if(isset($email))--}}
    {{--        <div id="user_email" style="display: none;">{{ $email }}</div>--}}
    {{--    @else--}}
    {{--        <div id="user_email" style="display: none;">{{ $user->email }}</div>--}}
    {{--    @endif--}}
    <div class="question_menu_bar"
         style="margin: 0 auto;display: flex;justify-content: space-between;padding-top: 10px;">
        <p id="question_list">Question List
            <span id="question_number" style="display: none;">1</span>
        </p>
        <div id="question_result" style="display: flex;">
            <p id="question_time" style="display: none;"><span>60</span>&nbsp;sec&nbsp;</p>
            <p id="question_point" style="display: none;">&nbsp;Point Value: <span>10</span></p>
{{--            <p id="question_point">&nbsp;Point Value: <span>10</span> |&nbsp;</p>--}}
{{--            <p>Total Points: <span id="total_point">0</span> out of <span id="passing_score">100</span></p>--}}
        </div>
    </div>
    @php
        $index = 0
    @endphp
    @foreach ($quizzes as $quiz)
        @if ($quiz->type_id < 14 || $quiz->type_id == 16)
            <div id="quiz_list_container-{{ $quiz->id }}"
                 class="quiz_list_container {{ $index == 0 ? 'quiz_show' : 'quiz_hide' }}"
                 style="margin:0 auto;width: {{ $quiz->exam_group->exam->screen_width }}px;height: {{ $quiz->exam_group->exam->screen_height }}px;{{ $quiz->exam_group->exam->theme_style ?? 'background:white' }}">
                <div class="quiz_item_container"
                     style="{{ isset($quiz->background_img) ? ('background-image:' . $quiz->background_img . ';background-size:100% 100%;background-repeat: no-repeat;') : '' }}">
                    {!! $quiz->question_element !!}
                    {!! $quiz->answer_element !!}
                    {!! $quiz->media_element !!}
                    {!! $quiz->video_element !!}
                    {!! $quiz->other_elements !!}
                    <audio controls autoplay id="quiz_list_audio-{{ $quiz->id }}" style="display: none;">
                        <source src="{{ $quiz->audio }}">
                    </audio>
                </div>
                <div class="quiz_id" style="display: none;">{!! $quiz->id !!}</div>
                <div class="type_id" style="display: none;">{!! $quiz->type_id !!}</div>
                <div class="correct_answer" style="display: none;">{!! $quiz->answer !!}</div>
                <div class="attempts" style="display: none;">{!! $quiz->attempts !!}</div>
                <div class="feedback_correct" style="display: none;">{!! $quiz->feedback_correct !!}</div>
                <div class="feedback_incorrect" style="display: none;">{!! $quiz->feedback_incorrect !!}</div>
                <div class="feedback_try_again" style="display: none;">{!! $quiz->feedback_try_again !!}</div>
                <div class="correct_score" style="display: none;">{!! $quiz->correct_score !!}</div>
                <div class="incorrect_score" style="display: none;">{!! $quiz->incorrect_score !!}</div>
                <div class="try_again_score" style="display: none;">{!! $quiz->try_again_score !!}</div>
                <div class="question_type" style="display: none;">{!! $quiz->question_type !!}</div>
                <div class="feedback_type" style="display: none;">{!! $quiz->feedback_type !!}</div>
                <div class="shuffle_answers" style="display: none;">{!! $quiz->shuffle_answers !!}</div>
                <div class="case_sensitive" style="display: none;">{!! $quiz->case_sensitive !!}</div>
                <div class="partially_correct" style="display: none;">{!! $quiz->partially_correct !!}</div>
                <div class="is_limit_time" style="display: none;">{!! $quiz->is_limit_time !!}</div>
                <div class="limit_time" style="display: none;">{!! $quiz->limit_time !!}</div>
                <div class="stuff_emails" style="display: none;">{!! $quiz->exam_group->exam->stuff_emails !!}</div>
                <div class="screen_height" style="display: none;">{!! $quiz->exam_group->exam->screen_height !!}</div>
                <div class="screen_width" style="display: none;">{!! $quiz->exam_group->exam->screen_width !!}</div>
                <div class="passing_score" style="display: none;">{!! $quiz->exam_group->exam->passing_score !!}</div>
                <div class="email_from" style="display: none;">{!! $quiz->exam_group->exam->email_from !!}</div>
                <div class="email_subject" style="display: none;">{!! $quiz->exam_group->exam->email_subject !!}</div>
                <div class="email_comment" style="display: none;">{!! $quiz->exam_group->exam->email_comment !!}</div>
                <div class="quiz_name" style="display: none;">{!! $quiz->exam_group->exam->name !!}</div>
                <div class="is_correct" style="display: none;"></div>
                <div class="question_user_answer" style="display: none;"></div>
            </div>
            @php
                $index += 1
            @endphp
        @endif
    @endforeach
    @foreach ($quizzes as $quiz)
        @if ($quiz->type_id > 13 && $quiz->type_id != 16)
            <div id="quiz_list_container-{{ $quiz->id }}"
                 class="quiz_list_container {{ $index == 0 ? 'quiz_show' : 'quiz_hide' }}"
                 style="margin:0 auto;width: {{ $quiz->exam_group->exam->screen_width }}px;height: {{ $quiz->exam_group->exam->screen_height }}px;{{ $quiz->exam_group->exam->theme_style ?? 'background:white' }}">
                <div class="quiz_item_container"
                     style="{{ isset($quiz->background_img) ? ('background-image:' . $quiz->background_img . ';background-size:100% 100%;background-repeat: no-repeat;') : '' }}">
                    {!! $quiz->question_element !!}
                    {!! $quiz->answer_element !!}
                    {!! $quiz->media_element !!}
                    {!! $quiz->video_element !!}
                    {!! $quiz->other_elements !!}
                    <audio controls autoplay id="quiz_list_audio-{{ $quiz->id }}" style="display: none;">
                        <source src="{{ $quiz->audio }}">
                    </audio>
                </div>
                <div class="quiz_id" style="display: none;">{!! $quiz->id !!}</div>
                <div class="type_id" style="display: none;">{!! $quiz->type_id !!}</div>
                <div class="correct_answer" style="display: none;">{!! $quiz->answer !!}</div>
                <div class="attempts" style="display: none;">{!! $quiz->attempts !!}</div>
                <div class="feedback_correct" style="display: none;">{!! $quiz->feedback_correct !!}</div>
                <div class="feedback_incorrect" style="display: none;">{!! $quiz->feedback_incorrect !!}</div>
                <div class="feedback_try_again" style="display: none;">{!! $quiz->feedback_try_again !!}</div>
                <div class="correct_score" style="display: none;">{!! $quiz->correct_score !!}</div>
                <div class="incorrect_score" style="display: none;">{!! $quiz->incorrect_score !!}</div>
                <div class="try_again_score" style="display: none;">{!! $quiz->try_again_score !!}</div>
                <div class="question_type" style="display: none;">{!! $quiz->question_type !!}</div>
                <div class="feedback_type" style="display: none;">{!! $quiz->feedback_type !!}</div>
                <div class="shuffle_answers" style="display: none;">{!! $quiz->shuffle_answers !!}</div>
                <div class="case_sensitive" style="display: none;">{!! $quiz->case_sensitive !!}</div>
                <div class="partially_correct" style="display: none;">{!! $quiz->partially_correct !!}</div>
                <div class="is_limit_time" style="display: none;">{!! $quiz->is_limit_time !!}</div>
                <div class="limit_time" style="display: none;">{!! $quiz->limit_time !!}</div>
                <div class="stuff_emails" style="display: none;">{!! $quiz->exam_group->exam->stuff_emails !!}</div>
                <div class="screen_height" style="display: none;">{!! $quiz->exam_group->exam->screen_height !!}</div>
                <div class="screen_width" style="display: none;">{!! $quiz->exam_group->exam->screen_width !!}</div>
                <div class="passing_score" style="display: none;">{!! $quiz->exam_group->exam->passing_score !!}</div>
                <div class="email_from" style="display: none;">{!! $quiz->exam_group->exam->email_from !!}</div>
                <div class="email_subject" style="display: none;">{!! $quiz->exam_group->exam->email_subject !!}</div>
                <div class="email_comment" style="display: none;">{!! $quiz->exam_group->exam->email_comment !!}</div>
                <div class="quiz_name" style="display: none;">{!! $quiz->exam_group->exam->name !!}</div>
                <div class="is_correct" style="display: none;"></div>
                <div class="question_user_answer" style="display: none;"></div>
            </div>
            @php
                $index += 1
            @endphp
        @endif
    @endforeach
    <div class="preview_btn">
        <div>
            <a href="javascript:void(0)" id="clear_hotspots" style="visibility: hidden;">Clear</a>
            <button onclick="review()" id="review_btn" style="visibility: hidden;">Review</button>
        </div>
        <button onclick="preview(this)" id="submit_btn">Submit</button>
    </div>
    <div class="review_buttons" style="display: none;">
        <button onclick="see_result()">See Result</button>
        <div>
            <button onclick="preview_review()">Previous</button>
            <button onclick="next_review()">Next</button>
        </div>
    </div>
@endsection
