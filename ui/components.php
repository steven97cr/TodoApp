<?php

class Components{

    var $pageData;
    var $userData;

    function __construct($pageData, $userData = null){
        $this -> pageData = $pageData;
        $this -> userData = $userData;
    }

    function navbar(){
        ?>
        <div class="NavBar">
            <?php
            if($this -> pageData['page'] != "login"){
                ?>
                <button class="navBarHamMenu"><i class="fas fa-bars fa-lg"></i></button>
                <div class="navBarSearchBar">
                    <div class="inputContainer">
                        <input type="text"/>
                    </div>
                    <div class="buttonContainer">
                        <button><i class="fas fa-search"></i></button>
                    </div>
                </div>
                <div class="navBarUserPhoto" 
                    style="background-image:url('assets/img/<?=$_SESSION['user']['userPhoto']?>')">
                    <button class="navBarUserPhotoButton"></button>
                </div>
                <div class="navBarUserMenu">
                    <div class="userInfoMenu">
                        <div class="navBarUserMenuPhoto" 
                            style="background-image:url('assets/img/<?=$_SESSION['user']['userPhoto']?>')">
                        </div>
                        <h4><?=$_SESSION['user']['userName']?></h4>
                        <p>Tareas: 00</p>
                    </div>
                    <div class="line"></div>
                    <ul>
                        <li><a id="viewProfileButton" href="">Mi Perfil</a></li>
                        <li><a href="">Configuracion</a></li>
                        <li><a href="routes/authRoutes.php?action=logout">Salir</a></li>
                    </ul>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
    }

    function sidebar(){
        ?>
        <div class="SideBar">
            <button id="addTaskButton"><i class="fas fa-plus"></i>Nueva tarea</button>
        </div> 
        <?php
    }
}

?>