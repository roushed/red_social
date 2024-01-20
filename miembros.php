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
        <h2>Lista de Miembros:</h2>
            <div class="panel_m">
                
            <?php   
            
            
            $consulta="SELECT * FROM usuarios u INNER JOIN perfiles p ON u.nick=p.nick";
            
            $lista=consultar_lista($consulta, array("nick", "foto"), array());
          
            if($lista > 0){
            
           
            for($i=0; $i<count($lista); $i++){

    
                
                echo "<div><p><img src='./img/".$lista[$i][1]."'></p><a href='./perfil.php?nick=".$lista[$i][0]."'>".$lista[$i][0]."</a>";
                $consultao="SELECT * FROM usuarios WHERE nick=? AND online=1";
                $online=hay_Registro($consultao, array($lista[$i][0]));

                if($online){
                echo "<div class='online'>Online</div>";
                }
                
                echo "</div>";
               
            }

            }else{

                echo "No hay ningun usuario registrado";
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