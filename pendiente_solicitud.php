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

        if(isset($_GET['nick'])){

            $consulta="UPDATE usuarios_grupo SET admitido=1 WHERE nombreG=? and nick_contacto=?";
            inserta_Datos($consulta, array($_GET['grupo'], $_GET['nick']));
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
                $datos.= "<div class='solicitud'>";
                    $datos.= "<div class='solicitud_c'><b><a href='./perfil.php?nick=".$fila['nick_contacto']."'>".$fila['nick_contacto']."</a></b> Le acaba de pedir una solicitud para entrar al grupo</div>";
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
           

           
            
            </div>
        </div>

        <div class="pie">

            @copyright
        </div>


    </div>

</body>
</html>