<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="url" content="{{ url('/') }}">

    {{--    @if(session('student'))--}}
    {{--    <title>{{ __('Exam Page') }}</title>--}}
    {{--    @else--}}
    <title>@yield('title')</title>
    {{--    @endif--}}
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    {{--    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">--}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    {{--    <link href="{{ asset('css/toast.css') }}" rel="stylesheet">--}}
    <link href="{{ asset('css/jquery.hotspot.css') }}" rel="stylesheet">
    <link href="{{ asset('css/preview.css') }}" rel="stylesheet">
    {{--    <link href="{{ asset('css/metro-all.css') }}" rel="stylesheet">--}}
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <link href="{{ asset('css/jquery-ui.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/jquery3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/1.7.22/fabric.js"></script>
</head>
<body>
<div class="se-pre-con" style="display: none;"></div>
<div id="progress_bar_container">
    <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: 100%;height: 10px;"></div>
    <div id="progress_bar_content">Sending assessment results...</div>
</div>
<div id="imagePopup" class="modal">

    <span class="close">&times;</span>

    <img class="modal-content" id="img01">

    <div id="caption"></div>
</div>
<div id="timer_confirm_dialog">
    <div id="timer_dialog_content">You have 60 sec to answer this question.</div>
    <div id="timer_dialog_btn">
        <button>OK</button>
    </div>
</div>
<div id="preview_container">
    <div id="preview_toast" style="display: none;">
        <div id="preview_toast_title">Incorrect</div>
        <div id="preview_toast_body">You didn't choose the correct answer.</div>
    </div>

    <div id="exam_id" style="display: none;"></div>
    @yield('content')
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
{{--<script src="{{ asset('js/toast.js') }}" defer></script>--}}
<script src="{{ asset('js/jquery.hotspot.js') }}" defer></script>
{{--<script src="{{ asset('js/metro.js') }}" defer></script>--}}
<script src="{{ asset('js/main.js') }}" defer></script>
<script src="{{ asset('js/drag_and_drop_mobile.js') }}" defer></script>
<script src="{{ asset('js/preview.js') }}" defer></script>
<script src="https://raw.githack.com/SortableJS/Sortable/master/Sortable.js"></script>
<script>
    function show_modal(type, title, content) {
        switch (type) {
            case 'error':
                $('#preview_toast_title').css('background', '#D55F51');
                break;

            case 'success':
                $('#preview_toast_title').css('background', '#6BBA4A');
                break;
        }

        $('#preview_toast_title').html(title);
        $('#preview_toast_body').html(content);
        $('#preview_toast').fadeIn(500);
        setTimeout(function () {
            $('#preview_toast').fadeOut(1500);
        }, 3000);

        return type + ': ' + title + ': ' + content;
    }

    function image_popup(img_url) {
        $('#imagePopup').fadeIn(500);
        $('#imagePopup .modal-content').attr('src', img_url);
    }

    $('#imagePopup span.close').click(function () {
        $('#imagePopup').fadeOut(500);
    });

</script>
</body>
</html>
