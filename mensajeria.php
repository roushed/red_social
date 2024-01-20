<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
    <?php
       
        include "./seguridad.php";
        include "./f_modular.php";
            
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

            <div class='boton'><a href='./filtrar_respuestas.php'>Filtrar Respuestas</a></div>
            <?php
                    try{     
                       
                        $con=Conectar();
                        //$stmt=$con->prepare("SELECT * FROM mensajeria WHERE dni_destino='".$_SESSION['nombre']."' GROUP BY nombre ORDER BY fecha DESC ");
                        $stmt=$con->prepare("SELECT * FROM post p INNER JOIN post_usuarios pu ON p.idpost=pu.idpost INNER JOIN usuarios u ON pu.nick_envia=u.nick INNER JOIN perfiles per ON per.nick=u.nick WHERE p.idpost IN (SELECT MAX(idpost) FROM post_usuarios WHERE nick_recibe='".$_SESSION['nombre']."'  GROUP BY nick_envia) GROUP BY PU.nick_envia ORDER BY p.idpost DESC");

                        //$stmt->bindValue(1, $cod);
                        //$stmt->bindValue(2, $id);
                        $stmt->execute();
                        $num_filas=$stmt->rowCount();
                        
                        echo "<h2>Bandeja de Entrada</h2>";
                    
                        $datos="<div>";
                        if($num_filas > 0){
                            $datos.="<form method='get' id='form' action='mensaje_priv.php' name='form'>";
                            $datos.="<input type='hidden' id='nick' name='nick'>";
                            while($fila=$stmt->fetch(PDO::FETCH_ASSOC)){
                                
                                $consulta="SELECT * FROM `post_usuarios` WHERE nick_recibe=? AND nick_envia=? AND leido=0";
                                $num_msg=contar_Registros($consulta, array($_SESSION['nombre'], $fila['nick_envia']));
                                //array_push($lista_mascotas['Pl'],$fila['rasgo']);
                                    
                                        $datos.="<div class='mensajeria'>";
                                        if($num_msg != 0){
                                            $datos.="<div><span class='circle'>$num_msg</span></div>";
                                        }
                                        $datos.="<a href='./mensaje_priv.php?nick=".$fila['nick_envia']."#ancla-1'>";
                                        //$datos.="<div id='".$fila['nick_envia']."' onclick=fDetalles(this)>";
                                        $datos.= "<div><img src='./img/".$fila['foto']."' width='2%' height='2%'><b>".$fila['nick_envia'].":</b></div>";
                                        $datos.="<div>".$fila['texto']."</div>";
                                        $date1 = new DateTime($fila['fecha']);
                                        $date2 = new DateTime("now");
                                        $diff = $date1->diff($date2);
                                        if($diff->days != 0){
                                        $datos.="<div> Hace ".$diff->days." dias</div>";
                                        }else if($diff->days >7){
                                            $semana=$diff->days/7;
                                            $datos.="<div> Hace ".$semana." semanas</div>";

                                        }else{
                                            $datos.="<div>Hoy</div>";  
                                        }
                                    
                                        $datos.="</a></div>";
                                        

                                    }   
                            $datos.="</form>";
                        }else{
                            $datos.="No tienes Mensajes";
                        }
                        $datos.="</div>";
                    
                        
                        echo $datos;
                    }catch(PDOException $e){
                        echo $e->getMessage();
                
                    }
                ?>
    
    <script>
        const fDetalles=(obj) => {
            alert(obj.id);
            document.getElementById("nick").value=obj.id;
            document.getElementById("form").submit();

        }
    </script>

            


            </div>
        </div>

        <div class="pie">

            @copyright
        </div>


    </div>

</body>
</html>