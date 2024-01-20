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
        if(isset($_GET['nick'])){

            $consulta="UPDATE usuarios_grupo SET admitido=1 WHERE nombreG=? and nick_contacto=?";
            inserta_Datos($consulta, array($_GET['grupo'], $_GET['nick']));
        }
    ?>
</head>
<body>
<?php
if(isset($_GET['grupo'])){
    try{     
       
        $con=Conectar();
        $stmt=$con->prepare("SELECT * FROM usuarios_grupo WHERE nombreG=? AND admitido=0");
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
                    $datos.= "<div>".$fila['nick_contacto']." Le acaba de pedir una solicitud para entrar al grupo</div>";
                    $datos.= "<div><a href='./pendiente_solicitud.php?nick=".$fila['nick_contacto']."&grupo=".$_GET['grupo']."'>Aceptar</a> |<a href='./mis_grupos.php'>Cancelar</a></div>";
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