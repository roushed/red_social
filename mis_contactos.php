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
      
            <div class="contactos">
            <h2>Lista de Contactos:</h2>
                
                
            <?php
            
            $consulta="SELECT * FROM contactos WHERE nick_contacto=? and admitir=1";
            $num_reg=contar_Registros($consulta, array($_SESSION['nombre']));
            if($num_reg > 0){

                if($num_reg == 1){
                    $solicitud="solicitud";
                }else{

                    $solicitud="solicitudes";

                }
                echo "<p><div><a href='./pendiente_solicitud_c.php'>Tienes $num_reg $solicitud de amistad</a></div></p>";
            }
            
            $consulta2="SELECT * FROM contactos c INNER JOIN usuarios u  ON  c.nick_contacto=u.nick INNER JOIN perfiles p ON u.nick=p.nick WHERE c.nick=? and c.admitir=2 and c.bloqueo=0";
            
            $lista=consultar_lista2($consulta2, array("nick_contacto", "foto"), array($_SESSION['nombre']));
            
            if($lista > 0){
            echo "<div>";
            
            for($i=0; $i<count($lista); $i++){
    
                //if(count($lista)>1){
                    echo "<div><img src='./img/".$lista[$i][1]."' width='8%' height='8%'></div><div><a href='./perfil.php?nick=".$lista[$i][0]."'>".$lista[$i][0]."</a>";
                    $consultao="SELECT * FROM usuarios WHERE nick=? AND online=1";
                    $online=hay_Registro($consultao, array($lista[$i][0]));

                    if($online){
                        echo "<div class='online'>Online</div>";
                    }
                    echo"</div>";
                //}else{
                    //echo "<div><a href='./perfil.php?nick=".$lista[$i]."'>".$lista[$i]."</a></div>";

                //}
            }

            echo "</div>";
            }else{

                echo "No tienes ningún usuario en tu lista de contacto";
            }
            
            if($lista != 0){
                echo "<h3>Total amigos:".count($lista)."</h3>";
            }
            echo "<div class='boton_b'><h3><a href='./u_bloqueados.php'>Usuarios Bloqueados</a></h3></div>";
            


    ?>
            



            
            </div>
        </div>

        <div class="pie">

            @copyright
        </div>


    </div>

</body>
</html>