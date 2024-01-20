<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <?php
        
        
        if (isset($_GET['cerrar'])){

            include "./f_modular.php";
            $consultao="UPDATE usuarios SET online=0 WHERE nick=?";
            inserta_Datos($consultao, array($_GET['cerrar']));
            $_COOKIE=array();
            setcookie(session_name(), time()-3600);
            session_destroy();
            header('Location:./inicio_sesion.php');

        }
        
        
   ?>    
      

</head>
<body>
    
    <?php
   
        $consulta="SELECT * FROM contactos WHERE nick_contacto=? and admitir=1";
        $num_reg=contar_Registros($consulta, array($_SESSION['nombre']));
        $consulta2="SELECT * FROM `post_usuarios` WHERE nick_recibe=? AND leido=0";
        $num_msg=contar_Registros($consulta2, array($_SESSION['nombre']));
        $consulta4="SELECT * FROM usuarios_grupo WHERE admitido=0";
        $num_sg=contar_Registros($consulta4, array());

        $datos="<nav id='menu'>";

                    $datos.="<ul>";
                        $datos.="<li><div class='seccion'><a href='./panel_principal.php'>Panel Principal</a></div></li>";
                        $datos.="<li><div class='seccion'><a href='./novedades.php'>Novedades";
                        //$consultamg="SELECT * FROM grupos g INNER JOIN usuarios_grupo ug ON g.nombreG=ug.nombreG WHERE nick_contacto=? AND moderador=1 ORDER BY g.nombreG DESC";
                        //$mis_grupos=consultar_lista3($consultamg, array("nombreG"), array($_SESSION['nombre']));
                        //$total_nov=0;
                        //if($mis_grupos > 0){
                            //foreach($mis_grupos as $grupo){

                                //$consultan="SELECT * FROM post p INNER JOIN post_grupos pg ON p.idpost=pg.idpost WHERE pg.estado=2 AND pg.leido=0 AND nombreG=? AND p.idpostR IS NULL";
                                //$num_n=contar_Registros($consultan, array($grupo));
                                //$total_nov+=$num_n;
                            //}
                        //}
                        $consultan="SELECT * FROM usuarios u INNER JOIN usuarios_grupo ug ON u.nick=ug.nick_contacto WHERE u.nick=?";
                        $total_nov=consultar_lista_1col($consultan, 'no_leidos', array($_SESSION['nombre']));
                        
                        if($total_nov != 0){
                            if($total_nov[0] >0){
                                $datos.="<span class='circle'>".$total_nov[0]."</span>";
                            }
                        }
                        $datos.="</a></div></li>";
                        $datos.="<li><div class='seccion'><a href='./enviar_post.php'>Crear un Post </a></div></li>";
                        $datos.="<li><div class='seccion'><a href='./lista_grupos.php'>&nbspLista de Grupos </a></div></li>";
                        $datos.="<li><div class='seccion'><a href='./miembros.php'>&nbspMiembros</a></div></li>";
                        $datos.="<li><div class='seccion'><a href='./mensajeria.php'>&nbspMensajes";
                        if($num_msg != 0){
                            $datos.="<span class='circle'>$num_msg</span>";

                        }
                        $datos.="</a></div></li>";
                        $consulta_p="SELECT * FROM perfiles WHERE nick=?";
                        $l_perfil=consultar_lista2($consulta_p, array('nick', 'foto'), array($_SESSION['nombre']));
                        $datos.="<li><div class='imgperfil'><div><a href=''><img src='./img/".$l_perfil[0][1]."'>";
                        $consultamg="SELECT * FROM grupos g INNER JOIN usuarios_grupo ug ON g.nombreG=ug.nombreG WHERE nick_contacto=? AND moderador=1 ORDER BY g.nombreG DESC";
                        //$mis_grupos=consultar_lista3($consultamg, array("nombreG"), array($_SESSION['nombre']));
                        $mis_grupos=consultar_lista_1col($consultamg, "nombreG", array($_SESSION['nombre']));
                        $total_g=0;
                        $total_m=0;
                        if($mis_grupos > 0){
                            foreach($mis_grupos as $grupo){

                                $consultag="SELECT * FROM usuarios_grupo WHERE nombreG=? and admitido=0";
                                $num_g=contar_Registros($consultag, array($grupo));
                                $total_g+=$num_g;

                                $consultam="SELECT * FROM post p INNER JOIN post_grupos pg ON p.idpost=pg.idpost WHERE pg.nombreG=? AND pg.estado=1";
                                $num_m=contar_Registros($consultam, array($grupo));
                                $total_m+=$num_m;
                            }
                         }
                        //$consultac="SELECT * FROM contactos WHERE nick_contacto=? and admitir=1";
                        //$num_c=contar_Registros($consultac, array($_SESSION['nombre']));
                        $total_reg=$total_g+$total_m+$num_reg;
                        $total_mg=$total_g+$total_m;
                        $datos.="</a></div><div>".$l_perfil[0][0];
                        if($total_reg != 0){
                            $datos.=" <span class='circlep'>".$total_reg."</span>";
                        }
                        $datos.="</div></div>";
                        $datos.="<ul>";
                        $datos.="<li><div class='seccion'><a href='./mi_perfil.php'>Mi Perfil </a></div>";
                        $datos.="<li><div class='seccion'><a href='./mis_grupos.php'>&nbspMis Grupos";
                        if($total_mg != 0){
                            $datos.="<p>(+$total_mg)</p>";
                        }
                        $datos.="</a></div></li>";
                        $datos.="<li><div class='seccion'><a href='./mis_contactos.php'>&nbspContactos";
                        if($num_reg != 0){
                        $datos.="<p>(+$num_reg)</p>";
                        }
                        $datos.="</a></div></li>";
                        //$datos.="<div class='seccion'><a href='./mis_posts.php'>&nbspMis Posts</a></div>";
                        //$consulta2="SELECT * FROM contactos WHERE nick_contacto=? and admitir=1";
                        //$num_reg=contar_Registros($consulta2, array($_SESSION['nombre']));
                        //if($num_reg > 0){

                            //$datos.= " | <a href='./pendiente_solicitud_c.php'> (+$num_reg Solicitud)</a>";
                        //}
                        //$datos.= "</div></li>";
                        $datos.="<li><div class='seccion'><a href='./panelcito.php?cerrar=".$_SESSION['nombre']."'>&nbspLog Out </a></div></li>";
                        $datos.="</li>";
                        $datos.="</ul>";
                    $datos.="</ul>";
                $datos.="</nav>";
      
                echo $datos;
     
    ?>


</body>
</html>