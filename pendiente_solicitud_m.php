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

        if(isset($_GET['id'])){

            if($_GET['op'] == "a"){

                if(!empty($_GET['subj'])){
                    $consultal="UPDATE usuarios u INNER JOIN usuarios_grupo ug ON u.nick=ug.nick_contacto SET u.no_leidos=u.no_leidos+1 WHERE ug.nombreG=?";
                    inserta_Datos($consultal, array($_GET['grupo']));
                }   
                $consulta="UPDATE post_grupos SET estado=2 WHERE idpost=?";
            }else if($_GET['op'] == "c"){
                $consulta="UPDATE post_grupos SET estado=3 WHERE idpost=?";

            }
            inserta_Datos($consulta, array($_GET['id']));
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
            <div class="panel_r">

            <?php

                if(isset($_GET['grupo'])){

                    try{     
                    
                        $con=Conectar();
                        $stmt=$con->prepare("SELECT * FROM post p INNER JOIN post_grupos pg ON p.idpost=pg.idpost WHERE pg.nombreG=? AND pg.estado=1");
                        $stmt->bindValue(1, $_GET['grupo']);
                        //$stmt->bindValue(2, $id);
                        $stmt->execute();
                        $num_filas=$stmt->rowCount();
                        if($num_filas !=0){
                            $datos="<div>";
                            while($fila=$stmt->fetch(PDO::FETCH_ASSOC)){
                                $datos.="<p>";
                                //array_push($lista_mascotas['Pl'],$fila['rasgo']);
                                $datos.= "<div class='solicitud'>";
                                    if(!empty($fila['subject'])){
                                    $datos.="<div><h3>".$fila['subject']."</h3></div>";
                                    }else{
                                        $datos.="<div><b>Comentario:</b></div>";
                                    }
                                    $datos.="<div>".$fila['texto']."</div>";
                                    $datos.="<div><p>Mensaje de: <a href=''>".$fila['nick_envia']."</a></p></div>";
                                    $datos.="<p>";
                                    $datos.= "<div>¿Desea validar este mensaje?</div>";
                                    $datos.= "<div><a href='./pendiente_solicitud_m.php?id=".$fila['idpost']."&grupo=".$fila['nombreG']."&subj=".$fila['subject']."&op=a'>Aceptar</a> |<a href='./pendiente_solicitud_m.php?id=".$fila['idpost']."&grupo=".$fila['nombreG']."&op=c'>Rechazar</a></div>";
                                    $datos.="</p>";
                                $datos.= "</div>";
                                $datos.="</p>";
                                
                            }
                            $datos.="</div>";
                            
                            echo $datos;
                        }else{

                            header("Location:./mis_grupos.php");
                        }

                        
                    }catch(PDOException $e){
                        echo $e->getMessage();

                    }

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