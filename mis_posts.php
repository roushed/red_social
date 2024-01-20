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
    ?>
</head>
<body>
    <?php

try{     
                    
    $con=Conectar();
    $stmt=$con->prepare("SELECT * FROM post p INNER JOIN post_grupos pg ON p.idpost = pg.idpost  WHERE pg.nick_envia=? AND pg.estado=2 AND p.idpostR IS NULL ORDER BY p.fecha DESC, p.idpost DESC");
    $stmt->bindValue(1, $_SESSION['nombre']);
    //$stmt->bindValue(2, $id);
    $stmt->execute();
    //$num_filas=$stmt->rowCount();
    $datos="<div>";
    $datos.="<h2> Mis Posts:</h2>";
    while($fila=$stmt->fetch(PDO::FETCH_ASSOC)){
        $datos.="<p>";
        //array_push($lista_mascotas['Pl'],$fila['rasgo']);
        $datos.= "<div>";
        $datos.= "<p><div><h3>GRUPO: ".$fila['nombreG']."</h3></div></p>";
            $datos.= "<p><div><b>".$fila['subject']."</b></div></p>";
            $datos.= "<div>".$fila['texto']."</div>";
            $datos.= "<div>".$fila['fecha']."</div>";
            $datos.= "<div><img src='./img/".$fila['imagen']."'></div>";
            $datos.="<div><a href='./comentarios.php?idpost=".$fila['idpost']."&grupo=".$fila['nombreG']."'>Comentarios";
            $consulta="SELECT * FROM post p INNER JOIN post_grupos pg ON p.idpost = pg.idpost  WHERE p.idpostR=?";
            $num_reg=contar_Registros($consulta, array($fila['idpost']));
            $datos.="($num_reg)</a></div>";
           
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