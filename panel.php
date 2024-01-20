<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
        include "./seguridad.php";
        include "./f_modular.php";

        if (isset($_GET['cerrar'])){
        
            $_COOKIE=array();
            setcookie(session_name(), time()-3600);
            session_destroy();
            header('Location:./inicio_sesion.php');
        }
        

        $datos="<div class='seccion'>Bienvenido!!".$_SESSION['nombre']."</div>";
        $datos.="<div class='seccion'><a href='./mi_perfil.php'>Mi Perfil </a></div>";
        $datos.="<div class='seccion'><a href='./enviar_post.php'>Crear un Post </a></div>";
        $datos.="<div class='seccion'><a href='./lista_grupos.php'>&nbspLista de Grupos </a></div>";
        $datos.="<div class='seccion'><a href='./mis_grupos.php'>&nbspMis Grupos</a></div>";
        $datos.="<div class='seccion'><a href='./miembros.php'>&nbspMiembros</a></div>";
        $datos.="<div class='seccion'><a href='./mensajeria.php'>&nbspMis Mensajes</a></div>";
        //$datos.="<div class='seccion'><a href='./mis_posts.php'>&nbspMis Posts</a></div>";
        $datos.="<div class='seccion'><a href='./mis_contactos.php'>&nbspContactos </a>";
        $consulta2="SELECT * FROM contactos WHERE nick_contacto=? and admitir=1";
            $num_reg=contar_Registros($consulta2, array($_SESSION['nombre']));
            if($num_reg > 0){

                
                $datos.= " | <a href='./pendiente_solicitud_c.php'> (+$num_reg Solicitud)</a>";
            }

        $datos.= "</div>";
        $datos.="<div class='seccion'><a href='./panel.php?cerrar'>&nbspCerrar Sesión </a></div>";

        echo $datos;
        
    ?>
</head>
<body>
    



</body>
</html>