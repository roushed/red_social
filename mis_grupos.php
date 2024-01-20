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

        if(isset($_GET['grupo'])){

            $consulta="INSERT INTO usuarios_grupo VALUES(?,?, 0)";
            inserta_Datos($consulta, array($_SESSION['nombre'], $_GET['grupo']));
            echo "Has realizado la solicitud al grupo";

        }

        if(isset($_GET['grupos'])){

            $consulta="DELETE FROM usuarios_grupo WHERE nick_contacto=? AND nombreG=?";
            //Elimina
            inserta_Datos($consulta, array($_SESSION['nombre'], $_GET['grupos']));
            

        }

        if(isset($_GET['grupoe'])){

            $consulta="DELETE FROM usuarios_grupo WHERE nombreG=?";
            //Elimina
            inserta_Datos($consulta, array($_GET['grupoe']));

            $consulta2="DELETE FROM grupos WHERE nombreG=?";
            inserta_Datos($consulta2, array($_GET['grupoe']));
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
            
            <div class="gps">
               
            <div class='boton'><h2><a href='./crear_grupo.php'>Crear Grupo</a></h2></div>
            <?php
                

                echo "<h4>Mis Grupos:</h4>";
            try{     
                
                $con=Conectar();
                $stmt=$con->prepare("SELECT * FROM grupos g INNER JOIN usuarios_grupo ug ON g.nombreG=ug.nombreG  WHERE  nick_contacto=? AND moderador=1 ORDER BY g.nombreG DESC");
                $stmt->bindValue(1, $_SESSION['nombre']);
                //$stmt->bindValue(2, $id);
                $stmt->execute();
                $num_filas=$stmt->rowCount();
                $datos="<div class='gcreados'>";
                if($num_filas != 0){
                while($fila=$stmt->fetch(PDO::FETCH_ASSOC)){
                    
                    //array_push($lista_mascotas['Pl'],$fila['rasgo']);
                    $datos.= "<div class='mgrupo'>";
                        $datos.= "<div><img src='./img/grupos.png'></div>";
                        $datos.= "<div class='titulo_grupo'><a href='./grupo.php?grupo=".$fila['nombreG']."'>".$fila['nombreG']."</a></div>";
                        $datos.= "<div>".$fila['descripcion']."</div>";
                        $consulta="SELECT * FROM post p INNER JOIN post_grupos pg ON p.idpost=pg.idpost WHERE pg.nombreG=? AND pg.estado=1";
                        $num_filas=contar_Registros($consulta, array($fila['nombreG']));
                        $datos.="<div><a href='./pendiente_solicitud_m.php?grupo=".$fila['nombreG']."'>Validar Mensajes($num_filas)</a></div>";
                        $stmtg=$con->prepare("SELECT * FROM usuarios_grupo WHERE nombreG=? AND admitido=0");
                        $stmtg->bindValue(1, $fila['nombreG']);
                        $stmtg->execute();
                        $num_filas=$stmtg->rowCount();
                        if($num_filas > 0){
                            $datos.="<div><a href='./pendiente_solicitud.php?grupo=".$fila['nombreG']."'>";
                            if($num_filas == 1){
                                $datos.="Tienes $num_filas Solicitud al grupo!";
                            }else{
                                $datos.="Tienes $num_filas Solicitudes al grupo!";

                            }
                            $datos.="</a></div>";
                        
                        }
                        $consulta_a="SELECT * FROM usuarios_grupo WHERE nick_contacto=? AND nombreG=? AND moderador=1 AND admitido=1 AND admin=1";
                        $reg_admin=contar_Registros($consulta_a, array($_SESSION['nombre'],  $fila['nombreG']));

                        if($reg_admin != 0){
                            
                            $datos.="<div class='boton_g'><p><a href='./mis_grupos.php?grupoe=".$fila['nombreG']."'>Eliminar Grupo</p></a></div>";

                        }else{

                            $datos.="<div class='boton_g'><p><a href='./mis_grupos.php?grupos=".$fila['nombreG']."'>Salir del Grupo</p></a></div>";
                        }
                        $datos.="</div>";
                    
                }

                }else{

                    echo "<p>No perteneces a ningún grupo </p>";
                }
                $datos.="</div>";
                
                    
                  
                
                echo $datos;

                
            }catch(PDOException $e){
                echo $e->getMessage();

            }
            ?>
            
            </div>
            <div class="gps">
            <?php
                echo "<h4>Grupos Unidos:</h4>";


                try{     
                    
                    $con=Conectar();
                    $stmt=$con->prepare("SELECT * FROM grupos g INNER JOIN usuarios_grupo ug ON g.nombreG=ug.nombreG WHERE ug.nick_contacto=? AND ug.moderador=0 AND ug.admitido=1 ORDER BY ug.nombreG DESC");
                    $stmt->bindValue(1, $_SESSION['nombre']);
                    $stmt->execute();
                    $num_filas=$stmt->rowCount();
                    $datos="<div class='gcreados'>";
                    if($num_filas != 0){
                        while($fila=$stmt->fetch(PDO::FETCH_ASSOC)){
                        
                            //array_push($lista_mascotas['Pl'],$fila['rasgo']);
                            $datos.= "<div class='mgrupo'>";
                                $datos.= "<div><img src='./img/grupos.png'></div>";
                                $datos.= "<div class='titulo_grupo'><a href='./grupo.php?grupo=".$fila['nombreG']."'>".$fila['nombreG']."</a></div>";
                                $datos.= "<div>".$fila['descripcion']."</div>";
                                //$datos.="<div><a href='./grupo.php?grupo=".$fila['nombreG']."'>Ver Grupo </a>";
                                $datos.="<div class='boton_g'><a href='./mis_grupos.php?grupos=".$fila['nombreG']."'> Salir del Grupo</a></div>";
                                        
                            $datos.= "</div>";
                        
                            
                        }
                    }else{
                        echo "<p>No te has unido a ningún grupo </p>";
                    }
                    $datos.="</div>";
                    
                    echo $datos;

                    
                }catch(PDOException $e){
                    echo $e->getMessage();

                }


            ?>
            </div>
        </div>

        <div class="pie">

            @copyright
        </div>


    </div>

</body>
</html>