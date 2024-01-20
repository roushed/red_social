<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>


    <?php
        session_start();
        if(isset($_SESSION['autentificar'])){
            header('Location: ./panel.php');
            exit();

        }

    ?>

    <?php
    
    if(isset($_POST['inicio'])){

      
        //session_start();
                if(!isset($_SESSION['autentificar'])){
                    if(!empty($_POST['usuario']) && !empty($_POST['contrasena'])){

                        try{
            
                            include "./conectar.php";
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
                            header('Location:./panel.php');
                    
                        }else{
                            header('Location:./inicio_sesion.php?error=1');
                        }
                    }else{
                        header('Location:./inicio_sesion.php?error=2');
                    }
                }else{
                    header('Location:./panel.php');
                    
       
                }

    }



    ?>
</head>
<body>
    <form action="inicio_sesion.php" method="post">
            <p><label>Login</label><input type="text" name="usuario" id=""></p>
            <p><label>Password</label><input type="password" name="contrasena" id=""></p>
            <p><input type="submit" value="Entrar" name="inicio"></p>
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
</body>
</html>