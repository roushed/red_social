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
        <h2>Últimas visitas:</h2>
            <div class="panel_m">
                
            <?php   
            
            
            $consulta="SELECT p.foto, p.nick, MAX(v.fecha) as fecha FROM visitas v INNER JOIN usuarios u ON v.nick_visitante=u.nick INNER JOIN perfiles p ON u.nick=p.nick WHERE v.nick_perfil=? GROUP BY v.nick_visitante ORDER BY fecha DESC, v.id DESC";
            
            $lista=consultar_lista2($consulta, array("nick", "foto", "fecha"), array($_SESSION['nombre']));
        
          
            if($lista > 0){
            
           
            for($i=0; $i<count($lista); $i++){

    
                
                echo "<div><p><img src='./img/".$lista[$i][1]."'></p><p><a href='./perfil.php?nick=".$lista[$i][0]."'>".$lista[$i][0]."</a></p>";
                
                $date1 = new DateTime($lista[$i][2]);
                $date2 = new DateTime("now");
                $diff = $date1->diff($date2);
                $datos="";
                if($diff->days != 0){
                $datos.="<div> Hace ".$diff->days." dias</div>";
                }else if($diff->days >7){
                $semana=$diff->days/7;
                $datos.="<div> Hace ".$semana." semanas</div>";
                }else{
                    $datos.="<div>Hoy</div>";  
                }

                echo "<p>".$datos."</p></div>";
               
            }

            }else{

                echo "No hay ninguna visita";
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