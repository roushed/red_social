<?php

    session_start();
    if($_SESSION['autentificar'] != true){
        header('Location:./inicio_sesion.php');
        exit();
    }

 
?>