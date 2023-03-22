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