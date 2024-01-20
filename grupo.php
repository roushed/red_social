<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
    <?php
        include "./f_modular.php";
        include "./seguridad.php";

        if(isset($_GET['nick'])){

            $consulta="DELETE FROM usuarios_grupo WHERE nick_contacto=? AND nombreG=?";
            //Elimina
            inserta_Datos($consulta, array($_GET['nick'], $_SESSION['grupo']));

            header("Location:./grupo.php?grupo=".$_SESSION['grupo']);
            

        }

        if(isset($_GET['idpost'])){

            elimina_Datos(array($_GET['idpost']), "DELETE FROM post WHERE idpost=?");
            header("Location:./grupo.php?grupo=".$_SESSION['grupo']);
        }

        if(isset($_GET['quitar'])){

            $consulta="UPDATE usuarios_grupo SET moderador=0 WHERE nick_contacto=? AND nombreG=?";
            inserta_Datos($consulta, array($_GET['quitar'],  $_SESSION['grupo']));
            header('Location:./grupo.php?grupo='.$_SESSION['grupo']);


        }

        if(isset($_GET['ocultarid'])){
            $consulta="UPDATE post_grupos SET estado=3 WHERE idpost=?";
            inserta_Datos($consulta, array($_GET['ocultarid']));
            header('Location:./grupo.php?grupo='.$_SESSION['grupo']);

        }

        if(isset($_GET['grupops'])){

            $consulta="INSERT INTO usuarios_grupo VALUES(?,?, 0, 0, 0)";
            inserta_Datos($consulta, array($_SESSION['nombre'], $_SESSION['grupo']));
            echo "Has realizado la solicitud al grupo";
            header('Location:./grupo.php?grupo='.$_SESSION['grupo']);

        }

        if(isset($_GET['grupos'])){

            $consulta="DELETE FROM usuarios_grupo WHERE nick_contacto=? AND nombreG=?";
            //Elimina
            inserta_Datos($consulta, array($_SESSION['nombre'], $_SESSION['grupo']));
            header('Location:./grupo.php?grupo='.$_SESSION['grupo']);
            
 
        }

        if(isset($_GET['idlike'])){
            $consulta="INSERT INTO likes VALUES (?, ?)";
            inserta_Datos($consulta, array($_GET['idlike'], $_SESSION['nombre']));
            echo "Has seleccionado Like";
            header('Location:./grupo.php?grupo='.$_SESSION['grupo'].'#ancla-'.$_GET['idlike']);
        }

        if(isset($_GET['idislike'])){
            $consulta="DELETE FROM likes WHERE id_post=? AND nick=?";
            inserta_Datos($consulta, array($_GET['idislike'], $_SESSION['nombre']));
            header('Location:./grupo.php?grupo='.$_SESSION['grupo'].'#ancla-'.$_GET['idislike']);
        }
        
            
    ?>
       
   
</head>
<body>
    <div class="container">

        <div class="titulo">
            RED SOCIAL SCARLATTI

        </div>
        <div class="secciones">
        <?php include "./panelcito.php" ?>

        </div>

        <div class="contenido">
            <div class="panel_grp">
                

            <?php
        
        if(isset($_GET['grupo'])){

            $_SESSION['grupo']=$_GET['grupo'];
            $consulta_a="SELECT * FROM usuarios_grupo WHERE nick_contacto=? AND nombreG=? AND moderador=1 AND admitido=1 AND admin=1";
            $reg_admin=contar_Registros($consulta_a, array($_SESSION['nombre'],  $_SESSION['grupo']));
            if($reg_admin != 0){
            echo "<div class='boton'><a href='./mensajes_denegados.php?grupo=". $_SESSION['grupo']."'>Mensajes Ocultos</a></div>";
            }
            echo "<h1>". $_SESSION['grupo']."</h1>";
           
            
            $consulta="SELECT * FROM usuarios_grupo WHERE nick_contacto=? AND nombreG=? AND admitido=1";
            $registros=contar_Registros($consulta, array($_SESSION['nombre'],  $_SESSION['grupo']));

            if($registros == 0){
             
                echo "<p><img src='./img/grupos.png'></p>";
                echo "<p>Usted no tiene permiso del administrador para acceder a este grupo, debería de realizar una solicitud.</p>";
                $consulta_s="SELECT * FROM usuarios_grupo WHERE nick_contacto=? AND nombreG=? and admitido=0";
                $solicitar=hay_Registro($consulta_s, array($_SESSION['nombre'], $_SESSION['grupo']));

                if(!$solicitar){

                    echo "<div class='boton_e'><a href='./grupo.php?grupops'>Solicitar</a></div>";

                }else{
                    echo "<div class='boton_e'><a href='./grupo.php?grupos'>Cancelar Solicitud</a></div>";

                }
              
            }else{

                try{     
                   
                    $con=Conectar();
                    $stmt=$con->prepare("SELECT * FROM post p INNER JOIN post_grupos pg ON p.idpost = pg.idpost INNER JOIN usuarios u ON pg.nick_envia=u.nick INNER JOIN perfiles per ON per.nick=u.nick   WHERE pg.nombreG=? AND pg.estado=2 AND p.idpostR IS NULL ORDER BY p.fecha DESC, p.idpost DESC");
                    $stmt->bindValue(1,  $_SESSION['grupo']);
                    //$stmt->bindValue(2, $id);
                    $stmt->execute();
                    $num_filas=$stmt->rowCount();
                    $datos="<div>";
                    if($num_filas != 0){
                    
                        while($fila=$stmt->fetch(PDO::FETCH_ASSOC)){
                            $datos.="<a name='ancla-".$fila['idpost']."'></a>";
                            $datos.="<p>";
                            //array_push($lista_mascotas['Pl'],$fila['rasgo']);
                            $datos.= "<div class='lista_posts'>";
                                $datos.= "<p><div><b>".$fila['subject']."</b></div></p>";
                                $datos.= "<div class='post_texto'><p>".$fila['texto']."</p></div>";
                                if($fila['imagen'] != null){
                                    $datos.= "<div class='img_post'><img src='./img/".$fila['imagen']."' width='65%' height='65%'></div>";
                                }
                                $datos.= "<div>".strftime("%d de %B, %G", strtotime($fila['fecha']))."</div>";
                                $datos.= "<div><img src='./img/".$fila['foto']."' width='8%' height='8%'><br><a href='./perfil.php?nick=".$fila['nick_envia']."'>".$fila['nick_envia']."</a></br></div>";
                            
                                $datos.="<div class='div_coment'><a href='./comentarios.php?idpost=".$fila['idpost']."&grupo=".$fila['nombreG']."'>Comentarios";
                                $consulta="SELECT * FROM post p INNER JOIN post_grupos pg ON p.idpost = pg.idpost WHERE p.idpostR=? AND pg.estado=2 ";
                                $num_reg=contar_Registros($consulta, array($fila['idpost']));
                                $datos.="($num_reg)</a></div>";
                                $num_likes=contar_Registros("SELECT * FROM likes WHERE id_post=?", array($fila['idpost']));
                                $datos.="<div class='like'><span class='numlikes' id='numlikes'>$num_likes</span>";
                                $haylikes=hay_Registro("SELECT * FROM likes WHERE id_post=? AND nick=?", array($fila['idpost'], $_SESSION['nombre']));
                                if(!$haylikes){

                                    $datos.="<a href='grupo.php?idlike=".$fila['idpost']."'><img src='./img/mano.png'></a>";
                                }else{

                                    $datos.="<a href='grupo.php?idislike=".$fila['idpost']."'><img src='./img/mano2.png'></a> ";
                                }
                                $personas_like=consultar_lista_1col("SELECT * FROM likes WHERE id_post=?", "nick", array($fila['idpost']));

                                if($personas_like != 0){
                                    if(count($personas_like) > 3){

                                        $datos.="A&nbsp <b>".implode(", ", array_slice($personas_like, 0, 3))."</b>&nbsp y más les ha gustado";
                                    }else{
                                        
                                        $datos.="A&nbsp <b>".implode(", ", $personas_like)."</b>&nbsp le ha gustado";
                                    }
                                    
                                }

                                
                                $datos.="</div>";
                                $num_ad=contar_Registros("SELECT * FROM usuarios_grupo WHERE nick_contacto=? AND nombreG=? AND moderador=? AND admitido=?", array($_SESSION['nombre'],  $_SESSION['grupo'],1 ,1));
                                
                                if($num_ad > 0){
                                    
                                    $datos.="<div class='botones_edit2'><div class='boton_e2'><form class='form1' action='edicion_post.php' method='post'><input type='hidden' name='id' value='".$fila['idpost']."'><input type='hidden' name='grupo' value='".$_SESSION['grupo']."'><a>Editar</a></form></div><div class='boton_e2'><a href='./grupo.php?idpost=".$fila['idpost']."'> Eliminar </a></div>";
                                    if($reg_admin != 0){
                                    $datos.="<div class='boton_e2'><a href='./grupo.php?ocultarid=".$fila['idpost']."'>Ocultar </a></div>";
                                    }
                                    $datos.="</div>";

                                }else{

                                if($_SESSION['nombre'] == $fila['nick_envia']){
                                    
                                    $datos.="<div class='botones_edit2'><div class='boton_e2'><form class='form1' action='edicion_post.php' method='post'><input type='hidden' name='id' value='".$fila['idpost']."'><input type='hidden' name='grupo' value='".$_SESSION['grupo']."'><a>Editar</a></form></div><div class='boton_e2'><a href='./grupo.php?idpost=".$fila['idpost']."'> Eliminar </a></div></div>";
                                }

                                }
                                
                            
                            $datos.= "</div>";
                            
                        
                        }
                    }else{
                        echo "<p>No se ha publicado ningun post</p>";
                        
                    }
                    $datos.="</div>";
                    
                    echo $datos;
                
                    
                }catch(PDOException $e){
                    echo $e->getMessage();
                
                }


                echo "<h2>Usuarios:</h2>";

                try{     
                
                    $con=Conectar();
                    $stmt=$con->prepare("SELECT * FROM usuarios_grupo WHERE nombreG=? AND moderador=0 AND admitido=1 ORDER BY nick_contacto ASC");
                    $stmt->bindValue(1, $_SESSION['grupo']);
                    //$stmt->bindValue(2, $id);
                    $stmt->execute();
                    $num_filas=$stmt->rowCount();
                    echo "<div class='contacts'>";
                    if($num_filas != 0){
                    while($fila=$stmt->fetch(PDO::FETCH_ASSOC)){
                        
                        //array_push($lista_mascotas['Pl'],$fila['rasgo']); 
                        
                        $consulta="SELECT * FROM usuarios_grupo WHERE nick_contacto=? AND nombreG=? AND moderador=1 AND admitido=1";
                        $registros=contar_Registros($consulta, array($_SESSION['nombre'],  $_SESSION['grupo']));
                        if($registros > 0){
                            $contenido=" | <a href='./grupo.php?nick=".$fila['nick_contacto']."'> Expulsar</a>";

                        }else{
                            $contenido="";

                        }
                        echo "<div class='miembg'><b><a href='./perfil.php?nick=".$fila['nick_contacto']."'>".$fila['nick_contacto']."</a></b>$contenido</div>";
                        
                        
                    }
                    }else{
                        echo "<p>No se ha unido ningún miembro</p>";

                    }
                    echo "</div>";
                    
                    
                
                    
                }catch(PDOException $e){
                    echo $e->getMessage();
                
                }


                
                $consulta2="SELECT * FROM usuarios_grupo WHERE nombreG=? AND moderador=1 AND admitido=1 AND admin=0 ORDER BY nick_contacto ASC";
                $lista=consultar_lista($consulta2, array("nick_contacto"), array($_SESSION['grupo']));
                echo "<div>";
                echo "<p>";
           

                echo "<h2>Moderador/es:</h2>";
                
                echo "<div class='contacts'>";
                if($lista == 0){
                    echo "No se ha agregado a ninguno";
                    if($reg_admin != 0){
                        
                        echo "<div class='boton_a'><a href='./agregar_admin.php?grupo=".$_SESSION['grupo']."'><h3>Agregar Moderador</h3></a></div>";
                    }

                }else if(count($lista)>1){
                    
                    if($reg_admin != 0){
                    
                        
                        foreach($lista as $clave => $valor){
                            foreach($valor as $clave2 => $valor2){
                            
                                    echo "<div class='miembg'><a href='./perfil.php?nick=$valor2'><b>$valor2</b></a> | <a href='./grupo.php?quitar=$valor2'>Quitar</a></div>";
                            
                            }
        
                        }

                        echo "<div class='boton_a'><a href='./agregar_admin.php?grupo=".$_SESSION['grupo']."'><h3>Agregar Moderador</h3></a></div>";
                    }else{
                        
                        foreach($lista as $clave => $valor){
                            foreach($valor as $clave2 => $valor2){
                        
                                echo "<div><a href=''>$valor2</a></div>";
                                    
                            }
                        }
                    }
        
                    
                    echo "</p>";

                }else{
                
                    
                    if($reg_admin != 0){

                        echo "<div class='miembg'><a href='./perfil.php?nick=".$lista[0]."'><b>".$lista[0]."</b></a> | <a href='./grupo.php?quitar=".$lista[0]."'>Quitar</a></div>";
                        echo "<div class='boton_a'><a href='./agregar_admin.php?grupo=".$_SESSION['grupo']."'><h3>Agregar Moderador</h3></a></div>";
                    }else{

                        echo "<div class='miembg'><a href='./perfil.php?nick=".$lista[0]."'><b>".$lista[0]."</b></a></div>";  
                    }
                    echo "</div>";
                    echo "/<p>";
                }
                echo "</div>";
                $consulta3="SELECT * FROM usuarios_grupo WHERE nombreG=? AND moderador=1 AND admitido=1 AND admin=1 ORDER BY nick_contacto ASC";
                $lista=consultar_lista($consulta3, array("nick_contacto"), array($_GET['grupo']));
                echo "<div><h2>Administrador</h2></div>";
                echo "<div class='contacts'>";
                echo "<div><p><a href='./perfil.php?nick=".$lista[0]."'>".$lista[0]."</a></p></div>";
                echo "</div>";
                echo "</div>";
            }
           
      
        }

          
        ?>

            
        
        </div>
        </div>

        <div class="pie">

            @copyright
        </div>


    </div>
    
        <script src="./java/script2.js"></script>
</body>
</html>