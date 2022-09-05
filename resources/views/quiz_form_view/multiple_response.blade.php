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
                <h4>Multiple Response Question</h4>
                <textarea name="question" id="question" cols="30"
                          rows="3">Select one or more correct answers:</textarea>
            </div>
            <br>

            <h4>Choices</h4>
            <div style="height: 216px;overflow-y: scroll;">
                <input id="response_id_array" type="text"
                       class="form-control @error('response_id_array') is-invalid @enderror"
                       name="response_id_array"
                       value="" autocomplete="response_id_array" autofocus hidden>
                <div>
                    <table class="table striped" style="margin: 0">
                        <thead>
                        <tr>
                            <th>Correct</th>
                            <th>Choice</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody id="response_list">
                        <tr class="response_item">
                            <td><input type="checkbox" onclick="responsehandleclick();" id="1" name="1" value="1" style="padding-right: 10px;" checked>
                            </td>
                            <td><label class="response_label" data-editable
                                       for="1">Option 1</label>
                            </td>
                            <td></td>
                            <td><a onclick="{$(this).parent().parent().remove();save_response_data();}"><i
                                        class="fas fa-trash-alt"></i></a></td>
                        </tr>
                        <tr class="response_item">
                            <td><input type="checkbox" onclick="responsehandleclick();" id="2" name="2" value="2" style="padding-right: 10px;">
                            </td>
                            <td><label class="response_label" data-editable
                                       for="2">Option 2</label>
                            </td>
                            <td></td>
                            <td><a onclick="{$(this).parent().parent().remove();save_response_data();}"><i
                                        class="fas fa-trash-alt"></i></a></td>
                        </tr>
                        <tr class="response_item">
                            <td><input type="checkbox" onclick="responsehandleclick();" id="3" name="3" value="3" style="padding-right: 10px;">
                            </td>
                            <td><label class="response_label" data-editable
                                       for="3">Option 3</label>
                            </td>
                            <td></td>
                            <td><a onclick="{$(this).parent().parent().remove();save_response_data();}"><i
                                        class="fas fa-trash-alt"></i></a></td>
                        </tr>
                        </tbody>
                    </table>
                    <a id="add_response" style="padding: 10px 0;margin-left: 90px;margin-top: 10px;">Type to add a new
                        choice</a>
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
                    <td><label class="choice_label" data-editable>That's right! You answered correctly.</label></td>
                    <td></td>
                    <td>1</td>
                </tr>
                <tr>
                    <td>Incorrect:</td>
                    <td><label class="choice_label" data-editable>You did not choose the correct response.</label></td>
                    <td></td>
                    <td>0</td>
                </tr>
                <tr>
                    <td>Try Again:</td>
                    <td><label class="choice_label" data-editable>Try again.</label></td>
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
                            <select data-role="select" data-filter="false" name="score">
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
                        <div class="cell-12">
                            <input type="checkbox" data-role="checkbox" data-caption="Shuffle answers">
                        </div>
                        <div class="cell-12">
                            <input type="checkbox" data-role="checkbox" data-caption="Accept partially correct answers">
                        </div>
                        <div class="cell-12">
                            <input type="checkbox" data-role="checkbox" data-caption="Limit number of responses:(1)">
                        </div>
                    </div>
                </div>
            </div>
            <div>preview</div>
        </div>
    </div>
</div>

<script>
    function get_response_item_id() {
        const length = $('.response_item').length;

        let id = 1;

        if (length > 0) {
            id = 0;

            for (let i = 0; i < length; i++) {
                const inputId = parseInt($('.response_item input').eq(i).attr('id'));
                if (inputId > id) id = inputId + 1;
            }
        }

        return id;
    }

    function save_response_data() {
        const length = $('.response_item').length;

        let response_id_array = '';
        let answer_content_array = '';

        for (let i = 0; i < length; i++) {
            response_id_array += $('.response_item input').eq(i).attr('id') + ';';
            answer_content_array += $('.response_item label').eq(i).html() + ';';
        }

        console.log(response_id_array, answer_content_array);

        $('input#answer_content_array').val(answer_content_array);
        $('input#response_id_array').val(response_id_array);
    }

    $('#add_response').click(function () {

        const id = get_response_item_id();

        const element = $('<tr class="response_item"><td><input onclick="responsehandleclick();" type="checkbox" id="' + id + '" name="answer" value="' + id + '" style="padding-right: 10px;"></td><td><label class="response_label" data-editable for="' + id + '">Type content ...</label></td><td></td><td><a onclick="{$(this).parent().parent().remove();save_response_data();}"><i class="fas fa-trash-alt"></i></a></td></tr>');
        $('tbody#response_list').append(element);

        save_response_data();
    });

    function responsehandleclick() {
        const length = $('.response_item').length;

        let answer_array = '';

        for (let i = 0; i < length; i++) {
            if ($('.response_item input').eq(i)[0].checked) {
                answer_array += $('.response_item input').eq(i).attr('id') + ';';
            }
        }

        console.log(answer_array);

        $('input#answer').val(answer_array);
    }

</script>
