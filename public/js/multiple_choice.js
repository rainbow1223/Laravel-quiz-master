function get_choice_item_id() {
    const length = $('#choice_list .choice_item').length;

    console.log(length);

    let id = 1;

    if (length > 0) {
        id = 0;

        for (let i = 0; i < length; i++) {
            const inputId = parseInt($('#choice_list .choice_item input').eq(i).attr('value'));
            if (inputId >= id) id = inputId + 1;
        }
    }

    return id;
}

$('#quiz_view #add_choice').click(function () {

    const id = get_choice_item_id();

    const element = $('<tr class="choice_item"><td><input type="radio" name="answer" value="' + id + '" style="padding-right: 10px;"></td><td><label class="choice_label" data-editable for="' + id + '">Type content ...</label></td><td></td><td><a onclick="{$(this).parent().parent().remove();set_flag_true();}"><i class="fas fa-trash-alt"></i></a></td></tr>');
    $('tbody#choice_list').append(element);

    set_flag_true();
});
