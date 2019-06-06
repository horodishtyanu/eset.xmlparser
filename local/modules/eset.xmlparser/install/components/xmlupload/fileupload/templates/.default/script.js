
$(document).on('click','#upload', function(event) {
    event.preventDefault();
    let file_data = $('#xmlfile').prop('files')[0];
    let form_data = new FormData();
    form_data.append('file', file_data);
    console.log(form_data);
    BX.ajax.runComponentAction('xmlupload:fileupload',
        'uploadFiles', {
            mode: 'class',
            data: {post: {form_data}}
        })
        .then(function(response) {
            console.log(response);
        });
});