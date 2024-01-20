<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php

        include "f_modular.php";

        if(isset($_POST['envio'])){

            $correcto=validacionFormulario(array($_POST["nick"], $_POST["pwd"] , $_POST["email"]), array("text", "password", "email"));

            if($correcto){

                echo "Todo correcto";
                $consulta="INSERT INTO usuarios VALUES(?,?,?,?)";
                inserta_Datos($consulta, array($_POST['nick'], $_POST['pwd'], $_POST['email'], $_POST['tlfn']));
                $consulta2="INSERT INTO perfiles VALUES (?,1,null, ?, ?, null, null, ?, null, ?)";
                inserta_Datos($consulta2, array($_POST['nick'], "", "", "", "img_defecto.jpg"));
            }

        }
    ?>
</head>
<body>
    <form action="" method="post">
        <?php
        crearFormularioText(array("nick", "pwd", "email", "tlfn"), array("text", "password", "text", "number"));
        ?>
    <input type="submit" value="Registrar" name="envio">
    </form>
</body>
</html>