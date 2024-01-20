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
                
                
            <?php
            if(isset($_GET['nick'])){

                $consulta="SELECT * FROM contactos WHERE nick_contacto=? AND nick=? and admitir=2";
                $num_reg=contar_Registros($consulta, array($_GET['nick'], $_SESSION['nombre']));
                if($num_reg > 0){
                    echo "<h2>Lista de amigos de ".$_GET['nick'].":</h2>"; 
                    $consulta2="SELECT * FROM contactos c INNER JOIN usuarios u  ON  c.nick_contacto=u.nick INNER JOIN perfiles p ON u.nick=p.nick WHERE c.nick=? and c.admitir=2 and c.bloqueo=0";
                    $lista=consultar_lista2($consulta2, array("nick_contacto", "foto"), array($_GET['nick']));
                
                    if($lista > 0){
                    echo "<div>";
                    
                    for($i=0; $i<count($lista); $i++){
            
                        //if(count($lista)>1){
                            echo "<div><img src='./img/".$lista[$i][1]."' width='8%' height='8%'></div><div><a href='./perfil.php?nick=".$lista[$i][0]."'>".$lista[$i][0]."</a></div>";
                        //}else{
                            //echo "<div><a href='./perfil.php?nick=".$lista[$i]."'>".$lista[$i]."</a></div>";

                        //}
                    }

                    echo "</div>";
                    }else{

                        echo "No tiene agregado a nadie en su lista de contactos";
                    }
                    
                    if($lista != 0){
                        echo "<h3>Total amigos:".count($lista)."</h3>";
                    }
                
                }else{
                    echo "Usted no tiene a esta persona agregada";
                }    
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