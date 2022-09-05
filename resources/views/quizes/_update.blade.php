@extends('layouts.app')

@section('content')
    <div id="main">
        <div id="content" class="full">
            <div class="post manage_forms">
                <div class="content_header">
                    <div class="content_header_title">
                        <div style="float: left">
                            <h2>Update Quiz
                            </h2>
                            <p>Update this quiz</p>
                        </div>
                        <div style="clear: both; height: 1px"></div>
                    </div>
                </div>


                <div class="content_body">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <form method="POST" action="{{ url('/quizes') }}/{{ $quiz->id }}" class="create_form"
                                      id="quiz_form">
                                    @csrf
                                    @method('PUT')
                                    <input id="exam_id" type="text"
                                           class="form-control @error('exam_id') is-invalid @enderror" name="exam_id"
                                           value="{{ $quiz->exam_id }}" required autocomplete="exam_id" autofocus
                                           hidden>
                                    <input id="type_id" type="text"
                                           class="form-control @error('type_id') is-invalid @enderror" name="type_id"
                                           value="{{ $quiz->type_id }}" required autocomplete="type_id" autofocus
                                           hidden>
                                    <input id="answer_content_array" type="text"
                                           class="form-control @error('answer_content_array') is-invalid @enderror"
                                           name="answer_content_array"
                                           value="" autocomplete="answer_content_array" autofocus hidden>
                                    <div class="form-group row">
                                        <label for="question" class="col-md-3 col-form-label text-md-right">{{
                                        __('Question') }}</label>
                                        <div class="col-md-7">
                                            <textarea class="content" name="example">{{$quiz->question}}</textarea>
                                            <textarea id="question"
                                                      class="form-control @error('question') is-invalid @enderror"
                                                      name="question"
                                                      value="{{ old('question') }}" rows="4" cols="50"
                                                      autocomplete="question" required
                                                      style="display: none;"></textarea>

                                            @error('question')
                                            <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="answer" class="col-md-3 col-form-label text-md-right">{{ __('Answer')
                                        }}</label>
                                        <div class="col-md-7" id="answer_content">
                                            @switch($quiz->type_id)
                                                @case(1)
                                                <input id="choice_id_array" type="text"
                                                       class="form-control @error('choice_id_array') is-invalid @enderror"
                                                       name="choice_id_array"
                                                       value="" autocomplete="choice_id_array" autofocus hidden>
                                                @foreach($quiz->multi_choice_answer_contents as $answer_content)
                                                    <div class="choice_item" style="display: flex;">
                                                        <input type="radio" id="{{ $answer_content->choice_id }}"
                                                               name="answer" value="{{ $answer_content->choice_id }}"
                                                               style="padding-right: 10px;">
                                                        <label class="choice_label" data-editable
                                                               for="{{ $answer_content->choice_id }}">{{ $answer_content->content }}</label>
                                                        <a onclick="{$(this).parent().remove();save_choice_data();}"><i
                                                                class="fas fa-trash-alt"></i></a>
                                                    </div>
                                                @endforeach
                                                <a id="add_choice" style="padding: 10px 0;">Type to add a new choice</a>
                                                @break
                                                @case(2)
                                                <input id="response_id_array" type="text"
                                                       class="form-control @error('response_id_array') is-invalid @enderror"
                                                       name="response_id_array"
                                                       value="" autocomplete="response_id_array" autofocus hidden>
                                                @foreach($quiz->multi_response_answer_contents as $answer_content)
                                                    <div class="response_item">
                                                        <input type="checkbox" onclick="responsehandleclick();"
                                                               id="{{ $answer_content->response_id }}"
                                                               name="answer{{ $answer_content->response_id }}"
                                                               value="{{ $answer_content->response_id }}"
                                                               style="padding-right: 10px;">
                                                        <label class="response_label" data-editable
                                                               for="{{ $answer_content->choice_id }}">{{ $answer_content->content }}</label>
                                                        <a onclick="{$(this).parent().remove();save_choice_data();}"><i
                                                                class="fas fa-trash-alt"></i></a>
                                                    </div>
                                                @endforeach
                                                <a id="add_response" style="padding: 10px 0;">Type to add a new
                                                    response</a>
                                                <input id="answer" type="text"
                                                       class="form-control @error('answer') is-invalid @enderror"
                                                       name="answer"
                                                       value="{{ old('answer') }}" required autocomplete="answer"
                                                       autofocus hidden>
                                                @break
                                                @case(3)
                                                <div class="choice_item">
                                                    <input type="radio" id="true" name="answer" value="1"
                                                           style="padding-right: 10px;" {{$quiz->answer ? 'checked' : ''}}>
                                                    <label for="true">True</label>
                                                </div>
                                                <div class="choice_item">
                                                    <input type="radio" id="false" name="answer" value="0"
                                                           style="padding-right: 10px;" {{$quiz->answer ? '' : 'checked'}}>
                                                    <label for="false">False</label>
                                                </div>
                                                @break
                                                @case(4)
                                                <input id="answer" type="text"
                                                       class="form-control @error('answer') is-invalid @enderror"
                                                       name="answer"
                                                       value="{{ $quiz->answer }}" required autocomplete="answer"
                                                       autofocus>
                                                @error('answer')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                                @break
                                                @case(5)
                                                @foreach($quiz->numeric_answer_contents as $answer_content)
                                                    <div class="select_item" style="display: flex;padding: 5px 0;">
                                                        <select
                                                            onchange="{select_change(this);}"
                                                            name="' + {{ $answer_content->id }} + '"
                                                            id="' + {{ $answer_content->id }} + '">
                                                            <option
                                                                value="==" {{ $answer_content->option_value == '==' ? 'selected' : '' }}>
                                                                Equal to
                                                            </option>
                                                            <option
                                                                value="<<" {{ $answer_content->option_value == '<<' ? 'selected' : '' }}>
                                                                Between
                                                            </option>
                                                            <option
                                                                value=">" {{ $answer_content->option_value == '>' ? 'selected' : '' }}>
                                                                Greater than
                                                            </option>
                                                            <option
                                                                value=">=" {{ $answer_content->option_value == '>=' ? 'selected' : '' }}>
                                                                Greater than or equal to
                                                            </option>
                                                            <option
                                                                value="<" {{ $answer_content->option_value == '<' ? 'selected' : '' }}>
                                                                Less than
                                                            </option>
                                                            <option
                                                                value="<=" {{ $answer_content->option_value == '<=' ? 'selected' : '' }}>
                                                                Less than or equal to
                                                            </option>
                                                            <option
                                                                value="!=" {{ $answer_content->option_value == '!=' ? 'selected' : '' }}>
                                                                Not equal to
                                                            </option>
                                                        </select>
                                                        <div>
                                                            <input type="number"
                                                                   value="{{$answer_content->input_value_1}}"
                                                                   onchange="{save_select_data();}">
                                                            @if ($answer_content->option_value == '<<')
                                                                <span>and</span>
                                                                <input
                                                                    type="number"
                                                                    value="{{$answer_content->input_value_2}}"
                                                                    onchange="{save_select_data();}">
                                                            @endif
                                                        </div>
                                                        <a onclick="{$(this).parent().remove();save_select_data();}"><i
                                                                class="fas fa-trash-alt"></i></a>
                                                    </div>
                                                @endforeach
                                                <select name="add_select" id="add_select">
                                                    <option value="+">Add a new condition</option>
                                                    <option value="==">Equal to</option>
                                                    <option value="<<">Between</option>
                                                    <option value=">">Greater than</option>
                                                    <option value=">=">Greater than or equal to</option>
                                                    <option value="<">Less than</option>
                                                    <option value="<=">Less than or equal to</option>
                                                    <option value="!=">Not equal to</option>
                                                </select>
                                                <input id="answer" type="text"
                                                       class="form-control @error('answer') is-invalid @enderror"
                                                       name="answer"
                                                       value="numeric" required autocomplete="answer" autofocus hidden>
                                                <input id="select_answer" type="text"
                                                       class="form-control @error('select_answer') is-invalid @enderror"
                                                       name="select_answer"
                                                       value="" required autocomplete="select_answer" autofocus hidden>
                                                @break
                                                @case(6)
                                                <ul id="sortable">
                                                    @foreach ($quiz->sequence_array as $item)
                                                        <li class="ui-state-default"><span
                                                                class="ui-icon ui-icon-arrowthick-2-n-s"></span><label
                                                                class="sequence_label" data-editable>{{ $item }}</label><a
                                                                onclick="{$(this).parent().remove();save_select_data();}"><i
                                                                    class="fas fa-trash-alt"></i></a></li>
                                                    @endforeach
                                                </ul>
                                                <a id="add_sequence" style="padding: 10px 0;">Type to add a new
                                                    choice</a>
                                                <input id="sequence_array" type="text"
                                                       class="form-control @error('answer') is-invalid @enderror"
                                                       name="answer"
                                                       value="" autocomplete="answer" autofocus hidden>
                                                @break
                                                @case(7)
                                                <ul id="sortable">
                                                    @foreach ($quiz->item_array as $key => $item)
                                                        <li class="ui-state-default"><span
                                                                class="ui-icon ui-icon-arrowthick-2-n-s"></span><label
                                                                class="matching_item_label" data-editable>{{ $item }}</label>
                                                            <div
                                                                style="border_right: 1px black solid;width: 30px;"></div>
                                                            <label class="matching_label" data-editable>{{ $quiz->matching_array[$key] }}</label><a
                                                                onclick="{$(this).parent().remove();save_select_data();}"><i
                                                                    class="fas fa-trash-alt"></i></a></li>
                                                    @endforeach
                                                </ul>
                                                <a id="add_matching" style="padding: 10px 0;">Type to add a new
                                                    choice</a>
                                                <input id="matching_array" type="text"
                                                       class="form-control @error('answer') is-invalid @enderror"
                                                       name="answer"
                                                       value="" autocomplete="answer" autofocus hidden>
                                                @break
                                                @default
                                                <input id="answer" type="text"
                                                       class="form-control @error('answer') is-invalid @enderror"
                                                       name="answer"
                                                       value="{{ old('answer') }}" required autocomplete="answer"
                                                       autofocus>
                                                @error('answer')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            @endswitch
                                        </div>
                                    </div>
                                    <div class="form-group row" style="align-items: center">
                                        <label for="is_feedback" class="col-md-3 col-form-label text-md-right">{{
                                        __('Feedback')
                                        }}</label>
                                        <div class="col-md-7">
                                            <input id="is_feedback" type="checkbox"
                                                   class="@error('is_feedback') is-invalid @enderror" name="is_feedback"
                                                   value="feedback_checked" {{$quiz->is_feedback ? 'checked' : ''}}
                                                   autocomplete="is_feedback" autofocus>
                                            @error('is_feedback')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="feedback_correct" class="col-md-3 col-form-label text-md-right">{{
                                        __('Feedback Correct')
                                        }}</label>
                                        <div class="col-md-7">
                                            <input id="feedback_correct" type="text"
                                                   class="form-control @error('feedback_correct') is-invalid @enderror"
                                                   name="feedback_correct"
                                                   value="{{ $quiz->feedback_correct }}" required
                                                   autocomplete="feedback_correct" autofocus>
                                            @error('feedback_correct')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="feedback_incorrect" class="col-md-3 col-form-label text-md-right">{{
                                        __('Feedback Incorrect')
                                        }}</label>
                                        <div class="col-md-7">
                                            <input id="feedback_incorrect" type="text"
                                                   class="form-control @error('feedback_incorrect') is-invalid @enderror"
                                                   name="feedback_incorrect"
                                                   value="{{ $quiz->feedback_incorrect }}" required
                                                   autocomplete="feedback_incorrect" autofocus>
                                            @error('feedback_incorrect')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="feedback_try_again" class="col-md-3 col-form-label text-md-right">{{
                                        __('Feedback Try Again')
                                        }}</label>
                                        <div class="col-md-7">
                                            <input id="feedback_try_again" type="text"
                                                   class="form-control @error('feedback_try_again') is-invalid @enderror"
                                                   name="feedback_try_again"
                                                   value="{{ $quiz->feedback_try_again }}" required
                                                   autocomplete="feedback_try_again" autofocus>
                                            @error('feedback_try_again')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="button" class="btn btn-primary" onclick="submitForm()">
                                                {{ __('Update quiz') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
