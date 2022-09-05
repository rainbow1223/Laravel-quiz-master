$('.middle_form_bar').click(function () {
    $(this).next().toggle();
});

var label_prev_content = '';

$('body').on('click', '.form_view_element [data-editable]', function () {

    console.log("clicked");

    const $el = $(this);

    label_prev_content = $el.html();

    let $input = $('<div contenteditable="true" class="form_view_textbox_editable" style="border: 1px solid black;width: 100%;overflow-y: scroll;">' + $el.html() + '</div>');
    if ($input.html().indexOf('Type') != -1 && $input.html().indexOf('content') != -1 && $input.html().indexOf('...') != -1) {
        $input = $('<div contenteditable="true" class="form_view_textbox_editable" style="border: 1px solid black;width: 100%;overflow-y: scroll;"></div>');
    }
    // const $input = $('<input style="margin: 0 40px 0 5px;"/>').val($el.text());
    $el.replaceWith($input);

    $('div[contenteditable=true]').keydown(function (e) {
        console.log(e.keyCode);
        if ($(this).closest('.question_score').length > 0) {
            if (!((e.keyCode > 47 && e.keyCode < 58) || (e.keyCode > 95 && e.keyCode < 106) || e.keyCode == 8 || e.keyCode == 46)) e.preventDefault();
            set_flag_true();
        } else if ($(this).closest('.fill_blanks_dropdown_menu').length > 0 || $(this).closest('.select_lists_dropdown_menu').length > 0) {
            if (e.keyCode == 13) e.preventDefault();
        } else {
            set_flag_true();
        }
    });

    const save = function () {
        let $label = $('<label data-editable />').html($input.html());

        if ($input.html() == '') {
            if ($input.closest('.question_score').length > 0) {
                $label = $('<label data-editable />').html('0');
            } else {
                $label = $('<label data-editable />').html(label_prev_content);
            }
        }

        if ($input.closest('#select_lists').length > 0) {
            $input.prev().val($input.html());
        }
        $input.replaceWith($label);
    };

    $input.one('blur', save).focus();

});

$(function () {
    var fromIndex, toIndex;
    var groupId;
    var parentNode;

    $('.listview li ul').sortable({
        cancel: '.instruction_node',

        start: function (event, ui) {
            $(this).attr('data-previndex', ui.item.index());
        },

        stop: function (event, ui) {
            toIndex = ui.item.index();
            fromIndex = $(this).attr('data-previndex');
            parentNode = $(this).closest('.node-group');
            groupId = parentNode.attr('id');

            if (toIndex == fromIndex) return;

            var element_id = ui.item.attr('id');
            console.log('id of Item moved = ' + element_id + ' old position = ' + fromIndex + ' new position = ' + toIndex);
            $(this).removeAttr('data-previndex');

            const root_url = $('meta[name=url]').attr('content');
            const token = $('meta[name=csrf-token]').attr('content');

            const exam_id = $('#exam_id').val();

            $.ajax({
                url: root_url + '/update_quiz_index',
                type: 'POST',
                data: {
                    _token: token,
                    fromIndex: fromIndex,
                    toIndex: toIndex,
                    exam_id: exam_id,
                    exam_group_id: groupId,
                },
                success: function (data) {

                    const element = $('#preview_item-' + element_id)[0].outerHTML;
                    $('#preview_item-' + element_id).remove();

                    const to_element_id = parentNode.find('li.node').eq(toIndex + 1).attr('id');

                    // if (toIndex < fromIndex) {
                    $(element).insertBefore($('#preview_item-' + to_element_id));
                    // } else {
                    //     $(element).insertAfter($('.preview_item').eq(toIndex - 1));
                    // }

                    if (fromIndex > toIndex) {
                        for (let i = 0; i < parentNode.find('li.node').length; i++) {
                            if (parseInt(parentNode.find('li.node').eq(i).attr('order')) >= toIndex && parseInt(parentNode.find('li.node').eq(i).attr('order')) < fromIndex) {
                                parentNode.find('li.node').eq(i).attr('order', parseInt(parentNode.find('li.node').eq(i).attr('order')) + 1);
                            }
                        }
                    }

                    if (fromIndex < toIndex) {
                        for (let i = 0; i < parentNode.find('li.node').length; i++) {
                            if (parseInt(parentNode.find('li.node').eq(i).attr('order')) <= toIndex && parseInt(parentNode.find('li.node').eq(i).attr('order')) > fromIndex) {
                                parentNode.find('li.node').eq(i).attr('order', parseInt(parentNode.find('li.node').eq(i).attr('order')) - 1);
                            }
                        }
                    }
                    ui.item.attr('order', toIndex);
                    show_modal('success', 'Success', 'Question Index updated successfully');
                }
            }).catch((XHttpResponse) => {
                console.log(XHttpResponse);
            });
        },
    });

    function get_order(ui) {
        console.log(ui.attr('order'));
        return ui.attr('order');
    }

});

function show_preload() {
    $('.se-pre-con').show();
    $('.se-pre-con').addClass('se-pre-con-show');
}

function hide_preload() {
    $('.se-pre-con').hide();
    $('.se-pre-con').removeClass('se-pre-con-show');
}

$('body').on('click', 'div[contenteditable=true]', function () {
    $('div[contenteditable=true]').keydown(function (e) {
        set_flag_true();
    });
});

function set_flag_true() {
    localStorage.setItem('is_edited', 'true');
    localStorage.setItem('is_edited_for_timer', 'true');
}
