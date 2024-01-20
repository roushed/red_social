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

        if(isset($_POST['anadir'])){
            foreach ($_POST['ncontacto'] as $valor){
            $consulta="UPDATE usuarios_grupo SET moderador=1 WHERE nick_contacto=? AND nombreG=?";
            inserta_Datos($consulta, array($valor,  $_SESSION['grupo']));
            header('Location:./grupo.php?grupo='.$_SESSION['grupo']);
            }

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
            <div class="panel_reg">
              
            <h1>Agregar Moderador/es al Grupo:</h1>
                <form action="" method="post">
                    <?php
                    if(isset($_GET['grupo'])){
                        $_SESSION['grupo']=$_GET['grupo'];
                        $consultac="SELECT * FROM usuarios_grupo WHERE nombreG='".$_GET['grupo']."' AND moderador=0 AND admitido=1 ORDER BY nick_contacto ASC";
                        creacion_Selectm($consultac, "nick_contacto", "nick_contacto", "ncontacto");
                    }
                    ?>
                    <p><input type="submit" value="Añadir" name="anadir"></p>
                </form>

            
            </div>
        </div>

        <div class="pie">

            @copyright
        </div>


    </div>

</body>
</html>