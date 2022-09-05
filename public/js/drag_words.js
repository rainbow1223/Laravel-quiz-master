function add_drag_words_insert() {

    const index = get_new_input_id();

    if ($('#drag_words div').length > 0) {
        if (!$('#drag_words > div:last-child').hasClass('blank')) {
            $('#drag_words > div:last-child').append('<div class="blank" style="display: inline; width: 70px; height: 100%; border: 1px solid grey; background: white; padding-right: 0px;"><input style="max-width: 70px;" id="' + index + '" value="blanks"></div>&nbsp');
            return;
        }
    }

    $('#drag_words').append('<div class="blank" style="display: inline; width: 70px; height: 100%; border: 1px solid grey; background: white; padding-right: 0px;"><input style="max-width: 70px;" id="' + index + '" value="blanks"></div>&nbsp');

    set_flag_true();
}

function get_new_input_id() {
    var inputCollection = $('#drag_words input');
    var result = 0;

    for (let i = 0; i < inputCollection.length; i++) {
        if (result < parseInt(inputCollection.eq(i).attr('id'))) result = parseInt(inputCollection.eq(i).attr('id'));
    }

    result = result + 1;

    return result;
}
