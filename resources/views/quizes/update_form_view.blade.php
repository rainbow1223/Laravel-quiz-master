@switch($quiz->type_id)
    @case(1)
        @include('quiz_form_view.multiple_choice', array('quiz' => $quiz))
        @break

    @case(2)
        @include('quiz_form_view.multiple_response', array('quiz' => $quiz))
        @break

    @case(3)
        @include('quiz_form_view.true_false', array('quiz' => $quiz))
        @break

    @case(4)
        @include('quiz_form_view.short_answer', array('$quiz' => $quiz))
        @break

    @case(5)
        @include('quiz_form_view.numeric', array('quiz' => $quiz))
        @break

    @case(6)
        @include('quiz_form_view.sequence', array('quiz' => $quiz))
        @break

    @case(7)
        @include('quiz_form_view.matching', array('quiz' => $quiz))
        @break

    @case(8)
        @include('quiz_form_view.fill_blanks', array('quiz' => $quiz))
        @break

    @case(9)
        @include('quiz_form_view.select_lists', array('quiz' => $quiz))
        @break

    @case(10)
        @include('quiz_form_view.drag_words', array('quiz' => $quiz))
        @break

    @case(11)
        @include('quiz_form_view.hotspot', array('quiz' => $quiz))
        @break

@endswitch
