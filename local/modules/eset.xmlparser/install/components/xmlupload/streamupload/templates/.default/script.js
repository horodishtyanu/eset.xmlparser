/**
 * Created by Alexander on 06.06.2019.
 */


$(document).on('submit','#streamform', function(event) {
    event.preventDefault();
    let xmlData = $(this).serializeArray();
    console.log(xmlData);
    let url = BX.message('AJAX_STREAM_TEMPLATE_PATH');
    $(this).attr('disabled', true);
    $.ajax({
        url: url,
        type: 'POST',
        data: xmlData,
        success: function(resp){
            console.log(resp);
            $('#streamform').attr('disabled', false);
        }
    })
});