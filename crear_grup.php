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

        if(isset($_POST['crear'])){
            $consulta="INSERT INTO grupos VALUES(?,?)";
            inserta_Datos($consulta, array($_POST['nombre'], $_POST['descripcion']));
            $consulta2="INSERT INTO usuarios_grupo VALUES(?,?,1,1,1)";
            inserta_Datos($consulta2, array($_SESSION['nombre'], $_POST['nombre']));




        }
    ?>
</head>
<body>
    <form action="" method="post">

        <p><label>Nombre de Grupo:</label><input type="text" name="nombre" id=""></p>
        <p><label>Descripcion:</label><textarea name="descripcion" cols="30" rows="8"></textarea></p>
        
    <input type="submit" value="Crear" name="crear">
    </form>
</body>
</html>