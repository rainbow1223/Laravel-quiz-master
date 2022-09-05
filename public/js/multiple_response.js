function get_response_item_id() {
    const length = $('#response_list .response_item').length;

    console.log(length);

    let id = 1;

    if (length > 0) {
        id = 0;

        for (let i = 0; i < length; i++) {
            const inputId = parseInt($('#response_list .response_item input').eq(i).attr('value'));
            console.log(inputId);
            if (inputId >= id) id = inputId + 1;
            console.log(id);
        }
    }

    return id;
}

$('#add_response').click(function () {

    const id = get_response_item_id();

    const element = $('<tr class="response_item"><td><input type="checkbox" name="answer" value="' + id + '" style="padding-right: 10px;"></td><td><label class="response_label" data-editable for="' + id + '">Type content ...</label></td><td></td><td><a onclick="{$(this).parent().parent().remove();set_flag_true();}"><i class="fas fa-trash-alt"></i></a></td></tr>');
    $('tbody#response_list').append(element);

    set_flag_true();
});
