$(document).ready(()=>{
    $('.mainContainer').fadeIn(200);
})

$('.loginForm p a').click((e)=>{
    e.preventDefault();
    $('.loginForm').fadeOut(300);
    $('.registerForm').fadeIn(300);
})

$('.registerForm p a').click((e)=>{
    e.preventDefault();
    $('.registerForm').fadeOut(300);
    $('.loginForm').fadeIn(300);
})

$('.navBarUserPhotoButton').click(()=>{
    $('.navBarUserMenu').toggle(300);
})
$('#viewProfileButton').click((e)=>{
    e.preventDefault();
    $('.modalProfile').show();
    $('.modalBackground').fadeIn(300);
})

$('#addTaskButton').click(()=>{
    $('.modalBodyAddEdit').show();
    $('.modalBackground').fadeIn(300);
})

$('#closeTaskModal').click(()=>{
    $('.modalBackground').fadeOut(300);
    $('.modalBodyAddEdit').hide();
})

$('#closeProfileModal').click(()=>{
    $('.modalBackground').fadeOut(300);
    $('.modalProfile').hide();
})

