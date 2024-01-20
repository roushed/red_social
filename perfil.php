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

        if(isset($_GET['solicitar'])){

            $consulta="INSERT INTO contactos VALUES(?, ?, ?, ?)";
            inserta_Datos($consulta, array($_SESSION['nombre'], $_SESSION['nick'], 1 ,0));
          
        }

        if(isset($_GET['eliminar'])){

            $consulta="DELETE FROM contactos WHERE nick=? AND nick_contacto=?";
            inserta_Datos($consulta, array($_SESSION['nombre'], $_SESSION['nick']));
            $consulta2="DELETE FROM contactos WHERE nick=? AND nick_contacto=?";
            inserta_Datos($consulta, array($_SESSION['nick'], $_SESSION['nombre']));
            header('Location:./mis_contactos.php');
        }

        if(isset($_GET['cancelar'])){

            $consulta="DELETE FROM contactos WHERE nick=? AND nick_contacto=?";
            inserta_Datos($consulta, array($_SESSION['nombre'], $_SESSION['nick']));

        }

        if(isset($_GET['bloquear'])){

            $consulta="UPDATE contactos SET bloqueo=1, admitir=3  WHERE nick=? AND nick_contacto=?";
            inserta_Datos($consulta, array($_SESSION['nombre'], $_SESSION['nick']));
            $consulta2="UPDATE contactos SET bloqueo=1 WHERE nick=? AND nick_contacto=?";
            inserta_Datos($consulta2, array($_SESSION['nick'], $_SESSION['nombre']));
            header('location:./mis_contactos.php');

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
        
            <div class="perfil_u">
               
           <?php
                //echo "<div class='perfil'><a href='./editar_perfil.php'>Editar Perfil</a></div>";
                //echo "<div class='perfil'><h2>Mensajes:</h2></div>";
            
                //$datos="<div class='mensajes'>";

            




                
                if(isset($_GET['nick'])){
                    $_SESSION['nick']=$_GET['nick'];
                }
        
                if(isset($_SESSION['nick'])){
                    
        
                    $bloqueo=hay_Registro("SELECT * FROM contactos WHERE nick=? AND nick_contacto=? AND bloqueo=1", array($_SESSION['nombre'], $_SESSION['nick']));
        
                    if($bloqueo){
        
                        echo "<p>El perfil de este usuario se encuentra bloqueado</p>";
                        echo "</div>";
                    }else{
        
                        
                    
                        echo "<h2>Perfil:</h2>";
                        $consulta="SELECT * FROM perfiles WHERE nick=?";
                        imprime_perfil_bd($consulta, array($_SESSION['nick']), array("nick", "foto", "nombre", "apellidos", "fecha_nacimiento", "ciudad", "pais", "url", "descripcion"), array("title", "img","text", "text", "birth","text","text","text","text"));
                        $consultao="SELECT * FROM usuarios WHERE nick=? AND online=1";
                        $online=hay_Registro($consultao, array($_SESSION['nick']));

                        if($online){
                        echo "<div class='online_p'>Online</div>";
                        }
                        $num_filas=contar_Registros("SELECT * FROM contactos WHERE nick=? AND nick_contacto=?", array($_SESSION['nombre'], $_SESSION['nick']));
                        $num_admitidos=contar_Registros("SELECT * FROM contactos WHERE nick=? AND nick_contacto=? AND admitir=2", array($_SESSION['nombre'], $_SESSION['nick']));
                        $consultad="SELECT * FROM contactos WHERE nick_contacto=? AND nick=? AND admitir=1";
                        $admitido=hay_Registro($consultad, array($_SESSION['nombre'], $_SESSION['nick']));
                        if($num_filas > 0){
                            
        
                            if($num_admitidos > 0 ){
                                         
                                $consulta_v="INSERT INTO visitas VALUES (?, ?, ?, ?)";
                                $fecha=date("Y-m-d");
                                inserta_Datos($consulta_v, array(0, $_SESSION['nick'], $_SESSION['nombre'], $fecha));

                                echo "<div class='op_admin'>";
                                echo "<p><div class='boton_msg'><a href='./mensaje_priv.php?nick=".$_SESSION['nick']."#ancla-1'>Enviar Mensaje</a></div></p>";
                                echo "<p><div><a href='./ver_posts.php?nick=".$_SESSION['nick']."'>Ver Posts</a></div></p>";
                                echo "<p><div><a href='./ver_contactos.php?nick=".$_SESSION['nick']."'>Ver Amigos</a></div></p>";
                                echo"<div class='opciones_perfil'>";
                                echo "<p><div><a href='./perfil.php?eliminar=".$_SESSION['nick']."'>Eliminar Contacto</a></div></p>";
                                echo "<p><div><a href='./perfil.php?bloquear=".$_SESSION['nick']."'>Bloquear</a></div></p>";
                                echo "</div>";
                                echo "</div>";
                                echo "<h2>Grupos Pertenecientes:</h2>";
                                echo "</div>";
                      
                                $consulta2="SELECT * FROM grupos g INNER JOIN usuarios_grupo ug ON g.nombreG=ug.nombreG WHERE ug.nick_contacto=? AND ug.admitido=1 ORDER BY ug.nombreG DESC"; 
                        
                       
                                try{     
                    
                                    $con=Conectar();
                                    $stmt=$con->prepare($consulta2);
                                    $stmt->bindValue(1,  $_SESSION['nick']);
                                    
                                    //$stmt->bindValue(2, $id);
                                    $stmt->execute();
                                    //$num_filas=$stmt->rowCount();
                                    $datos="<div class='mensajes'>";
                                    while($fila=$stmt->fetch(PDO::FETCH_ASSOC)){
                                    
                                        //array_push($lista_mascotas['Pl'],$fila['rasgo']);
                                        $datos.= "<div class='msg_cuadro'>";
                                        
                                            $datos.= "<div><a href='./grupo.php?grupo=".$fila['nombreG']."'><b>".$fila['nombreG']."</b></a></div>";
                                            $datos.= "<div>".$fila['descripcion']."</div>";
                                        
                                        $datos.= "</div>";
                                    
                                        
                                    }
                                    $datos.="</div>";
                                    
                                    echo $datos;
                                
                                }catch(PDOException $e){
                                    echo $e->getMessage();
                                
                                }



                            }else{

                                if(!$admitido){
                                    echo "<p><div class='solic'><a href='./perfil.php?cancelar=".$_SESSION['nick']."'>Cancelar Solicitud</a></div></p>";
                                }
                                echo "</div>";
            
        
                            }
                        }else{
                            
                            if($_SESSION['nombre'] != $_SESSION['nick']){

                                    if(!$admitido){

                                        echo "<p><div class='solic'><a href='./perfil.php?solicitar'>Solicitar Amistad</a></div></p>";
                                    }
                            }
                            echo "</div>";
                        }
                       

                    }
                   
                }
        
                
          
            ?>
            
           
           
            
        </div>
        
       

        <div class="pie">

            @copyright
        </div>


    </div>

</body>
</html>