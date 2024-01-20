<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    ?>
</head>
<body>
    <?php
        
        if(isset($_GET['grupo'])){

            $_SESSION['grupo']=$_GET['grupo'];
            $consulta_a="SELECT * FROM usuarios_grupo WHERE nick_contacto=? AND nombreG=? AND moderador=1 AND admitido=1 AND admin=1";
            $reg_admin=contar_Registros($consulta_a, array($_SESSION['nombre'],  $_SESSION['grupo']));
            if($reg_admin != 0){
            echo "<p><a href='./mensajes_denegados.php?grupo=". $_SESSION['grupo']."'>Mensajes Ocultos</a></p>";
            }
            echo "<h1>". $_SESSION['grupo']."</h1>";
           
            
            $consulta="SELECT * FROM usuarios_grupo WHERE nick_contacto=? AND nombreG=? AND admitido=1";
            $registros=contar_Registros($consulta, array($_SESSION['nombre'],  $_SESSION['grupo']));

            if($registros == 0){

                echo "Usted no tiene permiso del administrador para acceder a este grupo";
            }else{

                try{     
                   
                    $con=Conectar();
                    $stmt=$con->prepare("SELECT * FROM post p INNER JOIN post_grupos pg ON p.idpost = pg.idpost INNER JOIN usuarios u ON pg.nick_envia=u.nick INNER JOIN perfiles per ON per.nick=u.nick   WHERE pg.nombreG=? AND pg.estado=2 AND p.idpostR IS NULL ORDER BY p.fecha DESC, p.idpost DESC");
                    $stmt->bindValue(1,  $_SESSION['grupo']);
                    //$stmt->bindValue(2, $id);
                    $stmt->execute();
                    //$num_filas=$stmt->rowCount();
                    $datos="<div>";
                    while($fila=$stmt->fetch(PDO::FETCH_ASSOC)){
                        $datos.="<p>";
                        //array_push($lista_mascotas['Pl'],$fila['rasgo']);
                        $datos.= "<div>";
                            $datos.= "<p><div><b>".$fila['subject']."</b></div></p>";
                            $datos.= "<div><p>".$fila['texto']."</p></div>";
                            if($fila['imagen'] != null){
                                $datos.= "<div><img src='./img/".$fila['imagen']."'></div>";
                            }
                            $datos.= "<div>".$fila['fecha']."</div>";
                            $datos.= "<div><img src='./img/".$fila['foto']."' width='2%' height='2%'><a href='./perfil.php?nick=".$fila['nick_envia']."'>".$fila['nick_envia']."</a></div>";
                           
                            $datos.="<div><a href='./comentarios.php?idpost=".$fila['idpost']."&grupo=".$fila['nombreG']."'>Comentarios";
                            $consulta="SELECT * FROM post p INNER JOIN post_grupos pg ON p.idpost = pg.idpost WHERE p.idpostR=? AND pg.estado=2 ";
                            $num_reg=contar_Registros($consulta, array($fila['idpost']));
                            $datos.="($num_reg)</a></div>";
                            $num_ad=contar_Registros("SELECT * FROM usuarios_grupo WHERE nick_contacto=? AND nombreG=? AND moderador=? and admitido=?", array($_SESSION['nombre'],  $_SESSION['grupo'],1 ,1));
                            
                            if($num_ad > 0){

                                $datos.="<div><p>  <a href='./edicion_post.php?id=".$fila['idpost']."&grupo=". $_SESSION['grupo']."'>Editar </a> |<a href='./grupo.php?idpost=".$fila['idpost']."'> Eliminar </a>";
                                if($reg_admin != 0){
                                $datos.="| <a href='./grupo.php?ocultarid=".$fila['idpost']."'>Ocultar </a>";
                                }
                                $datos.="</p></div>";

                            }else{

                            if($_SESSION['nombre'] == $fila['nick_envia']){
                                
                                $datos.="<div><p> <a href='./edicion_post.php?id=".$fila['idpost']."&grupo=".$_SESSION['grupo']."'>Editar</a> |<a href='./grupo.php?idpost=".$fila['idpost']."'> Eliminar </a></p></div>";
                            }


                            }
                            
                            
                        $datos.= "</div>";
                        $datos.="</p>";
                        
                    }
                    $datos.="</div>";
                    
                    echo $datos;
                
                    
                }catch(PDOException $e){
                    echo $e->getMessage();
                
                }
            }
            echo "<h2>Usuarios:</h2>";

            try{     
              
                $con=Conectar();
                $stmt=$con->prepare("SELECT * FROM usuarios_grupo WHERE nombreG=? AND moderador=0 AND admitido=1 ORDER BY nick_contacto ASC");
                $stmt->bindValue(1, $_SESSION['grupo']);
                //$stmt->bindValue(2, $id);
                $stmt->execute();
                //$num_filas=$stmt->rowCount();
                echo "<div>";
                while($fila=$stmt->fetch(PDO::FETCH_ASSOC)){
                    
                    //array_push($lista_mascotas['Pl'],$fila['rasgo']); 
                    
                    $consulta="SELECT * FROM usuarios_grupo WHERE nick_contacto=? AND nombreG=? AND moderador=1 AND admitido=1";
                    $registros=contar_Registros($consulta, array($_SESSION['nombre'],  $_SESSION['grupo']));
                    if($registros > 0){
                        $contenido=" | <a href='./grupo.php?nick=".$fila['nick_contacto']."'> Expulsar</a>";

                    }else{
                        $contenido="";

                    }
                    echo "<div><a href='./perfil.php?nick=".$fila['nick_contacto']."'>".$fila['nick_contacto']."</a>$contenido</div>";
                    
                    
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
                
                
                if($lista == 0){
                    echo "No se ha agregado a ninguno";
                    if($reg_admin != 0){
                        
                        echo "<p><a href='./agregar_admin.php?grupo=".$_SESSION['grupo']."'><h3>Agregar Moderador</h3></a></p>";
                    }

                }else if(count($lista)>1){
                    
                    if($reg_admin != 0){
                    
                        
                        foreach($lista as $clave => $valor){
                            foreach($valor as $clave2 => $valor2){
                            
                                    echo "<div><a href=''>$valor2</a> | <a href='./grupo.php?quitar=$valor2'>Quitar</a></div>";
                            
                            }
        
                        }

                        echo "<a href='./agregar_admin.php?grupo=".$_SESSION['grupo']."'><h3>Agregar Moderador</h3></a>";
                    }else{
                        
                        foreach($lista as $clave => $valor){
                            foreach($valor as $clave2 => $valor2){
                        
                                echo "<div><a href=''>$valor2</a></div>";
                                    
                            }
                        }
                    }
        
                    echo "</div>";
                    echo "</p>";

                }else{
                
                    
                    if($reg_admin != 0){

                        echo "<div><a href=''>".$lista[0]."</a> | <a href='./grupo.php?quitar=".$lista[0]."'>Quitar</a></div>";
                        echo "<a href='./agregar_admin.php?grupo=".$_SESSION['grupo']."'><h3>Agregar Moderador</h3></a>";
                    }else{

                        echo "<div><a href=''>".$lista[0]."</a></div>";  
                    }
                    echo "</div>";
                    echo "/<p>";
                }
            }
            $consulta3="SELECT * FROM usuarios_grupo WHERE nombreG=? AND moderador=1 AND admitido=1 AND admin=1 ORDER BY nick_contacto ASC";
            $lista=consultar_lista($consulta3, array("nick_contacto"), array($_GET['grupo']));
            echo "<div>";
            echo "<div><h2>Administrador</h2></div>";
            echo "<div><p><a href=''>".$lista[0]."</a></p></div>";
            echo "</div>";



            
        
        
          
        ?>
    
</body>
</html>