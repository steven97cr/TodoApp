<?php 
    require_once(__DIR__.'/ui/components.php');
    require_once(__DIR__.'/ln/lnAuth.php');
    require_once(__DIR__.'/ln/lnTasks.php');
    $lnAuth = new lnAuth();
    $lnAuth -> getAccess($page = "home");
    $lnTasks = new lnTasks();
    $components = new Components(array("page"=>"home"));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ToDoApp</title>
    <link rel="stylesheet" 
        href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" 
        integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" 
        crossorigin="anonymous"
    >
    <link rel="stylesheet" href="assets/css/Main.css">
    <link rel="stylesheet" href="assets/css/Navbar.css">
    <link rel="stylesheet" href="assets/css/Sidebar.css">
    <link rel="stylesheet" href="assets/css/TaskContainer.css">
    <link rel="stylesheet" href="assets/css/Modal.css">
</head>
<body>
    <div class="mainContainer">
        <?= $components -> navbar() ?>
        <?= $components -> sidebar() ?>
        <div class="taskContainer">
            <?php
                foreach($lnTasks -> getTasks($_SESSION['user']['idUser']) as $task){
                    ?>
                    <div class="taskCard">
                        <button id="deleteTaskBtn" value="<?=$task['idTask']?>"><i class="fas fa-trash-alt fa-lg"></i></button>
                        <div class="taskCardTitle"><h2><?=$task['taskTitle']?></h2></div>
                        <div class="taskCardBody"><p><?=$task['taskBody']?></p></div>
                        <div class="taskCardPriority">Prioridad: <span><?=$task['taskPriority']?></span></div>
                    </div>
                    <?php
                }
            ?>
        </div>
        <div class="modalBackground">
            <div class="modalBodyAddEdit">
                <button id="closeTaskModal" class="closeModalButton"><i class="fas fa-times fa-lg"></i></button>
                <div class="inputContainer">
                    <h2>Nueva Tarea:</h2>
                </div>
                <div class="lineModal"></div>
                <input type="hidden" id="userID" value="<?=$_SESSION['user']['idUser']?>">
                <div class="inputContainer">
                    <label for="titleInput">Titulo:</label>
                    <input id="titleInput" type="text">
                </div>
                <div class="inputContainer">
                    <label for="bodyInput">Comentario:</label>
                    <textarea name="" id="bodyInput" rows="6"></textarea>
                </div>
                <div class="inputContainer">
                    <label for="priorityInput">Prioridad:</label>
                    <select name="" id="priorityInput">
                        <option value="1">Alta</option>
                        <option value="2">Media</option>
                        <option value="3">Baja</option>
                    </select>
                </div>
                <div class="inputContainer">
                    <button type="button" id="submitTaskButton">Agregar</button>
                </div>
            </div>
            <div class="modalProfile">
                <button id="closeProfileModal" class="closeModalButton"><i class="fas fa-times fa-lg"></i></button>
                <form action="" id="submitProfile">
                    <div class="col1">
                        <div class="modalPhoto" name="userPhoto" style="background-image: url('assets/img/<?=$_SESSION['user']['userPhoto']?>')">
                        </div>
                        <input type="file" accept="image/*" id="userPhoto" method="post" enctype="multipart/form-data" name="userPhoto">
                    </div>
                    <div class="col2">     
                        <div class="inputContainer">
                            <label for="fullNameInput">Nombre:</label>
                            <input id="fullNameInput" name="fullName" type="text" value="<?=$_SESSION['user']['fullName']?>">
                        </div>
                        <div class="inputContainer">
                            <label for="userNameInput">Apodo:</label>
                            <input id="userNameInput" name="userName" type="text" value="<?=$_SESSION['user']['userName']?>">
                        </div>
                        <div class="inputContainer">
                            <label for="userMailInput">Email:</label>
                            <input id="userMailInput" name="userMail" type="text" value="<?=$_SESSION['user']['userMail']?>">
                        </div>
                        <div class="inputContainer">
                            <label for="userPassInput">Contrasena:</label>
                            <input id="userPassInput" name="userPass" type="text" value="<?=$_SESSION['user']['userPass']?>">
                        </div>
                        <div class="inputContainer">
                            <button type="submit" id="submitProfileButton">Aceptar</button>
                        </div> 
                    </div>
                </form>
            </div>
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
    $('document').ready(()=>{

        $('#submitTaskButton').click(()=>{
            $.ajax({
                url: 'routes/taskRoutes.php',
                method: 'POST',
                dataType: 'json',
                data: {
                    action: 'addTask',
                    userID: $("#userID").val(),
                    taskTitle: $("#titleInput").val(),
                    taskBody: $("#bodyInput").val(),
                    taskPriority: $("#priorityInput").val()
                },
                success: function(res){
                    console.log(res);
                    if(res.error){
                        $('.alert').html('<i style="color: rgb(255,222,87)" class="fas \
                         fa-exclamation-triangle fa-2x"></i><p>Ocurrio un error!</p>');
                        $('.alert').fadeIn(300).delay(3000).fadeOut(300);
                    }else{
                        $('.taskContainer').append(
                            `<div class="taskCard" >
                                <div class="taskCardTitle"><h2>${res.taskTitle}</h2></div>
                                <div class="taskCardBody"><p>${res.taskBody}</p></div>
                                <div class="taskCardPriority">Prioridad: <span>${res.taskPriority}</span></div>
                            </div>`
                        );
                        $('.alert').html('<i style="color: rgb(149,189,121)" class="fas \
                         fa-check fa-2x"></i><p>Operacion Exitosa!</p>');
                        $('.alert').fadeIn(300).delay(3000).fadeOut(300);
                    }
                }
            });
        });
        $('#submitProfile').on('submit',()=>{
            // e.preventDefault();
            var form = $('#submitProfile');
            var fd = new FormData(form[0]);
            fd.append('action','editUser');
            fd.append('userID',$('#userID').val());
            $.ajax({
                url: 'routes/userRoutes.php',
                method: 'POST',
                dataType: 'json',
                processData: false,  
                data: fd,
                contentType: false,
                success: function(res){
                    console.log(res);
                    if(res.rows == null){
                        $('.alert').html('<i style="color: rgb(255,222,87)" class="fas \
                         fa-exclamation-triangle fa-2x"></i><p>Ocurrio un error!</p>');
                        $('.alert').fadeIn(300).delay(3000).fadeOut(300);
                    }else{
                        $('.alert').html('<i style="color: rgb(149,189,121)" class="fas \
                         fa-check fa-2x"></i><p>Operacion Exitosa!</p>');
                        $('.alert').fadeIn(300).delay(3000).fadeOut(300);
                    }
                }
            });
        });
        $('document').on('click','#deleteTaskBtn',()=>{
            console.log('idddd')
            $.ajax({
                url: 'routes/taskRoutes.php',
                method: 'POST',
                dataType: 'json', 
                data: { 
                    taskID: $(this).val(),
                    action: 'deleteTask'
                },
                success: function(res){
                    console.log(res);
                    if(res.rows == null){
                        $('.alert').html('<i style="color: rgb(255,222,87)" class="fas \
                         fa-exclamation-triangle fa-2x"></i><p>Ocurrio un error!</p>');
                        $('.alert').fadeIn(300).delay(3000).fadeOut(300);
                    }else{
                        $('.alert').html('<i style="color: rgb(149,189,121)" class="fas \
                         fa-check fa-2x"></i><p>Operacion Exitosa!</p>');
                        $('.alert').fadeIn(300).delay(3000).fadeOut(300);
                    }
                }
            });
        });

    });
    </script>
</body>
</html>