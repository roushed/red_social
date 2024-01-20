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


        if(isset($_GET['idadmitir'])){

            $consulta="UPDATE post_grupos SET estado=2 WHERE idpost=?";
            inserta_Datos($consulta, array($_GET['idadmitir']));
            header("Location:./grupo.php?grupo=". $_SESSION['grupo']);
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
            <div class="panel_r">

            <?php
            if(isset($_GET['grupo'])){
                $_SESSION['grupo']=$_GET['grupo'];
                $consulta_a="SELECT * FROM usuarios_grupo WHERE nick_contacto=? AND nombreG=? AND moderador=1 AND admitido=1 AND admin=1";
                $reg_admin=contar_Registros($consulta_a, array($_SESSION['nombre'],  $_SESSION['grupo']));
                if($reg_admin != 0){

                try{     
                            
                    $con=Conectar();
                    $stmt=$con->prepare("SELECT * FROM post p INNER JOIN post_grupos pg ON p.idpost = pg.idpost  WHERE pg.nombreG=? AND pg.estado=3");
                    $stmt->bindValue(1,  $_SESSION['grupo']);
                    //$stmt->bindValue(2, 1);
                    $stmt->execute();
                    $num_filas=$stmt->rowCount();

                    if($num_filas !=0){
                
                        $datos="<div>";
                        while($fila=$stmt->fetch(PDO::FETCH_ASSOC)){
                            $datos.="<p>";
                            
                                //array_push($lista_mascotas['Pl'],$fila['rasgo']);
                            $datos.= "<div class='solicitud'>";
                            $datos.= "<div><p><b>".$fila['subject']."</b></p></div>";
                            $datos.= "<div><p>".$fila['texto']."</p></div>";
                            $datos.= "<div><p>".$fila['nick_envia']."</p></div>";
                            $datos.= "<div><p>".$fila['fecha']."</p></div>";
                            $datos.= "<div class='confirmacion'><p><a href='./mensajes_denegados.php?idadmitir=".$fila['idpost']."'>Admitir</a> |<a href=''>Eliminar</a></p></div>";
                            $datos.= "</div>";
                            $datos.="</p>";
                                
                            }
                        $datos.="</div>";
                            
                            echo $datos;
                    
                    }else{
                    
                        header("Location:./grupo.php?grupo=". $_SESSION['grupo']);
                    }
                    
                }catch(PDOException $e){
                    echo $e->getMessage();

                }
                }else{

                    echo "Usted no esta autorizado, solo el Admin";
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