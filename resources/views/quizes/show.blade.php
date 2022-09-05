@extends('layouts.app')

@section('content')
    <div id="main">

        <div id="content" class="full">
            <div class="post manage_forms">
                <div class="content_header">
                    <div class="content_header_title">
                        <div style="float: left">
                            {!! $quiz->question !!}
                        </div>
                        <div style="float: right;margin-right: 0px">
                        </div>
                        <div style="clear: both; height: 1px"></div>
                    </div>
                </div>


                <div class="content_body">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <form method="POST" action="{{ url('/quizes') }}" class="create_form">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            @switch($quiz->type_id)
                                                @case(1)
                                                @foreach($quiz->multi_choice_answer_contents as $answer_content)
                                                    <div class="choice_item">
                                                        <input type="radio" id="{{ $answer_content->choice_id }}"
                                                               name="answer" value="{{ $answer_content->choice_id }}"
                                                               style="padding-right: 10px;">
                                                        <label
                                                            for="{{ $answer_content->choice_id }}">{{ $answer_content->content }}</label>
                                                    </div>
                                                @endforeach
                                                @break
                                                @case(2)
                                                @foreach($quiz->multi_response_answer_contents as $answer_content)
                                                    <div class="response_item">
                                                        <input type="checkbox" id="{{ $answer_content->response_id }}"
                                                               name="answer" value="{{ $answer_content->response_id }}"
                                                               style="padding-right: 10px;">
                                                        <label
                                                            for="{{ $answer_content->response_id }}">{{ $answer_content->content }}</label>
                                                    </div>
                                                @endforeach
                                                @break
                                                @case(3)
                                                <div class="choice_item">
                                                    <input type="radio" id="true" name="answer" value="1"
                                                           style="padding-right: 10px;">
                                                    <label for="true">True</label>
                                                </div>
                                                <div class="choice_item">
                                                    <input type="radio" id="false" name="answer" value="0"
                                                           style="padding-right: 10px;">
                                                    <label for="false">False</label>
                                                </div>
                                                @break
                                                @case(5)
                                                <input id="answer" type="number"
                                                       class="form-control @error('answer') is-invalid @enderror"
                                                       name="answer"
                                                       value="{{ old('answer') }}"
                                                       autocomplete="answer">

                                                @error('answer')
                                                <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                @enderror
                                                @break
                                                @case(6)
                                                <ul id="sortable">
                                                    @foreach ($quiz->sequence_array as $item)
                                                        <li class="ui-state-default"><span
                                                                class="ui-icon ui-icon-arrowthick-2-n-s"></span><label
                                                                class="sequence_label" data-editable>{{ $item }}</label>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                                @break
                                                @case(7)
                                                @foreach($quiz->item_array as $key => $item)
                                                <div
                                                    style="display: flex;justify-content: space-around;padding-bottom: 10px;">
                                                    <div class="ui-widget-header droppable" style="width: 40%">
                                                        <p>{{ $item }}</p>
                                                    </div>

                                                    <div class="ui-widget-content draggable" style="width: 40%"
                                                         isdropped=false>
                                                        <p>{{ $quiz->matching_array[$key] }}</p>
                                                    </div>
                                                </div>
                                                @endforeach
                                                @break
                                                @default
                                                <input id="answer" type="text"
                                                       class="form-control @error('answer') is-invalid @enderror"
                                                       name="answer"
                                                       value="{{ old('answer') }}"
                                                       autocomplete="answer">

                                                @error('answer')
                                                <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                @enderror
                                            @endswitch
                                        </div>
                                    </div>
                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Next Quiz') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- /.post -->
        </div><!-- /#content -->


        <div class="clear"></div>

    </div>
@endsection
