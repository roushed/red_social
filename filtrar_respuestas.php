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
        
            <div class="mi_perfil">
               
            <?php
            echo "<div class='filtrar'>";
            echo "<h2>Filtrar Respuestas:</h2>";
            echo "<form method='post' action=''>";
            echo "<input type='text' name='buscar'> <input type='submit' name='filtrar'>";
            echo "</form>";
            echo "</div>";
            
        
            if(isset($_POST['filtrar'])){


                try{     
                
                    $con=Conectar();
                    $stmt=$con->prepare("SELECT * FROM post p INNER JOIN post_usuarios pu ON p.idpost=pu.idpost WHERE pu.nick_recibe=? AND p.texto LIKE ? ORDER BY p.fecha DESC");
                    $stmt->bindValue(1, $_SESSION['nombre']);
                    $stmt->bindValue(2, "%".$_POST['buscar']."%");
                    //$stmt->bindValue(2, $id);
                    $stmt->execute();
                    //$num_filas=$stmt->rowCount();
                    $datos="<div class='fondo_respuesta'>";
                    while($fila=$stmt->fetch(PDO::FETCH_ASSOC)){
                      
                        //array_push($lista_mascotas['Pl'],$fila['rasgo']);
                        $datos.= "<div class='msg_respuesta'>";
                            $datos.="<div>".$fila['texto']."</div>";
                            $datos.= "<div><b>".$fila['nick_envia']."</b></div>";
                            $datos.= "<div>".$fila['fecha']."</div>";
                        $datos.= "</div>";
                   
                        
                    }
                    $datos.="</div>";
                    
                    
                    echo $datos;
                
                    
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