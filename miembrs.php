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
            echo "<h2>Lista de Miembros:</h2>";
            
            $consulta="SELECT * FROM usuarios u INNER JOIN perfiles p ON u.nick=p.nick";
            
            $lista=consultar_lista($consulta, array("nick", "foto"), array());
          
            if($lista > 0){
            echo "<div>";
           
            for($i=0; $i<count($lista); $i++){

    
                
                echo "<p><div><img src='./img/".$lista[$i][1]."' width='2%' height='2%'><a href='./perfil.php?nick=".$lista[$i][0]."'>".$lista[$i][0]."</a></div></p>";
               
            }

            echo "</div>";
            }else{

                echo "No hay ningun usuario registrado";
            }


?>
</body>
</html>