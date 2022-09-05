@switch($quiz_type)
    @case(1)
        @include('createquiz.multiple_choice', array('quiz_type' => $quiz_type, 'exam_id' => $exam_id))
        @break

    @case(2)
        @include('createquiz.multiple_response', array('quiz_type' => $quiz_type, 'exam_id' => $exam_id))
        @break

    @default
        @include('createquiz.multiple_choice', array('quiz_type' => $quiz_type, 'exam_id' => $exam_id))

@endswitch
