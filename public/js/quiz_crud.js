let prev_id = '';
let clicked_node;
let is_active_real_time_update_slide_view_nav = false;
var preview_timer;
let create_type_id;
var tmp_selected_node_id_list = [];
var shift_prev_id = '';

var keyPressed = 'undefined';

$(document).keydown(function (event) {
    if (event.which == "17") keyPressed = 'ctrl';
    if (event.which == '16') keyPressed = 'shift'
});

$(document).keyup(function () {
    keyPressed = 'undefined';
});

function show_quiz_editor(node) {
    const root_url = $('meta[name=url]').attr('content');
    const quizId = node.attr('id');

    $('#quiz_view').show();
    $('#no_question_slide').hide();

    $('.preview_item').removeClass('selected_preview_item');

    $('#duplicate_btn').removeAttr('disabled');
    $('#question_group_btn').removeAttr('disabled');
    $('.info_slide_btn').removeAttr('disabled');

    if (quizId == 'none' || quizId === undefined) {

        $('#quiz_view').hide();
        $('#no_question_slide').show();

        $('#duplicate_btn').attr('disabled', '');
        return;
    }

    const node_question_type = node.find('.content').html();

    if (node_question_type == '<i>Passed</i>' || node_question_type == '<i>Failed</i>') {
        $('#duplicate_btn').attr('disabled', '');
        $('#question_group_btn').attr('disabled', '');
        $('.info_slide_btn').attr('disabled', '');
    }

    if (node_question_type == '<i>Quiz Instructions</i>') {
        $('#duplicate_btn').attr('disabled', '');
    }

    show_preload();

    $.get(root_url + "/quizes/" + quizId + "/edit", function (data, status) {
        $('.selected_preview_item').removeClass('selected_preview_item');
        $('#preview_item-' + quizId).addClass('selected_preview_item');

        $('#quiz_view').html(data);
        show_correct_view();
        localStorage.setItem("is_edited", "false");
        if ($('#quiz_view .slide_view_group_checkbox').length === 0) $('#quiz_view .slide_view_group').append('<input class="slide_view_group_checkbox" type="checkbox" style="position: absolute;top: 0;left: 0;">');
        hide_preload();
        real_time_update_slide_view_nav_active();
    }).catch((XHttpResponse) => {
        console.log(XHttpResponse);
        if (XHttpResponse.responseJSON.message == '' && XHttpResponse.status == 404) {
            window.location.href = '/';
        }
        hide_preload();
        real_time_update_slide_view_nav_active();
    });
}

$('#alert_save').click(function () {
    console.log('alert_save');
    const root_url = $('meta[name=url]').attr('content');
    const token = $('meta[name=csrf-token]').attr('content');

    if ($('#node_click_or_create').val() == 'node_click') update_quiz(true);
    if ($('#node_click_or_create').val() == 'create') {
        update_quiz(false);


        create_question(create_type_id, root_url, token);
    }

    if ($('#node_click_or_create').val() == 'redirect_exams') {
        update_quiz(false);

        window.location.href = root_url + '/exams';
    }

    if ($('#node_click_or_create').val() == 'redirect_users') {
        update_quiz(false);

        window.location.href = root_url + '/users';
    }

    if ($('#node_click_or_create').val() == 'quiz_properties') {
        update_quiz(false);

        window.location.href = root_url + '/exams/' + $('#exam_id').val() + '/edit';
    }

    init_styling_and_layout();

    $('#question_save_alert').fadeOut(300);

});

$('#alert_not_save').click(function () {
    console.log('alert_not_save');
    const root_url = $('meta[name=url]').attr('content');
    const token = $('meta[name=csrf-token]').attr('content');

    if ($('#node_click_or_create').val() == 'node_click') {
        show_quiz_editor(clicked_node);
        prev_id = clicked_node.attr('id');
    }

    if ($('#node_click_or_create').val() == 'create') {

        create_question(create_type_id, root_url, token);
    }

    if ($('#node_click_or_create').val() == 'redirect_exams') {
        window.location.href = root_url + '/exams';
    }

    if ($('#node_click_or_create').val() == 'redirect_users') {
        window.location.href = root_url + '/users';
    }

    if ($('#node_click_or_create').val() == 'quiz_properties') {
        window.location.href = root_url + '/exams/' + $('#exam_id').val() + '/edit';
    }

    init_styling_and_layout();

    $('#question_save_alert').fadeOut(300);
    real_time_update_slide_view_nav_active();
});

$('#alert_cancel').click(function () {
    console.log('alert_cancel');

    if ($('#node_click_or_create').val() == 'node_click') {
        $('#quiz_list').find('.current').removeClass('current current-select');
        $('#quiz_list li#' + prev_id).addClass('current current-select');
    }

    console.log(prev_id);
    // $('.selected_preview_item').removeClass('selected_preview_item');
    // $('#preview_item-' + prev_id).addClass('selected_preview_item');

    $('#question_save_alert').fadeOut(300);
    real_time_update_slide_view_nav_active();
});

function redirect_exams() {
    const root_url = $('meta[name=url]').attr('content');

    if (is_edited()) {

        $('#node_click_or_create').val('redirect_exams');
        $('#question_save_alert').fadeIn(300);
    } else {
        window.location.href = root_url + '/exams';
    }
}

$('#quiz_properties_btn').click(function () {
    const root_url = $('meta[name=url]').attr('content');

    if (is_edited()) {

        $('#node_click_or_create').val('quiz_properties');
        $('#question_save_alert').fadeIn(300);
    } else {
        window.location.href = root_url + '/exams/' + $('#exam_id').val() + '/edit';
    }
});

function redirect_users() {
    const root_url = $('meta[name=url]').attr('content');

    if (is_edited()) {

        $('#node_click_or_create').val('redirect_users');
        $('#question_save_alert').fadeIn(300);
    } else {
        window.location.href = root_url + '/users';
    }
}

function highlight_selected_node() {
    for (let i = 0; i < tmp_selected_node_id_list.length; i++) {
        $('#' + tmp_selected_node_id_list[i]).addClass('current');
        $('#' + tmp_selected_node_id_list[i]).addClass('current-select');
    }
}

function get_id_between_2_elements(prev_id, current_id) {
    var elements = $('.node');
    var node_id_list = [];

    for (let i = 0; i < elements.length; i++) {
        node_id_list.push(elements.eq(i).attr('id'));
    }

    console.log('node_id_list ', node_id_list);

    var prev_index = node_id_list.indexOf(prev_id);
    var current_index = node_id_list.indexOf(current_id);

    console.log(prev_index, current_index);

    if (current_index < prev_index) {
        return node_id_list.slice(current_index + 1, prev_index + 1);
    } else {
        return node_id_list.slice(prev_index + 1, current_index + 1);
    }
}

function shift_get_tmp_list(prev_id, current_id) {
    var shift_index_list = get_id_between_2_elements(prev_id, current_id);

    for (let i = 0; i < shift_index_list.length; i++) {
        if (!tmp_selected_node_id_list.includes(shift_index_list[i])) {
            tmp_selected_node_id_list.push(shift_index_list[i]);
        } else {
            tmp_selected_node_id_list.splice(tmp_selected_node_id_list.indexOf(shift_index_list[i]), 1);
            $('#' + shift_index_list[i]).removeClass('current');
            $('#' + shift_index_list[i]).removeClass('current-select');
        }
    }
}

function shift_hightlight_selected_node(prev_id, current_id) {
    shift_get_tmp_list(prev_id, current_id);
    highlight_selected_node();
}

function onNodeClick(node) {

    switch (keyPressed) {
        case 'ctrl':
            console.log('ctrl + click');
            console.log('tmp_selected_node_id_list', tmp_selected_node_id_list);

            var current_ctrl_id = $('.node.current').attr('id');

            if (!tmp_selected_node_id_list.includes(current_ctrl_id)) {
                tmp_selected_node_id_list.push(current_ctrl_id);
            } else {
                tmp_selected_node_id_list.splice(tmp_selected_node_id_list.indexOf(current_ctrl_id), 1);
                $('#' + current_ctrl_id).removeClass('current');
                $('#' + current_ctrl_id).removeClass('current-select');
            }
            highlight_selected_node();
            shift_prev_id = current_ctrl_id;
            break;

        case 'shift':
            console.log('shift + click');

            if (shift_prev_id == '') shift_prev_id = prev_id;
            var current_shift_id = $('.node.current').attr('id');

            shift_hightlight_selected_node(shift_prev_id, current_shift_id);
            shift_prev_id = current_shift_id;
            break;

        default:
            tmp_selected_node_id_list = [];
            shift_prev_id = '';

            clicked_node = node;

            if (prev_id === '') {
                real_time_update_slide_view_nav_inactive();
                show_quiz_editor(node);
                prev_id = node.attr('id');
                init_styling_and_layout();

                tmp_selected_node_id_list.push(prev_id);

                return;
            }

            if (prev_id === node.attr('id')) {
                tmp_selected_node_id_list.push(prev_id);
                return;
            }
            real_time_update_slide_view_nav_inactive();
            if (is_edited()) {
                $('#node_click_or_create').val('node_click');
                $('#question_save_alert').fadeIn(300);

            } else {
                show_quiz_editor(node);
                prev_id = node.attr('id');
                init_styling_and_layout();
            }

            tmp_selected_node_id_list.push(prev_id);
            break;
    }

}

function is_edited() {
    return localStorage.getItem('is_edited') == 'true';
}

function create_quiz(quiz_type, root_url, token) {

    if (is_edited()) {
        $('#node_click_or_create').val('create');
        create_type_id = quiz_type;
        $('#question_save_alert').fadeIn(300);

    } else {
        create_question(quiz_type, root_url, token);
        init_styling_and_layout();
    }
    console.log('prev_id: ', prev_id);
}

function create_question(quiz_type, root_url, token) {

    let quizId;
    const lv = Metro.getPlugin('#quiz_list', 'listview');
    const parentNode = $('.current').closest('.node-group');
    let groupId = parentNode.attr('id');
    const node = parentNode.find('li.current').eq(0);
    // const node = parentNode.find('li:last');
    const firstParentNode = $('.node-group:first');
    const firstNode = firstParentNode.find('li:first');

    if (quiz_type == 13) {
        groupId = firstParentNode.attr('id');
    }

    if (parentNode.attr('data-caption') == 'Results') {
        show_modal('error', 'Warning', 'You can\'t insert quizzes at Results Group!');
        return;
    }

    switch (quiz_type) {
        case (1):
            lv.insertAfter(node, {
                caption: 'Select the correct answer option:',
                content: '<i>Multiple Choice</i>'
            });
            break;


        case (2):
            lv.insertAfter(node, {
                caption: 'Select one or more correct answers:',
                content: '<i>Multiple Response</i>'
            });
            break;

        case (3):
            lv.insertAfter(node, {
                caption: 'Choose whether the statement is true or false:',
                content: '<i>True/False</i>'
            });
            break;

        case (4):
            lv.insertAfter(node, {
                caption: 'Type your response:',
                content: '<i>Short Answer</i>'
            });
            break;

        case (5):
            lv.insertAfter(node, {
                caption: 'Type your response:',
                content: '<i>Numeric</i>'
            });
            break;

        case (6):
            lv.insertAfter(node, {
                caption: 'Arrange the following items in the correct order:',
                content: '<i>Sequence</i>'
            });
            break;

        case (7):
            lv.insertAfter(node, {
                caption: 'Match the following items with their descriptions:',
                content: '<i>Matching</i>'
            });
            break;

        case (8):
            lv.insertAfter(node, {
                caption: 'Fill in the blank fields in this text:',
                content: '<i>Fill in the Blanks</i>'
            });
            break;

        case (9):
            lv.insertAfter(node, {
                caption: 'Choose the correct answer in each drop-down list:',
                content: '<i>Select from Lists</i>'
            });
            break;

        case (10):
            lv.insertAfter(node, {
                caption: 'Drag and drop the words to their places:',
                content: '<i>Drag the Words</i>'
            });
            break;

        case (11):
            lv.insertAfter(node, {
                caption: 'Click on the correct area in the image.',
                content: '<i>Hotspot</i>'
            });
            break;

        case (12):
            lv.insertAfter(node, {
                caption: 'Title',
                content: '<i>Info Slide</i>'
            });
            break;

        case (13):
            lv.insertBefore(firstNode, {
                caption: 'Quiz Instructions',
                content: '<i>Quiz Instructions</i>'
            });
            break;

        default:
    }

    $('#quiz_list').find('.current').removeClass('current current-select');
    if (quiz_type == 13) {
        firstParentNode.find('li').eq(0).addClass('current current-select');
    } else {
        node.next().addClass('current current-select');
    }

    let order = parseInt(node.attr('order')) + 1;
    if (node.attr('id') === 'none' || node.attr('id') === undefined) order = 0;
    if (quiz_type == 13) order = 0;
    // return;

    if (groupId === undefined) {
        show_modal('error', 'Warning', 'Choose a quiz and then insert a new quiz');
        return;
    }

    const exam_id = $('#exam_id').val();

    show_preload();
    $.post(root_url + "/quizes", {
            '_token': token,
            'type_id': quiz_type,
            'exam_group_id': groupId,
            'exam_id': exam_id,
            'order': order,
        },
        function (data, status) {
            quizId = data;

            let caption;

            if (quiz_type == 13) {
                for (let i = 0; i < firstParentNode.find('li.node').length; i++) {
                    if (parseInt(firstParentNode.find('li.node').eq(i).attr('order')) >= order) {
                        firstParentNode.find('li.node').eq(i).attr('order', parseInt(firstParentNode.find('li.node').eq(i).attr('order')) + 1);
                    }
                }
            } else {
                for (let i = 0; i < parentNode.find('li.node').length; i++) {
                    if (parseInt(parentNode.find('li.node').eq(i).attr('order')) >= order) {
                        parentNode.find('li.node').eq(i).attr('order', parseInt(parentNode.find('li.node').eq(i).attr('order')) + 1);
                    }
                }
            }

            if (quiz_type == '13') {
                firstParentNode.find('li').eq(0).addClass('instruction_node');
                firstParentNode.find('li').eq(0).attr('id', quizId);
                firstParentNode.find('li').eq(0).attr('order', order);
                $('#introduction_btn').attr('disabled', '');
            } else {
                node.next().attr('id', quizId);
                node.next().attr('order', order);
            }


            if (node.attr('id') === 'none' || node.attr('id') === undefined) node.remove();

            $.get(root_url + "/quizes/" + quizId + "/edit", function (data, status) {
                $('#quiz_view').show();
                $('#no_question_slide').hide();

                $('#quiz_view').html(data);

                const element = '<div id="preview_item-' + quizId + '" class="preview_item selected_preview_item">' + $('#quiz_view .slide_view_element').html().replace('top:50%;left:50%;transform:translate(-50%, -50%);', '') + '</div>';

                if (quiz_type == '13') {
                    $('#slide_view_quiz_list').prepend(element);
                } else {
                    if (prev_id == undefined || prev_id == 'none' || prev_id == '') {
                        if ($('#slide_view_quiz_list .preview_item').length == 2) {
                            $('#slide_view_quiz_list').prepend(element);
                        } else {
                            const tmp_id = $('.node.current').closest('.node-group').prev().find('.listview').eq(0).find('li.node').last().eq(0).attr('id');
                            $(element).insertAfter($('#preview_item-' + tmp_id));
                        }
                    } else {
                        $(element).insertAfter($('#preview_item-' + prev_id));
                    }
                }

                $('#preview_item-' + quizId).css({
                    'width': $('#preview_item-' + prev_id).css('width'),
                    'height': $('#preview_item-' + prev_id).css('height'),
                });

                $('#preview_item-' + quizId + ' > div').css({
                    'margin': 'auto',
                    'top': '50%',
                    'left': '50%',
                    'transform': $('#preview_item-' + prev_id + ' > div').css('transform'),
                });

                $('.selected_preview_item').removeClass('selected_preview_item');
                $('#preview_item-' + quizId).addClass('selected_preview_item');

                show_correct_view();
                hide_preload();

                prev_id = quizId;

                tmp_selected_node_id_list = [prev_id];
            }).catch((XHttpResponse) => {
                console.log(XHttpResponse);
                if (XHttpResponse.responseJSON.message == '' && XHttpResponse.status == 404) {
                    window.location.href = '/';
                }
                hide_preload();
            });
        }).catch((XHttpResponse) => {
        console.log(XHttpResponse);
        if (XHttpResponse.responseJSON.message == '' && XHttpResponse.status == 404) {
            window.location.href = '/';
        }
        hide_preload();
    });
}

function update_and_show_preview(url) {
    if (is_form_or_slide() === 'form') {
        form_to_slide();
    }

    if (is_form_or_slide() === 'slide') {
        slide_to_form();
    }

    if ($('#quiz_view .slide_view_group_checkbox').length === 0) $('#quiz_view .slide_view_group').append('<input class="slide_view_group_checkbox" type="checkbox" style="position: absolute;top: 0;left: 0;">');


    const typeId = $('#type_id').val();
    let question_element = $('#quiz_view .slide_view_question_element')[0].outerHTML;

    const answer = $('#answer_content').val();

    if (!validate_correct_answer_type(typeId, answer)) {
        show_modal('error', 'Warning', 'You should complete correct answer about this question.');
        return;
    }

    const feedback_correct = $('.feedback_branching tr:first-child td:nth-child(2) label').html();
    const feedback_incorrect = $('.feedback_branching tr:nth-child(2) td:nth-child(2) label').html();
    const feedback_try_again = $('.feedback_branching tr:nth-child(3) td:nth-child(2) label').html();
    const correct_score = $('.feedback_branching tr:first-child td:nth-child(3) label').html();
    const incorrect_score = $('.feedback_branching tr:nth-child(2) td:nth-child(3) label').html();
    const try_again_score = $('.feedback_branching tr:nth-child(3) td:nth-child(3) label').html();
    const media = $('#media').val();
    const video = $('#video').val();
    const audio = $('#audio').val();
    const background_img = $('#background_img').val();
    // const order
    let answer_element = $('#quiz_view .slide_view_answer_element')[0].outerHTML;
    let media_element = $('#quiz_view .slide_view_media_element')[0] == undefined ? null : $('#quiz_view .slide_view_media_element')[0].outerHTML;
    let video_element = $('#quiz_view .slide_view_video_element')[0] == undefined ? null : $('#quiz_view .slide_view_video_element')[0].outerHTML;
    const question_type = Metro.getPlugin('#question_type', 'select').val();
    const feedback_type = Metro.getPlugin('#feedback', 'select').val();

    question_element = remove_resizable_tag(question_element);
    answer_element = remove_resizable_tag(answer_element);
    media_element = remove_resizable_tag(media_element);
    video_element = remove_resizable_tag(video_element);

    let branching;
    if ($('#branching:disabled').length !== 0 || $('#branching').length === 0) {
        branching = null;
    } else {
        branching = Metro.getPlugin('#branching', 'select').val();
    }

    // const score = Metro.getPlugin('#score', 'select').val();
    const attempts = Metro.getPlugin('#attempts', 'select').val();

    let is_limit_time = $('#is_limit_time').is(":checked");
    is_limit_time = is_limit_time ? 1 : 0;
    if ($('#is_limit_time').length === 0) is_limit_time = null;

    const limit_time = $('#limit_time').val();

    if (limit_time.indexOf('_') != -1 || limit_time == '') {
        show_modal('error', 'Warning', 'You should enter correct limit time.');
        return;
    }

    let shuffle_answers = $('#shuffle_answers').is(":checked");
    shuffle_answers = shuffle_answers ? 1 : 0;
    if ($('#shuffle_answers').length === 0) shuffle_answers = null;

    let partially_correct = $('#partially_correct').is(":checked");
    partially_correct = partially_correct ? 1 : 0;
    if ($('#partially_correct').length === 0) partially_correct = null;

    let limit_number_response = $('#limit_number_response').is(":checked");
    limit_number_response = limit_number_response ? 1 : 0;
    if ($('#limit_number_response').length === 0) limit_number_response = null;

    let case_sensitive = $('#case_sensitive').is(":checked");
    case_sensitive = case_sensitive ? 1 : 0;
    if ($('#case_sensitive').length === 0) case_sensitive = null;


    let other_elements = '';
    for (let i = 0; i < $('#quiz_view .slide_view_element .other_slide_view_element').length; i++) {
        other_elements += remove_resizable_tag($('#quiz_view .slide_view_element .other_slide_view_element').eq(i)[0].outerHTML);
    }

    const root_url = $('meta[name=url]').attr('content');
    const token = $('meta[name=csrf-token]').attr('content');
    const quizId = $('#quiz_list').find('.current').attr('id');

    show_preload();
    $.ajax({
        url: root_url + '/quizes/' + quizId,
        type: 'PUT',
        data: {
            _token: token,
            question_element: question_element,
            answer: answer,
            answer_element: answer_element,
            media_element: media_element,
            feedback_correct: feedback_correct,
            feedback_incorrect: feedback_incorrect,
            feedback_try_again: feedback_try_again,
            media: media,
            media_element: media_element,
            video: video,
            audio: audio,
            video_element: video_element,
            background_img: background_img,
            // order: order,
            question_type: question_type,
            feedback_type: feedback_type,
            branching: branching,
            // score: score,
            attempts: attempts,
            is_limit_time: is_limit_time,
            limit_time: limit_time,
            shuffle_answers: shuffle_answers,
            partially_correct: partially_correct,
            limit_number_response: limit_number_response,
            case_sensitive: case_sensitive,
            correct_score: correct_score,
            incorrect_score: incorrect_score,
            try_again_score: try_again_score,
            other_elements: other_elements,
        },
        success: function (data) {
            hide_preload();
            localStorage.setItem('is_edited', 'false');
            window.open(url);
        }
    }).catch((XHttpResponse) => {
        console.log(XHttpResponse);
        if (XHttpResponse.responseJSON.message == '' && XHttpResponse.status == 404) {
            window.location.href = '/';
        }
        hide_preload();
    });
}

function validate_correct_answer_type(question_type_id, answer) {
    switch (question_type_id) {
        case '1':
            return answer != '';
            break;

        case '2':
            return answer != '';
            break;

        case '4':
            return answer != '';
            break;

        case '5':
            return answer != '' && answer.indexOf(';;') == -1;
            break;

        case '6':
            return answer != '';
            break;

        case '7':
            return answer != '';
            break;

        case '8':
            return answer != '' && answer != '@' && answer.indexOf('@@') == -1;
            break;

        case '9':
            return answer != '' && answer.indexOf('undefined') == -1;
            break;

        case '10':
            return answer != '' && answer != ';' && answer.indexOf(';;') == -1;
            break;

        case '11':
            return answer.indexOf('@{}') == -1;
            break;

        default:
            return true;
    }
}

function update_quiz(is_alert_save) {

    if (is_form_or_slide() === 'form') {
        form_to_slide();
    }

    if (is_form_or_slide() === 'slide') {
        slide_to_form();
    }

    if ($('#quiz_view .slide_view_group_checkbox').length === 0) $('#quiz_view .slide_view_group').append('<input class="slide_view_group_checkbox" type="checkbox" style="position: absolute;top: 0;left: 0;">');


    const typeId = $('#type_id').val();
    let question_element = $('#quiz_view .slide_view_question_element')[0].outerHTML;

    const answer = $('#answer_content').val();

    if (!validate_correct_answer_type(typeId, answer)) {
        show_modal('error', 'Warning', 'You should complete correct answer about this question.');
        return;
    }

    const feedback_correct = $('.feedback_branching tr:first-child td:nth-child(2) label').html();
    const feedback_incorrect = $('.feedback_branching tr:nth-child(2) td:nth-child(2) label').html();
    const feedback_try_again = $('.feedback_branching tr:nth-child(3) td:nth-child(2) label').html();
    const correct_score = $('.feedback_branching tr:first-child td:nth-child(3) label').html();
    const incorrect_score = $('.feedback_branching tr:nth-child(2) td:nth-child(3) label').html();
    const try_again_score = $('.feedback_branching tr:nth-child(3) td:nth-child(3) label').html();
    const media = $('#media').val();
    const video = $('#video').val();
    const audio = $('#audio').val();
    const background_img = $('#background_img').val();
    // const order
    let answer_element = $('#quiz_view .slide_view_answer_element')[0].outerHTML;
    let media_element = $('#quiz_view .slide_view_media_element')[0] == undefined ? null : $('#quiz_view .slide_view_media_element')[0].outerHTML;
    let video_element = $('#quiz_view .slide_view_video_element')[0] == undefined ? null : $('#quiz_view .slide_view_video_element')[0].outerHTML;
    const question_type = Metro.getPlugin('#question_type', 'select').val();
    const feedback_type = Metro.getPlugin('#feedback', 'select').val();

    question_element = remove_resizable_tag(question_element);
    answer_element = remove_resizable_tag(answer_element);
    media_element = remove_resizable_tag(media_element);
    video_element = remove_resizable_tag(video_element);

    let branching;
    if ($('#branching:disabled').length !== 0 || $('#branching').length === 0) {
        branching = null;
    } else {
        branching = Metro.getPlugin('#branching', 'select').val();
    }

    // const score = Metro.getPlugin('#score', 'select').val();
    const attempts = Metro.getPlugin('#attempts', 'select').val();

    let is_limit_time = $('#is_limit_time').is(":checked");
    is_limit_time = is_limit_time ? 1 : 0;
    if ($('#is_limit_time').length === 0) is_limit_time = null;

    const limit_time = $('#limit_time').val();

    if (limit_time.indexOf('_') != -1 || limit_time == '') {
        show_modal('error', 'Warning', 'You should enter correct limit time.');
        return;
    }

    let shuffle_answers = $('#shuffle_answers').is(":checked");
    shuffle_answers = shuffle_answers ? 1 : 0;
    if ($('#shuffle_answers').length === 0) shuffle_answers = null;

    let partially_correct = $('#partially_correct').is(":checked");
    partially_correct = partially_correct ? 1 : 0;
    if ($('#partially_correct').length === 0) partially_correct = null;

    let limit_number_response = $('#limit_number_response').is(":checked");
    limit_number_response = limit_number_response ? 1 : 0;
    if ($('#limit_number_response').length === 0) limit_number_response = null;

    let case_sensitive = $('#case_sensitive').is(":checked");
    case_sensitive = case_sensitive ? 1 : 0;
    if ($('#case_sensitive').length === 0) case_sensitive = null;


    let other_elements = '';
    for (let i = 0; i < $('#quiz_view .slide_view_element .other_slide_view_element').length; i++) {
        other_elements += remove_resizable_tag($('#quiz_view .slide_view_element .other_slide_view_element').eq(i)[0].outerHTML);
    }

    const root_url = $('meta[name=url]').attr('content');
    const token = $('meta[name=csrf-token]').attr('content');
    const quizId = $('#quiz_list').find('.current').attr('id');

    console.log(root_url + '/quizes/' + (is_alert_save ? prev_id : quizId));

    show_preload();
    $.ajax({
        url: root_url + '/quizes/' + (is_alert_save ? prev_id : quizId),
        type: 'PUT',
        data: {
            _token: token,
            question_element: question_element,
            answer: answer,
            answer_element: answer_element,
            media_element: media_element,
            feedback_correct: feedback_correct,
            feedback_incorrect: feedback_incorrect,
            feedback_try_again: feedback_try_again,
            media: media,
            media_element: media_element,
            video: video,
            audio: audio,
            video_element: video_element,
            background_img: background_img,
            // order: order,
            question_type: question_type,
            feedback_type: feedback_type,
            branching: branching,
            // score: score,
            attempts: attempts,
            is_limit_time: is_limit_time,
            limit_time: limit_time,
            shuffle_answers: shuffle_answers,
            partially_correct: partially_correct,
            limit_number_response: limit_number_response,
            case_sensitive: case_sensitive,
            correct_score: correct_score,
            incorrect_score: incorrect_score,
            try_again_score: try_again_score,
            other_elements: other_elements,
        },
        success: function (data) {
            console.log(typeId);
            if (typeId > 11) {
                show_modal('success', 'Success', 'Slide updated successfully');
            } else {
                show_modal('success', 'Success', 'Question updated successfully');
            }
            store_quiz_state();
            if (is_alert_save) {
                show_quiz_editor(clicked_node);
                prev_id = clicked_node.attr('id');
                init_styling_and_layout();
                real_time_update_slide_view_nav_active();
            }
            localStorage.setItem('is_edited', 'false');
            hide_preload();
        }
    }).catch((XHttpResponse) => {
        console.log(XHttpResponse);
        if (XHttpResponse.responseJSON.message == '' && XHttpResponse.status == 404) {
            window.location.href = '/';
        }
        hide_preload();
    });

}

function remove_resizable_tag(string) {
    var tmp_element;
    if (string != null) {
        tmp_element = $(string);
        tmp_element.removeClass('selected_slide_view_group');
        tmp_element.children('.ui-resizable-handle').remove();
        tmp_element.children('input[type=checkbox]').remove();
        return tmp_element[0].outerHTML;
    }
    return null;
}

function show_delete_dialog(string, element) {
    if (string == 'question') {

        const node = $('#quiz_list').find('.current');

        if (node.closest('.node-group').attr('data-caption') == 'Results') {
            show_modal('error', 'Warning', 'You can\'t this slide!');
            return;
        }

        const quizId = string + '-' + node.attr('id');
        $('#delete_dialog_id').val(quizId);
    }

    if (string == 'group') {
        const groupId = string + '-' + $(element).attr('id').split('-')[1];
        $('#delete_dialog_id').val(groupId);
    }

    $('#delete_confirm_dialog').fadeIn(500);
};

$('#delete_no').click(function () {
    $('#delete_confirm_dialog').fadeOut(500);
});

$('#delete_yes').click(async function () {
    $('#delete_confirm_dialog').fadeOut(500);

    const dialog_id = $('#delete_dialog_id').val();

    if (dialog_id.split('-')[0] == 'question') {
        delete_selected_quizzes(0);
        // delete_quiz(dialog_id.split('-')[1]);
    }

    if (dialog_id.split('-')[0] == 'group') {
        delete_question_group(dialog_id.split('-')[1]);
    }
});

function delete_selected_quizzes(i) {
    console.log(i);
    console.log(tmp_selected_node_id_list.length);

    if (i == tmp_selected_node_id_list.length) return;
    console.log('delete: ', tmp_selected_node_id_list[i]);
    delete_quiz(i);
}

function get_next_node_element(node) {
    var nodeCollection = $('.node');
    var index = nodeCollection.index(node);

    return index == nodeCollection.length ? nodeCollection.eq(0) : nodeCollection.eq(index + 1);
}

function delete_quiz(i) {
    const quizId = tmp_selected_node_id_list[i];
    const root_url = $('meta[name=url]').attr('content');
    const token = $('meta[name=csrf-token]').attr('content');

    const node = $('#' + quizId);
    const order = node.attr('order');

    console.log('order: ', order);

    const typeId = $('#type_id').val();

    prev_id = '';

    show_preload();
    $.ajax({
        url: root_url + '/quizes/' + quizId,
        type: 'DELETE',
        data: {
            id: quizId,
            _token: token,

        },
        success: function (data) {

            if (!data) {
                delete_selected_quizzes(i + 1);
                // if (i == tmp_selected_node_id_list.length - 1) get_next_node_element(node).trigger('click');

                return;
            }

            const parentNode = node.closest('.node-group');

            if (parentNode.find('li').length === 1) {
                Metro.getPlugin('#quiz_list', 'listview').add(parentNode, {
                    caption: 'No questions',
                    content: '<i>Add questions<i>'
                });
            }

            if (node.find('.content').html() == '<i>Quiz Instructions</i>') {
                $('#introduction_btn').removeAttr('disabled');
            }


            node.remove();

            for (let i = 0; i < parentNode.find('li.node').length; i++) {
                if (parseInt(parentNode.find('li.node').eq(i).attr('order')) > order) {
                    parentNode.find('li.node').eq(i).attr('order', parseInt(parentNode.find('li.node').eq(i).attr('order')) - 1);
                }
            }

            $('#preview_item-' + quizId).remove();

            $('#quiz_view').html('');
            if (typeId > 11) {
                show_modal('success', 'Success', 'Slide deleted successfully');
            } else {
                show_modal('success', 'Success', 'Question deleted successfully');
            }
            hide_preload();
            delete_selected_quizzes(i + 1);
            console.log('delete_quiz: ', quizId);
            if (i == tmp_selected_node_id_list.length - 1) get_next_node_element(node).trigger('click');
        }
    }).catch((XHttpResponse) => {
        console.log(XHttpResponse);
        if (XHttpResponse.responseJSON.message == '' && XHttpResponse.status == 404) {
            window.location.href = '/';
        }
        hide_preload();
    });
}

function is_form_or_slide() {
    if ($('#form_view_btn').hasClass('clicked')) return 'form';
    if ($('#slide_view_btn').hasClass('clicked')) return 'slide';
}

function show_correct_view() {
    if (is_form_or_slide() === 'form') {
        $('.form_view_element').show();
        $('.slide_view_element').hide();
    }

    if (is_form_or_slide() === 'slide') {
        $('.form_view_element').hide();
        $('.slide_view_element').show();
        fit_slide_view();

        $('#quiz_view .slide_view_group').mouseover(function () {
            $(this).resizable({
                resize: function (evt, ui) {
                    console.log(ui)
                    var changeWidth = ui.size.width - ui.originalSize.width;
                    var newWidth = ui.originalSize.width + changeWidth / get_zoom();

                    var changeHeight = ui.size.height - ui.originalSize.height;
                    var newHeight = ui.originalSize.height + changeHeight / get_zoom();

                    ui.size.width = newWidth;
                    ui.size.height = newHeight;

                },
                stop: function () {
                    set_flag_true();
                },
                minWidth: 0,
                maxWidth: get_containment_position().width / get_zoom() - parseFloat($(this).css('left')) + 40,
                minHeight: 0,
                maxHeight: get_containment_position().height / get_zoom() - parseFloat($(this).css('top')) + 40,
            });
        });

        $('#quiz_view #quiz_background_container .slide_view_group').mouseover(function () {
            $(this).draggable({
                drag: function (evt, ui) {
                    const zoom = get_zoom();
                    ui.position.top = Math.round(ui.position.top / zoom);
                    ui.position.left = Math.round(ui.position.left / zoom);

                },
                stop: function () {
                    set_flag_true();
                },
                cancel: 'div.cancel_drag',
                cursor: 'move',
                containment: [get_containment_position().x0, get_containment_position().y0, get_containment_position().x1 - ($(this).width() - 40) * get_zoom(), get_containment_position().y1 - ($(this).height() - 40) * get_zoom()],
            });
        });

        if ($('.slide_view_group_checkbox').length === 0) $('.slide_view_group').append('<input class="slide_view_group_checkbox" type="checkbox" style="position: absolute;top: 0;left: 0;">');
    }
}

/*
*  For Preview
* */
var root_url = $('meta[name=url]').attr('content');

$('.preview_quiz_btn').click(function () {
    update_and_show_preview(root_url + '/exam/' + $('#exam_id').val());
});

$('.preview_slide_btn').click(function () {
    update_and_show_preview(root_url + '/preview_slide/' + $('#quiz_id').val());
});

$('.preview_group_btn').click(function () {
    update_and_show_preview(root_url + '/preview_group/' + $('#exam_group_id').val());
});

/*
* ************ create question group **************
* */
$('#question_group_btn').click(function () {
    const lv = Metro.getPlugin('#quiz_list', 'listview');
    let node = lv.addGroup({
        caption: 'Question Group',
    });
    node.remove();
    node.insertBefore($('#quiz_list li.node-group:last-child'));

    Metro.getPlugin('#quiz_list', 'listview').add(node, {
        caption: 'No questions',
        content: '<i>Add questions<i>'
    });

    // const element = $('#quiz_list li:nth-last-child(2)')[0].outerHTML;
    // $('#quiz_list li:nth-last-child(2)').remove();
    // $('#quiz_list').append(element);

    const root_url = $('meta[name=url]').attr('content');
    const token = $('meta[name=csrf-token]').attr('content');

    const exam_id = $('#exam_id').val();

    show_preload();
    $.ajax({
        url: root_url + '/add_exam_group',
        type: 'POST',
        data: {
            _token: token,
            exam_id: exam_id,
        },
        success: function (data) {
            node.attr('id', data);
            node.children('div.data').append('<i class="fas fa-trash" id="delete_group_icon-' + data + '" style="font-size: 12px;" onclick="show_delete_dialog(\'group\', this)"></i>');
            node.children('div.data').css({
                'display': 'flex',
                'align-items': 'center',
                'justify-content': 'space-around',
            });
            hide_preload();
        }
    }).catch((XHttpResponse) => {
        console.log(XHttpResponse);
        if (XHttpResponse.responseJSON.message == '' && XHttpResponse.status == 404) {
            window.location.href = '/';
        }
        hide_preload();
    });
});

/*
* ***************** Delete question group *****************
* */
function delete_question_group(groupId) {

    const root_url = $('meta[name=url]').attr('content');
    const token = $('meta[name=csrf-token]').attr('content');
    const node = $('#' + groupId);

    show_preload();
    $.ajax({
        url: root_url + '/exam_groups/' + groupId,
        type: 'DELETE',
        data: {
            id: groupId,
            _token: token,

        },
        success: function (data) {

            for (let i = 0; i < data.length; i++) {
                $('#preview_item-' + data[i]).remove();
            }

            node.remove();

            $('#quiz_view').html('');
            $('#form_view_quiz_list .node').eq(0).trigger('click');
            show_modal('success', 'Success', 'Question Group deleted successfully');
            hide_preload();
        }
    }).catch((XHttpResponse) => {
        console.log(XHttpResponse);
        if (XHttpResponse.responseJSON.message == '' && XHttpResponse.status == 404) {
            window.location.href = '/';
        }
        hide_preload();
    });
}

/*
* **************** Duplicate quiz ***************
* */

$('#duplicate_btn').click(function () {
    const lv = Metro.getPlugin('#quiz_list', 'listview');

    if ($('.current').length == 0) {
        show_modal('error', 'Warning', 'Choose a quiz to duplicate');
        return;
    }

    const parentNode = $('.current').closest('.node-group');
    const groupId = parentNode.attr('id');
    const node = parentNode.find('li.current');

    if (parentNode.attr('data-caption') == 'Results') {
        show_modal('error', 'Warning', 'You can\'t duplicate at Results Group!');
        return;
    }

    if (node.attr('data-content') == '<i>Quiz Instructions</i>') {
        show_modal('error', 'Warning', 'This slide can\'t be duplicated!');
        return;
    }

    let caption = node.attr('data-caption');
    let content = node.attr('data-content');

    if (caption == undefined) caption = node.find('.caption').html();
    if (content == undefined) content = node.find('.content').html();

    lv.insertAfter(node, {
        caption: caption,
        content: content
    });

    $('#quiz_list').find('.current').removeClass('current current-select');
    node.next().addClass('current current-select');

    let order = parentNode.find('li').index(node.next());
    const id = node.attr('id');
    const root_url = $('meta[name=url]').attr('content');
    const token = $('meta[name=csrf-token]').attr('content');

    show_preload();
    $.ajax({
        url: root_url + '/duplicate_quiz',
        type: 'POST',
        data: {
            _token: token,
            id: id,
            order: order,
        },
        success: function (data) {
            quizId = data;
            node.next().attr('id', quizId);

            $.get(root_url + "/quizes/" + quizId + "/edit", function (data, status) {
                $('#quiz_view').html(data);

                const element = '<div id="preview_item-' + quizId + '" class="preview_item selected_preview_item">' + $('#quiz_view .slide_view_element').html().replace('top:50%;left:50%;transform:translate(-50%, -50%);', '') + '</div>';
                $(element).insertAfter($('#preview_item-' + prev_id));

                $('#preview_item-' + quizId).css({
                    'width': $('#preview_item-' + prev_id).css('width'),
                    'height': $('#preview_item-' + prev_id).css('height'),
                });

                $('#preview_item-' + quizId + ' > div').css({
                    'margin': 'auto',
                    'top': '50%',
                    'left': '50%',
                    'transform': $('#preview_item-' + prev_id + ' > div').css('transform'),
                });

                $('.selected_preview_item').removeClass('selected_preview_item');
                $('#preview_item-' + quizId).addClass('selected_preview_item');

                prev_id = quizId;

                show_correct_view();
                hide_preload();
            }).catch((XHttpResponse) => {
                console.log(XHttpResponse);
                if (XHttpResponse.responseJSON.message == '' && XHttpResponse.status == 404) {
                    window.location.href = '/';
                }
                hide_preload();
            });
        }
    }).catch((XHttpResponse) => {
        console.log(XHttpResponse);
        if (XHttpResponse.responseJSON.message == '' && XHttpResponse.status == 404) {
            window.location.href = '/';
        }
        hide_preload();
    });
});

/*
* ************* get quiz state ***************
* */
function get_quiz_state() {
    // if (is_form_or_slide() === 'form') {
    //     form_to_slide();
    // }
    //
    // if (is_form_or_slide() === 'slide') {
    //     slide_to_form();
    // }

    if ($('#quiz_view .slide_view_group_checkbox').length === 0) $('.slide_view_group').append('<input class="slide_view_group_checkbox" type="checkbox" style="position: absolute;top: 0;left: 0;">');


    const typeId = $('#type_id').val();
    let question_element = $('#quiz_view .slide_view_question_element')[0].outerHTML;

    const answer = $('#answer_content').val();

    const question = $('#question').html();

    const form_view_answer = $('.form_view_answer_element').html();

    const feedback_correct = $('.feedback_branching tr:first-child td:nth-child(2) label').html();
    const feedback_incorrect = $('.feedback_branching tr:nth-child(2) td:nth-child(2) label').html();
    const feedback_try_again = $('.feedback_branching tr:nth-child(3) td:nth-child(2) label').html();
    const correct_score = $('.feedback_branching tr:first-child td:nth-child(3) label').html();
    const incorrect_score = $('.feedback_branching tr:nth-child(2) td:nth-child(3) label').html();
    const try_again_score = $('.feedback_branching tr:nth-child(3) td:nth-child(3) label').html();
    const media = $('#media').val();
    const video = $('#video').val();
    const audio = $('#audio').val();
    const background_img = $('#background_img').val();
    // const order
    let answer_element = $('#quiz_view .slide_view_answer_element')[0].outerHTML;
    let media_element = $('#quiz_view .slide_view_media_element')[0] == undefined ? null : $('#quiz_view .slide_view_media_element')[0].outerHTML;
    let video_element = $('#quiz_view .slide_view_video_element')[0] == undefined ? null : $('#quiz_view .slide_view_video_element')[0].outerHTML;
    const question_type = Metro.getPlugin('#question_type', 'select').val();
    const feedback_type = Metro.getPlugin('#feedback', 'select').val();

    question_element = remove_resizable_tag(question_element);
    answer_element = remove_resizable_tag(answer_element);
    media_element = remove_resizable_tag(media_element);
    video_element = remove_resizable_tag(video_element);

    let branching;
    if ($('#branching:disabled').length !== 0 || $('#branching').length === 0) {
        branching = '';
    } else {
        branching = Metro.getPlugin('#branching', 'select').val();
    }

    // const score = Metro.getPlugin('#score', 'select').val();
    const attempts = Metro.getPlugin('#attempts', 'select').val();

    // let is_limit_time = $('#is_limit_time').is(":checked");
    // is_limit_time = is_limit_time === 'true' ? 1 : 0;
    // if ($('#is_limit_time').length === 0) is_limit_time = ';

    const limit_time = $('#limit_time').val();

    let shuffle_answers = $('#shuffle_answers').is(":checked");
    shuffle_answers = shuffle_answers === 'true' ? 1 : 0;
    if ($('#shuffle_answers').length === 0) shuffle_answers = '';

    let partially_correct = $('#partially_correct').is(":checked");
    partially_correct = partially_correct === 'true' ? 1 : 0;
    if ($('#partially_correct').length === 0) partially_correct = '';

    let limit_number_response = $('#limit_number_response').is(":checked");
    limit_number_response = limit_number_response === 'true' ? 1 : 0;
    if ($('#limit_number_response').length === 0) limit_number_response = '';

    let case_sensitive = $('#case_sensitive').is(":checked");
    case_sensitive = case_sensitive === 'true' ? 1 : 0;
    if ($('#case_sensitive').length === 0) case_sensitive = '';


    let other_elements = '';
    for (let i = 0; i < $('#quiz_view .other_slide_view_element').length; i++) {
        other_elements += remove_resizable_tag($('#quiz_view .other_slide_view_element').eq(i)[0].outerHTML);
    }

    const tmp_values = question + question_element + form_view_answer + answer + answer_element + media_element + feedback_correct + feedback_incorrect + feedback_try_again + media + media_element + video + audio + video_element + background_img + question_type + feedback_type + branching + attempts + shuffle_answers + partially_correct + limit_number_response + case_sensitive + correct_score + incorrect_score + try_again_score + other_elements;

    return tmp_values;
}

/*
* ************ Store quiz state ***************
* */
function store_quiz_state() {
    setTimeout(function () {
        $('#tmp_quiz_database_values').val(get_quiz_state());
    }, 100);
}

/*
* *********** remove zoom style ***************
* */
function remove_zoom_style(string) {
    if (string.indexOf('zoom:') == -1) return string;

    var tmp_1 = string.split('zoom:');
    var tmp_2 = tmp_1[1].split(';');
    tmp_2.shift();
    return (tmp_1[0] + tmp_2.join(';'));
}

/*
* *************** slide view quiz list *************************
* */
$('#slide_view_quiz_list').on('click', '.preview_item', function () {
    $('#' + $(this).attr('id').split('-')[1]).trigger('click');
});

/*
* ***************** real-time update at left navigation for question list ****************
* */
function real_time_update_slide_view_nav_active() {
    if (localStorage.getItem('is_played_timer') == 'true') return;
    preview_timer = setInterval(function () {
        console.log('setinterval');
        localStorage.setItem('is_played_timer', 'true');
        const navZoomScale = ($('#slide_view_quiz_list').width() - 40) / parseInt($('#screen_width').val());
        if ($('#quiz_list .node.current').length > 0 && localStorage.getItem('is_edited_for_timer') == 'true') {
            localStorage.setItem('is_edited_for_timer', 'false');

            if ($('#quiz_view .slide_view_element').html() != undefined) $('#preview_item-' + $('#quiz_list .node.current').attr('id')).html($('#quiz_view .slide_view_element').html().replace('top: 50%; left: 50%; transform: translate(-50%, -50%);', '').replace('top:50%;left:50%;transform:translate(-50%, -50%);', '').replace('slide_view_hotspots_canvas', 'slide_view_hotspots_canvas-' + $('#quiz_list .node.current').attr('id')));
            $('#preview_item-' + $('#quiz_list .node.current').attr('id') + ' > div').css({
                'margin': 'auto',
                // 'zoom': ($('#slide_view_quiz_list').width() - 40) / parseInt($('#screen_width').val()),
                'top': '50%',
                'left': '50%',
                'transform': 'translate(-50%, -50%) matrix(' + navZoomScale + ', 0, 0, ' + navZoomScale + ', 0, 0)',
            });
            if ($('#question').html() != undefined) $('#' + $('#quiz_list .node.current').attr('id') + ' .data .caption').html($('#question').html().replace(/(<([^>]+)>)/gi, ''));

            if ($('#type_id').val() == '11') {
                var slide_view_canvas = new fabric.Canvas('slide_view_hotspots_canvas-' + $('#quiz_list .node.current').attr('id'));

                var canvas_info = $('#answer_content').val();

                if (canvas_info == '@{}') return;

                var canvas_bg_url = canvas_info.split('@')[0];
                var canvas_item_info = canvas_info.split('@')[1];

                var json_bg_url = JSON.parse(canvas_bg_url);
                var json_canvas_item = JSON.parse(canvas_item_info);

                fabric.Image.fromURL(root_url + '/' + json_bg_url.background, function (img) {
                    slide_view_canvas.setBackgroundImage(img, slide_view_canvas.renderAll.bind(slide_view_canvas), {
                        scaleX: fit_canvas_image(slide_view_canvas.width, slide_view_canvas.height, img.width, img.height).scaleFactor,
                        scaleY: fit_canvas_image(slide_view_canvas.width, slide_view_canvas.height, img.width, img.height).scaleFactor,
                        originX: 'left',
                        originY: 'top',
                        top: fit_canvas_image(slide_view_canvas.width, slide_view_canvas.height, img.width, img.height).top,
                        left: fit_canvas_image(slide_view_canvas.width, slide_view_canvas.height, img.width, img.height).left,
                    });
                });

                if (json_canvas_item.type === 'circle') {

                    slide_view_canvas.add(new fabric.Circle({
                        radius: json_canvas_item.radius,
                        strokeWidth: 3,
                        stroke: '#288f02',
                        fill: '#c1fc8580',
                        originX: 'center',
                        originY: 'center',
                        top: json_canvas_item.top,
                        left: json_canvas_item.left
                    }));
                }

                if (json_canvas_item.type === 'rect') {

                    slide_view_canvas.add(new fabric.Rect({
                        width: json_canvas_item.width,
                        height: json_canvas_item.height,
                        strokeWidth: 3,
                        stroke: '#288f02',
                        fill: '#c1fc8580',
                        top: json_canvas_item.top,
                        left: json_canvas_item.left
                    }));
                }

                if (json_canvas_item.type === 'polyline') {

                    slide_view_canvas.add(new fabric.Polygon(json_canvas_item.points, {
                        strokeWidth: 3,
                        stroke: '#288f02',
                        fill: '#c1fc8580'
                    }));
                }
            }
        }
    }, 3000);
}

function real_time_update_slide_view_nav_inactive() {
    clearTimeout(preview_timer);
    localStorage.setItem('is_played_timer', 'false');
}

