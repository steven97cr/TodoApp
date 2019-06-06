<?php
    require_once(__DIR__.'/ui/components.php');
    require_once(__DIR__.'/ln/lnAuth.php');
    $lnAuth = new lnAuth();
    $lnAuth -> getAccess($page = "login");
    $components = new Components(array('page'=>'login'));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CRUD</title>
    <link rel="stylesheet" 
        href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" 
        integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" 
        crossorigin="anonymous"
    >
    <link rel="stylesheet" href="assets/css/Main.css">
    <link rel="stylesheet" href="assets/css/Navbar.css">
    <link rel="stylesheet" href="assets/css/LoginForms.css">
    <link rel="stylesheet" href="assets/css/mainBackground.css">
</head>
<body>
    <div class="mainContainer">
        <?= $components -> navbar()?>
        <div class="registerForm registerLoginForm">
            <h4>Registrarse:</h4>
            <p>o <a href="">ingresar</a></p>
            <div class="line"></div>
            <form action="" method="POST">
                <input type="hidden" name="action" value="addUser">
                <div class="inputContainer">
                    <label for="name">Nombre: </label>
                    <input id="name" name="fullName" type="text">
                </div>
                <div class="inputContainer">
                    <label for="nickname">Apodo:</label>
                    <input id="nickname" name="userName" type="text">
                </div>
                <div class="inputContainer">
                    <label for="email">Email:</label>
                    <input id="email" name="userMail" type="text">
                </div>
                <div class="inputContainer">
                    <label for="pass">Contrasena:</label>
                    <input id="pass" name="userPass" type="password">
                </div>
                <div class="inputContainer">
                    <label for="confirmPass">Confirmar contrasena:</label>
                    <input id="confirmPass" type="password">
                </div>
                <div class="inputContainer">
                    <button type="button" id="registerSubmit">Continuar</button>
                </div>       
            </form>
        </div>
        <div class="loginForm registerLoginForm">
            <h4>Ingresar:</h4>
            <p>o <a href="">registrarse</a></p>
            <div class="line"></div>
            <form action="routes/authRoutes.php?action=login" method="POST">
                <div class="inputContainer">
                    <label for="user2">Email o apodo:</label>
                    <input id="user2" name="username" type="text">
                </div>
                <div class="inputContainer">
                    <label for="pass2">Contrasena:</label>
                    <input id="pass2" name="pass" type="password">
                </div>
                <div class="inputContainer">
                    <button type="submit">Ingresar</button>
                </div> 
            </form>
        </div>

        <div class="alert">
        
        </div>

    </div>

    <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous">
    </script>
    <script src="assets/js/ui.js"></script>
    <script>

        $('#registerSubmit').click(()=>{
            $.ajax({
                url: 'routes/userRoutes.php',
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
                    if(res.error){
                        $('.alert').html('<i class="fas fa-exclamation-triangle fa-2x"></i><p>Ocurrio un error!</p>');
                        $('.alert').fadeIn(300).delay(3000).fadeOut(300);
                    }else{
                        $('.alert').html('<i style="color: rgb(149,189,121)" class="fas fa-check fa-2x"></i><p>Operacion Exitosa!</p>');
                        $('.alert').fadeIn(300).delay(3000).fadeOut(300);
                    }
                }
            });
        });

    </script>
</body>
</html>