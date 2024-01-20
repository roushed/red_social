<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
        include "./seguridad.php";
        include "./f_modular.php";
    ?>
</head>
<body>
    <?php   
            echo "<h2>Lista de contactos:</h2>";
            
            $consulta="SELECT * FROM contactos c INNER JOIN usuarios u  ON  c.nick_contacto=u.nick INNER JOIN perfiles p ON u.nick=p.nick WHERE c.nick=? and c.admitir=2 and c.bloqueo=0";
            
            $lista=consultar_lista($consulta, array("nick_contacto", "foto"), array($_SESSION['nombre']));
          
            if($lista > 0){
            echo "<div>";
           
            for($i=0; $i<count($lista); $i++){

    
                //if(count($lista)>1){
                    echo "<div><img src='./img/".$lista[$i][1]."' width='2%' height='2%'><a href='./perfil.php?nick=".$lista[$i][0]."'>".$lista[$i][0]."</a></div>";
                //}else{
                    //echo "<div><a href='./perfil.php?nick=".$lista[$i]."'>".$lista[$i]."</a></div>";

                //}
            }

            echo "</div>";
            }else{

                echo "No tienes ningún usuario en tu lista de contacto";
            }
            $consulta2="SELECT * FROM contactos WHERE nick_contacto=? and admitir=1";
            $num_reg=contar_Registros($consulta2, array($_SESSION['nombre']));
            if($num_reg > 0){

                if($num_reg == 1){
                    $solicitud="solicitud";
                }else{

                    $solicitud="solicitudes";

                }
                echo "<p><div><a href='./pendiente_solicitud_c.php'>Tienes $num_reg $solicitud de amistad</a></div></p>";
            }

            echo "<div><h3><a href='./u_bloqueados.php'>Usuarios Bloqueados</a></h3></div>"


    ?>
</body>
</html>