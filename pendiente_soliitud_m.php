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

        if(isset($_GET['id'])){

            if($_GET['op'] == "a"){
                $consulta="UPDATE post_grupos SET estado=2 WHERE idpost=?";
            }else if($_GET['op'] == "c"){
                $consulta="UPDATE post_grupos SET estado=3 WHERE idpost=?";

            }
            inserta_Datos($consulta, array($_GET['id']));
        }
    ?>
</head>
<body>
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
                $datos.= "<div>";
                    if(!empty($fila['subject'])){
                    $datos.="<div><h3>".$fila['subject']."</h3></div>";
                    }else{
                        $datos.="<div><b>Comentario:</b></div>";
                    }
                    $datos.="<div>".$fila['texto']."</div>";
                    $datos.="<div><p>Mensaje de: <a href=''>".$fila['nick_envia']."</a></p></div>";
                    $datos.="<p>";
                    $datos.= "<div>¿Desea validar este mensaje?</div>";
                    $datos.= "<div><a href='./pendiente_solicitud_m.php?id=".$fila['idpost']."&grupo=".$fila['nombreG']."&op=a'>Aceptar</a> |<a href='./pendiente_solicitud_m.php?id=".$fila['idpost']."&grupo=".$fila['nombreG']."&op=c'>Rechazar</a></div>";
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
</body>
</html>