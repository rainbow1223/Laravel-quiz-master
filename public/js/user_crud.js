$('#user_delete').click(function () {

    if ($('input[type=checkbox]:checked').length == 0) {
        alert('Please choose users to delete');
        return;
    }

    var result = confirm("Are you sure to delete?");
    if (result) {
        let selected_Ids = [];


        for (let i = 0; i < $('input[type=checkbox]:checked').length; i++) {
            selected_Ids.push($('input[type=checkbox]:checked').eq(i).val());
        }

        const root_url = $('meta[name=url]').attr('content');
        const token = $('meta[name=csrf-token]').attr('content');

        $.ajax({
            url: root_url + '/delete_selected_users',
            type: 'POST',
            data: {
                _token: token,
                selected_Ids: selected_Ids,
            },
            success: function (data) {
                for (let i = 0; i < data.length; i++) {
                    $('#row_' + data[i]).remove();
                }
            }
        }).catch((XHttpResponse) => {
            console.log(XHttpResponse);
        });
    }

});

$('#user_suspend').click(function () {
    if ($('input[type=checkbox]:checked').length == 0) {
        alert('Please choose users to delete');
        return;
    }

    var result = confirm("Are you sure to suspend?");
    if (result) {
        let selected_Ids = [];


        for (let i = 0; i < $('input[type=checkbox]:checked').length; i++) {
            selected_Ids.push($('input[type=checkbox]:checked').eq(i).val());
        }

        const root_url = $('meta[name=url]').attr('content');
        const token = $('meta[name=csrf-token]').attr('content');

        $.ajax({
            url: root_url + '/suspend_selected_users',
            type: 'POST',
            data: {
                _token: token,
                selected_Ids: selected_Ids,
            },
            success: function (data) {
                for (let i = 0; i < data.length; i++) {
                    $('#row_' + data[i] + ' .active_col').html('Suspend');
                }
            }
        }).catch((XHttpResponse) => {
            console.log(XHttpResponse);
        });
    }
});
