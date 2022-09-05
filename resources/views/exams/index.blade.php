@extends('layouts.app')

@section('content')
    <div id="quiz_delete_confirm_dialog" class="quiz_dialog">
        <input id="quiz_delete_dialog_id" type="text" hidden>
        <div id="quiz_delete_dialog_content" class="quiz_dialog_content">Are you sure you want to delete?</div>
        <div id="quiz_delete_dialog_btn" class="quiz_dialog_btn">
            <button id="quiz_delete_yes" class="button success" onclick="{$('#delete_form-' + $('#quiz_delete_dialog_id').val()).submit();}">Yes</button>
            <button id="quiz_delete_no" class="button light" onclick="{$('#quiz_delete_confirm_dialog').fadeOut(300);}">No</button>
        </div>
    </div>
    <div id="main">

        <div id="content" class="full">
            <div class="post manage_forms">
                <div class="content_header">
                    <div class="content_header_title">
                        <div style="float: left">
                            @hasrole('manager')
                            <h2>Exam Management
                            </h2>
                            <p>Create, edit, delete and test your exams</p>
                            @endhasrole
                            @hasrole('student')
                            <h2>Exam Page</h2>
                            @endhasrole
                        </div>
                        @hasrole('manager')
                        <div style="float: right;margin-right: 0px">
                            <a href="{{ url('/exams/create') }}" title="Create New Exam" id="button_create_exam"
                               class="button_primary">
                                <i class="fas fa-plus"></i>Create New Exam
                            </a>
                        </div>
                        @endhasrole
                        <div style="clear: both; height: 1px"></div>
                    </div>
                </div>

                <div class="content_body">
                    <div class="content_body_main ">
                        <ul id="mf_form_list">
                            @if (count($exams) > 0)
                                @foreach($exams as $exam)
                                    <li data-theme_id="{{ $exam->id }}" id="liform_{{ $exam->id }}"
                                        class="form_visible">

                                        <div class="middle_form_bar" style="display: block; margin-bottom: 2px;">
{{--                                            <span class="tooltiptext">{{ $exam->description }}</span>--}}
                                            <h3 style="float: left; margin: 0;">{{ $exam->name }}</h3>
                                            <div>
                                                <span style="float: right; margin: 5px;" id="exam_link{{ $exam->id }}">{{ env('APP_URL') . '/exam/'. $exam->id }}</span>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="form_meta" style="display:none;">

                                                <div class="form_actions">
                                                    <a class="form_actions_toggle" data-formid="{{ $exam->id }}"
                                                       id="form_action_{{ $exam->id }}"
                                                       href="javascript:;"><span class="icon-cog"></span></a>
                                                </div>
                                                <div id="action_toggle_content_{{ $exam->id }}" style="display: none">
                                                    <div class="form_action_item mf_link_delete"><a href="#"><span
                                                                class="icon-trash2"></span> Delete</a></div>

                                                    <div class="form_action_item mf_link_duplicate"><a href="#"><span
                                                                class="icon-copy1"></span> Duplicate</a></div>

                                                    <div class="form_action_item mf_link_disable">
                                                        <a href="#"><span class="icon-pause-circle"></span> Disable</a>
                                                    </div>

                                                    <div class="form_action_item"><a title="View Form Info"
                                                                                     href="form_info.php?id={{ $exam->id }}"><span
                                                                class="icon-file-charts"></span> Info</a></div>

                                                    <div class="form_action_item mf_link_export"><a
                                                            title="Export Form Template"
                                                            class="exportform"
                                                            id="exportform_42152"
                                                            href="#"><span
                                                                class="icon-exit-up"></span> Export</a></div>
                                                </div>

                                                <div class="form_tag">
                                                    <ul class="form_tag_list">

                                                        <li class="form_tag_list_icon">
                                                            <a title="Add a Tag Name" class="addtag" id="addtag_42152"
                                                               href="#"><span class="icon-tag"></span></a>
                                                        </li>


                                                    </ul>
                                                </div>
                                            </div>
                                            <div style="height: 0px; clear: both;"></div>
                                        </div>
                                        <div class="bottom_form_bar" style="display: none;">
                                            @hasrole('manager')
                                            {{--                                    <div class="form_option">--}}
                                            {{--                                        <a href="{{ url('/exams') }}/{{$exam->id}}/edit"><i class="fas fa-edit"></i>Edit Exam</a>--}}
                                            {{--                                    </div>--}}

                                            <div class="form_option">
                                                <a href="{{ url('/exams') }}/{{$exam->id}}"><i class="far fa-eye"></i>Edit Exam</a>
                                            </div>
                                            <div class="form_option_separator"></div>
                                            <div class="form_option option_expandable">
                                                <a class="mf_link_theme" href="javascript:void(0)"
                                                   onclick="{window.open('{{ url('/exam') }}/{{ $exam->id }}')}"><i
                                                        class="far fa-play-circle"></i><span class="option_text">Test Exam</span></a>
                                            </div>
                                            <div class="form_option_separator"></div>
                                            <div class="form_option">
                                                <a href="{{ url('/result') }}/{{$exam->id}}"><i class="far fa-eye"></i>Show Result</a>
                                            </div>
                                            <div class="form_option_separator"></div>
                                            <div class="form_option option_expandable">
                                                <a class="mf_link_theme" href="javascript:void(0)"
                                                   onclick="showDuplicateModel({{ $exam->id }}, '{{ $exam->name }} - copy')"><i
                                                        class="fas fa-copy"></i><span class="option_text">Duplicate</span></a>
                                            </div>
                                            @endhasrole
                                            @hasrole('student')
                                            <div class="form_option option_expandable">
                                                <a class="mf_link_theme" href="javascript:void(0)"
                                                   onclick="{window.open('{{ url('/exam') }}/{{ $exam->id }}')}"><i
                                                        class="far fa-play-circle"></i><span class="option_text">Start Exam</span></a>
                                            </div>
                                            @endhasrole
                                            @hasrole('manager')
                                            <div class="form_option_separator"></div>
                                            <div class="form_option option_expandable" style="position: relative">
                                                <a class="mf_link_theme" href="javascript:void(0)"
                                                   onclick="copyToClipboard({{ $exam->id }})">
                                                    <i class="fas fa-link"></i>
                                                    <span class="option_text">Copy Link</span>
                                                </a>
                                                <div style="position: absolute; left: 100%;border-radius: 5px; background-color: #eee;padding: 5px; top: 5px; display: none;" id="copiedAlert{{ $exam->id }}">
                                                    <p style="color: black; margin: 0">Copied</p>
                                                </div>
                                            </div>
                                            <form method="POST" action="{{ url('/exams') }}/{{ $exam->id }}" id="delete_form-{{ $exam->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <div class="form_option" style="float: right;">
                                                    <a href="javascript:void(0)" class="mf_link_theme" onclick="{$('#quiz_delete_confirm_dialog').fadeIn(300);$('#quiz_delete_dialog_id').val('{{ $exam->id }}')}"><i class="fas fa-trash"></i>Delete Exam</a>
                                                </div>
                                            </form>
                                            @endhasrole
                                        </div>

                                        <div style="height: 0px; clear: both;"></div>
                                    </li>
                                @endforeach
                            @else
                                <span>No exam</span>
                            @endif
                        </ul>

                    </div>
                </div> <!-- /end of content_body -->

            </div><!-- /.post -->
        </div><!-- /#content -->


        <div class="clear"></div>

    </div>
    <div id="duplicateModal" style="height: 100vh; width: 100vw; background: #666a; z-index: 10000; position: fixed; top: 0; left: 0; display: none;">
        <form action="{{ route("duplicateExam") }}" method="post">
            @csrf
            <div class="modalContainer" style="width: 500px; padding: 20px 40px; background: white; margin: auto; margin-top: 200px; box-shadow: 0 0 3px 2px lightgrey;">
                <div class="modalBody">
                    <label for="exam_name" style="display: block; font-size: 18px; ">Please input a name of duplicated exam.</label>
                    <input type="text" name="name" id="exam_name" class="form-control @error('name') is-invalid @enderror">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <input type="hidden" name="exam_id" value="0" id="duplicate_exam_id">
                </div>
                <div style="width: 100%; display: flex; margin-top: 15px;justify-content: space-around;">
                    <button class="btn btn-success btn-lg col-5" type="submit">Duplicate</button>
                    <button class="btn btn-danger btn-lg col-5" type="button" onclick="$('#duplicateModal').fadeOut(200);">Cancel</button>
                </div>
            </div>
        </form>
    </div>
    <script>
        function copyToClipboard(id) {
            const exam_link = $("#exam_link" + id).text();
            navigator.clipboard.writeText(exam_link).then(
                function() {
                    const elem = $("#copiedAlert" + id);
                    $(elem).fadeIn(50).delay(1000).fadeOut(50);},
                function() {}
            );
        }
        function showDuplicateModel(id, name) {
            $("#duplicate_exam_id").val(id);
            $("#duplicateModal #exam_name").val(name);
            $("#duplicateModal").fadeIn(200);
        }
        @if(session('status'))
            console.log("duplicate");
            const id = "{{ session('id') }}";
            const name = "{{ session('name') }}";
            showDuplicateModel(id, name);
        @endif
    </script>

@endsection
