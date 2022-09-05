var remove_link = false;
var clipboard_str = '';


// $('#target_element').val();

// template function
$('#xxxxx').click(function () {
});
$('#xxxxx').mousedown(function (e) {
    e.preventDefault();
});

//=========================================
//
//          Copy Cut Paste
//
//=========================================

// Copy btn click function
$('.copy_btn').click(function () {
    clipboard_str = get_selected_str();
    set_flag_true();
});

$('.copy_btn').mousedown(function (e) {
    e.preventDefault();
});


// cut function
$('.cut_btn').click(function () {
    clipboard_str = get_selected_str();
    delete_selected_str();

    set_flag_true();
});

$('.cut_btn').mousedown(function (e) {
    e.preventDefault();
});


// Paste btn click function
$('.paste_btn').click(function () {
    paste_str(clipboard_str);
    set_flag_true();
    // window.getSelection().removeAllRanges();
    // sel.focusOffset
    // setCurrentCursorPosition(get_cursor_pos_supposed_to_be(clipboard_str));
});

$('.paste_btn').mousedown(function (e) {
    e.preventDefault();
});

//  https://raw.githubusercontent.com/Sophie627/flutter-Enriched-Digital-Writer-re-build/master/lib/widget/texteditor/divelement.dart

function get_selected_str() {
    var sel = window.getSelection();
    if (sel.rangeCount) {
        return (sel.toString());
    }
    return ('');
}

function delete_selected_str() {
    var sel = window.getSelection();
    if (sel.rangeCount) {
        var range = sel.getRangeAt(0);
        range.deleteContents();
    }
}

function paste_str(str) {
    var sel = window.getSelection();

    if (sel.rangeCount) {
        var e = document.createElement('span');
        // e.style = 'font-family:' + font.value + ';';
        e.innerHTML = str;
        var range = sel.getRangeAt(0);
        range.deleteContents();
        range.insertNode(e);
    }
}

function createRange(node, chars, range) {
    if (!range) {
        range = document.createRange()
        range.selectNode(node);
        range.setStart(node, 0);
    }

    if (chars.count === 0) {
        range.setEnd(node, chars.count);
    } else if (node && chars.count > 0) {
        if (node.nodeType === Node.TEXT_NODE) {
            if (node.textContent.length < chars.count) {
                chars.count -= node.textContent.length;
            } else {
                range.setEnd(node, chars.count);
                chars.count = 0;
            }
        } else {
            for (var lp = 0; lp < node.childNodes.length; lp++) {
                range = createRange(node.childNodes[lp], chars, range);

                if (chars.count === 0) {
                    break;
                }
            }
        }
    }
    return range;
};

function setCurrentCursorPosition(chars) {
    if (chars >= 0) {
        var selection = window.getSelection();

        range = createRange(document.getElementsByClassName("slide_view_question_element")[0], {
            count: chars
        });

        if (range) {
            range.collapse(false);
            selection.removeAllRanges();
            selection.addRange(range);
        }
    }
};

function get_cursor_pos_supposed_to_be(str) {
    var el = document.getElementsByClassName('slide_view_question_element')[0].innerText;
    return (el.lastIndexOf(str) + str.length);
}

//=========================================
//
//          Font Family Settings
//
//  **********************************
//  range.startContainer.style.fontSize ...
//  range.endContainer => text then use default val
//  **********************************
//=========================================

// Font Family Select
$('#slide_view_font_family_selector').change(function () {
    // changeFont($(this).val());
    var element = $('#quiz_view .selected_slide_view_group'); // get selected element
    if (element.hasClass('slide_view_answer_element')) {
        element.css('font-family', $(this).val());
        if (element.find('label').length > 0) element.find('label').css('font-family', $(this).val());
        if (element.find('.ui-widget-header').length > 0) element.find('.ui-widget-header').css('font-family', $(this).val());
        if (element.find('.ui-widget-content').length > 0) element.find('.ui-widget-content').css('font-family', $(this).val());
        if (element.find('#slide_drag_words_answer').length > 0) element.find('#slide_drag_words_answer').find('span').css('font-family', $(this).val());
        if (element.find('.select_lists_dropdown_body').length > 0) element.find('.select_lists_dropdown_body').find('select').css('font-family', $(this).val());

    } else {
        document.execCommand('styleWithCSS', false, true);
        document.execCommand('fontName', false, $(this).val());
    }

    set_flag_true();
});

var fontSize = 16;
var changing_font_size_for_answer_element = parseInt($('#font_size_selector').val());

// Font size select
$('#font_size_selector').change(function () {
    var element = $('#quiz_view .selected_slide_view_group'); // get selected element
    if (element.hasClass('slide_view_answer_element')) {
        element.css('font-size', $(this).val() + 'px');
        if (element.find('label').length > 0) element.find('label').css('font-size', $(this).val() + 'px');
        if (element.find('input[type=checkbox]').length > 0) element.find('input[type=checkbox]').not('.slide_view_group_checkbox').css('width', parseFloat($(this).val()) / 2 + 'px');
        if (element.find('input[type=checkbox]').length > 0) element.find('input[type=checkbox]').not('.slide_view_group_checkbox').css('height', parseFloat($(this).val()) / 2 + 'px');
        if (element.find('input[type=radio]').length > 0) element.find('input[type=radio]').css('width', parseFloat($(this).val()) / 2 + 'px');
        if (element.find('input[type=radio]').length > 0) element.find('input[type=radio]').css('height', parseFloat($(this).val()) / 2 + 'px');
        if (element.find('.ui-widget-header').length > 0) element.find('.ui-widget-header').css('font-size', $(this).val() + 'px');
        if (element.find('.ui-widget-content').length > 0) element.find('.ui-widget-content').css('font-size', $(this).val() + 'px');
        if (element.find('#slide_drag_words_answer').length > 0) element.find('#slide_drag_words_answer').find('span').css('font-size', $(this).val() + 'px');
        if (element.find('.select_lists_dropdown_body').length > 0) element.find('.select_lists_dropdown_body').find('select').css('font-size', $(this).val() + 'px');

        changing_font_size_for_answer_element = parseInt($('#font_size_selector').val());
    } else {
        console.log('am here!!!');
        fontSize = parseInt($('#font_size_selector').val());
        document.execCommand("fontSize", false, "1");
        resetFont();
    }

    set_flag_true();
});

function resetFont() {
    if ($("font[size=1]").length > 0) {
        $("font[size=1]").removeAttr("size").css("font-size", fontSize + "px");
        return;
    }
    var deepest_editable_div = $('#quiz_view .selected_slide_view_group .cancel_drag').eq(0);
    // var length = deepest_editable_div.length;
    // for (let i = 0; i < length; i++) {
    //     var font_size_changed_html = deepest_editable_div.eq(i).html().split('x-small').join(fontSize + 'px');
    //     deepest_editable_div.eq(i).html(font_size_changed_html);
    // }
        var font_size_changed_html = deepest_editable_div.html().split('x-small').join(fontSize + 'px');
        deepest_editable_div.html(font_size_changed_html);

    set_flag_true();
}

// Font size increase
$('#font_size_bigger_btn').click(function () {
    var element = $('#quiz_view .selected_slide_view_group'); // get selected element
    if (element.hasClass('slide_view_answer_element')) {
        if (changing_font_size_for_answer_element < 100) changing_font_size_for_answer_element += 2;
        element.css('font-size', changing_font_size_for_answer_element);
        if (element.find('label').length > 0) element.find('label').css('font-size', changing_font_size_for_answer_element);
        if (element.find('.ui-widget-header').length > 0) element.find('.ui-widget-header').css('font-size', changing_font_size_for_answer_element);
        if (element.find('.ui-widget-content').length > 0) element.find('.ui-widget-content').css('font-size', changing_font_size_for_answer_element);
        if (element.find('#slide_drag_words_answer').length > 0) element.find('#slide_drag_words_answer').find('span').css('font-size', changing_font_size_for_answer_element);
        if (element.find('.select_lists_dropdown_body').length > 0) element.find('.select_lists_dropdown_body').find('select').css('font-size', changing_font_size_for_answer_element);
        if (element.find('input[type=checkbox]').length > 0) element.find('input[type=checkbox]').not('.slide_view_group_checkbox').css('width', changing_font_size_for_answer_element / 2 + 'px');
        if (element.find('input[type=checkbox]').length > 0) element.find('input[type=checkbox]').not('.slide_view_group_checkbox').css('height', changing_font_size_for_answer_element / 2 + 'px');
        if (element.find('input[type=radio]').length > 0) element.find('input[type=radio]').css('width', changing_font_size_for_answer_element / 2 + 'px');
        if (element.find('input[type=radio]').length > 0) element.find('input[type=radio]').css('height', changing_font_size_for_answer_element / 2 + 'px');
        $('#font_size_selector').val(changing_font_size_for_answer_element);
    } else {
        if (fontSize < 100) fontSize += 2;
        document.execCommand("fontSize", false, "1");
        console.log(fontSize);
        $('#font_size_selector').val(fontSize);
        resetFont();
    }

    set_flag_true();
});

// Font size decrease
$('#font_size_smaller_btn').click(function () {
    var element = $('#quiz_view .selected_slide_view_group'); // get selected element
    if (element.hasClass('slide_view_answer_element')) {
        if (changing_font_size_for_answer_element > 6) changing_font_size_for_answer_element -= 2;
        element.css('font-size', changing_font_size_for_answer_element);
        if (element.find('label').length > 0) element.find('label').css('font-size', changing_font_size_for_answer_element);
        if (element.find('.ui-widget-header').length > 0) element.find('.ui-widget-header').css('font-size', changing_font_size_for_answer_element);
        if (element.find('.ui-widget-content').length > 0) element.find('.ui-widget-content').css('font-size', changing_font_size_for_answer_element);
        if (element.find('#slide_drag_words_answer').length > 0) element.find('#slide_drag_words_answer').find('span').css('font-size', changing_font_size_for_answer_element);
        if (element.find('.select_lists_dropdown_body').length > 0) element.find('.select_lists_dropdown_body').find('select').css('font-size', changing_font_size_for_answer_element);
        if (element.find('input[type=checkbox]').length > 0) element.find('input[type=checkbox]').not('.slide_view_group_checkbox').css('width', changing_font_size_for_answer_element / 2 + 'px');
        if (element.find('input[type=checkbox]').length > 0) element.find('input[type=checkbox]').not('.slide_view_group_checkbox').css('height', changing_font_size_for_answer_element / 2 + 'px');
        if (element.find('input[type=radio]').length > 0) element.find('input[type=radio]').css('width', changing_font_size_for_answer_element / 2 + 'px');
        if (element.find('input[type=radio]').length > 0) element.find('input[type=radio]').css('height', changing_font_size_for_answer_element / 2 + 'px');
        $('#font_size_selector').val(changing_font_size_for_answer_element);
    } else {
        if (fontSize > 6) fontSize -= 2;
        document.execCommand("fontSize", false, "1");
        $('#font_size_selector').val(fontSize);
        resetFont();
    }

    set_flag_true();
});

// Font style clear
$('#font_style_clear_btn').click(function () {

    $('#slide_view_font_family_selector').val('Arial');
    $('#font_size_selector').val('16');
    fontSize = 16;
    changing_font_size_for_answer_element = 16;

    var element = $('#quiz_view .selected_slide_view_group'); // get selected element
    if (element.hasClass('slide_view_answer_element')) {
        element.css('font-size', '16px');
        element.css('font-style', 'normal');
        element.css('font-weight', 'normal');
        element.css('font-family', 'Arial');
        element.css('color', 'black');
        element.css('text-decoration', 'none');

        if (element.find('label').length > 0) {
            element.find('label').css('font-size', '16px');
            element.find('label').css('font-style', 'normal');
            element.find('label').css('font-weight', 'normal');
            element.find('label').css('font-family', 'Arial');
            element.find('label').css('color', 'black');
            element.find('label').css('text-decoration', 'none');
        }

        if (element.find('.ui-widget-header').length > 0) {
            element.find('.ui-widget-header').css('font-size', '16px');
            element.find('.ui-widget-header').css('font-style', 'normal');
            element.find('.ui-widget-header').css('font-weight', 'normal');
            element.find('.ui-widget-header').css('font-family', 'Arial');
            element.find('.ui-widget-header').css('color', 'black');
            element.find('.ui-widget-header').css('text-decoration', 'none');
        }

        if (element.find('.ui-widget-content').length > 0) {
            element.find('.ui-widget-content').css('font-size', '16px');
            element.find('.ui-widget-content').css('font-style', 'normal');
            element.find('.ui-widget-content').css('font-weight', 'normal');
            element.find('.ui-widget-content').css('font-family', 'Arial');
            element.find('.ui-widget-content').css('color', 'black');
            element.find('.ui-widget-content').css('text-decoration', 'none');
        }

        if (element.find('#slide_drag_words_answer').length > 0) {
            element.find('#slide_drag_words_answer').find('span').css('font-size', '16px');
            element.find('#slide_drag_words_answer').find('span').css('font-style', 'normal');
            element.find('#slide_drag_words_answer').find('span').css('font-weight', 'normal');
            element.find('#slide_drag_words_answer').find('span').css('font-family', 'Arial');
            element.find('#slide_drag_words_answer').find('span').css('color', 'black');
            element.find('#slide_drag_words_answer').find('span').css('text-decoration', 'none');
        }

        if (element.find('.select_lists_dropdown_body').length > 0) {
            element.find('.select_lists_dropdown_body').find('select').css('font-size', '16px');
            element.find('.select_lists_dropdown_body').find('select').css('font-style', 'normal');
            element.find('.select_lists_dropdown_body').find('select').css('font-weight', 'normal');
            element.find('.select_lists_dropdown_body').find('select').css('font-family', 'Arial');
            element.find('.select_lists_dropdown_body').find('select').css('color', 'black');
            element.find('.select_lists_dropdown_body').find('select').css('text-decoration', 'none');
        }

        if (element.find('input[type=checkbox]').length > 0) element.find('input[type=checkbox]').not('.slide_view_group_checkbox').css('width', '8px');
        if (element.find('input[type=checkbox]').length > 0) element.find('input[type=checkbox]').not('.slide_view_group_checkbox').css('height', '8px');
        if (element.find('input[type=radio]').length > 0) element.find('input[type=radio]').css('width', '8px');
        if (element.find('input[type=radio]').length > 0) element.find('input[type=radio]').css('height', '8px');
    } else {
        clear_formatting();
    }

    set_flag_true();
});

var formatting_bold = false;

// Font bold toggle
$('.font_bold_btn').click(function () {
    // toggle_bold(formatting_bold);

    var element = $('#quiz_view .selected_slide_view_group'); // get selected element
    if (element.hasClass('slide_view_answer_element')) {
        formatting_bold = !formatting_bold;
        if (formatting_bold) {
            element.css('font-weight', 'bold');
            if (element.find('label').length > 0) element.find('label').css('font-weight', 'bold');
            if (element.find('.ui-widget-header').length > 0) element.find('.ui-widget-header').css('font-weight', 'bold');
            if (element.find('.ui-widget-content').length > 0) element.find('.ui-widget-content').css('font-weight', 'bold');
            if (element.find('#slide_drag_words_answer').length > 0) element.find('#slide_drag_words_answer').find('span').css('font-weight', 'bold');
            if (element.find('.select_lists_dropdown_body').length > 0) element.find('.select_lists_dropdown_body').find('select').css('font-weight', 'bold');
        } else {
            element.css('font-weight', 'normal');
            if (element.find('label').length > 0) element.find('label').css('font-weight', 'normal');
            if (element.find('.ui-widget-header').length > 0) element.find('.ui-widget-header').css('font-weight', 'normal');
            if (element.find('.ui-widget-content').length > 0) element.find('.ui-widget-content').css('font-weight', 'normal');
            if (element.find('#slide_drag_words_answer').length > 0) element.find('#slide_drag_words_answer').find('span').css('font-weight', 'normal');
            if (element.find('.select_lists_dropdown_body').length > 0) element.find('.select_lists_dropdown_body').find('select').css('font-weight', 'normal');
        }
    } else {
        document.execCommand('styleWithCSS', false, true);
        document.execCommand('bold');
    }

    set_flag_true();
});

var formatting_strike = false;

// Font strikethrough toggle
$('#slide_view_font_strike_btn').click(function () {
    var element = $('#quiz_view .selected_slide_view_group'); // get selected element
    if (element.hasClass('slide_view_answer_element')) {
        formatting_strike = !formatting_strike;
        if (formatting_strike) {
            element.css('text-decoration', 'line-through');
            if (element.find('label').length > 0) element.find('label').css('text-decoration', 'line-through');
            if (element.find('.ui-widget-header').length > 0) element.find('.ui-widget-header').css('text-decoration', 'line-through');
            if (element.find('.ui-widget-content').length > 0) element.find('.ui-widget-content').css('text-decoration', 'line-through');
            if (element.find('#slide_drag_words_answer').length > 0) element.find('#slide_drag_words_answer').find('span').css('text-decoration', 'line-through');
            if (element.find('.select_lists_dropdown_body').length > 0) element.find('.select_lists_dropdown_body').find('select').css('text-decoration', 'line-through');
        } else {
            element.css('text-decoration', 'none');
            if (element.find('label').length > 0) element.find('label').css('text-decoration', 'none');
            if (element.find('.ui-widget-header').length > 0) element.find('.ui-widget-header').css('text-decoration', 'none');
            if (element.find('.ui-widget-content').length > 0) element.find('.ui-widget-content').css('text-decoration', 'none');
            if (element.find('#slide_drag_words_answer').length > 0) element.find('#slide_drag_words_answer').find('span').css('text-decoration', 'none');
            if (element.find('.select_lists_dropdown_body').length > 0) element.find('.select_lists_dropdown_body').find('select').css('text-decoration', 'none');
        }
    } else {
        document.execCommand('styleWithCSS', false, true);
        document.execCommand('strikeThrough');
    }

    set_flag_true();
});

var formatting_ital = false;

// Font italic toggle
$('.font_ital_btn').click(function () {
    var element = $('#quiz_view .selected_slide_view_group'); // get selected element
    if (element.hasClass('slide_view_answer_element')) {
        formatting_ital = !formatting_ital;
        if (formatting_ital) {
            element.css('font-style', 'italic');
            if (element.find('label').length > 0) element.find('label').css('font-style', 'italic');
            if (element.find('.ui-widget-header').length > 0) element.find('.ui-widget-header').css('font-style', 'italic');
            if (element.find('.ui-widget-content').length > 0) element.find('.ui-widget-content').css('font-style', 'italic');
            if (element.find('#slide_drag_words_answer').length > 0) element.find('#slide_drag_words_answer').find('span').css('font-style', 'italic');
            if (element.find('.select_lists_dropdown_body').length > 0) element.find('.select_lists_dropdown_body').find('select').css('font-style', 'italic');

        } else {
            element.css('font-style', 'normal');
            if (element.find('label').length > 0) element.find('label').css('font-style', 'normal');
            if (element.find('.ui-widget-header').length > 0) element.find('.ui-widget-header').css('font-style', 'normal');
            if (element.find('.ui-widget-content').length > 0) element.find('.ui-widget-content').css('font-style', 'normal');
            if (element.find('#slide_drag_words_answer').length > 0) element.find('#slide_drag_words_answer').find('span').css('font-style', 'normal');
            if (element.find('.select_lists_dropdown_body').length > 0) element.find('.select_lists_dropdown_body').find('select').css('font-style', 'normal');
        }
    } else {
        document.execCommand('styleWithCSS', false, true);
        document.execCommand('italic');
    }

    set_flag_true();
});

var formatting_underline = false;
// Font underline toggle
$('.font_underline_btn').click(function () {
    var element = $('#quiz_view .selected_slide_view_group'); // get selected element
    if (element.hasClass('slide_view_answer_element')) {
        formatting_underline = !formatting_underline;
        if (formatting_underline) {
            element.css('text-decoration', 'underline');
            if (element.find('label').length > 0) element.find('label').css('text-decoration', 'underline');
            if (element.find('.ui-widget-header').length > 0) element.find('.ui-widget-header').css('text-decoration', 'underline');
            if (element.find('.ui-widget-content').length > 0) element.find('.ui-widget-content').css('text-decoration', 'underline');
            if (element.find('#slide_drag_words_answer').length > 0) element.find('#slide_drag_words_answer').find('span').css('text-decoration', 'underline');
            if (element.find('.select_lists_dropdown_body').length > 0) element.find('.select_lists_dropdown_body').find('select').css('text-decoration', 'underline');
        } else {
            element.css('text-decoration', 'none');
            if (element.find('label').length > 0) element.find('label').css('text-decoration', 'none');
            if (element.find('.ui-widget-header').length > 0) element.find('.ui-widget-header').css('text-decoration', 'none');
            if (element.find('.ui-widget-content').length > 0) element.find('.ui-widget-content').css('text-decoration', 'none');
            if (element.find('#slide_drag_words_answer').length > 0) element.find('#slide_drag_words_answer').find('span').css('text-decoration', 'none');
            if (element.find('.select_lists_dropdown_body').length > 0) element.find('.select_lists_dropdown_body').find('select').css('text-decoration', 'none');
        }
    } else {
        document.execCommand('styleWithCSS', false, true);
        document.execCommand('underline');
    }

    set_flag_true();
});

var formatting_subscript = false;

$('.font_subscription_btn').click(function () {

    formatting_subscript = !formatting_subscript;
    // toggle_subscript(formatting_subscript);
    document.execCommand('styleWithCSS', false, true);
    document.execCommand('subscript');

    set_flag_true();
});

var formatting_superscript = false;

$('.font_superscription_btn').click(function () {


    formatting_superscript = !formatting_superscript;
    // toggle_superscript(formatting_superscript);
    document.execCommand('styleWithCSS', false, true);
    document.execCommand('superscript');

    set_flag_true();
});

$('#font_picker_trigger').click(function () {
    // $('#font_color_picker').trigger('click');
});

$('#font_picker_trigger').mousedown(function (e) {
    e.preventDefault();
});

$('#office_color_picker').mousedown(function (e) {
    e.preventDefault();
});

// Font color select
$("#office_color_picker").on("change.color", function (event, color) {
    var element = $('#quiz_view .selected_slide_view_group'); // get selected element
    if (element.hasClass('slide_view_answer_element')) {
        element.css('color', color);
        if (element.find('label').length > 0) element.find('label').css('color', color);
        if (element.find('.ui-widget-header').length > 0) element.find('.ui-widget-header').css('color', color);
        if (element.find('.ui-widget-content').length > 0) element.find('.ui-widget-content').css('color', color);
        if (element.find('#slide_drag_words_answer').length > 0) element.find('#slide_drag_words_answer').find('span').css('color', color);
        if (element.find('.select_lists_dropdown_body').length > 0) element.find('.select_lists_dropdown_body').find('select').css('color', color);

    } else {
        document.execCommand('styleWithCSS', false, true);
        document.execCommand('foreColor', false, color);
    }

    set_flag_true();
    // event.preventDefault();
    // change_font_color(color);
});

function change_font_color(color) {
    var sel = window.getSelection();
    if (sel.rangeCount) {
        var e = document.createElement('span');
        e.style = 'color: ' + color + ';';
        e.innerHTML = sel.toString();
        // https://developer.mozilla.org/en-US/docs/Web/API/Selection/getRangeAt
        var range = sel.getRangeAt(0);
        range.deleteContents();
        range.insertNode(e);
    }
}

function toggle_superscript(formatting_superscript) {
    var sel = window.getSelection();
    if (sel.rangeCount) {
        var e = document.createElement('span');
        if (formatting_superscript) e.style = 'vertical-align: super;';
        else e.style = 'vertical-align: unset;';
        e.innerHTML = sel.toString();
        // https://developer.mozilla.org/en-US/docs/Web/API/Selection/getRangeAt
        var range = sel.getRangeAt(0);
        range.deleteContents();
        range.insertNode(e);
    }
}

function toggle_subscript(formatting_subscript) {
    var sel = window.getSelection();
    if (sel.rangeCount) {
        var e = document.createElement('span');
        if (formatting_subscript) e.style = 'vertical-align: sub;';
        else e.style = 'vertical-align: unset;';
        e.innerHTML = sel.toString();
        // https://developer.mozilla.org/en-US/docs/Web/API/Selection/getRangeAt
        var range = sel.getRangeAt(0);
        range.deleteContents();
        range.insertNode(e);
    }
}

function toggle_strike(formatting_strike) {
    var sel = window.getSelection();
    if (sel.rangeCount) {
        var e = document.createElement('span');
        if (formatting_strike) e.style = 'text-decoration: line-through;';
        else e.style = 'text-decoration: none;';
        e.innerHTML = sel.toString();
        // https://developer.mozilla.org/en-US/docs/Web/API/Selection/getRangeAt
        var range = sel.getRangeAt(0);
        range.deleteContents();
        range.insertNode(e);
    }
}

function toggle_underline(formatting_underline) {
    var sel = window.getSelection();
    if (sel.rangeCount) {
        var e = document.createElement('span');
        if (formatting_underline) e.style = 'text-decoration: underline;';
        else e.style = 'text-decoration: none;';
        e.innerHTML = sel.toString();
        // https://developer.mozilla.org/en-US/docs/Web/API/Selection/getRangeAt
        var range = sel.getRangeAt(0);
        range.deleteContents();
        range.insertNode(e);
    }
}

function toggle_ital(formatting_ital) {
    var sel = window.getSelection();
    if (sel.rangeCount) {
        var e = document.createElement('span');
        if (formatting_ital) e.style = 'font-style: italic;';
        else e.style = 'font-style: normal;';
        e.innerHTML = sel.toString();
        // https://developer.mozilla.org/en-US/docs/Web/API/Selection/getRangeAt
        var range = sel.getRangeAt(0);
        range.deleteContents();
        range.insertNode(e);
    }
}

function toggle_bold(formatting_bold) {
    var sel = window.getSelection();
    if (sel.rangeCount) {
        var e = document.createElement('span');
        if (formatting_bold) e.style = 'font-weight: bold;';
        else e.style = 'font-weight: 400;';
        e.innerHTML = sel.toString();
        // https://developer.mozilla.org/en-US/docs/Web/API/Selection/getRangeAt
        var range = sel.getRangeAt(0);
        range.deleteContents();
        range.insertNode(e);
    }
}

function changeFont(font_family) {
    var sel = window.getSelection();
    if (sel.rangeCount) {
        var e = document.createElement('span');
        e.style = 'font-family:' + font_family + ';';
        e.innerHTML = sel.toString();
        // https://developer.mozilla.org/en-US/docs/Web/API/Selection/getRangeAt
        var range = sel.getRangeAt(0);
        range.deleteContents();
        range.insertNode(e);
    }
}

function clear_formatting() {
    var sel = window.getSelection();
    if (sel.rangeCount) {
        var e = document.createElement('span');
        e.style = "font-family: 'arial'; font-size: 12px; color: black;";
        e.innerHTML = sel.toString();
        // https://developer.mozilla.org/en-US/docs/Web/API/Selection/getRangeAt
        var range = sel.getRangeAt(0);
        range.deleteContents();
        range.insertNode(e);
    }
}

function changeFont_size(font_size) {
    var sel = window.getSelection();
    if (sel.rangeCount) {
        var e = document.createElement('span');
        e.style = 'font-size:' + font_size + 'px;';
        e.innerHTML = sel.toString();
        // https://developer.mozilla.org/en-US/docs/Web/API/Selection/getRangeAt
        var range = sel.getRangeAt(0);
        range.deleteContents();
        range.insertNode(e);
    }
}


//==============================================
//
//          Paragraph styling
//
//==============================================

var para_numbering = false;

$('.numbering_btn').click(function () {
    // para_numbering = !para_numbering;
    // create_numbering(para_numbering);


    document.execCommand('insertOrderedList');
    set_flag_true();
});

function create_numbering(para_numbering) {
    el = document.getElementsByClassName('slide_view_question_element')[0];

    if (para_numbering) {
        $('.slide_view_question_element').eq(0).find('span.buuuuullet').remove();

        nodes = el.childNodes;
        for (i = 0; i < nodes.length; i++) {
            nodes[i].innerHTML = '<span class="nuuumbering">' + (i + 1) + '. ' + '</span>' + ' ' + nodes[i].innerText;
        }
    } else {
        // document.getElementsByClassName('nuuumbering').remove();
        $('.slide_view_question_element').eq(0).find('span.nuuumbering').remove();
    }
}

var para_bullet = false;

$('.bullet_btn').click(function () {
    // para_bullet = !para_bullet;
    // create_bullet(para_bullet);


    document.execCommand('insertUnorderedList', false);
    set_flag_true();
});

function create_bullet(para_bullet) {
    el = document.getElementsByClassName('slide_view_question_element')[0];

    if (para_bullet) {
        $('.slide_view_question_element').eq(0).find('span.nuuumbering').remove();
        nodes = el.childNodes;
        for (i = 0; i < nodes.length; i++) {
            nodes[i].innerHTML = '<span class="buuuuullet">&bull;</span>' + ' ' + nodes[i].innerText;
        }
    } else {
        // document.getElementsByClassName('buuuuullet').remove();
        $('.slide_view_question_element').eq(0).find('span.buuuuullet').remove();
    }
}

$('#paragraph_align_left').click(function () {
    var element = $('#quiz_view .selected_slide_view_group'); // get selected element
    element.css('text-align', 'left');
    if (element.find('.choice_item').length > 0) element.find('.choice_item').css('justify-content', 'flex-start');
    if (element.find('.response_item').length > 0) element.find('.response_item').css('justify-content', 'flex-start');

    set_flag_true();
});

$('#paragraph_align_center').click(function () {
    var element = $('#quiz_view .selected_slide_view_group'); // get selected element
    element.css('text-align', 'center');
    if (element.find('.choice_item').length > 0) element.find('.choice_item').css('justify-content', 'center');
    if (element.find('.response_item').length > 0) element.find('.response_item').css('justify-content', 'center');

    set_flag_true();
});

$('#paragraph_align_right').click(function () {
    var element = $('#quiz_view .selected_slide_view_group'); // get selected element
    element.css('text-align', 'right');
    if (element.find('.choice_item').length > 0) element.find('.choice_item').css('justify-content', 'flex-end');
    if (element.find('.response_item').length > 0) element.find('.response_item').css('justify-content', 'flex-end');

    set_flag_true();
});

$('#paragraph_align_justify').click(function () {
    var element = $('#quiz_view .selected_slide_view_group'); // get selected element
    element.css('text-align', 'justify');

    set_flag_true();
});

$('#paragraph_line_spacing_100').click(function () {
    var element = $('#quiz_view .selected_slide_view_group'); // get selected element
    element.css('line-height', '1');

    set_flag_true();
});

$('#paragraph_line_spacing_115').click(function () {
    var element = $('#quiz_view .selected_slide_view_group'); // get selected element
    element.css('line-height', '1.15');

    set_flag_true();
});

$('#paragraph_line_spacing_150').click(function () {
    var element = $('#quiz_view .selected_slide_view_group'); // get selected element
    element.css('line-height', '1.5');

    set_flag_true();
});

$('#paragraph_line_spacing_200').click(function () {
    var element = $('#quiz_view .selected_slide_view_group'); // get selected element
    element.css('line-height', '2');

    set_flag_true();
});

$('#paragraph_line_spacing_option').click(function () {
    // show modal
});

var paragraph_line_spacing_add_before = false;
$('#paragraph_line_spacing_add_before').click(function () {
    paragraph_line_spacing_add_before = !paragraph_line_spacing_add_before;
    if (!paragraph_line_spacing_add_before) $(this).find('a').eq(0).text('Add Space Before Paragraph');
    else $(this).find('a').eq(0).text('Remove Space Before Paragraph');
    add_line_spacing_before(paragraph_line_spacing_add_before);

    set_flag_true();
});

$('#paragraph_line_spacing_add_before').mousedown(function (e) {
    e.preventDefault();
});

var paragraph_line_spacing_add_after = false;
$('#paragraph_line_spacing_add_after').click(function () {
    paragraph_line_spacing_add_after = !paragraph_line_spacing_add_after;
    if (!paragraph_line_spacing_add_after) $(this).find('a').eq(0).text('Add Space After Paragraph');
    else $(this).find('a').eq(0).text('Remove Space After Paragraph');
    add_line_spacing_after(paragraph_line_spacing_add_after);

    set_flag_true();
});

$('#paragraph_line_spacing_add_after').mousedown(function (e) {
    e.preventDefault();
});

function add_line_spacing_after(paragraph_line_spacing_add_after) {
    // var sel = window.getSelection();
    // if (sel.rangeCount) {
    //     var e = document.createElement('span');
    //     e.innerHTML = sel.toString();
    //     // https://developer.mozilla.org/en-US/docs/Web/API/Selection/getRangeAt
    //     var range = sel.getRangeAt(0);
    //     range.deleteContents();
    //     range.insertNode(e);
    //     while (!(e.parentElement.classList.contains('slide_view_question_element'))) {
    //         e = e.parentElement
    //     }
    //     if (paragraph_line_spacing_add_after)
    //         e.style.marginBottom = '25px';
    //     else
    //         e.style.marginBottom = 'unset';
    // }
    var element = $('#quiz_view .selected_slide_view_group'); // get selected element
    if (element.hasClass('slide_view_question_element') || element.hasClass('other_slide_view_element')) {
        if (paragraph_line_spacing_add_after ) {
            element.find('.cancel_drag').children().css('padding-bottom', '10px');
            // var sel = window.getSelection();
            // console.log(sel.extentNode.parentNode);
            // sel.extentNode.parentNode.style.paddingBottom = '20px';
        } else {
            element.find('.cancel_drag').children().css('padding-bottom', '0px');
            // var sel = window.getSelection();
            // console.log(sel.extentNode.parentNode);
            // sel.extentNode.parentNode.style.paddingBottom = '0px';
        }
    }
}

function add_line_spacing_before(paragraph_line_spacing_add_before) {
    // var sel = window.getSelection();
    // if (sel.rangeCount) {
    //     console.log(sel.rangeCount);
    //     var e = document.createElement('span');
    //     e.innerHTML = sel.toString();
    //     // https://developer.mozilla.org/en-US/docs/Web/API/Selection/getRangeAt
    //     var range = sel.getRangeAt(0);
    //     range.deleteContents();
    //     range.insertNode(e);
    //     while (!(e.parentElement.classList.contains('slide_view_question_element'))) {
    //         e = e.parentElement
    //     }
    //     if (paragraph_line_spacing_add_before)
    //         e.style.marginTop = '25px';
    //     else
    //         e.style.marginTop = 'unset';
    // }


    var element = $('#quiz_view .selected_slide_view_group'); // get selected element
    if (element.hasClass('slide_view_question_element') || element.hasClass('other_slide_view_element')) {
        if (paragraph_line_spacing_add_before) {
            element.find('.cancel_drag').children().css('padding-top', '10px');
            // var sel = window.getSelection();
            // console.log(sel.extentNode.parentNode);
            // sel.extentNode.parentNode.style.paddingTop = '20px';
        } else {
            element.find('.cancel_drag').children().css('padding-top', '0px');
            // var sel = window.getSelection();
            // console.log(sel.extentNode.parentNode);
            // sel.extentNode.parentNode.style.paddingTop = '0px';
        }
    }

    // document.execCommand("fontSize", false, "1");
    // set_paragraph_spacing(paragraph_line_spacing_add_before);
}

function set_paragraph_spacing(paragraph_line_spacing_add_before) {
    if (paragraph_line_spacing_add_before) {
        if ($("font[size=1]").length > 0) {
            $("font[size=1]").removeAttr("size").css("margin-top", "25px").css("display", "block");
            return;
        }
        var deepest_editable_div = $('#quiz_view .slide_view_question_element.selected_slide_view_group  .cancel_drag');
        var font_size_changed_html = deepest_editable_div.html().split('x-small').join('px; margin-top: 25px; display: block;');
        deepest_editable_div.html(font_size_changed_html);
    } else {
        if ($("font[size=1]").length > 0) {
            $("font[size=1]").removeAttr("size").css("margin-top", "0px").css("display", "block");
            return;
        }
        var deepest_editable_div = $('#quiz_view .slide_view_question_element.selected_slide_view_group  .cancel_drag');
        var font_size_changed_html = deepest_editable_div.html().split('x-small').join('px; margin-top: 0px; display: block;');
        deepest_editable_div.html(font_size_changed_html);
    }

    set_flag_true();
}

// $('#slide_view_paragraph_style_decrease_indent_btn').click(function () {
//     decrease_indent();
// });

$('.decrease_indent').click(function () {
    // decrease_indent();
    // element = $('.selected_slide_view_group');
    // var indent = parseInt(element.css('text-indent'));
    // if (indent > 0) element.css('text-indent', indent - 10 + 'px');
    document.execCommand('outdent', false, null);

    set_flag_true();
});

$('.decrease_indent').mousedown(function (e) {
    e.preventDefault();
});

$('.increase_indent').click(function () {

    // increase_indent();

    // element = $('.selected_slide_view_group');
    // var indent = parseInt(element.css('text-indent'));
    // element.css('text-indent', indent + 10 + 'px');

    document.execCommand('indent', false, null);


    set_flag_true();
});

$('.increase_indent').mousedown(function (e) {
    e.preventDefault();
});

function decrease_indent() {
    var sel = window.getSelection();
    if (sel.rangeCount) {
        var e = document.createElement('span');
        e.innerHTML = sel.toString();
        // https://developer.mozilla.org/en-US/docs/Web/API/Selection/getRangeAt
        var range = sel.getRangeAt(0);
        range.deleteContents();
        range.insertNode(e);
        while (!((e.parentElement.classList.contains('slide_view_question_element')) || (e.parentElement.classList.contains('form_view_question_element')))) {
            e = e.parentElement
        }
        if (e.style.marginLeft == '' || e.style.marginLeft == '0px')
            e.style.marginLeft = '0px';
        else
            e.style.marginLeft = parseInt(e.style.marginLeft) - 10 + 'px';
    }
}

function increase_indent() {
    var sel = window.getSelection();
    if (sel.rangeCount) {
        var e = document.createElement('span');
        e.innerHTML = sel.toString();
        // https://developer.mozilla.org/en-US/docs/Web/API/Selection/getRangeAt
        var range = sel.getRangeAt(0);
        range.deleteContents();
        range.insertNode(e);
        while (!((e.parentElement.classList.contains('slide_view_question_element')) || (e.parentElement.classList.contains('form_view_question_element')))) {
            e = e.parentElement
        }
        if (e.style.marginLeft == '' || e.style.marginLeft == '0px')
            e.style.marginLeft = '10px';
        else
            e.style.marginLeft = parseInt(e.style.marginLeft) + 10 + 'px';
    }
}

//=========================================================================
//
//          Slide View => Home / Drawing
//
//=========================================================================

$('.shape_effect_shadow_sample').click(function () {
    var element = $('#quiz_view .selected_slide_view_group'); // get selected element
    element.css('box-shadow', $(this).attr('data-style'));

    set_flag_true();
});
$('.shape_effect_glow_sample').click(function () {
    console.log('general styling')
    var element = $('#quiz_view .selected_slide_view_group'); // get selected element
    element.css('box-shadow', $(this).attr('data-style'));

    set_flag_true();
});

$('#arrange_bring_forward').click(function () {

    var elements = $('.slide_view_group');
    var len = elements.length;
    for (let i = 0; i < len; i++) {
        if (elements.eq(i).css('display') != 'none') elements.eq(i).addClass('displayed_block');
    }

    var elements = $('.displayed_block');
    var len = elements.length;
    var selected_el = $('.selected_slide_view_group').eq(0); // get selected element
    var zIndex_of_selected_el = parseInt(selected_el.css('z-index'));
    var zIndex_list = [];

    for (let i = 0; i < len; i++) {
        zIndex_list.push(parseInt(elements.eq(i).css('z-index')));
    }

    var isOnTop = true;
    for (let i = 0; i < len; i++) {
        if (zIndex_list[i] == zIndex_of_selected_el + 1) {
            elements.eq(i).css('z-index', zIndex_list[i] - 1);
            isOnTop = false;
        }
    }
    if (!isOnTop)
        selected_el.css('z-index', zIndex_of_selected_el + 1);

    set_flag_true();
});

$('#arrange_send_backward').click(function () {
    var elements = $('.slide_view_group');
    var len = elements.length;
    for (let i = 0; i < len; i++) {
        if (elements.eq(i).css('display') != 'none') elements.eq(i).addClass('displayed_block');
    }

    var elements = $('.displayed_block');
    var len = elements.length;
    var selected_el = $('.selected_slide_view_group').eq(0); // get selected element
    var zIndex_of_selected_el = parseInt(selected_el.css('z-index'));
    var zIndex_list = [];

    for (let i = 0; i < len; i++) {
        zIndex_list.push(parseInt(elements.eq(i).css('z-index')));
    }

    var isAtBottom = true;
    for (let i = 0; i < len; i++) {
        if (zIndex_list[i] == zIndex_of_selected_el - 1) {
            elements.eq(i).css('z-index', zIndex_list[i] + 1);
            isAtBottom = false;
        }
    }
    if (!isAtBottom)
        selected_el.css('z-index', zIndex_of_selected_el - 1);

    set_flag_true();
});

$('#arrange_bring_front').click(function () {
    var elements = $('.slide_view_group');
    var len = elements.length;
    for (let i = 0; i < len; i++) {
        if (elements.eq(i).css('display') != 'none') elements.eq(i).addClass('displayed_block');
    }

    var elements = $('.displayed_block');
    var len = elements.length;
    var selected_el = $('.selected_slide_view_group').eq(0); // get selected element
    var zIndex_of_selected_el = parseInt(selected_el.css('z-index'));
    var zIndex_list = [];

    for (let i = 0; i < len; i++) {
        zIndex_list.push(parseInt(elements.eq(i).css('z-index')));
    }

    for (let i = 0; i < len; i++) {
        if (zIndex_list[i] > zIndex_of_selected_el) {
            elements.eq(i).css('z-index', zIndex_list[i] - 1);
        }
    }
    selected_el.css('z-index', '3');

    set_flag_true();
});

$('#arrange_send_back').click(function () {

    var elements = $('.slide_view_group');
    var len = elements.length;
    for (let i = 0; i < len; i++) {
        if (elements.eq(i).css('display') != 'none') elements.eq(i).addClass('displayed_block');
    }

    var elements = $('.displayed_block');
    var len = elements.length;
    var selected_el = $('.selected_slide_view_group').eq(0); // get selected element
    var zIndex_of_selected_el = parseInt(selected_el.css('z-index'));
    var zIndex_list = [];

    for (let i = 0; i < len; i++) {
        zIndex_list.push(parseInt(elements.eq(i).css('z-index')));
    }

    for (let i = 0; i < len; i++) {
        if (zIndex_list[i] < zIndex_of_selected_el) {
            elements.eq(i).css('z-index', zIndex_list[i] + 1);
        }
    }
    selected_el.css('z-index', '1');

    set_flag_true();
});

$('#rotate_right').click(function () {
    var elements = $('.selected_slide_view_group'); // get selected element
    for (let i = 0; i < elements.length; i++) {
        element = elements.eq(i);
        if (element.attr('rotate') == undefined || element.attr('rotate') == '0') {
            element.attr('rotate', '90');
            element.css('transform', 'rotate(90deg)');
            continue;
        }
        if (element.attr('rotate') == '90') {
            element.attr('rotate', '180');
            element.css('transform', 'rotate(180deg)');
            continue;
        }
        if (element.attr('rotate') == '180') {
            element.attr('rotate', '270');
            element.css('transform', 'rotate(270deg)');
            continue;
        }
        if (element.attr('rotate') == '270') {
            element.attr('rotate', '0');
            element.css('transform', 'rotate(0deg)');
            continue;
        }
    }

    set_flag_true();
});

$('#rotate_left').click(function () {
    var elements = $('.selected_slide_view_group'); // get selected element
    for (let i = 0; i < elements.length; i++) {
        element = elements.eq(i)
        if (element.attr('rotate') == undefined || element.attr('rotate') == '0') {
            element.attr('rotate', '270');
            element.css('transform', 'rotate(270deg)');
            continue;
        }
        if (element.attr('rotate') == '270') {
            element.attr('rotate', '180');
            element.css('transform', 'rotate(180deg)');
            continue;
        }
        if (element.attr('rotate') == '180') {
            element.attr('rotate', '90');
            element.css('transform', 'rotate(90deg)');
            continue;
        }
        if (element.attr('rotate') == '90') {
            element.attr('rotate', '0');
            element.css('transform', 'rotate(0deg)');
            continue;
        }
    }

    set_flag_true();
});

$('#align_left').click(function () {
    var element = $('#quiz_view .selected_slide_view_group'); // get selected element
    element.css('left', '0px');

    set_flag_true();
});

$('#align_right').click(function () {
    var parent_el = $('#slide_view_container');
    var parent_width = parent_el.width();

    var elements = $('.selected_slide_view_group'); // get selected element
    var el_num = elements.length;
    for (let i = 0; i < el_num; i++) {
        var element = elements.eq(i);
        element.css('left', parent_width - element.outerWidth());
    }

    set_flag_true();
});


$('#align_center').click(function () {
    var parent_el = $('#slide_view_container');
    var parent_width = parent_el.width();

    var elements = $('.selected_slide_view_group'); // get selected element
    var ele_count = elements.length;
    for (let i = 0; i < ele_count; i++) {
        element = elements.eq(i);
        element.css('left', (parent_width - element.outerWidth()) / 2 + 'px');
    }

    set_flag_true();
});

$('#align_top').click(function () {
    var element = $('#quiz_view .selected_slide_view_group'); // get selected element
    element.css('top', '0px');

    set_flag_true();

});

$('#align_bottom').click(function () {
    var parent_el = $('#slide_view_container');
    var parent_height = parent_el.height();
    var elements = $('.selected_slide_view_group'); // get selected element
    var el_num = elements.length;
    for (let i = 0; i < el_num; i++) {
        var element = elements.eq(i);
        element.css('top', parent_height - element.outerHeight());
    }

    set_flag_true();

});

$('#align_middle').click(function () {
    var parent_el = $('#slide_view_container');
    var parent_height = parent_el.height();
    var elements = $('.selected_slide_view_group'); // get selected element
    var ele_count = elements.length;
    for (let i = 0; i < ele_count; i++) {
        element = elements.eq(i);
        element.css('top', (parent_height - element.outerHeight()) / 2 + 'px');
    }

    set_flag_true();
});

$('#distribute_vertically').click(function () {
    var height_sum = 0;
    var elements = $('#quiz_view .selected_slide_view_group'); // get selected element
    var ele_count = elements.length;
    console.log(ele_count);
    for (let i = 0; i < ele_count; i++) {
        height_sum += elements.eq(i).outerHeight();
        console.log(height_sum);
    }
    var gap = ($('#slide_view_container').height() - height_sum) / (ele_count + 1);
        if (gap < 0) return;

    for (let i = 0; i < ele_count; i++) {
        var height_to_set_sum = 0;
        for (let j = 0; j < i; j++) {
            height_to_set_sum += elements.eq(j).outerHeight();
        }
        elements.eq(i).css('top', height_to_set_sum + gap * (i + 1) + 'px');
    }

    set_flag_true();
});

$('#distribute_horizontally').click(function () {
    var width_sum = 0;
    var elements = $('#quiz_view .selected_slide_view_group'); // get selected element
    ele_count = elements.length;
    for (let i = 0; i < ele_count; i++) {
        width_sum += elements.eq(i).outerWidth();
    }
    var gap = ($('#slide_view_container').width() - width_sum) / (ele_count + 1);
    if (gap < 0) return;
    for (let i = 0; i < ele_count; i++) {
        var width_to_set_sum = 0;
        for (let j = 0; j < i; j++) {
            width_to_set_sum += elements.eq(j).outerWidth();
        }
        elements.eq(i).css('left', width_to_set_sum + gap * (i + 1) + 'px');
    }

    set_flag_true();
});

$('.quick_style_sample').click(function () {

    var element = $('#quiz_view .selected_slide_view_group'); // get selected element
    // var element = $('.slide_view_question_element').eq(0);

    element.css('border', this.style.border);
    element.css('color', $(this).css('color'));
    element.css('background', this.style.background);
    // element.css('box-shadow', $(this).css('box-shadow'));
    if (this.style.background.indexOf('repeating-conic-gradient(rgb') == -1) {
        element.css('background', this.style.background);
    } else {
        element.css('background', 'rgba' + this.style.background.split('repeating-conic-gradient(rgb')[1].split(') 0deg,')[0] + ', 0.7)');
    }

    set_flag_true();
});

$('.quick_style_sample_none').click(function () {
    var element = $('#quiz_view .selected_slide_view_group'); // get selected element
    element.css('border', 'none');
    element.css('background', 'none');
    element.css('color', 'black');

    set_flag_true();
});

$('.quick_style_sample').mousedown(function (e) {
    e.preventDefault();
});

$('#office_color_picker').colorpicker({
    color: '#ffffff',
    defaultPalette: 'theme'
});

$('#shape_fill_color_picker').colorpicker({
    color: '#ffffff',
    defaultPalette: 'theme'
});

$('#shape_outline_color_picker').colorpicker({
    color: '#000000',
    defaultPalette: 'theme'
});

// triggered when a color is selected.
$("#shape_fill_color_picker").on("change.color", function (event, color) {
    var element = $('#quiz_view .selected_slide_view_group'); // get selected element
    element.css('background', color);

    set_flag_true();
});

$("#shape_outline_color_picker").on("change.color", function (event, color) {
    var element = $('#quiz_view .selected_slide_view_group'); // get selected element
    element.css('border', '3px solid ' + color);

    set_flag_true();
});


//========================================================
//
//               Design => Themes
//
//========================================================


$('.design_themes_panels').click(function () {
    $('#slide_view_container').eq(0).css('background', 'unset');
    $('#slide_view_container').eq(0).css('font-family', $(this).css('font-family'));
    $('#slide_view_container').eq(0).css('color', $(this).css('color'));
    $('#slide_view_container').eq(0).css('background-image', $(this).css('background-image').split(".png").join(' - Copy.png'));
    $('#slide_view_container').eq(0).css('background-size', '100% 100%');
    $('#slide_view_container').eq(0).css('background-repeat', 'no-repeat');

    $('.preview_item > div').css('background', 'unset');
    $('.preview_item > div').css('font-family', $(this).css('font-family'));
    $('.preview_item > div').css('color', $(this).css('color'));
    $('.preview_item > div').css('background-image', $(this).css('background-image'));
    $('.preview_item > div').css('background-size', '100% 100%');
    $('.preview_item > div').css('background-repeat', 'no-repeat');

    var style = "background: unset; font-fmily:" + $(this).css('font-family') + "; color:" + $(this).css('color') + "; background-image:" + $(this).css('background-image').split(".png").join(' - Copy.png') + "; background-size: 100% 100%; background-repeat: no-repeat; ";

    store_theme_style(style);

    set_flag_true();

});
$('.design_themes_panels').mousedown(function (e) {
    e.preventDefault();
});


//====================================================
//
//              Insert panel functions
//
//====================================================

// $('#layout_reset_btn').click(function () {
//     var sel = window.getSelection()
//     let range = new Range();
//     var content = sel.cloneContents();
// });


//================================
//
//          Modal
//
//================================
var recording_panel_holder = document.getElementById("recording_panel_holder");

var edit_hyperlink_modal = document.getElementById("edit_hyperlink_modal_container");
var span = document.getElementsByClassName("edit_hyperlink_close_symbol")[0];

$('.edit_hyperlink_close_symbol').click(function () {
    edit_hyperlink_modal.style.display = "none";
});

window.onclick = function (event) {
    if (event.target == edit_hyperlink_modal) {
        edit_hyperlink_modal.style.display = "none";
    }
    if (event.target == recording_panel_holder) {
        recording_panel_holder.style.display = "none";
        $('body').css('overflow', 'auto');
    }
}

var selected_html;

$('.hyperlink_btn').click(function () {
    $('#hyper_text').val(get_selected_txt());
    selected_html = saveSelection();
    edit_hyperlink_modal.style.display = "block";
    remove_link = false;
});

$('.hyperlink_btn').mousedown(function (e) {
    e.preventDefault();
});

function get_selected_txt() {
    var sel = window.getSelection();
    return (sel.toString());
}

$('#link_to_bar input').on('click', function () {
    if ($('input[name=link_type]:checked').val() == 'webpage') {
        $('#open_in_new_check').css('display', 'block');
        $('#hyperlink_test_btn').css('display', 'block');
        $('#link_address').val('http://');
    } else {
        $('#open_in_new_check').css('display', 'none');
        $('#hyperlink_test_btn').css('display', 'none');
        $('#link_address').val('');
    }
});

$('#edit_hyperlink_ok').click(function () {
    edit_hyperlink_modal.style.display = "none";
    restoreSelection(selected_html);
    set_flag_true();
    if (remove_link) {
        document.execCommand('insertHTML', false, '<span>' + $('#hyper_text').val() + '</span>');
        return;
    }
    ;
    if ($('input[name=link_type]:checked').val() == 'webpage') {
        if (document.getElementById('open_in_new').checked)
            document.execCommand('insertHTML', false, '<a style="font-size:' + fontSize + 'px;" href="' + $('#link_address').val() + '" target="_blank">' + $('#hyper_text').val() + '</a>');
        else
            document.execCommand('insertHTML', false, '<a style="font-size:' + fontSize + 'px;" href="' + $('#link_address').val() + '">' + $('#hyper_text').val() + '</a>');
    } else {
        document.execCommand('insertHTML', false, '<a style="font-size:' + fontSize + 'px;" href="mailto:' + $('#link_address').val() + '">' + $('#hyper_text').val() + '</a>');
    }

});

function saveSelection() {
    if (window.getSelection) {
        sel = window.getSelection();
        if (sel.getRangeAt && sel.rangeCount) {
            var ranges = [];
            for (var i = 0, len = sel.rangeCount; i < len; ++i) {
                ranges.push(sel.getRangeAt(i));
            }
            return ranges;
        }
    } else if (document.selection && document.selection.createRange) {
        return document.selection.createRange();
    }
    return null;
}

function restoreSelection(savedSel) {
    if (savedSel) {
        if (window.getSelection) {
            sel = window.getSelection();
            sel.removeAllRanges();
            for (var i = 0, len = savedSel.length; i < len; ++i) {
                sel.addRange(savedSel[i]);
            }
        } else if (document.selection && savedSel.select) {
            savedSel.select();
        }
    }
}

$('#hyperlink_test_btn').click(function () {
    window.open($('#link_address').val(), '_blank');
});

$('#edit_hyperlink_cancel').click(function () {
    edit_hyperlink_modal.style.display = "none";
});

$('#hyperlink_remove_btn').click(function () {
    remove_link = true;
});

$('#slide_view_rec_mic_btn').click(function () {
    $('#recording_panel_holder').show();
    $('body').css('overflow', 'hidden');
});

$('#form_view_rec_mic_btn').click(function () {
    $('#recording_panel_holder').show();
    $('body').css('overflow', 'hidden');
});

$('#close_recording').click(function () {
    $('#recording_panel_holder').hide();
    $('body').css('overflow', 'auto');
});

//===================================
//
//             LAYOUT
//
//===================================

var picture_element_ratio = 0;
var video_element_ratio = 0;

var layout_applied = false;
var question_style_top;
var question_style_left;
var question_style_width;
var question_style_height;
var answer_style_top;
var answer_style_left;
var answer_style_width;
var answer_style_height;
var picture_style_top;
var picture_style_left;
var picture_style_width;
var picture_style_height;
var video_style_top;
var video_style_left;
var video_style_width;
var video_style_height;

$('.layout_panel_img_holder').click(function () {

    if (!layout_applied) {
        question_style_top = $('#quiz_view .slide_view_question_element').css('top');
        question_style_left = $('#quiz_view .slide_view_question_element').css('left');
        question_style_width = $('#quiz_view .slide_view_question_element').css('width');
        question_style_height = $('#quiz_view .slide_view_question_element').css('height');
        answer_style_top = $('#quiz_view .slide_view_answer_element').css('top');
        answer_style_left = $('#quiz_view .slide_view_answer_element').css('left');
        answer_style_width = $('#quiz_view .slide_view_answer_element').css('width');
        answer_style_height = $('#quiz_view .slide_view_answer_element').css('height');
        picture_style_top = $('#quiz_view .slide_view_media_element').css('top');
        picture_style_left = $('#quiz_view .slide_view_media_element').css('left');
        picture_style_width = $('#quiz_view .slide_view_media_element').css('width');
        picture_style_height = $('#quiz_view .slide_view_media_element').css('height');
        video_style_top = $('#quiz_view .slide_view_video_element').css('top');
        video_style_left = $('#quiz_view .slide_view_video_element').css('left');
        video_style_width = $('#quiz_view .slide_view_video_element').css('width');
        video_style_height = $('#quiz_view .slide_view_video_element').css('height');
        layout_applied = true;
    }


    var question_style = $(this).attr('data-questyle').split(' ');
    var answer_style = $(this).attr('data-anstyle').split(' ');
    var media_style = $(this).attr('data-medstyle').split(' ');
    $('#quiz_view .slide_view_question_element').css('top', question_style[0] + '%');
    $('#quiz_view .slide_view_question_element').css('left', question_style[1] + '%');
    $('#quiz_view .slide_view_question_element').css('width', question_style[2] + '%');
    $('#quiz_view .slide_view_question_element').css('height', question_style[3] + '%');

    $('#quiz_view .slide_view_answer_element').css('top', answer_style[0] + '%');
    $('#quiz_view .slide_view_answer_element').css('left', answer_style[1] + '%');
    $('#quiz_view .slide_view_answer_element').css('width', answer_style[2] + '%');
    $('#quiz_view .slide_view_answer_element').css('height', answer_style[3] + '%');

    var container_ratio = $('#quiz_view #quiz_background_container').width() / $('#quiz_view #quiz_background_container').height();
    var ratio_to_be_changed = container_ratio * media_style[2] / media_style[3];

    if ($('#quiz_view .slide_view_element .slide_view_media_element').find('img').eq(0).attr('src') != '#') {
        // if ($('.slide_view_element .slide_view_media_element').css('display') != 'none') {
        if (picture_element_ratio == 0)
            picture_element_ratio = $('#quiz_view .slide_view_element .slide_view_media_element').width() / $('#quiz_view .slide_view_element .slide_view_media_element').height();
        // }
        if (picture_element_ratio < ratio_to_be_changed) {
            $('#quiz_view .slide_view_media_element').css('top', media_style[0] + '%');
            $('#quiz_view .slide_view_media_element').css('height', media_style[3] + '%');
            $('#quiz_view .slide_view_media_element').css('width', parseInt(media_style[2]) / ratio_to_be_changed * picture_element_ratio + '%');
            $('#quiz_view .slide_view_media_element').css('left', parseInt(media_style[1]) - (parseInt(media_style[2]) / ratio_to_be_changed * picture_element_ratio - parseInt(media_style[2])) / 2 + '%');
        } else {
            $('#quiz_view .slide_view_media_element').css('left', media_style[1] + '%');
            $('#quiz_view .slide_view_media_element').css('width', media_style[2] + '%');
            $('#quiz_view .slide_view_media_element').css('height', parseInt(media_style[3]) / picture_element_ratio * ratio_to_be_changed + '%');
            $('#quiz_view .slide_view_media_element').css('top', parseInt(media_style[0]) - (parseInt(media_style[3]) / picture_element_ratio * ratio_to_be_changed - parseInt(media_style[3])) / 2 + '%');
        }
    }

    if ($('#quiz_view .slide_view_element .slide_view_video_element').find('source').eq(0).attr('src') != '#') {
        // if ($('#quiz_view .slide_view_element .slide_view_video_element').css('display') != 'none') {
        if (video_element_ratio == 0)
            video_element_ratio = $('#quiz_view .slide_view_element .slide_view_video_element ').width() / $('#quiz_view .slide_view_element .slide_view_video_element').height();
        // }

        if (video_element_ratio < ratio_to_be_changed) {
            $('#quiz_view .slide_view_video_element').css('top', media_style[0] + '%');
            // $('#quiz_view .slide_view_video_element').css('height', media_style[3] + '%');
            $('#quiz_view .slide_view_video_element').css('width', parseInt(media_style[3]) * video_element_ratio / container_ratio + '%');
            $('#quiz_view .slide_view_video_element').css('left', parseInt(media_style[1]) + (parseInt(media_style[2]) - parseInt(media_style[3]) * video_element_ratio / container_ratio) / 2 + '%');
        } else {
            $('#quiz_view .slide_view_video_element').css('left', media_style[1] + '%');
            $('#quiz_view .slide_view_video_element').css('width', media_style[2] + '%');
            $('#quiz_view .slide_view_video_element').css('top', parseInt(media_style[0]) - (parseInt(media_style[2]) / video_element_ratio * container_ratio - parseInt(media_style[3])) / 2 + '%');
            // $('#quiz_view .slide_view_video_element').css('height', parseInt(media_style[3]) / picture_element_ratio * ratio_to_be_changed + '%');
        }
    }

    set_flag_true();
});


$('#layout_reset_btn').click(function () {
    if (layout_applied) {
        $('#quiz_view .slide_view_question_element').css('top', question_style_top);
        $('#quiz_view .slide_view_question_element').css('left', question_style_left);
        $('#quiz_view .slide_view_question_element').css('width', question_style_width);
        $('#quiz_view .slide_view_question_element').css('height', question_style_height);
        $('#quiz_view .slide_view_answer_element').css('top', answer_style_top);
        $('#quiz_view .slide_view_answer_element').css('left', answer_style_left);
        $('#quiz_view .slide_view_answer_element').css('width', answer_style_width);
        $('#quiz_view .slide_view_answer_element').css('height', answer_style_height);
        $('#quiz_view .slide_view_media_element').css('top', picture_style_top);
        $('#quiz_view .slide_view_media_element').css('left', picture_style_left);
        $('#quiz_view .slide_view_media_element').css('width', picture_style_width);
        $('#quiz_view .slide_view_media_element').css('height', picture_style_height);
        $('#quiz_view .slide_view_video_element').css('top', video_style_top);
        $('#quiz_view .slide_view_video_element').css('left', video_style_left);
        $('#quiz_view .slide_view_video_element').css('width', video_style_width);
        $('#quiz_view .slide_view_video_element').css('height', video_style_height);
    }

    set_flag_true();
});


$('#layout_column_01_btn').click(function () {
    var element = $('.selected_slide_view_group').eq(0); // get selected element
    if (element.find('.choice_item').length > 0) {
        element.find('.choice_item').eq(0).parent().css('display', 'flex');
        element.find('.choice_item').eq(0).parent().css('flex-direction', 'row');
        element.find('.choice_item').eq(0).parent().css('flex-wrap', 'wrap');
        element.find('.choice_item').css('flex', '0 0 100%');
    }
    if (element.find('.response_item').length > 0) {
        element.find('.response_item').eq(0).parent().css('display', 'flex');
        element.find('.response_item').eq(0).parent().css('flex-direction', 'row');
        element.find('.response_item').eq(0).parent().css('flex-wrap', 'wrap');
        element.find('.response_item').css('flex', '0 0 100%');
    }

    set_flag_true();
});

$('#layout_column_02_btn').click(function () {
    var element = $('.selected_slide_view_group').eq(0); // get selected element
    if (element.find('.choice_item').length > 0) {
        element.find('.choice_item').eq(0).parent().css('display', 'flex');
        element.find('.choice_item').eq(0).parent().css('flex-direction', 'row');
        element.find('.choice_item').eq(0).parent().css('flex-wrap', 'wrap');
        element.find('.choice_item').css('flex', '0 0 50%');
    }
    if (element.find('.response_item').length > 0) {
        element.find('.response_item').eq(0).parent().css('display', 'flex');
        element.find('.response_item').eq(0).parent().css('flex-direction', 'row');
        element.find('.response_item').eq(0).parent().css('flex-wrap', 'wrap');
        element.find('.response_item').css('flex', '0 0 50%');
    }

    set_flag_true();
});

$('#layout_column_03_btn').click(function () {
    var element = $('.selected_slide_view_group').eq(0); // get selected element
    if (element.find('.choice_item').length > 0) {
        element.find('.choice_item').eq(0).parent().css('display', 'flex');
        element.find('.choice_item').eq(0).parent().css('flex-direction', 'row');
        element.find('.choice_item').eq(0).parent().css('flex-wrap', 'wrap');
        element.find('.choice_item').css('flex', '0 0 33.3%');
    }
    if (element.find('.response_item').length > 0) {
        element.find('.response_item').eq(0).parent().css('display', 'flex');
        element.find('.response_item').eq(0).parent().css('flex-direction', 'row');
        element.find('.response_item').eq(0).parent().css('flex-wrap', 'wrap');
        element.find('.response_item').css('flex', '0 0 33.3%');
    }

    set_flag_true();
});

$('#layout_column_04_btn').click(function () {
    var element = $('.selected_slide_view_group').eq(0); // get selected element
    if (element.find('.choice_item').length > 0) {
        element.find('.choice_item').eq(0).parent().css('display', 'flex');
        element.find('.choice_item').eq(0).parent().css('flex-direction', 'row');
        element.find('.choice_item').eq(0).parent().css('flex-wrap', 'wrap');
        element.find('.choice_item').css('flex', '0 0 25%');
    }
    if (element.find('.response_item').length > 0) {
        element.find('.response_item').eq(0).parent().css('display', 'flex');
        element.find('.response_item').eq(0).parent().css('flex-direction', 'row');
        element.find('.response_item').eq(0).parent().css('flex-wrap', 'wrap');
        element.find('.response_item').css('flex', '0 0 25%');
    }

    set_flag_true();
});


// sel = window.getSelection();

// for(let i = 0; i < sel.rangeCount; i++) {
//  ranges[i] = sel.getRangeAt(i);
// }
// ranges[0].cloneContents()
// div=document.createElement("div");
// div.appendChild(content)
// div.innerHTML

// https://developer.mozilla.org/en-US/docs/Web/API/DocumentFragment

$('#xxxxxxx').click(function () {
    $('#yyyyyyy').trigger('click');
});

$('#design_section_preview_btn_top').click(function (e) {
    e.stopPropagation();
    $('#design_section_preview_btn_bottom').trigger('click');
});

$('#theme_select_btn_top').click(function (e) {
    e.stopPropagation();
    $('#theme_select_btn_bottom').trigger('click');
});

$('#insert_section_slide_btn_top').click(function (e) {
    e.stopPropagation();
    $('#insert_section_slide_btn_bottom').trigger('click');
});

$('#insert_section_audio_btn_top').click(function (e) {
    e.stopPropagation();
    $('#slide_view_insert_audio_btn').trigger('click');
});

$('#insert_section_question_btn_top').click(function (e) {
    e.stopPropagation();
    $('#insert_section_question_btn_bottom').trigger('click');
});

$('#slideview_home_preview_btn_top').click(function (e) {
    e.stopPropagation();
    $('#slideview_home_preview_btn_bottom').trigger('click');
});

$('#slideview_quick_styles_btn_top').click(function (e) {
    e.stopPropagation();
    $('#slideview_quick_styles_btn_bottom').trigger('click');
});

$('#slideview_arrange_btn_top').click(function (e) {
    e.stopPropagation();
    $('#slideview_arrange_btn_down').trigger('click');
});

$('#select_question_btn').click(function (e) {
    e.stopPropagation();
    $('#select_question_dropdown').trigger('click');
});

$('#formview_preview_btn').click(function (e) {
    e.stopPropagation();
    $('#formview_preview_dropdown').trigger('click');
});

$('#font_color_display_letter').mousedown(function (e) {
    e.preventDefault();
});

$('#font_color_display_letter').click(function (e) {
    e.stopPropagation();
    $('#font_picker_trigger').trigger('click');
});

function init_styling_and_layout() {
    picture_element_ratio = 0;
    video_element_ratio = 0;
    layout_applied = false;

    formatting_bold = false;
    formatting_strike = false;
    formatting_ital = false;
    formatting_underline = false;
    formatting_subscript = false;
    formatting_superscript = false;

    $('#slide_view_font_family_selector').val('Arial');
    $('#font_size_selector').val('16');
    fontSize = 16;
    changing_font_size_for_answer_element = 16;
}

// init_styling_and_layout()   when leaving current quiz, on a new quiz

$(document).ready(function (){
   // console.log('%c Loaded', 'color: blue;');
   // console.log($('.evo-palette').length);
   // Insert No fill option
   var a = $('.evo-palette').eq(1).find('tr').eq(0);
   a.clone().insertBefore(a).attr('id', 'no_fill_btn').attr('onclick', 'apply_no_fill()').find('th').text("No fill");

   // Insert No outline option
   var a = $('.evo-palette').eq(2).find('tr').eq(0);
   a.clone().insertBefore(a).attr('id', 'no_border_btn').attr('onclick', 'apply_no_outline()').find('th').text("No outline");

});

function apply_no_fill() {
    console.log('no fill');
    var element = $('#quiz_view .selected_slide_view_group'); // get selected element
    var len = element.length;
    for (let i = 0; i < len; i++) {
        var style = element.eq(i).attr('style');
        if (style.indexOf('background:') == -1) continue;
        var tmp = style.split('background:');
        var tmp_2 = tmp[1];
        var tmp_3 = tmp_2.split(';');
        tmp_3.shift();
        var no_fill_style = tmp[0] + tmp_3.join(';');

        element.eq(i).attr('style', no_fill_style);
    }
}

function apply_no_outline() {
    console.log('no border');
    var element = $('#quiz_view .selected_slide_view_group'); // get selected element
    var len = element.length;
    for (let i = 0; i < len; i++) {
        var style = element.eq(i).attr('style');
        if (style.indexOf('border:') == -1) continue;
        var tmp = style.split('border:');
        var tmp_2 = tmp[1];
        var tmp_3 = tmp_2.split(';');
        tmp_3.shift();
        var no_fill_style = tmp[0] + tmp_3.join(';');

        element.eq(i).attr('style', no_fill_style);
    }
}

$('#no_glow_btn').click(function () {
    console.log('specific styling');
    var element = $('#quiz_view .selected_slide_view_group'); // get selected element
    var len = element.length;
    for (let i = 0; i < len; i++) {
        var style = element.eq(i).attr('style');
        if (style.indexOf('box-shadow:') == -1) continue;
        var tmp = style.split('box-shadow:');
        var tmp_2 = tmp[1];
        var tmp_3 = tmp_2.split(';');
        tmp_3.shift();
        var no_fill_style = tmp[0] + tmp_3.join(';');

        element.eq(i).attr('style', no_fill_style);
    }
});

$('#no_shadow_btn').click(function () {
    console.log('specific styling');
    var element = $('#quiz_view .selected_slide_view_group'); // get selected element
    var len = element.length;
    for (let i = 0; i < len; i++) {
        var style = element.eq(i).attr('style');
        if (style.indexOf('box-shadow:') == -1) continue;
        var tmp = style.split('box-shadow:');
        var tmp_2 = tmp[1];
        var tmp_3 = tmp_2.split(';');
        tmp_3.shift();
        var no_fill_style = tmp[0] + tmp_3.join(';');

        element.eq(i).attr('style', no_fill_style);
    }
});

$('#quick_style_none').click(function () {
    console.log('specific styling');
    var element = $('#quiz_view .selected_slide_view_group'); // get selected element
    var len = element.length;
    for (let i = 0; i < len; i++) {
        var style = element.eq(i).attr('style');
        if (style.indexOf('border:') == -1) continue;
        var tmp = style.split('border:');
        var tmp_2 = tmp[1];
        var tmp_3 = tmp_2.split(';');
        tmp_3.shift();
        var no_fill_style = tmp[0] + tmp_3.join(';');

        element.eq(i).attr('style', no_fill_style);
    }
});
