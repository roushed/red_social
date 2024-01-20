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

        if (isset($_POST['modificar'])){

            $consulta="UPDATE post SET texto=? WHERE idpost=?";
            inserta_Datos($consulta, array($_POST['texto'], $_POST['idpost']));
            header('Location:./comentarios.php?idpost='.$_SESSION['idpost'].'&grupo='.$_GET['grupo']);
            
        }

    
    ?>
</head>
<body>
    <?php
    if(isset($_GET['id'])){
        $consulta="SELECT * FROM post WHERE idpost=?";
        $lista=consultar_lista($consulta, array("texto"), array($_GET['id']));

    }
    
    ?>
    <h1>Modificar mensaje</h1>
    <form action="" method="post">
        <input type="hidden" name="idpost" value="<?php echo $_GET['id'] ?>">
        <p><textarea name="texto" id="" cols="30" rows="10"><?php echo $lista[0] ?></textarea></p>
        <p><input type="submit" value="Modificar" name="modificar"></p>
    </form>
</body>
</html>