
$(document).on('click','#upload', function(event) {
    event.preventDefault();
    let file_data = $('#xmlfile').prop('files')[0];
    let form_data = new FormData();
    form_data.append('file', file_data);

    let url = BX.message('AJAX_TEMPLATE_PATH');
    $.ajax({
        url: url,
        type: 'POST',
        data: form_data,
        processData: false,
        contentType: false,
        dataType: "text",
        success: function(resp){
            console.log(resp);
            $(this).attr('disabled', false);
        }
    })
});