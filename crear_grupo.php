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

        if(isset($_POST['crear'])){
            $consulta="INSERT INTO grupos VALUES(?,?)";
            inserta_Datos($consulta, array($_POST['nombre'], $_POST['descripcion']));
            $consulta2="INSERT INTO usuarios_grupo VALUES(?,?,1,1,1)";
            inserta_Datos($consulta2, array($_SESSION['nombre'], $_POST['nombre']));
            header('Location:./mis_grupos.php');


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
                <h2>Crear Grupo</h2>
            <form action="" method="post">

                <p><label>Nombre de Grupo:</label></p><p><input type="text" name="nombre" id=""></p>
                <p><label>Descripcion:</label></p><p><textarea name="descripcion" cols="40" rows="20"></textarea></p>

                <p><input type="submit" value="Crear" name="crear"></p>
            </form>
            
            </div>
        </div>

        <div class="pie">

            @copyright
        </div>


    </div>

</body>
</html>