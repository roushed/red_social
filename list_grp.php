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
        if(isset($_GET['grupo'])){

            $consulta="INSERT INTO usuarios_grupo VALUES(?,?, 0, 0, 0)";
            inserta_Datos($consulta, array($_SESSION['nombre'], $_GET['grupo']));
            echo "Has realizado la solicitud al grupo";

        }

        if(isset($_GET['grupos'])){

            $consulta="DELETE FROM usuarios_grupo WHERE nick_contacto=? AND nombreG=?";
            //Elimina
            inserta_Datos($consulta, array($_SESSION['nombre'], $_GET['grupos']));
            

        }

        
    ?>
</head>
<body>
<?php

try{     
    
    $con=Conectar();
    $stmt=$con->prepare("SELECT * FROM grupos g INNER JOIN usuarios_grupo ug ON g.nombreG=ug.nombreG  WHERE ug.moderador=? GROUP BY ug.nombreG ORDER BY g.nombreG DESC");
    $stmt->bindValue(1, 1);
    //$stmt->bindValue(2, $id);
    $stmt->execute();
    //$num_filas=$stmt->rowCount();
    $datos="<div>";
    while($fila=$stmt->fetch(PDO::FETCH_ASSOC)){
        $datos.="<p>";
        //array_push($lista_mascotas['Pl'],$fila['rasgo']);
        $datos.= "<div>";
            $datos.= "<div>".$fila['nombreG']."</div>";
            $datos.= "<div>".$fila['descripcion']."</div>";
            $datos.= "<div>Creado por <b>".$fila['nick_contacto']."</b>";
            $stmtg=$con->prepare("SELECT * FROM usuarios_grupo WHERE nick_contacto=? AND nombreG=?");
            $stmtg->bindValue(1, $_SESSION['nombre']);
            $stmtg->bindValue(2, $fila['nombreG']);
            $stmtg->execute();
            $num_filas=$stmtg->rowCount();
            $filag=$stmtg->fetch(PDO::FETCH_ASSOC);
            if($num_filas != 0){
                if($filag['admitido'] != 1){

                    $datos.="<div>Solicitado | <a href='./lista_grupos.php?grupos=".$fila['nombreG']."'>Cancelar</a></div>";
                }else{

                    $datos.="<div><a href='./grupo.php?grupo=".$fila['nombreG']."'>Ver Grupo </a>";
                    if($filag['moderador'] == 0){
                      $datos.="| <a href='./lista_grupos.php?grupos=".$fila['nombreG']."'> Salir del Grupo</a></div>";
                    }
                }
                
            }else{
                $datos.="<div><a href='./lista_grupos.php?grupo=".$fila['nombreG']."'>Unirse</a></div>";
            }
           
        $datos.= "</div>";
        $datos.="</p>";
        
    }
    $datos.="</div>";
    
    echo $datos;

    
}catch(PDOException $e){
    echo $e->getMessage();

}




?>
</body>
</html>