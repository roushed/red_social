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
    ?>
</head>
<body>
    <?php
            echo "<h2>Filtrar Respuestas:</h2>";
            echo "<form method='post' action=''>";
            echo "<input type='text' name='buscar'> <input type='submit' name='filtrar'>";
            echo "</form>";
            
        
            if(isset($_POST['filtrar'])){


                $consulta="SELECT * FROM post p INNER JOIN post_usuarios pu ON p.idpost=pu.idpost WHERE pu.nick_recibe=? AND p.texto LIKE ?"; 
             
                imprime_perfil_bd($consulta, array($_SESSION['nombre'], "%".$_POST['buscar']."%"), array("texto","nick_envia", "fecha"), array("text", "text", "date"));
              
            }
        ?>
</body>
</html>