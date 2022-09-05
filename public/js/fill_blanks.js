function add_word(element) {
    element.parent().parent().prepend('<li><label data-editable>Click and Type content...</label><a onclick="{$(this).parent().remove();set_flag_true();}"><i class="fas fa-trash-alt"></i></a></li>');

    set_flag_true();
}

function add_fill_word_dropdown() {
    if ($('#fill_blanks div').length > 0) {
        if (!$('#fill_blanks > div:last-child').hasClass('fill_blanks_dropdown')) {
            $('#fill_blanks > div:last-child').append('<div class="fill_blanks_dropdown" contenteditable="true" style="display: inline;"><div class="fill_blanks_dropdown_body" contenteditable="false"  style="display: inline;"><div class="fill_blanks_dropdown_content"></div><div class="fill_blanks_dropdown_arrow" onclick="toggle_fill_blanks_dropdown(this)"><i class="fas fa-chevron-down"></i></div><div class="fill_blanks_dropdown_menu" contenteditable="false"><ul><li><i onclick="add_word($(this));">Add a new word</i></li></ul></div></div></div>&nbsp');
            return;
        }
    }
    $('#fill_blanks').append('<div class="fill_blanks_dropdown" contenteditable="true" style="display: inline;"><div class="fill_blanks_dropdown_body" contenteditable="false"  style="display: inline;"><div class="fill_blanks_dropdown_content"></div><div class="fill_blanks_dropdown_arrow" onclick="toggle_fill_blanks_dropdown(this)"><i class="fas fa-chevron-down"></i></div><div class="fill_blanks_dropdown_menu" contenteditable="false"><ul><li><i onclick="add_word($(this));">Add a new word</i></li></ul></div></div></div>&nbsp');

    set_flag_true();
}

function toggle_fill_blanks_dropdown(element) {

    hide_fill_blanks_dropdown_except_one($(element).next());

    if($(element).next().css('display') == 'none') {
        $(element).next().show();
    } else {
        $(element).next().hide();
    }
}

function hide_fill_blanks_dropdown_except_one(element) {

    var dropdownCollection = $('.fill_blanks_dropdown_menu');
    var index = dropdownCollection.index(element);

    for (let i = 0; i <dropdownCollection.length; i++) {
        if (i != index) dropdownCollection.eq(i).hide();
    }
}
