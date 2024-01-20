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
            <div class="panel_grp">
                

            <?php
        
        if(isset($_GET['nick'])){

            $_SESSION['nick']=$_GET['nick'];

            $num_admitidos=contar_Registros("SELECT * FROM contactos WHERE nick=? AND nick_contacto=? AND admitir=2", array($_SESSION['nombre'], $_SESSION['nick']));

            if($num_admitidos != 0){
            echo "<h1>Posts de ".$_SESSION['nick'].":</h1>";

                try{     
                   
                    $con=Conectar();
                    $stmt=$con->prepare("SELECT * FROM post p INNER JOIN post_grupos pg ON p.idpost = pg.idpost INNER JOIN usuarios u ON pg.nick_envia=u.nick INNER JOIN perfiles per ON per.nick=u.nick INNER JOIN usuarios_grupo ug ON ug.nombreG=pg.nombreG WHERE ug.nick_contacto IN (SELECT ug.nick_contacto FROM usuarios_grupo WHERE ug.nick_contacto=?) AND pg.nick_envia=? AND pg.estado=2 AND p.idpostR IS NULL ORDER BY p.fecha DESC, p.idpost DESC");
                    $stmt->bindValue(1,  $_SESSION['nombre']);
                    $stmt->bindValue(2,  $_SESSION['nick']);
                    //$stmt->bindValue(2, $id);
                    $stmt->execute();
                    $num_filas=$stmt->rowCount();
                    $datos="<div¡>";
                    if($num_filas != 0){
                    
                        while($fila=$stmt->fetch(PDO::FETCH_ASSOC)){
                            $datos.="<p>";
                            //array_push($lista_mascotas['Pl'],$fila['rasgo']);
                            $datos.= "<div class='lista_posts'>";
                                $datos.="<div><a href='./comentarios.php?idpost=".$fila['idpost']."&grupo=".$fila['nombreG']."'><h2>".$fila['nombreG']."</h2></a></div>";
                                $datos.= "<p><div><b>".$fila['subject']."</b></div></p>";
                                $datos.= "<div class='post_texto'><p>".$fila['texto']."</p></div>";
                                $datos.= "<div>".strftime("%d de %B, %G", strtotime($fila['fecha']))."</div>";
                               
      
     
                            $datos.= "</div>";
                            
                        
                        }
                    }else{
                        $datos.="<p>No hay mensajes</p>";
                    }
                    
                    $datos.="</div>";
                    
                    echo $datos;
                
                    
                }catch(PDOException $e){
                    echo $e->getMessage();
                
                }
            }else{
                echo "<p>Usted no tiene agregado a a esta persona en tus contactos</p>";
                
            }
        
            }

        

                
           
      
            
        

          
        ?>

            
       
       
        </div>

        <div class="pie">

            @copyright
        </div>


    </div>
    

</body>
</html>