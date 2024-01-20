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

        

        if(isset($_POST['envio'])){
            $fecha_act=date('Y/m/d H:i:s');
            //$num_reg=contar_Registros("SELECT * FROM post_usuarios WHERE nick_recibe=? AND nick_envia=?", array($_SESSION['nombre'], $_POST['msg_destino']));
   

            $consulta="INSERT INTO post VALUES(0, null, ?, null, ?, null)";
            inserta_Datos($consulta, array($_POST['mensaje'], $fecha_act));
            $ult_id=sumar_Valores("SELECT MAX(idpost)  AS total FROM post", array());
            $consulta2="INSERT INTO post_usuarios VALUES(?, ?, ?)";
            inserta_Datos($consulta2, array($ult_id, $_POST['msg_destino'], $_SESSION['nombre']));

            

        }
    ?>
</head>
<body>
    <?php
        try{     
         
            $con=Conectar();
            $stmt=$con->prepare("SELECT * FROM post_usuarios pu INNER JOIN post p ON pu.idpost=p.idpost INNER JOIN usuarios u ON pu.nick_envia=u.nick INNER JOIN perfiles per ON per.nick=u.nick WHERE pu.nick_recibe='".$_SESSION['nombre']."' AND pu.nick_envia='".$_GET['nick']."' OR  pu.nick_recibe='".$_GET['nick']."' AND pu.nick_envia='".$_SESSION['nombre']."' ORDER BY pu.idpost ASC");
            
            //$stmt->bindValue(1, $cod);
            //$stmt->bindValue(2, $id);
            $stmt->execute();
            $num_filas=$stmt->rowCount();
            
            $datos="<div>";
            while($fila=$stmt->fetch(PDO::FETCH_ASSOC)){
                
                //array_push($lista_mascotas['Pl'],$fila['rasgo']);
                    //if($_SESSION['nombre'] == $fila['nick_recibe']){
                        $datos.="<div>";
                            $datos.= "<div><img src='./img/".$fila['foto']."' width='5%' height='5%'>".$fila['nick_envia'].":</div>";
                            $datos.= "<div>".$fila['texto']."</div>";
                            if($fila['imagen'] != null){
                                $datos.= "<div><img src='./img/".$fila['imagen']."' width='10%' height='10%'></div>";
                            }
                        $datos.="</div>";

                    //}else{
                                   
            }
            $datos.="</div>";
            
            
            echo $datos;
        }catch(PDOException $e){
            echo $e->getMessage();
    
        }
    ?>
    <?php
     $num_admitidos=contar_Registros("SELECT * FROM contactos WHERE nick=? AND nick_contacto=? AND admitir=2 AND bloqueo=0", array($_SESSION['nombre'], $_GET['nick']));

    if($num_admitidos >0){

        echo "<form action='' method='post'>";

            
            if(isset($_GET['nick'])){
                echo "<input type='hidden' value='".$_GET['nick']."' name='msg_destino'>";
                echo "<h2>Enviar un mensaje a ".$_GET['nick']."</h2>";
                crearFormularioText(array("mensaje"), array("textarea"));
            }
            
            echo "<input type='submit' value='Enviar Mensaje' name='envio'>";

        echo "</form>";

    }else{
        echo "<p>";
        echo "Ya no puede contactar con esta persona";
        echo "</p>";
    }
    ?>
    
    <p><a href="./mensajeria.php">Volver</a></p>
</body>
</html>