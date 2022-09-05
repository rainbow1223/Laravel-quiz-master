let quizzes = [];
let quizId = 0;
let question_result;
let question_user_point = 0;
let attempts = 0;
let question_feedback;
let question_user_answer = [];
let question_correct_answer = [];

let result = '';
let total_score = 0;
let correct_quiz_count = 0;
let hotspots_points = [];
let isReview = false;

var question_timer;
$('div.quiz_item_container .slide_view_question_element').attr('contenteditable', 'false');
$('div.quiz_item_container .cancel_drag').attr('contenteditable', 'false');
$('div.quiz_item_container input').attr('autocomplete', 'off');
$('#question_list_modal .question_content div').attr('contenteditable', 'false');
$('.other_slide_view_element_delete_icon').remove();

let user_info_field_patterns = [];
/*
* ************ Fit Quiz size ********************
* */

let zoomScale;
let isFitted = false;

function fit_question_list_container_size() {

    var w = window.innerWidth;
    var h = window.innerHeight;

    const elementHeight = parseInt($('.screen_height').html());
    const elementWidth = parseInt($('.screen_width').html());

    let height_zoomScale = h / elementHeight;
    let width_zoomScale = (w - 50) / elementWidth;

    zoomScale = Math.min(height_zoomScale, width_zoomScale);

    $('.quiz_list_container').css('zoom', 1);
    $('#preview_container').css('transform', 'translate(-50%, -50%) matrix(' + zoomScale + ', 0, 0, ' + zoomScale + ', 0, 0)');

    isFitted = true;
}

setInterval(function () {
    if ($('.screen_height').length > 0 && !isFitted) {
        // hide_some_btns_for_mobile();
        fit_question_list_container_size();
    }
}, 500);

function fit_drag_with_zoom(ui) {
    var changeLeft = ui.position.left - ui.originalPosition.left;
    var newLeft = ui.originalPosition.left + changeLeft / zoomScale;
    var changeTop = ui.position.top - ui.originalPosition.top;
    var newTop = ui.originalPosition.top + changeTop / zoomScale;

    ui.position.left = newLeft;
    ui.position.top = newTop;
}

/*
* For Sequence UI
* */

var canvasHeight = $('.slide_view_answer_element .col-md-12 > ul').height();
var canvasWidth = $('.slide_view_answer_element .col-md-12 > ul').width();

// $('.slide_view_answer_element .col-md-12 > ul').sortable({
//     sort: function (evt, ui) {
//         ui.item.css('top', parseFloat(ui.item.css('top')) / zoomScale);
//         ui.item.css('left', parseFloat(ui.item.css('left')) / zoomScale);
//     }
// });
if ($('.slide_view_answer_element .col-md-12 #sortable').length > 0) {
    var el = $('.slide_view_answer_element .col-md-12 #sortable')[0];
    var sortable = Sortable.create(el);
}

let drag_and_drop_mobile;
/*
* ************ For Matching UI ***********
* */
$(function () {

    // for mobile
    if ($('.draggable').length > 0 && $('.droppable').length > 0) {
        let drag = new Drag($('.draggable'));
        let drop = new Drop($('.droppable'));

        drag_and_drop_mobile = new Drag_and_drop_mobile(drag, drop, zoomScale, 'matching');

        drag_and_drop_mobile.drag_and_drop();

    }

    // for web browser
    $(".draggable").draggable({

        start: function () {
            $(this).addClass("ui-state-highlight");
            if ($(this).attr("isdropped")) {
                $(this).parent().css({'justify-content': 'space-around'});
                $(this).attr("isdropped", false);
            }
        },

        drag: function (evt, ui) {
            fit_drag_with_zoom(ui);
        },

        stop: function () {
            $(this).removeClass("ui-state-highlight");
        },

        revert: true,
    });
    $(".droppable").droppable({
        classes: {
            "ui-droppable-hover": "ui-state-highlight"
        },
        drop: function (event, ui) {
            $(this).addClass("ui-state-hover");
            $(this).parent().css({'justify-content': 'center'});
            ui.draggable.attr("isdropped", true);

            swap_value(ui.draggable, $(this).next());
        }
    });
});

/*
* ************ For Drag the Words UI ***********
* */
var drag_words_array = [];

function insert_drag_words_array(index, content) {
    drag_words_array[index] = content;
}

// for mobile
if ($('#slide_drag_words_answer span').length > 0 && $('#slide_drag_words_question .blank').length > 0) {
    let drag = new Drag($('#slide_drag_words_answer span'));
    let drop = new Drop($('#slide_drag_words_question .blank'));

    drag_and_drop_mobile = new Drag_and_drop_mobile(drag, drop, zoomScale, 'drag_words');

    drag_and_drop_mobile.drag_and_drop();
    // console
}

$("#slide_drag_words_answer span").draggable({

    start: function (evt, ui) {
        $(this).addClass("ui-state-highlight");
        // if ($(this).attr("isdropped")) {
        // $(this).parent().css({'justify-content': 'space-around'});
        // $(this).attr("isdropped", false);
        // }
    },

    drag: function (evt, ui) {
        fit_drag_with_zoom(ui);
    },

    stop: function (evt, ui) {
        $(this).removeClass("ui-state-highlight");
    },

    cursor: 'move',

    // revert: true,
});
$("#slide_drag_words_question .blank").droppable({
    classes: {
        "ui-droppable-hover": "ui-state-highlight"
    },
    drop: function (event, ui) {
        console.log('dropped');

        drag_words_array[$(this).index('.quiz_show .blank')] = ui.draggable.html();
        // $(this).parent().css({'justify-content': 'center'});
        // ui.draggable.attr("isdropped", true);

        // swap_value(ui.draggable, $(this).next());
    }
});

function swap_value(a, b) {
    tmp = a.html();
    a.html(b.html());
    b.html(tmp);
}


/*
* ************** Rearrange Preview UI *************
* */

var user_email = $('#user_EMAIL').val();
var user_name = $('#user_FIRST_NAME').val() + ' ' + $('#user_LAST_NAME').val();



rearrange_preview_ui();

function change_input_id_label_for(element_array, quiz_id) {
    for (let i = 0; i < element_array.length; i++) {
        element_array.eq(i).find('input').eq(0).attr('id', quiz_id + '_' + element_array.eq(i).find('input').eq(0).attr('id'));
        element_array.eq(i).find('input').eq(0).attr('name', quiz_id + '_' + element_array.eq(i).find('input').eq(0).attr('name'));
        element_array.eq(i).find('label').eq(0).attr('for', quiz_id + '_' + element_array.eq(i).find('label').eq(0).attr('for'));
    }
}

function get_drag_words_blank_width() {
    let width = 0;

    const drag_words_elements = $('#slide_drag_words_answer span');

    for (let i = 0; i < drag_words_elements.length; i++) {
        width = Math.max(width, drag_words_elements.eq(i).width());
    }

    return width;
}

function hide_some_btns_for_mobile() {

    console.log($('.quiz_show .type_id').html());
    const type_id = $('.quiz_show .type_id').html();

    $('.question_menu_bar').hide();
    $('.question_list_modal_close').hide();
    if (type_id == '14' || type_id == '15') {
        $('.preview_btn').show();
        $('#submit_btn').hide();
    } else {
        $('.preview_btn').hide();
    }
    $('.review_buttons').hide();
}

function rearrange_preview_ui() {

    $('.quiz_show video').hide();

    console.log($('.quiz_show .is_limit_time').html());
    console.log($('.quiz_show .limit_time').html());

    $('.quiz_show .up_down_container').hide();

    invokeNative();

    $('#question_time').hide();
    $('#question_list').css('visibility', 'visible');

    if (parseInt($('.quiz_show .type_id').html()) < 13) {
        $('#question_list').css('visibility', 'hidden');
    }

    if ($('.quiz_show .type_id').html() == '12') {
        $('#submit_btn').html('Continue');
    }


    limit_time();

    $('#question_number').html(quizId + 1);
    $('#question_point span').html($('.quiz_show .correct_score').html());
    $('#total_point').html(total_score);
    $('#passing_score').html($('.quiz_show .passing_score').html())

    switch ($('.quiz_show .type_id').html()) {
        case '1':
            console.log($('.quiz_show .shuffle_answers').html());
            if ($('.quiz_show .shuffle_answers').html() == 0) return;

            var choice_items = $('.quiz_show .choice_item');
            change_input_id_label_for(choice_items, $('.quiz_show .quiz_id').html());

            shuffle(choice_items);

            var rearrange_choice_items = '';
            for (let i = 0; i < choice_items.length; i++) {
                rearrange_choice_items += choice_items[i].outerHTML;
            }

            $('.quiz_show .slide_view_answer_element .col-md-12').html(rearrange_choice_items);
            break;

        case '2':
            console.log($('.quiz_show .shuffle_answers').html());
            if ($('.quiz_show .shuffle_answers').html() == 0) return;

            var response_items = $('.quiz_show .response_item');
            change_input_id_label_for(response_items, $('.quiz_show .quiz_id').html());

            shuffle(response_items);

            var rearrange_response_items = '';
            for (let i = 0; i < response_items.length; i++) {
                rearrange_response_items += response_items[i].outerHTML;
            }

            $('.quiz_show .slide_view_answer_element .col-md-12').html(rearrange_response_items);
            break;

        case '3':
            change_input_id_label_for($('.quiz_show .choice_item'), $('.quiz_show .quiz_id').html());
            break;

        case '6':
            var sequence_items = $('.quiz_show #sortable li');
            shuffle(sequence_items)

            var rearrange_sequence_sortable = '';
            for (let i = 0; i < sequence_items.length; i++) {
                rearrange_sequence_sortable += sequence_items[i].outerHTML;
            }

            $('.quiz_show #sortable').html(rearrange_sequence_sortable);

            $('.quiz_show .slide_view_answer_element .col-md-12').css('position', 'relative');
            $('.quiz_show .slide_view_answer_element .col-md-12').prepend('<div class="up_down_container"><div class="up_container"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 490 490" style="enable-background:new 0 0 490 490;" xml:space="preserve"><g><g> <polygon points="0,332.668 245.004,82.631 490,332.668 413.507,407.369 245.004,235.402 76.493,407.369"/></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg></div><div class="down_container" style="transform: rotate(180deg);"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 490 490" style="enable-background:new 0 0 490 490;" xml:space="preserve"><g><g><polygon points="0,332.668 245.004,82.631 490,332.668 413.507,407.369 245.004,235.402 76.493,407.369"/></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg></div></div>');  
            click_sequence_list();

            break;

        case '7':
            var matching_content_items = $('.quiz_show .ui-widget-content');
            shuffle(matching_content_items);

            var rearrange_matching = [];
            var matching_list_content = '<div class="matching_close_container"><span>&times;</span></div>';

            for (let i = 0; i < matching_content_items.length; i++) {
                rearrange_matching.push($(matching_content_items[i]).html());
                matching_list_content += '<div class="matching_list_content">' + $(matching_content_items[i]).html() + '</div>';
            }
            for (let i = 0; i < matching_content_items.length; i++) {
                $('.quiz_show .ui-widget-content').eq(i).html(rearrange_matching[i]);
            }

            $('.quiz_show .col-md-12 div').css('justify-content', 'center');
            $('.ui-widget-content').css('visibility', 'hidden');

            $('.quiz_show .slide_view_answer_element .col-md-12').css('position', 'relative');
            $('.quiz_show .slide_view_answer_element .col-md-12').prepend('<div class="matching_list">' + matching_list_content + '</div>');

            click_matching_list();
            break;

        case '10':
            console.log(get_drag_words_blank_width());
            $('#slide_drag_words_question .blank').css('padding-right', (get_drag_words_blank_width() + 20) + 'px');

            $('.quiz_show #slide_drag_words_answer').hide();

            var drag_word_items = $('.quiz_show #slide_drag_words_answer span');
            var words = [];

            for (let i = 0; i < drag_word_items.length; i++) {
                words.push(drag_word_items.eq(i).html());
            }
            shuffle(words);

            console.log(words);

            var drag_words_list_content = '<div class="drag_words_close_container"><span>&times;</span></div>';

            for (let i = 0; i < words.length; i++) {
                drag_words_list_content += '<div class="drag_words_list_content">' + words[i] + '</div>';
            }

            $('.quiz_show .slide_view_answer_element .col-md-12').css('position', 'relative');
            $('.quiz_show .slide_view_answer_element .col-md-12').prepend('<div class="drag_words_list">' + drag_words_list_content + '</div>');

            click_drag_words();
            break;

        case '11':
            var root_url = $('meta[name=url]').attr('content');

            var canvas_info = $('.quiz_show .correct_answer').html();

            console.log(canvas_info);

            var canvas_bg_url = canvas_info.split('@')[0];

            var json_bg_url = JSON.parse(canvas_bg_url);

            $('.quiz_show .slide_view_answer_element .col-md-12').html('<div id="image-hotspots" style="position: relative;width: 300px;height: 214px;left: 50%;transform: translateX(-50%)"><img src="' + json_bg_url.background + '" height="214" width="300" onclick="create_hotspots(event)" style="position: relative;left: 50%;transform: translateX(-50%);object-fit: contain;"></div>');

            $('#clear_hotspots').css('visibility', 'visible');
            break;

        case '13':
            $('#preview_container .preview_btn #submit_btn').html('Start Quiz');
            break;

        case '14':
            let passed_score_html = $('.quiz_show .slide_view_answer_element .col-md-12').html();
            console.log(passed_score_html);
            passed_score_html = passed_score_html.split('%%')[0] + total_score + passed_score_html.split('%%')[1];
            passed_score_html = passed_score_html.split('##')[0] + $('.quiz_show .passing_score').html() + passed_score_html.split('##')[1];
            console.log(passed_score_html);

            $('.quiz_show .slide_view_answer_element .col-md-12').html(passed_score_html);
            break;

        case '15':
            let failed_score_html = $('.quiz_show .slide_view_answer_element .col-md-12').html();
            failed_score_html = failed_score_html.split('%%')[0] + total_score + failed_score_html.split('%%')[1];
            failed_score_html = failed_score_html.split('##')[0] + $('.quiz_show .passing_score').html() + failed_score_html.split('##')[1];

            $('.quiz_show .slide_view_answer_element .col-md-12').html(failed_score_html);
            break;
    }
}

function shuffle(array) {
    var currentIndex = array.length, temporaryValue, randomIndex;

    // While there remain elements to shuffle...
    while (0 !== currentIndex) {

        // Pick a remaining element...
        randomIndex = Math.floor(Math.random() * currentIndex);
        currentIndex -= 1;

        // And swap it with the current element.
        temporaryValue = array[currentIndex];
        array[currentIndex] = array[randomIndex];
        array[randomIndex] = temporaryValue;
    }

    return array;
}

/*
* ************* For Hotspots UI ***************
* */

function create_hotspots(event) {
    var x = event.offsetX;
    var y = event.offsetY;
    // var x = Math.round(event.offsetX / zoomScale);
    // var y = Math.round(event.offsetY / zoomScale);

    console.log(x, y);
    $('.quiz_show #image-hotspots').append('<div class="preview_hotspots" style="top: ' + y + 'px;height: 20px;width: 20px;position: absolute;background: #29b160;border-radius: 50%;cursor: pointer;z-index: 200;margin-left: -10px;margin-top: -10px;left: ' + x + 'px;"></div>');
    hotspots_points.push([x, y]);
}

/*
* ************* Clear Hotspots ****************
* */
$('#clear_hotspots').click(function () {
    $('.preview_hotspots').remove();
    hotspots_points = [];
});

function review_prev_button() {
    $('.review_buttons > div button:nth-child(1)').trigger('click');
}

function review_next_button() {
    $('.review_buttons > div button:nth-child(2)').trigger('click');
}

function click_preview_button() {
    $('#submit_btn').trigger('click');
}

function hide_list_button() {
    $('#question_list_modal').hide();
}

function click_list_button() {
    console.log('question list clicked');
//    $('#question_list').trigger('click');
    $('#question_list_modal').show();
}

function show_progress_bar() {
    $('#progress_bar_container').show();
}

function hide_progress_bar() {
    $('#progress_bar_container').hide();
}

/*
* ********** question Processing **************
* */

function preview(element) {
    const root_url = $('meta[name=url]').attr('content');
    const token = $('meta[name=csrf-token]').attr('content');

    switch ($('#submit_btn').html()) {
        case 'Submit':
            if ($('.quiz_show').find('.type_id').html() == '16') {
                console.log('16');

                const user_info_elements = $('.quiz_show').find('#user_info').find('div');

                for (let i = 0; i < user_info_elements.length; i++) {
                    user_info_field_patterns.push(user_info_elements.eq(i).attr('id').split('user_').join('').split('_container').join(''));
                }

                if (!$('#user_info')[0].checkValidity()) {
                    show_modal('error', 'Warning', 'You must complete the form correctly before submitting.');
                } else {
                    $('#submit_btn').html('Continue');
                }
                return;
            }
            if (!is_completed_question()) {
                show_modal('error', 'Warning', 'You must complete the question before submitting.');
                return;
            }

            if ($('.quiz_show .question_type').html() != 'graded') {
                question_result = 'Survey';
                return;
            }
            if (evulate()) {
                clearInterval(question_timer);
                attempts += 1;
                total_score += parseInt($('.quiz_show .correct_score').html());
                question_user_point += parseInt($('.quiz_show .correct_score').html());
                correct_quiz_count += 1;
                if ($('.quiz_show .feedback_type').html() != 'none') {
                    show_modal('success', 'Correct', $('.quiz_show .feedback_correct').html());
                    $('.quiz_show .is_correct').html('true');

                }
                question_feedback = $('.quiz_show .feedback_correct').html();
                question_result = 'Correct';
                $('#submit_btn').html('Continue');
            } else {
                attempts += 1;
                incorrect_process();
            }
            break;

        case 'Try again':
            $('#submit_btn').html('Submit');
            break;

        case 'Start Quiz':

            $('#preview_toast').fadeOut(1500);

            attempts = 0;
            question_user_point = 0;

            update_question_list_modal();

            var current_show_id = $('.quiz_show').attr('id');
            var next_show_id = $('.quiz_show').next().attr('id');
            var type_id = $('.quiz_show').next().find('.type_id').html();
            var current_type_id = $('.quiz_show').find('.type_id').html();

            $('#quiz_list_audio-' + current_show_id.split('-')[1])[0].pause();


            if (next_show_id === undefined || type_id == 14 || type_id == 15) {

                if (current_type_id == 13) {
                    $('#submit_btn').html('Close');
                } else {

                    $('#submit_btn').html('See Result');
                    $('#review_btn').css('visibility', 'visible');
                }

            } else {

                $('#quiz_list_audio-' + next_show_id.split('-')[1])[0].pause();
                $('#quiz_list_audio-' + next_show_id.split('-')[1])[0].currentTime = 0;
                $('#quiz_list_audio-' + next_show_id.split('-')[1])[0].play();

                $('#' + current_show_id).removeClass('quiz_show');
                $('#' + current_show_id).addClass('quiz_hide');

                $('#' + next_show_id).removeClass('quiz_hide');
                $('#' + next_show_id).addClass('quiz_show');
                rearrange_preview_ui();
                // hide_some_btns_for_mobile();
                fit_question_list_container_size();

                if (type_id == 12) {
                    $('#submit_btn').html('Continue');
                    return;
                }
                $('#submit_btn').html('Submit');
            }


            break;

        case 'Continue':

            $('#preview_toast').fadeOut(1500);
            $('#question_list').css('visibility', 'hidden');

            quizzes.push({
                quizId: quizId,
                question_result: question_result,
                question_content: $('.quiz_show .slide_view_question_element').html(),
                question_point: $('.quiz_show .correct_score').html(),
                question_user_point: question_user_point,
                question_user_answer: question_user_answer,
                question_correct_answer: question_correct_answer,
                question_attempts: $('.quiz_show .attempts').html(),
                question_user_attempts: attempts,
                question_feedback: question_feedback,
            });

            update_question_list_modal();
            $('.quiz_show .question_user_answer').html(question_user_answer);

            attempts = 0;
            question_user_point = 0;
            drag_words_array = [];
            hotspots_points = [];


            if ($('.quiz_show').find('.type_id').html() != 12 && $('.quiz_show').find('.type_id').html() != 16) quizId++;

            var current_show_id = $('.quiz_show').attr('id');
            var current_show_type_id = $('.quiz_show .type_id').html();
            var next_show_id = $('.quiz_show').next().attr('id');
            var type_id = $('.quiz_show').next().find('.type_id').html();

            $('#quiz_list_audio-' + current_show_id.split('-')[1])[0].pause();

            if (next_show_id === undefined || type_id == 14 || type_id == 15) {
                // rearrange_preview_ui();
                AudioStop.postMessage('stop');

                if (current_show_type_id == 12) {
                    $('#submit_btn').html('Close');
                } else {
                    $('#review_btn').css('visibility', 'visible');
                    if ($('#is_quiz').html() == '0') {
                        $('#submit_btn').html('Close');
                    } else {
                        $('#submit_btn').html('See Result');
                    }
                }

                if (type_id != 11) $('#clear_hotspots').css('visibility', 'hidden');
            } else {

                show_result($('.quiz_show .correct_answer').html(), current_show_type_id, current_show_id);



                $('#' + current_show_id).removeClass('quiz_show');
                $('#' + current_show_id).addClass('quiz_hide');

                $('#' + next_show_id).removeClass('quiz_hide');
                $('#' + next_show_id).addClass('quiz_show');

                rearrange_preview_ui();
                // hide_some_btns_for_mobile();
                fit_question_list_container_size();

                if (type_id == 12) {
                    $('#submit_btn').html('Continue');
                    return;
                }
                if (type_id != 11) $('#clear_hotspots').css('visibility', 'hidden');
                $('#submit_btn').html('Submit');
            }


            break;

        case 'See Result':
            $('#question_list').css('visibility', 'visible');

            show_result($('.quiz_show .correct_answer').html(), $('.quiz_show .type_id').html(), $('.quiz_show').attr('id'));
            $('.review_buttons').hide();
            $('.preview_btn').show();
            if ($('#is_quiz').html() != '0') {

                if (total_score < parseInt($('.quiz_show .passing_score').html())) {
                    result = 'Fail';
                    var current_show_id = $('.quiz_show').attr('id');

                    var next_show_id = $('.quiz_show').next().next().attr('id');
                    if (next_show_id === undefined) return;

                    $('#quiz_list_audio-' + next_show_id.split('-')[1])[0].pause();
                    $('#quiz_list_audio-' + next_show_id.split('-')[1])[0].currentTime = 0;
                    $('#quiz_list_audio-' + next_show_id.split('-')[1])[0].play();

                    $('#' + current_show_id).removeClass('quiz_show');
                    $('#' + current_show_id).addClass('quiz_hide');

                    $('#' + next_show_id).removeClass('quiz_hide');
                    $('#' + next_show_id).addClass('quiz_show');

                    rearrange_preview_ui();
                    // hide_some_btns_for_mobile();
                    fit_question_list_container_size();
                } else {
                    result = 'Pass';
                    var current_show_id = $('.quiz_show').attr('id');

                    var next_show_id = $('.quiz_show').next().attr('id');
                    if (next_show_id === undefined) return;

                    $('#quiz_list_audio-' + next_show_id.split('-')[1])[0].pause();
                    $('#quiz_list_audio-' + next_show_id.split('-')[1])[0].currentTime = 0;
                    $('#quiz_list_audio-' + next_show_id.split('-')[1])[0].play();

                    $('#' + current_show_id).removeClass('quiz_show');
                    $('#' + current_show_id).addClass('quiz_hide');

                    $('#' + next_show_id).removeClass('quiz_hide');
                    $('#' + next_show_id).addClass('quiz_show');

                    rearrange_preview_ui();
                    // hide_some_btns_for_mobile();
                    fit_question_list_container_size();
                }


                user_email = $('#user_EMAIL').val();
                user_name = $('#user_FIRST_NAME').val() + ' ' + $('#user_LAST_NAME').val();

                var result_json = {
                    user_name: user_name,
                    user_email: user_email,
                    stuff_emails: $('.quiz_show .stuff_emails').html(),
                    email_from: $('.quiz_show .email_from').html(),
                    email_subject: change_email_subject($('.quiz_show .email_subject').html()),
                    email_comment: $('.quiz_show .email_comment').html(),
                    exam_answered: correct_quiz_count,
                    exam_question_count: quizId,
                    exam_user_score: total_score,
                    exam_passing_score: $('.quiz_show .passing_score').html(),
                    result: result,
                    quizzes: quizzes,
                };

                QuizResult.postMessage(JSON.stringify(result_json));


                $('#submit_btn').html('Close');
            } else {
                window.close();
                // alert('Answered: ' + correct_quiz_count + '/' + quizId + ', Total Score: ' + total_score);
            }

            break;

        case 'Close':
            window.close();

            break;
    }
}

function is_completed_question() {
    switch ($('.quiz_show .type_id').html()) {
        case '1':
            if ($('.quiz_show input:checked').length > 0) return true;
            return false;
            break;

        case '2':
            if ($('.quiz_show input:checked').length > 0) return true;
            return false;
            break;

        case '3':
            if ($('.quiz_show input:checked').length > 0) return true;
            return false;
            break;

        case '4':
            if ($('.quiz_show #answer').val() != '') return true;
            return false;
            break;

        case '5':
            if ($('.quiz_show #answer').val() != '') return true;
            return false;
            break;

        case '8':

            for (let i = 0; i < $('.quiz_show .slide_view_answer_element input').length; i++) {
                if ($('.quiz_show .slide_view_answer_element input').eq(i).val() == '') return false;
            }
            return true;
            break;

        case '9':
            const select_lists_items = $('.quiz_show .slide_view_answer_element select');

            for (let i = 0; i < select_lists_items.length; i++) {
                if (select_lists_items.eq(i).val() == 'none') return false;
            }

            return true;
            break;

        case '10':

            for (let i = 0; i < $('.quiz_show .slide_view_answer_element .blank').length; i++) {
                if ($('.quiz_show .slide_view_answer_element .blank').eq(i).html() == '') return false;
            }

            return true;
            break;

        case '11':
            if (hotspots_points.length > 0) return true;
            return false;
            break;

        default:
            return true;
    }
}

function evulate() {
    question_user_answer = [];
    question_correct_answer = [];

    switch ($('.quiz_show .type_id').html()) {
        case '1':
            question_user_answer.push($('.quiz_show input:checked').next().html());
            question_correct_answer.push($('.quiz_show input[value=' + $('.quiz_show .correct_answer').html() + ']').next().html());

            return compare_arrays(question_user_answer, question_correct_answer);
            break;

        case '2':
            var selected_checkbox = $(".quiz_show input:checked");

            for (var i = 0; i < selected_checkbox.length; i++) {
                question_user_answer.push(selected_checkbox.eq(i).next().html());
            }

            let correct_response_answer_array = $('.quiz_show .correct_answer').html().split(';');
            correct_response_answer_array.pop();
            for (var i = 0; i < correct_response_answer_array.length; i++) {
                question_correct_answer.push($('.quiz_show input[value=' + correct_response_answer_array[i] + ']').next().html());
            }

            if ($('.quiz_show .partially_correct').html() == '1') {
                for (let i = 0; i < question_user_answer.length; i++) {
                    if (question_correct_answer.indexOf(question_user_answer[i]) != -1) return true;
                }
                return false;
            }

            return compare_arrays(question_user_answer, question_correct_answer);
            // return response_answer == $('.quiz_show .correct_answer').html();
            break;

        case '3':
            question_user_answer.push($('.quiz_show input:checked').next().html());
            question_correct_answer.push($('.quiz_show input[value=' + $('.quiz_show .correct_answer').html() + ']').next().html());

            return $('.quiz_show input:checked').val() == $('.quiz_show .correct_answer').html();
            break;

        case '4':
            question_user_answer.push($('.quiz_show #answer').val());
            question_correct_answer.push($('.quiz_show .correct_answer').html());

            if ($('.quiz_show .case_sensitive').html() == 0) {
                return $('.quiz_show #answer').val().toUpperCase() == $('.quiz_show .correct_answer').html().toUpperCase();
            } else {
                return $('.quiz_show #answer').val() == $('.quiz_show .correct_answer').html();
            }
            break;

        case '5':
            const numeric_answer = parseInt($('.quiz_show #answer').val());
            var correct_answer = $('.quiz_show .correct_answer').html();
            var numeric_answer_array = correct_answer.split('@');
            numeric_answer_array.pop();

            question_user_answer.push($('.quiz_show #answer').val());
            question_correct_answer.push(correct_answer.split("&lt;").join("<").split("&lt;").join("<").split("&gt;").join(">").split(';@').join(', ').split('==;').join('Equal to ').split('<<;').join('Between ').split('>;').join('Greater than ').split('>=;').join('Greater than or equal to ').split('<;').join('Less than ').split('<=;').join('Less than or equal to ').split('!=;').join('Not equal to ').split(';').join(' and ').slice(0, -1));

            for (let numeric_item of numeric_answer_array) {
                numeric_item = numeric_item.replace("&lt;", "<").replace("&lt;", "<").replace("&gt;", ">");
                var symbol = numeric_item.split(';')[0];
                switch (symbol) {
                    case '==':
                        if (numeric_answer == parseInt(numeric_item.split(';')[1])) return true;
                        break;

                    case '<<':
                        if ((numeric_answer - parseInt(numeric_item.split(';')[1])) * (numeric_answer - parseInt(numeric_item.split(';')[2])) < 0) return true;
                        break;

                    case '>':
                        if (numeric_answer > parseInt(numeric_item.split(';')[1])) return true;
                        break;

                    case '>=':
                        if (numeric_answer >= parseInt(numeric_item.split(';')[1])) return true;
                        break;

                    case '<':
                        if (numeric_answer < parseInt(numeric_item.split(';')[1])) return true;
                        break;

                    case '<=':
                        if (numeric_answer <= parseInt(numeric_item.split(';')[1])) return true;
                        break;

                    case '!=':
                        if (numeric_answer != parseInt(numeric_item.split(';')[1])) return true;
                        break;
                }
            }

            return false;
            break;

        case '6':
            var sequence_answer = '';
            var sequence_items = $('.quiz_show #sortable li');

            for (let i = 0; i < sequence_items.length; i++) {
                sequence_answer += sequence_items.eq(i).find('label').html() + ';';
            }

            question_user_answer.push(sequence_answer);
            question_correct_answer.push($('.quiz_show .correct_answer').html());

            if ($('.quiz_show .partially_correct').html() == '1') {
                var correct_answer_array = question_correct_answer.split(';');
                correct_answer_array.pop();
                for (let i = 0; i < sequence_items.length; i++) {
                    if (correct_answer_array.indexOf(sequence_items.eq(i).find('label').html()) != -1) return true;
                }
                return false;
            }

            return sequence_answer == $('.quiz_show .correct_answer').html();
            break;

        case '7':
            const matching_items = $('.quiz_show .slide_view_answer_element .col-md-12 > div');
            let matching_answer = '';

            // detect matching
            for (let i = 1; i < matching_items.length; i++) {
                // if (matching_items.eq(i).css('justify-content') != 'center') return false;
                matching_answer += matching_items.eq(i).find('.ui-widget-header').eq(0).html() + ';' + matching_items.eq(i).find('.ui-widget-content').eq(0).html() + '@';
            }
            question_user_answer.push(matching_answer.split('<p>').join('').split('</p>').join(''));
            question_correct_answer.push($('.quiz_show .correct_answer').html().split('<p>').join('').split('</p>').join(''));

            console.log(question_correct_answer);
            console.log(question_user_answer);

            if ($('.quiz_show .partially_correct').html() == '1') {
                var correct_answer_array = question_correct_answer[0].split('@');
                correct_answer_array.pop();
                var user_answer_array = question_user_answer[0].split('@');
                user_answer_array.pop();

                for (let i = 0; i < user_answer_array.length; i++) {
                    if (correct_answer_array.indexOf(user_answer_array[i]) != -1) return true;
                }
                return false;
            }

            return question_user_answer[0] == question_correct_answer[0];
            break;

        case '8':
            var correct_answer = $('.quiz_show .correct_answer').html();
            var correct_answer_array = correct_answer.split('@');
            correct_answer_array.pop();

            let answer_array_items;


            if ($('.quiz_show .partially_correct').html() == '1') {
                if ($('.quiz_show .case_sensitive').html() == 0) {
                    for (let i = 0; i < correct_answer_array.length; i++) {
                        answer_array_items = correct_answer_array[i].toUpperCase().split(';');
                        answer_array_items.pop();
                        if (answer_array_items.indexOf($('.quiz_show .slide_view_answer_element input').eq(i).val().toUpperCase()) != -1) return true;
                    }
                } else {
                    for (let i = 0; i < correct_answer_array.length; i++) {
                        answer_array_items = correct_answer_array[i].split(';');
                        answer_array_items.pop();
                        console.log(answer_array_items);
                        console.log($('.quiz_show .slide_view_answer_element input').eq(i).val());
                        if (answer_array_items.indexOf($('.quiz_show .slide_view_answer_element input').eq(i).val()) != -1) return true;
                    }
                }

                return false;
            }

            if ($('.quiz_show .case_sensitive').html() == 0) {
                for (let i = 0; i < correct_answer_array.length; i++) {
                    answer_array_items = correct_answer_array[i].toUpperCase().split(';');
                    answer_array_items.pop();
                    if (answer_array_items.indexOf($('.quiz_show .slide_view_answer_element input').eq(i).val().toUpperCase()) == -1) return false;
                }
            } else {
                for (let i = 0; i < correct_answer_array.length; i++) {
                    answer_array_items = correct_answer_array[i].split(';');
                    answer_array_items.pop();
                    if (answer_array_items.indexOf($('.quiz_show .slide_view_answer_element input').eq(i).val()) == -1) return false;
                }
            }

            return true;
            break;

        case '9':
            const select_lists_items = $('.quiz_show .slide_view_answer_element select');
            let select_lists_answer = '';

            for (let i = 0; i < select_lists_items.length; i++) {
                select_lists_answer += select_lists_items.eq(i).val() + ';';
            }

            question_user_answer.push(select_lists_answer);
            question_correct_answer.push($('.quiz_show .correct_answer').html());

            if ($('.quiz_show .partially_correct').html() == '1') {
                var correct_answer_array = question_correct_answer[0].split(';');
                correct_answer_array.pop();
                var user_answer_array = question_user_answer[0].split(';');
                user_answer_array.pop();
                for (let i = 0; i < question_user_answer[0].length; i++) {
                    if (question_user_answer[0][i] == question_correct_answer[0][i]) return true;
                }

                return false;
            }

            return select_lists_answer == $('.quiz_show .correct_answer').html();
            break;

        case '10':
            let drag_words_answer = '';

            var drag_words_elements = $('.quiz_show .blank');

            for (let i = 0; i < drag_words_elements.length; i++) {
                drag_words_answer += drag_words_elements.eq(i).html() + ';';
            }

            question_user_answer.push(drag_words_answer);
            question_correct_answer.push($('.quiz_show .correct_answer').html());

            if ($('.quiz_show .partially_correct').html() == '1') {
                var correct_answer_array = question_correct_answer[0].split(';');
                correct_answer_array.pop();
                var user_answer_array = question_user_answer[0].split(';');
                user_answer_array.pop();
                for (let i = 0; i < question_user_answer[0].length; i++) {
                    if (question_user_answer[0][i] == question_correct_answer[0][i]) return true;
                }

                return false;
            }

            return drag_words_answer == $('.quiz_show .correct_answer').html();
            break;

        case '11':
            var root_url = $('meta[name=url]').attr('content');

            var canvas_info = $('.quiz_show .correct_answer').html();

            var canvas_item_info = canvas_info.split('@')[1];

            var json_canvas_item = JSON.parse(canvas_item_info);

            for (let i = 0; i < hotspots_points.length; i++) {
                switch (json_canvas_item.type) {
                    case 'circle':
                        console.log(hotspots_points);
                        console.log(json_canvas_item);
                        if (Math.pow(json_canvas_item.radius, 2) < Math.pow(hotspots_points[0][0] - json_canvas_item.left, 2) + Math.pow(hotspots_points[0][1] - json_canvas_item.top, 2)) return false;
                        break;

                    case 'rect':
                        if (hotspots_points[0][0] < json_canvas_item.left || hotspots_points[0][0] > json_canvas_item.left + json_canvas_item.width || hotspots_points[0][1] < json_canvas_item.top || hotspots_points[0][1] > json_canvas_item.top + json_canvas_item.height) return false;
                        break;

                    case 'polyline':
                        if (!(inside(hotspots_points[0], json_canvas_item.points))) return false;
                        break;
                }
            }

            return true;
            break;
    }
}

/*
* ************* method for hotspot polygen ***********************
* */
function inside(point, vs) {
    // ray-casting algorithm based on
    // https://wrf.ecse.rpi.edu/Research/Short_Notes/pnpoly.html/pnpoly.html

    var x = point[0], y = point[1];

    console.log(x, y);

    var inside = false;
    for (var i = 0, j = vs.length - 1; i < vs.length; j = i++) {
        var xi = vs[i].x, yi = vs[i].y;
        var xj = vs[j].x, yj = vs[j].y;

        var intersect = ((yi > y) != (yj > y))
            && (x < (xj - xi) * (y - yi) / (yj - yi) + xi);
        if (intersect) inside = !inside;
    }

    return inside;
};

function incorrect_process() {
    if (attempts == parseInt($('.quiz_show .attempts').html()) && $('.quiz_show .attempts').html() != 'unlimited') {
        clearInterval(question_timer);

        total_score += parseInt($('.quiz_show .incorrect_score').html());
        question_user_point += parseInt($('.quiz_show .incorrect_score').html());
        question_result = 'Wrong';
        question_feedback = $('.quiz_show .feedback_incorrect').html();

        $('#submit_btn').html('Continue');
        if ($('.quiz_show .feedback_type').html() != 'none') {
            show_modal('error', 'Incorrect', $('.quiz_show .feedback_incorrect').html());
            $('.quiz_show .is_correct').html('false');
        }
    } else {
        total_score -= parseInt($('.quiz_show .try_again_score').html());
        question_user_point -= parseInt($('.quiz_show .try_again_score').html());
        question_feedback = $('.quiz_show .feedback_try_again').html();

        $('#submit_btn').html('Try again');
        if ($('.quiz_show .feedback_type').html() != 'none') {
            show_modal('error', 'Incorrect', $('.quiz_show .feedback_try_again').html());
            $('.quiz_show .is_correct').html('false');
        }
    }
    console.log('incorrect_process function');
}

/*
*************** Compare 2 arrays ***************
*/
function compare_arrays(array1, array2) {
    sorted_array1 = array1.sort(s);
    sorted_array2 = array2.sort(s);

    var is_same = (sorted_array1.length == sorted_array2.length) && sorted_array1.every(function (element, index) {
        return element === sorted_array2[index];
    });

    return is_same;
}

function s(x, y) {
    var pre = ['string', 'number', 'bool']
    if (typeof x !== typeof y) return pre.indexOf(typeof y) - pre.indexOf(typeof x);

    if (x === y) return 0;
    else return (x > y) ? 1 : -1;

}

$('.quiz_show .slide_view_media_element').click(function () {
    image_popup($(this).find('img').attr('src'));
});

/*
* ************* Question List Modal ********************
* */
$('#question_list_modal_close').click(function () {
    $('#question_list_modal').hide();
});

$('#question_list').click(function () {
    $('#question_list_modal').show();
});

function update_question_list_modal() {
    var current_question_Id = $('.quiz_show .quiz_id').html();
    var current_question_type_Id = $('.quiz_show .type_id').html();

    if (parseInt(current_question_type_Id) > 11) {
        console.log($('#question_list-' + current_question_Id).find('.question_result'));
        $('#question_list-' + current_question_Id).find('.question_result').html('<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="24px" height="24px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve" class="quiz-slide-list-status-icon__icon quiz-slide-list-status-icon__icon_answered"><circle fill="#FFFFFF" cx="12" cy="12" r="12"></circle> <path fill="#528BDF" d="M12,22C6.5,22,2,17.5,2,12S6.5,2,12,2s10,4.5,10,10S17.5,22,12,22z M9,11H7v2h2V11z M13,11h-2v2h2V11z M17,11 	h-2v2h2V11z"></path></svg>');
        return;
    }

    if (question_user_point < parseInt($('.quiz_show .correct_score').html())) {
        $('#question_list-' + current_question_Id).find('.question_awarded').html(question_user_point);
        $('#question_list-' + current_question_Id).find('.question_result').html('<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="24px" height="24px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve" class="quiz-slide-list-status-icon__icon quiz-slide-list-status-icon__icon_incorrect"><circle fill="#FFFFFF" cx="12" cy="12" r="12"></circle><path fill="#DB5A4B" d="M12,2C6.5,2,2,6.5,2,12s4.5,10,10,10s10-4.5,10-10S17.5,2,12,2z M16.4,8.8L13.2,12l2.9,2.9 	c0.3,0.3,0.3,0.9,0,1.2c-0.3,0.3-0.9,0.3-1.2,0l0,0L12,13.2l-3.2,3.2c-0.3,0.3-0.9,0.3-1.2,0s-0.3-0.9,0-1.2l3.2-3.2L7.9,9.1 	c-0.3-0.3-0.3-0.9,0-1.2s0.9-0.3,1.2,0l2.9,2.9l3.2-3.2c0.3-0.3,0.9-0.3,1.2,0C16.7,7.9,16.8,8.4,16.4,8.8 	C16.4,8.8,16.4,8.8,16.4,8.8z"></path></svg>');
    } else {
        $('#question_list-' + current_question_Id).find('.question_awarded').html(question_user_point);
        $('#question_list-' + current_question_Id).find('.question_result').html('<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="24px" height="24px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve" class="quiz-slide-list-status-icon__icon quiz-slide-list-status-icon__icon_correct"><circle fill="#FFFFFF" cx="12" cy="12" r="12"></circle><path fill="#7CB911" d="M12,2C6.5,2,2,6.5,2,12s4.5,10,10,10s10-4.5,10-10S17.5,2,12,2z M17.9,8.9l-7.7,7.7 	c-0.4,0.4-0.9,0.4-1.3,0l-3.2-3.2c-0.4-0.4-0.4-0.9,0-1.3s0.9-0.4,1.3,0l2.5,2.5l7.1-7.1c0.3-0.4,0.9-0.4,1.3,0 	C18.2,7.9,18.2,8.5,17.9,8.9C17.9,8.9,17.9,8.9,17.9,8.9z"></path></svg>');
    }
}

/*
* ***************** Review Javascript ****************
* */
var review_Id = 0;

function review() {
    isReview = true;
    Review.postMessage('review');

    show_result($('.quiz_show .correct_answer').html(), $('.quiz_show .type_id').html(), $('.quiz_show').attr('id'));

    if ($('#is_quiz').html() == '0') {
        $('.review_buttons > button').html('Close');
    }

    $('.preview_btn').hide();
    $('.review_buttons').show();

    $('.quiz_show').removeClass('quiz_show').addClass('quiz_hide');

    $('.quiz_list_container').eq(review_Id).removeClass('quiz_hide').addClass('quiz_show');

    // hide_some_btns_for_mobile();
    fit_question_list_container_size();

    disable_next_and_prev_btn();
}

// Next button
function next_review() {
    var current_show_id = $('.quiz_show').attr('id');
    var next_show_id = $('.quiz_show').next().attr('id');
    var type_id = $('.quiz_show').next().find('.type_id').html();

    if (next_show_id === undefined || type_id == 14 || type_id == 15) {
    } else {

        $('#' + current_show_id).removeClass('quiz_show');
        $('#' + current_show_id).addClass('quiz_hide');

        $('#' + next_show_id).removeClass('quiz_hide');
        $('#' + next_show_id).addClass('quiz_show');

        // hide_some_btns_for_mobile();
        fit_question_list_container_size();
        disable_next_and_prev_btn();
    }
}

// Previous Button
function preview_review() {
    var current_show_id = $('.quiz_show').attr('id');
    var previous_show_id = $('.quiz_show').prev().attr('id');
    var type_id = $('.quiz_show').prev().find('.type_id').html();

    if (previous_show_id === undefined || type_id == 14 || type_id == 15) {
    } else {

        $('#' + current_show_id).removeClass('quiz_show');
        $('#' + current_show_id).addClass('quiz_hide');

        $('#' + previous_show_id).removeClass('quiz_hide');
        $('#' + previous_show_id).addClass('quiz_show');

        // hide_some_btns_for_mobile();
        fit_question_list_container_size();
        disable_next_and_prev_btn();
    }
}

function disable_next_and_prev_btn() {
    $('.review_buttons > div button').removeClass('disable_btn');

    var next_show_id = $('.quiz_show').next().attr('id');
    var next_type_id = $('.quiz_show').next().find('.type_id').html();

    if (next_show_id === undefined || next_type_id == 14 || next_type_id == 15) {
        $('.review_buttons > div button').eq(1).addClass('disable_btn');
    }

    var previous_show_id = $('.quiz_show').prev().attr('id');
    var previous_type_id = $('.quiz_show').prev().find('.type_id').html();

    if (previous_show_id === undefined || previous_type_id == 14 || previous_type_id == 15) {
        $('.review_buttons > div button').eq(0).addClass('disable_btn');
    }
}

//Show Result
function show_result(question_correct_answer, question_type_id, question_id) {

    const root_url = $('meta[name=url]').attr('content');

    switch (question_type_id) {
        case '1':
            $('#' + question_id.split('-')[1] + '_' + question_correct_answer).parent().prepend('<div style="position: absolute; transform: translateX(-100%);width: 20px;"><img src="./green_tick.png" style="height: 20px;width: 20px;"></div>');
            break;

        case '2':
            let response_correct_answer_array = question_correct_answer.split(';');
            response_correct_answer_array.pop();

            for (let i = 0; i < response_correct_answer_array.length; i++) {
                $('#' + question_id.split('-')[1] + '_' + response_correct_answer_array[i]).parent().prepend('<div style="position: absolute; transform: translateX(-100%);width: 20px;"><img src="./green_tick.png" style="height: 20px;width: 20px;"></div>');
            }
            break;

        case '3':
            $('#' + question_id.split('-')[1] + '_' + (question_correct_answer == 1 ? 'true' : 'false')).parent().prepend('<div style="position: absolute; transform: translateX(-100%);width: 20px;"><img src="./green_tick.png" style="height: 20px;width: 20px;"></div>');
            break;

        case '4':
            if ($('.quiz_show .is_correct').html() == 'true') {
                $('.quiz_show #answer').css('cssText', 'color: green !important;');
            } else {
                $('.quiz_show #answer').css('cssText', 'color: red !important;');

                $('.quiz_show #answer').parent().append('<div style="color: #c6c61f;  position: absolute; top: 0; bottom: 0; right: 25px;display: flex;align-items: center;" onmouseover="{$(this).next().show()}" onmouseleave="{$(this).next().hide()}"><i class="fas fa-align-justify"></i></div>');
                $('.quiz_show #answer').parent().append('<div style="position: absolute;right: 0;background: white;color: black;padding: 10px;display: none;border-radius: 5px;z-index: 2;box-shadow: grey 2px 2px 6px 1px;"><div>Correct Answer</div><div style="display: flex"><img src="./green_tick.png" style="height: 20px;width: 20px;">' + question_correct_answer + '</div></div>');
            }
            break;

        case '5':
            let numeric_correct_answer_array = question_correct_answer.split('@');
            numeric_correct_answer_array.pop();
            console.log(numeric_correct_answer_array);

            if ($('.quiz_show .is_correct').html() == 'true') {
                $('.quiz_show #answer').css('cssText', 'color: green !important;');
            } else {
                $('.quiz_show #answer').css('cssText', 'color: red !important;');

                $('.quiz_show #answer').parent().append('<div style="color: #c6c61f;  position: absolute; top: 0; bottom: 0; right: 25px;display: flex;align-items: center;" onmouseover="{$(this).next().show()}" onmouseleave="{$(this).next().hide()}"><i class="fas fa-align-justify"></i></div>');
                $('.quiz_show #answer').parent().append('<div style="position: absolute;right: 0;background: white;color: black;padding: 10px;display: none;border-radius: 5px;z-index: 2;box-shadow: grey 2px 2px 6px 1px;"><div>Correct Answer</div><div class="correct_answer_list_element"></div></div>');

                for (let i = 0; i < numeric_correct_answer_array.length; i++) {
                    $('.quiz_show .correct_answer_list_element').append('<div style="display: flex"><img src="./green_tick.png" style="height: 20px;width: 20px;">' + numeric_correct_answer_array[i].slice(0, -1).split('==;').join('Equal to ').split('&lt;&lt;;').join('Between ').split('&gt;;').join('Greater than ').split('&gt;=;').join('Greater than or equal to ').split('&lt;;').join('Less than ').split('&lt;=;').join('Less than or equal to ').split('!=;').join('Not equal to ').split(';').join(' and ') + '</div>');
                }
            }
            break;

        case '6':
            let sequence_correct_answer_array = question_correct_answer.split(';');
            sequence_correct_answer_array.pop();

            let sequence_correct_index;
            for (let i = 0; i < $('.quiz_show .ui-state-default').length; i++) {

                sequence_correct_index = sequence_correct_answer_array.indexOf($('.quiz_show .ui-state-default').eq(i).find('.sequence_label').html());

                if (sequence_correct_index == i) {
                    $('.quiz_show .ui-state-default').eq(i).css('border', '1px solid green');
                    $('.quiz_show .ui-state-default').eq(i).css('color', 'green');
                } else {
                    $('.quiz_show .ui-state-default').eq(i).css('border', '1px solid red');
                    $('.quiz_show .ui-state-default').eq(i).css('color', 'red');
                }

                $('.quiz_show .ui-state-default').eq(i).find('.sequence_label').html((sequence_correct_index + 1) + '. ' + $('.quiz_show .ui-state-default').eq(i).find('.sequence_label').html());
            }
            break;

        case '7':
            let matching_correct_answer_array = question_correct_answer.split('@');
            matching_correct_answer_array.pop();

            for (let i = 0; i < matching_correct_answer_array.length; i++) {
                matching_correct_answer_array[i] = matching_correct_answer_array[i].split('<p>').join('').split('</p>').join('');
            }

            let matching_content_correct_answer_array = [];

            for (let i = 0; i < matching_correct_answer_array.length; i++) {
                matching_content_correct_answer_array.push(matching_correct_answer_array[i].split(';')[1]);
            }

            console.log(matching_correct_answer_array);
            const matching_elements = $('.quiz_show .slide_view_answer_element .col-md-12 > div');

            let matching_correct_index;

            for (let i = 1; i < matching_elements.length; i++) {

                console.log(matching_elements.eq(i));
                if (matching_elements.eq(i).find('.ui-widget-content').html() != undefined) {
                    matching_correct_index = matching_content_correct_answer_array.indexOf(matching_elements.eq(i).find('.ui-widget-content').html().split('<p>').join('').split('</p>').join(''));

                    if (matching_correct_index == i) {
                        matching_elements.eq(i).find('.ui-widget-header').css('border', '1px solid green');
                        matching_elements.eq(i).find('.ui-widget-content').css('border', '1px solid green');
                    } else {
                        matching_elements.eq(i).find('.ui-widget-header').css('border', '1px solid red');
                        matching_elements.eq(i).find('.ui-widget-content').css('border', '1px solid red');
                    }
                }

                // matching_elements.eq(i).find('.ui-widget-content').html((matching_correct_index + 1) + '. ' + matching_elements.eq(i).find('.ui-widget-content').html());
                // matching_elements.eq(i).find('.ui-widget-header').html((i + 1) + '. ' + matching_elements.eq(i).find('.ui-widget-header').html());

            }
            break;

        case '8':
            let fill_blanks_correct_answer_array = question_correct_answer.split('@');
            fill_blanks_correct_answer_array.pop();

            let fill_blanks_element_correct_answer_array;
            let input_value;
            for (let i = 0; i < fill_blanks_correct_answer_array.length; i++) {
                fill_blanks_element_correct_answer_array = fill_blanks_correct_answer_array[i].split(';');
                fill_blanks_element_correct_answer_array.pop();

                input_value = $('#' + question_id + ' #' + i).val();

                if (fill_blanks_element_correct_answer_array.indexOf(input_value) != -1) {
                    $('#' + question_id + ' #' + i).css('color', 'green');
                } else {
                    $('#' + question_id + ' #' + i).css('color', 'red');

                    $('#' + question_id + ' #' + i).parent().css('position', 'relative');
                    $('#' + question_id + ' #' + i).parent().append('<div style="color: #c6c61f;  position: absolute; top: 0; bottom: 0; right: 8px;" onmouseover="{$(this).next().show()}" onmouseleave="{$(this).next().hide()}"><i class="fas fa-align-justify"></i></div>');
                    $('#' + question_id + ' #' + i).parent().append('<div style="position: absolute;left: 0;background: white;color: black;padding: 10px;display: none;border-radius: 5px;min-width: 180px;z-index: 2;box-shadow: grey 2px 2px 6px 1px;"><div>Correct Answer</div><div class="correct_answer_list_element"></div></div>');

                    for (let j = 0; j < fill_blanks_element_correct_answer_array.length; j++) {
                        $('#' + question_id + ' .correct_answer_list_element').append('<div style="display: flex"><img src="./green_tick.png" style="height: 20px;width: 20px;">' + fill_blanks_element_correct_answer_array[j] + '</div>');
                    }
                }
            }
            break;

        case '9':
            let select_lists_correct_answer_array = question_correct_answer.split(';');
            select_lists_correct_answer_array.pop();

            for (let i = 0; i < select_lists_correct_answer_array.length; i++) {
                if ($('#' + question_id + ' #' + i).val() == select_lists_correct_answer_array[i]) {
                    $('#' + question_id + ' #' + i).css('color', 'green');
                } else {
                    $('#' + question_id + ' #' + i).css('color', 'red');

                    $('#' + question_id + ' #' + i).parent().css('position', 'relative');
                    $('#' + question_id + ' #' + i).parent().find('select').attr('onmouseover', '{$(this).next().show()}');
                    $('#' + question_id + ' #' + i).parent().find('select').attr('onmouseleave', '{$(this).next().hide()}');
                    $('#' + question_id + ' #' + i).parent().append('<div style="position: absolute;left: 0;background: white;color: black;padding: 10px;display: none;border-radius: 5px;min-width: 180px;z-index: 2;box-shadow: grey 2px 2px 6px 1px;"><div>Correct Answer</div><div class="correct_answer_list_element"></div></div>');
                    $('#' + question_id + ' .correct_answer_list_element').append('<div style="display: flex"><img src="./green_tick.png" style="height: 20px;width: 20px;">' + select_lists_correct_answer_array[i] + '</div>');
                }
            }
            break;

        case '10':
            let drop_words_correct_answer_array = question_correct_answer.split(';');
            drop_words_correct_answer_array.pop();

            let drop_words_user_answer_array = $('#' + question_id + ' .question_user_answer').html().split(';');
            drop_words_user_answer_array.pop();

            $('#' + question_id + ' #slide_drag_words_answer').remove();

            const blank_element_list = $('#' + question_id + ' .blank');

            for (let i = 0; i < blank_element_list.length; i++) {
                blank_element_list.eq(i).html(drop_words_user_answer_array[i]);
                blank_element_list.eq(i).addClass('review_drag_words');
                if (drop_words_user_answer_array[i] == drop_words_correct_answer_array[i]) {
                    blank_element_list.eq(i).css('color', 'green');
                } else {
                    blank_element_list.eq(i).css('color', 'red');

                    blank_element_list.eq(i).css('position', 'relative');
                    blank_element_list.eq(i).attr('onmouseover', '{$(this).children().show()}');
                    blank_element_list.eq(i).attr('onmouseleave', '{$(this).children().hide()}');
                    blank_element_list.eq(i).append('<div style="position: absolute;left: 0;background: white;color: black;padding: 10px;display: none;border-radius: 5px;min-width: 180px;z-index: 2;box-shadow: grey 2px 2px 6px 1px;"><div>Correct Answer</div><div class="correct_answer_list_element"><div style="display: flex"><img src="./green_tick.png" style="height: 20px;width: 20px;">' + drop_words_correct_answer_array[i] + '</div></div></div>');
                }
            }
            break;

        case '11':
            console.log(question_correct_answer);
            console.log($('#' + question_id + ' #image-hotspots'));
            $('#' + question_id + ' #image-hotspots').append('<canvas id="preview_hotspots_canvas-' + question_id + '" height="214" width="300"></canvas>');

            var preview_view_canvas = new fabric.Canvas('preview_hotspots_canvas-' + question_id);

            var canvas_item_info = question_correct_answer.split('@')[1];

            var json_canvas_item = JSON.parse(canvas_item_info);

            if (json_canvas_item.type === 'circle') {

                preview_view_canvas.add(new fabric.Circle({
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

                preview_view_canvas.add(new fabric.Rect({
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

                preview_view_canvas.add(new fabric.Polygon(json_canvas_item.points, {
                    strokeWidth: 3,
                    stroke: '#288f02',
                    fill: '#c1fc8580'
                }));
            }
            break;
    }
}

function see_result() {
    $('#question_list').css('visibility', 'visible');
    const root_url = $('meta[name=url]').attr('content');
    const token = $('meta[name=csrf-token]').attr('content');

    $('.review_buttons').hide();
    $('.preview_btn').show();

    $('#submit_btn').html('Close');

    const length = $('.quiz_list_container').length;

    if (result == 'Fail') {
        var current_show_id = $('.quiz_show').attr('id');

        var next_show_id = $('.quiz_list_container').eq(length - 1).attr('id');
        if (next_show_id === undefined) return;

        $('#quiz_list_audio-' + next_show_id.split('-')[1])[0].pause();
        $('#quiz_list_audio-' + next_show_id.split('-')[1])[0].currentTime = 0;
        $('#quiz_list_audio-' + next_show_id.split('-')[1])[0].play();

        $('#' + current_show_id).removeClass('quiz_show');
        $('#' + current_show_id).addClass('quiz_hide');

        $('#' + next_show_id).removeClass('quiz_hide');
        $('#' + next_show_id).addClass('quiz_show');

        // hide_some_btns_for_mobile();
        fit_question_list_container_size();

        return;
    }

    if (result == 'Pass') {
        var current_show_id = $('.quiz_show').attr('id');

        var next_show_id = $('.quiz_list_container').eq(length - 2).attr('id');
        if (next_show_id === undefined) return;

        $('#quiz_list_audio-' + next_show_id.split('-')[1])[0].pause();
        $('#quiz_list_audio-' + next_show_id.split('-')[1])[0].currentTime = 0;
        $('#quiz_list_audio-' + next_show_id.split('-')[1])[0].play();

        $('#' + current_show_id).removeClass('quiz_show');
        $('#' + current_show_id).addClass('quiz_hide');

        $('#' + next_show_id).removeClass('quiz_hide');
        $('#' + next_show_id).addClass('quiz_show');

        // hide_some_btns_for_mobile();
        fit_question_list_container_size();

        return;
    }


    if ($('#is_quiz').html() != '0') {

        if (total_score < parseInt($('.quiz_show .passing_score').html())) {
            result = 'Fail';
            var current_show_id = $('.quiz_show').attr('id');

            var next_show_id = $('.quiz_list_container').eq(length - 1).attr('id');
            if (next_show_id === undefined) return;

            $('#quiz_list_audio-' + next_show_id.split('-')[1])[0].pause();
            $('#quiz_list_audio-' + next_show_id.split('-')[1])[0].currentTime = 0;
            $('#quiz_list_audio-' + next_show_id.split('-')[1])[0].play();

            $('#' + current_show_id).removeClass('quiz_show');
            $('#' + current_show_id).addClass('quiz_hide');

            $('#' + next_show_id).removeClass('quiz_hide');
            $('#' + next_show_id).addClass('quiz_show');

            rearrange_preview_ui();
            // hide_some_btns_for_mobile();
            fit_question_list_container_size();
        } else {
            result = 'Pass';
            var current_show_id = $('.quiz_show').attr('id');

            var next_show_id = $('.quiz_list_container').eq(length - 2).attr('id');
            if (next_show_id === undefined) return;

            $('#quiz_list_audio-' + next_show_id.split('-')[1])[0].pause();
            $('#quiz_list_audio-' + next_show_id.split('-')[1])[0].currentTime = 0;
            $('#quiz_list_audio-' + next_show_id.split('-')[1])[0].play();

            $('#' + current_show_id).removeClass('quiz_show');
            $('#' + current_show_id).addClass('quiz_hide');

            $('#' + next_show_id).removeClass('quiz_hide');
            $('#' + next_show_id).addClass('quiz_show');

            rearrange_preview_ui();
            // hide_some_btns_for_mobile();
            fit_question_list_container_size();
        }


        user_email = $('#user_EMAIL').val();
        user_name = $('#user_FIRST_NAME').val() + ' ' + $('#user_LAST_NAME').val();

        show_preload();
        $.ajax({
            url: root_url + '/send-mail',
            type: 'POST',
            data: {
                _token: token,
                user_name: user_name,
                user_email: user_email,
                stuff_emails: $('.quiz_show .stuff_emails').html(),
                email_from: $('.quiz_show .email_from').html(),
                email_subject: change_email_subject($('.quiz_show .email_subject').html()),
                email_comment: $('.quiz_show .email_comment').html(),
                exam_answered: correct_quiz_count,
                exam_question_count: quizId,
                exam_user_score: total_score,
                exam_passing_score: $('.quiz_show .passing_score').html(),
                result: result,
                quizzes: quizzes,
            },
            success: function (data) {
                console.log('success');
                hide_preload();
            }
        }).catch((XHttpResponse) => {
            console.log(XHttpResponse);
            hide_preload();
        });
        $('#submit_btn').html('Close');
    } else {
        window.close();
    }
}

/*
* ************* Limit Time *************
* */

var start_or_end;

function limit_time() {

    if ($('.quiz_show .is_limit_time').html() == '1') {

        const limit_second = get_limit_time_to_second();
        start_or_end = 'start';
        $('#question_time').show();

        $('#timer_dialog_content').html('You have ' + limit_second + ' sec to answer this question');

        $('#question_time span').html(limit_second);

        $('#timer_confirm_dialog').fadeIn(200);

    }

}

$('#timer_dialog_btn button').click(function () {
    if (start_or_end == 'start') {

        start_question_timer();
        start_or_end = 'end';
    }

    $('#timer_confirm_dialog').fadeOut(200);
});

function get_limit_time_to_second() {
    return parseInt($('.quiz_show .limit_time').html().split(':')[0]) * 60 + parseInt($('.quiz_show .limit_time').html().split(':')[1]);
}

function start_question_timer() {
    let current_second = get_limit_time_to_second();

    question_timer = setInterval(function () {
        current_second = current_second - 1;
        $('#question_time span').html(current_second);

        if (current_second == 0) {
            clearInterval(question_timer);
            $('#timer_dialog_content').html('Your time is up for this question.');
            $('#timer_confirm_dialog').fadeIn(200);
            $('#submit_btn').html('Continue');
        }
    }, 1000);
}

function change_email_subject(string) {
    string = string_replaceAll(string, '%QUIZ_TITLE%', $('.quiz_show .quiz_name').html());
    string = string_replaceAll(string, '%QUIZ_STATUS%', result);
    for (let i = 0; i < user_info_field_patterns.length; i++) {
        string = string_replaceAll(string, '%' + user_info_field_patterns[i] + '%', $('#user_' + user_info_field_patterns[i]).val());
    }

    console.log(string);

    return string;
}

function invokeNative() {
    if ($('.quiz_show video source').length > 0) {
        // VideoUrl.postMessage($('.quiz_show video source').attr('src'));
    } else {
        // VideoUrl.postMessage('#');
    }

    if ($('.quiz_show audio source').length > 0) {
        // AudioUrl.postMessage($('.quiz_show audio source').attr('src'));
    } else {
        // AudioUrl.postMessage('#');
    }
}

/******* Mobile Device UI ***************/
function click_sequence_list() {
    $('.quiz_show .ui-state-default').click(function () {
        if (isReview) return;
        enable_arrow_container();   

        console.log('ui-state-default clicked', $(this));

        $('.quiz_show .up_down_container').css('display', 'flex');
        $('.quiz_show .ui-state-default').removeClass('selected_sequence_list');
        $(this).addClass('selected_sequence_list');

        disable_down_arrow();
        disable_up_arrow();
    });

    $('.quiz_show .up_container').click(function () {
        enable_arrow_container();

        let prev_element = $('.quiz_show .selected_sequence_list').prev('.ui-state-default');
        if (prev_element.length > 0) {
            $('.quiz_show .selected_sequence_list').after(prev_element);
        }

        disable_up_arrow();
    });
    
    $('.quiz_show .down_container').click(function () {
        enable_arrow_container();

        let next_element = $('.quiz_show .selected_sequence_list').next('.ui-state-default');
        if (next_element.length > 0) {
            $('.quiz_show .selected_sequence_list').before(next_element);
        }

        disable_down_arrow();
    });
}

function enable_arrow_container() {
    $('.up_container').removeClass('disable_arrow_container');
    $('.down_container').removeClass('disable_arrow_container');
}

function disable_up_arrow() {
    let prev_element = $('.quiz_show .selected_sequence_list').prev('.ui-state-default');

    if (prev_element.length == 0) {
        $('.quiz_show .up_container').addClass('disable_arrow_container');
    }
}

function disable_down_arrow() {
    let next_element = $('.quiz_show .selected_sequence_list').next('.ui-state-default');

    console.log(next_element.length);

    if (next_element.length == 0) {
        $('.quiz_show .down_container').addClass('disable_arrow_container');
    }
}

function click_matching_list() {
    $('.quiz_show .ui-widget-header').click(function () {
        if (isReview) return;
        if ($('.quiz_show .selected_matching_list').length > 0) return;

        console.log('ui-widget-header clicked');

        $(this).addClass('selected_matching_list');
        $('.quiz_show .matching_list').show();
    });

    $('.quiz_show .matching_close_container span').click(function () {
        $('.quiz_show .matching_list').hide();
        $('.quiz_show .selected_matching_list').removeClass('selected_matching_list');
    });

    $('.quiz_show .matching_list_content').click(function () {

        for (let i = 0; i < $('.quiz_show .ui-widget-content').length; i++) {
            if ($('.quiz_show .ui-widget-content').eq(i).html() == $(this).html()) {
                $('.quiz_show .ui-widget-content').eq(i).css('visibility', 'hidden');
            }
        }

        $('.quiz_show .selected_matching_list').next().html($(this).html());
        $('.quiz_show .selected_matching_list').next().css('visibility', 'visible');
        $('.quiz_show .selected_matching_list').removeClass('selected_matching_list');

        $('.quiz_show .matching_list').hide();
    });
}

function click_drag_words() {
    $('.quiz_show .blank').click(function () {
        if (isReview) return;
        if($('.quiz_show .selected_drag_word').length > 0) return;

        console.log('click_drag_words clicked');

        $(this).addClass('selected_drag_word');
        $('.quiz_show .drag_words_list').show();
    });

    $('.quiz_show .drag_words_close_container span').click(function () {
        $('.quiz_show .drag_words_list').hide();
        $('.quiz_show .selected_drag_word').removeClass('selected_drag_word');
    });

    $('.quiz_show .drag_words_list_content').click(function () {

        for (let i = 0; i < $('.quiz_show .blank').length; i++) {
            if ($('.quiz_show .blank').eq(i).html() == $(this).html()) {
                $('.quiz_show .blank').eq(i).html('');
                $('.quiz_show .blank').eq(i).css('padding', '0px 64px 0px 0px');
            }
        }

        $('.quiz_show .selected_drag_word').html($(this).html());
        $('.quiz_show .selected_drag_word').css('padding', '5px 10px');
        $('.quiz_show .selected_drag_word').removeClass('selected_drag_word');

        $('.quiz_show .drag_words_list').hide();
    });
}

function string_replaceAll(str, str1, str2) {
    return str.split(str1).join(str2);
}

function eachWordUpperCase(str) {
    var splitStr = str.toLowerCase().split(' ');
    for (var i = 0; i < splitStr.length; i++) {
        splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);
    }

    return splitStr.join(' ');
}