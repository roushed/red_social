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
        $consultal="UPDATE post_usuarios SET leido=1 WHERE nick_recibe=? AND nick_envia=?";
        inserta_Datos($consultal, array($_SESSION['nombre'], $_GET['nick']));

        if(isset($_GET['id'])){
            elimina_Datos(array($_GET['id']), "DELETE FROM post_usuarios WHERE idpost=?");
            elimina_Datos(array($_GET['id']), "DELETE FROM post WHERE idpost=?");
            header('Location:./mensaje_priv.php?nick='.$_GET['nick'].'#ancla-1');  

        }

        if(isset($_POST['envio'])){
            $fecha_act=date('Y/m/d H:i:s');
            //$num_reg=contar_Registros("SELECT * FROM post_usuarios WHERE nick_recibe=? AND nick_envia=?", array($_SESSION['nombre'], $_POST['msg_destino']));
   

            $consulta="INSERT INTO post VALUES(0, null, ?, null, ?, null)";
            inserta_Datos($consulta, array($_POST['mensaje'], $fecha_act));
            $ult_id=sumar_Valores("SELECT MAX(idpost)  AS total FROM post", array());
            $consulta2="INSERT INTO post_usuarios VALUES(?, ?, ?,0)";
            inserta_Datos($consulta2, array($ult_id, $_POST['msg_destino'], $_SESSION['nombre']));

             
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
            <div class="panel_msg">
             

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
                                if($_SESSION['nombre'] != $fila['nick_recibe']){
                                    $clase_m="mensaje_r";
                                
                                }else{
                                    $clase_m="mensaje_e";

                                }
                                    $datos.="<div class=$clase_m>";
                                        if($clase_m == "mensaje_r"){
                                            //$datos.="<div class='msg_x'><a href='./mensaje_priv.php?id=".$fila['idpost']."&nick=".$fila['nick_recibe']."'>X</a></div>";
                                            $datos.="<div class='msg_x' id='".$fila['idpost']."#".$fila['nick_recibe']."' onclick='mensaje_Confirmar(this)'>X</div>";
                                        }
                                        $datos.= "<div><img src='./img/".$fila['foto']."' width='4%' height='4%'>".$fila['nick_envia'].":</div>";
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
                <center>
                <a name="ancla-1"></a>
                <?php
                $num_admitidos=contar_Registros("SELECT * FROM contactos WHERE nick=? AND nick_contacto=? AND admitir=2 AND bloqueo=0", array($_SESSION['nombre'], $_GET['nick']));

                if($num_admitidos >0){

                    echo "<form action='' method='post'>";

                        
                        if(isset($_GET['nick'])){
                            echo "<input type='hidden' value='".$_GET['nick']."' name='msg_destino'>";
                            echo "<h2>Enviar un mensaje a ".$_GET['nick']."</h2>";
                            //crearFormularioText(array("mensaje"), array("textarea"));
                            echo "<p><label>Descripcion:</label></p><p><textarea name='mensaje' cols='55' rows='20'></textarea></p>";
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
                </center>
            </div>
        </div>

        <div class="pie">

            @copyright
        </div>


    </div>
                <script src="./java/script3.js" defer></script>
</body>
</html>