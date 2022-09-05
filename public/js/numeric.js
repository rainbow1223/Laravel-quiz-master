function get_select_item_id() {
    const length = $('.select_item').length;

    let id = 1;

    if (length > 0) {
        id = 0;
        for (let i = 0; i < length; i++) {
            console.log(parseInt($('.select_item select').eq(i).attr('id')));
            if (parseInt($('.select_item select').eq(i).attr('id')) >= id) {
                id = parseInt($('.select_item select').eq(i).attr('id')) + 1;
            }
        }
    }
    console.log("id", id);
    return id;
}

$('#add_select').change(function () {

    if (this.value !== '+') {
        const id = get_select_item_id();

        let element;

        if (this.value === '<<') {
            element = $('<tr><td><div class="select_item" style="display: flex;padding: 5px 0;"><label for="' + id + '">Value is: </label><select onchange="{select_change(this);}" name="' + id + '" id="' + id + '" style="max-width: 160px;"><option value="==">Equal to</option><option value="<<">Between</option><option value=">">Greater than</option><option value=">=">Greater than or equal to</option><option value="<">Less than</option><option value="<=">Less than or equal to</option><option value="!=">Not equal to</option></select><div style="display: flex;"><input type="number" value="0" style="max-width: 100px;"><span>and</span><input type="number" value="0" style="max-width: 100px;"></div></div></td><td><a onclick="{$(this).parent().parent().remove();set_flag_true();}"><i class="fas fa-trash-alt"></i></a></td></tr>');
        } else {
            element = $('<tr><td><div class="select_item" style="display: flex;padding: 5px 0;"><label for="' + id + '">Value is: </label><select onchange="{select_change(this);}" name="' + id + '" id="' + id + '" style="max-width: 160px;"><option value="==">Equal to</option><option value="<<">Between</option><option value=">">Greater than</option><option value=">=">Greater than or equal to</option><option value="<">Less than</option><option value="<=">Less than or equal to</option><option value="!=">Not equal to</option></select><div style="display: flex;"><input type="number" value="0" style="max-width: 100px;"></div></div></td><td><a onclick="{$(this).parent().parent().remove();set_flag_true();}"><i class="fas fa-trash-alt"></i></a></td></tr>');
        }
        $('tbody#numeric_list').append(element);
        $('select#' + id).val(this.value);
    }

    $(this).val('+');

    set_flag_true();
});

function select_change(select) {
    console.log(select.value);
    if (select.value === '<<') {
        $(select).next().html('<input type="number" value="0" style="max-width: 100px;"><span>and</span><input type="number" value="0" style="max-width: 100px;">');
    } else {
        $(select).next().html('<input type="number" value="0" style="max-width: 100px;">');
    }

    set_flag_true();
}
