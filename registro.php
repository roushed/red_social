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
    ?>
</head>
<body>
    <div class="container">

        <div class="titulo">
            RED SOCIAL SCARLATTI

        </div>
        <div class="secciones">
        <div class="sect"><a href='./registro.php'>REGISTRO</a></div> <div class="sect"><a href='./inicio_sesion.php'>INICIO DE SESIÓN</a></div>

        </div>

        <div class="contenido">
            <div class="panel_reg">
                <h2>Registro:</h2>
                <form action="" method="post">
                    <?php
                    crearFormularioText(array("nick", "pwd", "repitepwd", "email", "tlfn"), array("text", "password", "password", "text", "number"));
                    ?>
                    <div class="p_envio"><p><input type="submit" value="Registrar" name="envio"></p></div>
                </form>
                <?php

                    if(isset($_POST['envio'])){
                        $consultar="SELECT * FROM usuarios WHERE nick=? OR email=?";
                        $existe=hay_Registro($consultar, array($_POST["nick"],$_POST["email"]));
                        if(!$existe){
                            if($_POST['pwd'] != $_POST['repitepwd']){
                                
                                echo "La contraseña debe de coincidir en ambos campos";
            
                            }else{
            
                                $correcto=validacionFormulario(array($_POST["nick"], $_POST["pwd"], $_POST["email"]), array("text", "password", "email"));

                                if($correcto){
                                    $fecha_act=date('Y/m/d H:i:s');
                                    echo "Todo correcto";
                                    $consulta="INSERT INTO usuarios VALUES(?,?,?,?,0,0)";
                                    inserta_Datos($consulta, array($_POST['nick'], $_POST["pwd"], $_POST['email'], $_POST['tlfn']));
                                    $consulta2="INSERT INTO perfiles VALUES (?,1,null, ?, ?, null, null, ?, null, ?)";
                                    inserta_Datos($consulta2, array($_POST['nick'], "", "", "", "img_defecto.jpg"));
        
                                    $consulta2="INSERT INTO post VALUES(0, null, ?, null, ?, null)";
                                    $mensaje="Bienvenidos a Red Social Scarlatti, Se sentirá muy agusto en este espacio";
                                    inserta_Datos($consulta2, array($mensaje, $fecha_act));
                                    $ult_id=sumar_Valores("SELECT MAX(idpost)  AS total FROM post", array());
                                    $consulta3="INSERT INTO post_usuarios VALUES(?, ?, ?, 0)";
                                    inserta_Datos($consulta3, array($ult_id, $_POST['nick'], "admin"));

                                    session_start();
                                    $_SESSION['autentificar'] = true;
                                    $_SESSION['nombre'] = $_POST['nick'];
                                    $consulta="UPDATE usuarios SET online=1 WHERE nick=?";
                                    inserta_Datos($consulta, array($_SESSION['nombre']));
                                    header('Location:./panel_principal.php');
        
                                }
            
                            }
                       
                         
                        }else{
                            echo "Ya se encuentra registrado este usuario";
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