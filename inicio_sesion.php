<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">


    <?php
        session_start();
        if(isset($_SESSION['autentificar'])){
            header('Location: ./panel_principal.php');
            exit();

        }

    ?>

    <?php
    include "./f_modular.php";
    if(isset($_POST['inicio'])){

       
        //session_start();
                if(!isset($_SESSION['autentificar'])){
                    if(!empty($_POST['usuario']) && !empty($_POST['contrasena'])){

                        try{
            
                           
                            $con=Conectar();
                            $stmt=$con->prepare("SELECT * FROM usuarios WHERE nick=? AND pwd=?");
                            $stmt->bindValue(1, $_POST['usuario']);
                            $stmt->bindValue(2, $_POST['contrasena']);
                            //$stmt->bindValue(2, $id);
                            $stmt->execute();
                            $num_filas=$stmt->rowCount();
                           $fila=$stmt->fetch(PDO::FETCH_ASSOC);
                            $nick=$fila['nick'];
                            $pass=$fila['pwd'];
                          
                            
                        }catch(PDOException $e){
                            echo $e->getMessage();
                   
                        }
                        
                        if($_POST['usuario'] == $nick && $_POST['contrasena'] == $pass){
                            $_SESSION['autentificar'] = true;
                            $_SESSION['nombre'] = $_POST['usuario'];
                            $consulta="UPDATE usuarios SET online=1 WHERE nick=?";
                            inserta_Datos($consulta, array($_SESSION['nombre']));
                            header('Location:./panel_principal.php');
                    
                        }else{
                            header('Location:./inicio_sesion.php?error=1');
                        }
                    }else{
                        header('Location:./inicio_sesion.php?error=2');
                    }
                }else{
                    header('Location:./panel_principal.php');
                    
       
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
        <div class="sect"><a href='./registro.php'>REGISTRO</a></div> <div class="sect"><a href='./inicio_sesion.php'>INICIO DE SESIÓN</a></div>

        </div>

        <div class="fondocuadro">

           <div class="cuadro">

            <form action="inicio_sesion.php" method="post">
                <div class="p_login"><label>Login</label></div>
                <div class="p_login"><input type="text" name="usuario" id=""></div>
                <div class="p_login"><label>Password</label></div>
                <div class="p_login"><input type="password" name="contrasena" id=""></div>
                <div class="p_login"><input type="submit" value="Entrar" name="inicio"></div>
                <div class="msg_error">

                    <?php

                        if(isset($_GET['error'])){
                            if($_GET['error'] == 1){

                                echo "<p>Nombre de usuario y contraseña incorrectos</p>";
                            }

                            if($_GET['error'] == 2){

                                echo "<p>Campos vacios</p>";
                            }

                        }

                    ?>
                    </div>
                </form>

           </div>

        </div>

        <div class="pie">

            @copyright
        </div>


    </div>

</body>
</html>