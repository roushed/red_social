<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
         include "./seguridad.php";
         
    ?>
</head>
<body>
    <a href='./filtrar_respuestas.php'>Filtrar Respuestas</a>
<?php
        try{     
            include "./conectar.php";
            $con=Conectar();
            //$stmt=$con->prepare("SELECT * FROM mensajeria WHERE dni_destino='".$_SESSION['nombre']."' GROUP BY nombre ORDER BY fecha DESC ");
            $stmt=$con->prepare("SELECT * FROM post p INNER JOIN post_usuarios pu ON p.idpost=pu.idpost INNER JOIN usuarios u ON pu.nick_envia=u.nick INNER JOIN perfiles per ON per.nick=u.nick WHERE p.idpost IN (SELECT MAX(idpost) FROM post_usuarios WHERE nick_recibe='".$_SESSION['nombre']."'  GROUP BY nick_envia) GROUP BY PU.nick_envia ORDER BY p.idpost DESC");

            //$stmt->bindValue(1, $cod);
            //$stmt->bindValue(2, $id);
            $stmt->execute();
            $num_filas=$stmt->rowCount();
            echo "<h2>Bandeja de Entrada</h2>";
            
            $datos="<div>";
            $datos.="<form method='get' id='form' action='mensaje_priv.php' name='form'>";
            $datos.="<input type='hidden' id='nick' name='nick'>";
            while($fila=$stmt->fetch(PDO::FETCH_ASSOC)){
                
                //array_push($lista_mascotas['Pl'],$fila['rasgo']);
                        $datos.="<p>";
                        //$datos.="<div id='".$fila['nick_envia']."' onclick=fDetalles(this)>";
                        $datos.= "<div><img src='./img/".$fila['foto']."' width='2%' height='2%'>".$fila['nick_envia'].":</div>";
                        $datos.="<div><a href='./mensaje_priv.php?nick=".$fila['nick_envia']."'>".$fila['texto']."</a></div>";
                        $date1 = new DateTime($fila['fecha']);
                        $date2 = new DateTime("now");
                        $diff = $date1->diff($date2);
                        if($diff->days != 0){
                        $datos.="<div> Hace ".$diff->days." dias</div>";
                        }else if($diff->days >7){
                            $semana=$diff->days/7;
                            $datos.="<div> Hace ".$semana." semanas</div>";

                        }else{
                            $datos.="<p><div>Hoy</div></p>";  
                        }
                       
                        $datos.="</div>";
                        $datos.="</p>";

                    }   
            $datos.="</form>";
            $datos.="</div>";
           
             
            echo $datos;
        }catch(PDOException $e){
            echo $e->getMessage();
    
        }
    ?>
    <p><a href="./panel.php">Volver</a></p>
    <script>
        const fDetalles=(obj) => {
            alert(obj.id);
            document.getElementById("nick").value=obj.id;
            document.getElementById("form").submit();

        }
    </script>
    
</body>
</html>