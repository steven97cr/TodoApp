$('#registerSubmit').click(()=>{
    $.ajax({
        url: '/../../routes/userRoutes.php',
        method: 'POST',
        dataType: 'text',
        data: {
            action: 'addUser',
            fullName: $("#name").val(),
            userName: $("#nickname").val(),
            userMail: $("#email").val(),
            userPass: $("#pass").val()
        },
        success: function(res){
            console.log(res);
        }
    });
});