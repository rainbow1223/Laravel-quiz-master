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
                <h4>Short Answer Question</h4>
                <textarea name="question" id="question" cols="30" rows="3">{{ strip_tags($quiz->question) }}</textarea>
            </div>
            <br>

            <h4>Acceptable Answers</h4>
            <div style="height: 216px;overflow-y: scroll;">
                <div>
                    <table class="table striped" style="margin: 0">
                        <thead>
                        <tr>
                            <th>Acceptable Answer</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody id="short_answer_list">
                        <tr>
                            <td>
                                <input id="answer" type="text"
                                       class="form-control @error('answer') is-invalid @enderror" name="answer"
                                       value="{{ $quiz->answer }}" required autocomplete="answer" autofocus>
                            </td>
                            <td><a onclick="{$(this).parent().parent().remove();}"><i
                                        class="fas fa-trash-alt"></i></a></td>
                        </tr>
                        </tbody>
                    </table>
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
                            <input type="checkbox" data-role="checkbox" data-caption="Answers are case sensitive">
                        </div>
                    </div>
                </div>
            </div>
            <div>preview</div>
        </div>
    </div>
</div>

<script>

</script>
