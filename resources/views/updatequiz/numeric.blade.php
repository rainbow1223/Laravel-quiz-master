<div class="row" style="height: 100%;margin: 0;">
    <div class="cell-8" style="background: #dcdcdc;display: flex;">
        <div style="margin: auto 10px;background: #f1f1f1;width: 100%;padding: 20px;">
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

            <div>
                <h4>Numeric Question</h4>
                <textarea name="question" id="question" cols="30" rows="3">{{ strip_tags($quiz->question) }}</textarea>
            </div>
            <br>

            <h4>Acceptable Numeric Values</h4>
            <div style="height: 216px;overflow-y: scroll;">
                <div>
                    <table class="table striped" style="margin: 0">
                        <thead>
                        <tr>
                            <th>Acceptable Value</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody id="numeric_list">
                        @foreach($quiz->numeric_answer_contents as $answer_content)
                            <tr>
                                <td>
                                    <div class="select_item" style="display: flex;padding: 5px 0;">
                                        <label for="{{ $answer_content->id }}">Value is: </label>
                                        <select
                                            onchange="{select_change(this);}"
                                            name="{{ $answer_content->id }}"
                                            id="{{ $answer_content->id }}" style="max-width: 160px;">
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
                                        <div style="display: flex;">
                                            <input type="number"
                                                   value="{{$answer_content->input_value_1}}"
                                                   onchange="{save_select_data();}" style="max-width: 100px;">
                                            @if ($answer_content->option_value == '<<')
                                                <span>and</span>
                                                <input
                                                    type="number"
                                                    value="{{$answer_content->input_value_2}}"
                                                    onchange="{save_select_data();}" style="max-width: 100px;">
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a onclick="{$(this).parent().parent().remove();save_select_data();}"><i
                                            class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <select name="add_select" id="add_select" style="max-width: 160px;margin-left: 65px;">
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
                </div>
            </div>

            <br>

            <h4>Feedback and Branching</h4>
            <table class="table striped feedback_branching" style="margin: 0">
                <thead>
                <tr>
                    <th></th>
                    <th>Feedback</th>
                    <th>Branching</th>
                    <th>Score</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Correct:</td>
                    <td><label class="choice_label" data-editable>{{ $quiz->feedback_correct }}</label></td>
                    <td></td>
                    <td>1</td>
                </tr>
                <tr>
                    <td>Incorrect:</td>
                    <td><label class="choice_label" data-editable>{{ $quiz->feedback_incorrect }}</label></td>
                    <td></td>
                    <td>0</td>
                </tr>
                <tr>
                    <td>Try Again:</td>
                    <td><label class="choice_label" data-editable>{{ $quiz->feedback_try_again }}</label></td>
                    <td>None</td>
                    <td>0</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="cell-4 slide_option" style="padding: 0 20px;">
        <h3 style="border-bottom: 1px dotted grey;padding: 15px 10px;">Slide Options</h3>
        <div>
            <div>
                <div class="row" style="padding: 0 10px;">
                    <div class="cell-5">
                        <label for="question_type" style="font-size: 16px;">Question type:</label>
                    </div>
                    <div class="cell-7">
                        <select data-role="select" data-filter="false" name="question_type">
                            <option value="dedicated_graded">Graded</option>
                            <option value="dedicated_survey">Survey</option>
                        </select>
                    </div>
                </div>
                <div id="slide_details" style="padding: 10px 10px 0 20px">
                    <div class="row">
                        <div class="cell-6">
                            <label for="feedback" name="feedback">Feedback:</label>
                        </div>
                        <div class="cell-6">
                            <select data-role="select" data-filter="false" name="feedback">
                                <option value="none">None</option>
                                <option value="by_result" selected>By Result</option>
                            </select>
                        </div>
                        <div class="cell-6">
                            <label for="score" name="score">Score:</label>
                        </div>
                        <div class="cell-6">
                            <select data-role="select" data-filter="false" name="score" disabled>
                                <option value="by_result" selected>By Result</option>
                                <option value="by_choice">By Choice</option>
                            </select>
                        </div>
                        <div class="cell-6">
                            <label for="attempts" name="attempts">Attempts:</label>
                        </div>
                        <div class="cell-6">
                            <select data-role="select" data-filter="false" name="attempts">
                                <option value="1">1</option>
                                <option value="2" selected>2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="unlimited">Unlimited</option>
                            </select>
                        </div>
                        <div class="cell-7">
                            <input type="checkbox" data-role="checkbox"
                                   data-caption="Limit time to answer the question:">
                        </div>
                        <div class="cell-5">
                            <input class="mt-1" type="time" data-role="input" value="01:00" disabled
                                   data-clear-button="false">
                        </div>
                    </div>
                </div>
            </div>
            <div>preview</div>
        </div>
    </div>
</div>
<script>
    function get_select_item_id() {
        const length = $('.select_item').length;

        let id = 1;

        if (length > 0) {
            id = 0;
            for (let i = 0; i < length; i++) {
                if (parseInt($('.select_item select:nth-child(1)').eq(i).attr('id')) > id) {
                    id = parseInt($('.select_item select:nth-child(1)').eq(i).attr('id')) + 1;
                }
            }
        }
        console.log("id", id);
        return id;
    }

    $('#add_select').change(function () {

        if (this.value !== '+') {
            const id = get_select_item_id();

            let element;

            if (this.value === '<<') {
                element = $('<tr><td><div class="select_item" style="display: flex;padding: 5px 0;"><label for="' + id + '">Value is: </label><select onchange="{select_change(this);}" name="' + id + '" id="' + id + '" style="max-width: 160px;"><option value="==">Equal to</option><option value="<<">Between</option><option value=">">Greater than</option><option value=">=">Greater than or equal to</option><option value="<">Less than</option><option value="<=">Less than or equal to</option><option value="!=">Not equal to</option></select><div style="display: flex;"><input type="number" value="0" onchange="{save_select_data();}" style="max-width: 100px;"><span>and</span><input type="number" value="0" onchange="{save_select_data();}" style="max-width: 100px;"></div></div></td><td><a onclick="{$(this).parent().parent().remove();save_select_data();}"><i class="fas fa-trash-alt"></i></a></td></tr>');
            } else {
                element = $('<tr><td><div class="select_item" style="display: flex;padding: 5px 0;"><label for="' + id + '">Value is: </label><select onchange="{select_change(this);}" name="' + id + '" id="' + id + '" style="max-width: 160px;"><option value="==">Equal to</option><option value="<<">Between</option><option value=">">Greater than</option><option value=">=">Greater than or equal to</option><option value="<">Less than</option><option value="<=">Less than or equal to</option><option value="!=">Not equal to</option></select><div style="display: flex;"><input type="number" value="0" onchange="{save_select_data();}" style="max-width: 100px;"></div></div></td><td><a onclick="{$(this).parent().parent().remove();save_select_data();}"><i class="fas fa-trash-alt"></i></a></td></tr>');
            }
            $('tbody#numeric_list').append(element);
            $('select#' + id).val(this.value);
        }

        $(this).val('+');
        save_select_data();
    });

    function select_change(select) {
        console.log(select.value);
        if (select.value === '<<') {
            $(select).next().html('<input type="number" value="0" onchange="{save_select_data();}" style="max-width: 100px;"><span>and</span><input type="number" value="0" onchange="{save_select_data();}" style="max-width: 100px;">');
        } else {
            $(select).next().html('<input type="number" value="0" onchange="{save_select_data();}" style="max-width: 100px;">');
        }
        save_select_data();
    }

    function save_select_data() {
        const length = $('.select_item').length;

        let select_answer_array = '';

        for (let i = 0; i < length; i++) {
            let value = $('#numeric_list tr:nth-child(' + (i + 1) + ') select').val();
            select_answer_array += value + ';';
            if (value === '<<') {
                select_answer_array += $('#numeric_list tr:nth-child(' + (i + 1) + ') input:nth-child(1)').val() + ';' + $('#numeric_list tr:nth-child(' + (i + 1) + ') input:nth-child(1)').next().next().val() + '@';
            } else {
                select_answer_array += $('#numeric_list tr:nth-child(' + (i + 1) + ') input:nth-child(1)').val() + ';' + '@';
            }
        }

        console.log(select_answer_array);
        $('input#select_answer').val(select_answer_array);
    }
</script>
