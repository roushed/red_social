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

        if(isset($_POST['contactosb'])){

            foreach($_POST['contactosb'] as $valor){
                
                $consulta="UPDATE contactos SET admitir=?, bloqueo=? WHERE nick=? AND nick_contacto=?";
                inserta_Datos($consulta, array(2,0, $_SESSION['nombre'], $valor));
                $consulta2="UPDATE contactos SET bloqueo=? WHERE nick=? AND nick_contacto=?";
                inserta_Datos($consulta2, array(0, $valor, $_SESSION['nombre']));
            }
            header('Location:./mis_contactos.php');
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
              
            <h2>Usuarios Bloqueados</h2>
                <form action="" method="post">
                    <?php
                        $consulta="SELECT nick_contacto FROM contactos WHERE nick='".$_SESSION['nombre']."' AND bloqueo=1 AND admitir=3";
                        $reg=hay_Registro($consulta, array());
                        
                        if(!$reg){
                            echo "<p>No se encuentra bloqueado ningún usuario</p>";
                        }else{
                            creacion_Selectm($consulta, "nick_contacto", "nick_contacto", "contactosb");

                            echo "<p><input type='submit' value='Desbloquear' name='desbloqueo'></p>";
                        }
                    ?>
                </form>
                        
            </div>
        </div>

        <div class="pie">

            @copyright
        </div>


    </div>

</body>
</html>