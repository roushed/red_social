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

        if (isset($_POST['modificar'])){

            $consulta="UPDATE post SET texto=? WHERE idpost=?";
            inserta_Datos($consulta, array(nl2br($_POST['texto']), $_POST['idpost']));
            header('Location:./grupo.php?grupo='.$_SESSION['grupo'].'#ancla-'.$_POST['idpost']);
            
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
            <?php
                if(isset($_POST['id'])){
                    $_SESSION['grupo']=$_POST['grupo'];
                    $consulta2="SELECT * FROM usuarios_grupo WHERE nick_contacto=? AND nombreG=? AND admitido=1";
                    $usuariog=contar_Registros($consulta2, array($_SESSION['nombre'], $_SESSION['grupo']));
                    if($usuariog > 0){

                        $consulta="SELECT * FROM post WHERE idpost=?";
                        $lista=consultar_lista($consulta, array("texto"), array($_POST['id']));

                        echo "<h1>Modificar mensaje</h1>";
                    echo "<form action='' method='post'>";
                        echo "<input type='hidden' name='idpost' value='".$_POST['id']."'>";
                        echo "<p><textarea name='texto' id='' cols='50' rows='20'>".$lista[0]."</textarea></p>";
                        echo "<p><input type='submit' value='Modificar' name='modificar'></p>";
                    echo "</form>";

                    }else{
                        echo "<div>No perteneces al grupo</div>";

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