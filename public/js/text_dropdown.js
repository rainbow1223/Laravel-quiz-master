$(function () {

    show_cursor();

    $('.textarea_dropdown').click(function () {
        if ($(this).html() === '') {
            $(this).html('<span class="select_cursor first_span" style="padding-left: 1px;"></span>');
        }
    });

    $('.textarea_dropdown').keypress(function () {
        const keyCode = event.keyCode;
        switch (keyCode) {
            case 32:
                break;
            case 13:
                $('.select_cursor').after('<br><span class="line_first_span" style="padding-left: 1px;" onclick="{cursor(this);}"></span>');
                cursor($('.select_cursor').next().next());
                break;

            default:
                $('.select_cursor').after('<span onclick="{cursor(this);}">' + String.fromCharCode(keyCode) + '</span>');
                cursor($('.select_cursor').next());
        }
    });

    $('.textarea_dropdown').keydown(function () {
        const keyCode = event.keyCode;
        switch (keyCode) {
            case 32:
                $('.select_cursor').after('<span style="padding-left: 3px;" onclick="{cursor(this);}"></span>');
                cursor($('.select_cursor').next());
                break;
            case 8:
                if ($('.select_cursor').hasClass('line_first_span')) {
                    cursor($('.select_cursor').prev().prev());
                    $('.select_cursor').next().remove();
                    $('.select_cursor').next().remove();
                } else if (!$('.select_cursor').hasClass('first_span')) {
                    cursor($('.select_cursor').prev());
                    $('.select_cursor').next().remove();
                }
                break;
            case 46:
                if ($('.select_cursor').next().next().hasClass('line_first_span')) {
                    $('.select_cursor').next().remove();
                    $('.select_cursor').next().remove();
                } else if (!$('.select_cursor').next().hasClass('first_span')) $('.select_cursor').next().remove();
                break;
            case 37:
                if ($('.select_cursor').prev().length > 0) {
                    if ($('.select_cursor').hasClass('line_first_span')) cursor($('.select_cursor').prev().prev());
                    else cursor($('.select_cursor').prev());
                }
                break;
            case 39:
                if ($('.select_cursor').next().length > 0) {
                    if ($('.select_cursor').next().next().hasClass('line_first_span')) {
                        cursor($('.select_cursor').next().next());
                    } else cursor($('.select_cursor').next());
                }
                break;
        }
    });
});

function insert_dropdown(type_id) {
    const id = get_dropdown_id();
    $('#textarea_dropdown').focus();
    switch (type_id) {
        case 8:
            $('.select_cursor').after('<span><div class="dropdown" id="' + id + '"><div onclick="dropdown(this)" class="dropbtn">Add a new word</div><div class="dropdown-content"><a href="javascript:void(0)" onclick="{add_new_word_blank(this);}">Add a new word</a></div></div></span>');
            break;
        default:
            $('.select_cursor').after('<span><div class="dropdown" id="' + id + '"><div onclick="dropdown(this)" class="dropbtn">Add a new word</div><div class="dropdown-content"><a href="javascript:void(0)" onclick="{add_new_word_list(this);}">Add a new word</a></div></div></span>');
    }
    cursor($('.select_cursor').next());
    $('#textarea_dropdown').focus();
}

function cursor(element) {
    $('.textarea_dropdown .select_cursor').removeClass('cursor');
    $('.textarea_dropdown .select_cursor').removeClass('select_cursor');
    $(element).addClass('select_cursor');
}

function show_cursor() {
    setInterval(function () {
        if ($('.textarea_dropdown .select_cursor').length > 0) {
            $('.textarea_dropdown .select_cursor').toggleClass('cursor');
        }
    }, 500);
}

function dropdown(element) {
    if ($(element).next().hasClass('show')) {
        cursor($(element).parent().parent());
        const text = $(element).parent().find('a').eq(0).find('label').text();
        $(element).text(text == '' ? 'Add a new word' : text);
    } else {
        const textarea_dropdown = $('.textarea_dropdown .select_cursor');
        textarea_dropdown.removeClass('cursor');
        textarea_dropdown.removeClass('select_cursor');
    }
    $(element).next().toggleClass('show');
}

function get_radio_id(element) {
    const length = $(element).parent().find('input').length;

    let id = 1;

    if (length > 0) {
        id = 0;
        for (let i = 0; i < length; i++) {
            const input_value = parseInt($(element).parent().find('input').eq(i).val());
            if (input_value > id) {
                id = input_value + 1;
            }
        }
    }

    return id;
}

function get_dropdown_id() {
    const length = $('.dropdown').length;

    let id = 1;

    if (length > 0) {
        id = 0;
        for (let i = 0; i < length; i++) {
            const dropdown_id = parseInt($('.dropdown').eq(i).attr('id'));
            if (dropdown_id > id) {
                id = dropdown_id + 1;
            }
        }
    }

    return id;
}

function add_new_word_blank(element) {
    $(element).parent().prepend('<a href="javascript:void(0)"><label class="matching_label" data-editable>Type matching content...</label><span onclick="{$(this).parent().remove();}"><i class="fas fa-trash-alt"></i></span></a>');
}

function add_new_word_list(element) {
    const id = get_radio_id(element);
    $(element).parent().prepend('<a href="javascript:void(0)"><input type="radio" name="answer" value="' + id + '" style="padding-right: 10px;"><label class="matching_label" data-editable>Type matching content...</label><span onclick="{$(this).parent().remove();}"><i class="fas fa-trash-alt"></i></span></a>');
}
