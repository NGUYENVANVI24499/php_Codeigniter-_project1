$('#change-password').change(function(){
    let status = !$(this).is(':checked');
    showChangePass(status)
})

$('#btn-reset-edit-user').click(function(){
    showChangePass(true)

})

function showChangePass(status){
    $('#password').attr('readonly',status)
    $('#password-confirm').attr('readonly',status)
    
    $('#password').val('')
    $('#password-confirm').val('')
}

$('.btn-del-confirm').click(function(){
    let url = $(this).data('url')
    if(!confirm('du lieu se bi mat')){
        return
    }
    
    window.location.href = url
})


$("#changeType").click(function(){
    if($(this).text() === 'dung Ajax'){
        $('#changeType').text('khong dung Ajax')
        $('.noneAjax').hide()
        $('.useAjax').show()
    }
    else{
        $('#changeType').text('dung Ajax')
        $('.noneAjax').show()
        $('.useAjax').hide()
    }
    
})

$('#edit-user').click(function(){
    console.log('hello')
    $('#text-type-user').text('Edit User')
})



$(function() {
$('#add_user_form').submit(function(e){
    e.preventDefault();
    const data = new FormData(this)
    if(!this.checkValidity()){
        e.preventDefault();
        $(this).addClass('was-validated');
    }
    else{
        $("#btn-add-user").text("loading...");
        $.ajax({
            url: 'post/add',
            method: 'post',
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'json',
            success: function(response) {
                if (response.error) {
                $("#image").addClass('is-invalid');
                $("#image").next().text(response.message.image);
                } else {
                $("#add_post_modal").modal('hide');
                $("#add_post_form")[0].reset();
                $("#image").removeClass('is-invalid');
                $("#image").next().text('');
                $("#add_post_form").removeClass('was-validated');
                Swal.fire(
                    'Added',
                    response.message,
                    'success'
                );
                fetchAllPosts();
                }
                $("#add_post_btn").text("Add Post");
            }
            });
        
    }
})})
