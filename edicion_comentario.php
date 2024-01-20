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

        if (isset($_POST['modificar'])){

            $consulta="UPDATE post SET texto=? WHERE idpost=?";
            inserta_Datos($consulta, array($_POST['texto'], $_POST['idpost']));
            header('Location:./comentarios.php?idpost='.$_SESSION['idpost'].'&grupo='.base64_decode(urldecode($_GET['grupo'])));
            
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
                $id_post=base64_decode(urldecode($_GET['id']));
                if(isset($id_post)){

                    $consulta="SELECT * FROM post WHERE idpost=?";
                    $lista=consultar_lista($consulta, array("texto"), array($id_post));

                }
                
                ?>
            <h1>Modificar mensaje</h1>
            <form action="" method="post">
                <input type="hidden" name="idpost" value="<?php echo $id_post ?>">
                <p><textarea name="texto" id="" cols="50" rows="20"><?php echo $lista[0] ?></textarea></p>
                <p><input type="submit" value="Modificar" name="modificar"></p>
            </form>
           
            
            </div>
        </div>

        <div class="pie">

            @copyright
        </div>


    </div>

</body>
</html>