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

        if(isset($_POST['cambio'])){
           
            $consulta="SELECT * FROM usuarios WHERE pwd=? AND nick=?";
            $num_filas=contar_Registros($consulta, array($_POST['antiguo'], $_SESSION['nombre']));

            if($num_filas != 0){

                if($_POST['nuevo'] == $_POST['repitenuevo']){

                    if($_POST['nuevo'] != $_POST['antiguo']){
                        $consulta="UPDATE usuarios SET pwd=? WHERE nick=?";
                        inserta_Datos($consulta, array($_POST['nuevo'], $_SESSION['nombre']));
                        header('Location:./mi_perfil.php');
                    }else{


                        header('Location:./cambiar_pass.php?error=1');

                    }

                }else{

                    header('Location:./cambiar_pass.php?error=2');

                }

            }else{

                header('Location:./cambiar_pass.php?error=3');
               

            }
 
        }
        

            
        ?>
       
   
</head>
<body>
    <div class="container">

        <div class="titulo">
            RED SOCIAL SCARLATTI

        </div>
        <div class="secciones">
        <?php include "./panelcito.php" 
        
        
        ?>
        

        </div>

        <div class="contenido">
            <div class="panel_p">
             
                <form action="" method="post">
                    <h2>Cambiar nuevo Password:</h2>
                        <?php
                        crearFormularioText(array("antiguo", "nuevo","repitenuevo"), array("password", "password", "password"));
                        ?>

                    <input type="submit" value="Cambiar Password" name="cambio">
                 
                </form>
        
                <div>
                    <?php
                        if(isset($_GET['error'])){

                            switch ($_GET['error']) {
                                case "1":
                                    echo "No se puede introducir la misma contraseña antigua";
                                    break;
                                case "2":
                                    echo "Las 2 contraseñas nuevas introducidas no coinciden";
                                    break;
                                case "3":
                                    echo "La contraseña antigua no es correcta";
                                    break;
                            }

                        }
                    ?>

                </div>
            
            </div>
        </div>

        <div class="pie">

            @copyright
        </div>


    </div>

</body>
</html>