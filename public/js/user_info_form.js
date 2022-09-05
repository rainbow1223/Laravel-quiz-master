$('#user_info_add_field a').click(function () {
    console.log('user_info_add_field');

    $('#user_info_table_body tr:last-child').after('<tr><th><input type="text" class="field_name" value="New field"></th><th><select class="condition"><option value="mandatory" selected="">Mandatory</option><option value="optional">Optional</option><option value="none">Don\'t ask</option></select></th><th><select class="field_type"><option value="text" selected="">Text</option><option value="choice">Choice</option><option value="email">Email</option></select></th><th><input type="text" class="value" value=""></th><th><input type="text" class="variable" value="NEW_FIELD"></th><th><a onclick="{$(this).parent().parent().remove();set_flag_true();}"><i style="font-size: 18px;" class="fas fa-trash-alt"></i></a></th></tr>');
});

function toggle_user_info_dropdown(element) {
    console.log('toggle_user_info_dropdown');

    $(element).next().toggle();
}

function add_word_user_info(element) {
    console.log('add_word_user_info');

    element.parent().before('<li><label data-editable="">Type content...</label><a onclick="{$(this).parent().remove();set_flag_true();}"><i class="fas fa-trash-alt"></i></a></li>');
}

$('.field_type').on('change', function () {
    if ($(this).val() == 'choice') {
        $(this).parent().next().html('<div class="user_info_dropdown_body"><div class="user_info_dropdown_content"></div><div class="user_info_dropdown_arrow" onclick="toggle_user_info_dropdown(this)"><i class="fas fa-chevron-down"></i></div><div class="user_info_dropdown_menu" style="display: none;"><ul><li><i onclick="add_word_user_info($(this));">Add a new word</i></li></ul></div></div>');
    } else {
        $(this).parent().next().html('<input type="text" class="value" value="">');
    }
});
