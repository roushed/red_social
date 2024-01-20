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
        if(isset($_GET['solicitar'])){

            $consulta="INSERT INTO contactos VALUES(?, ?, ?, ?)";
            inserta_Datos($consulta, array($_SESSION['nombre'], $_SESSION['nick'], 1 ,0));
          
        }

        if(isset($_GET['eliminar'])){

            $consulta="DELETE FROM contactos WHERE nick=? AND nick_contacto=?";
            inserta_Datos($consulta, array($_SESSION['nombre'], $_SESSION['nick']));
            $consulta2="DELETE FROM contactos WHERE nick=? AND nick_contacto=?";
            inserta_Datos($consulta, array($_SESSION['nick'], $_SESSION['nombre']));
            header('Location:./mis_contactos.php');
        }

        if(isset($_GET['cancelar'])){

            $consulta="DELETE FROM contactos WHERE nick=? AND nick_contacto=?";
            inserta_Datos($consulta, array($_SESSION['nombre'], $_SESSION['nick']));

        }

        if(isset($_GET['bloquear'])){

            $consulta="UPDATE contactos SET bloqueo=1, admitir=3  WHERE nick=? AND nick_contacto=?";
            inserta_Datos($consulta, array($_SESSION['nombre'], $_SESSION['nick']));
            $consulta2="UPDATE contactos SET bloqueo=1 WHERE nick=? AND nick_contacto=?";
            inserta_Datos($consulta2, array($_SESSION['nick'], $_SESSION['nombre']));
            header('location:./u_bloqueados.php');

        }
    ?>
</head>
<body>
    <?php
        if(isset($_GET['nick'])){
            $_SESSION['nick']=$_GET['nick'];
        }

        if(isset($_SESSION['nick'])){


            $bloqueo=hay_Registro("SELECT * FROM contactos WHERE nick=? AND nick_contacto=? AND bloqueo=1", array($_SESSION['nombre'], $_SESSION['nick']));

            if($bloqueo){

                echo "<p>El perfil de este usuario se encuentra bloqueado</p>";
            }else{

                
            
                echo "<h2>Perfil:</h2>";
                $consulta="SELECT * FROM perfiles WHERE nick=?";
                imprime_perfil_bd($consulta, array($_SESSION['nick']), array("nick", "foto", "nombre", "apellidos", "fecha_nacimiento", "ciudad", "pais", "url", "descripcion"), array("title", "img","text", "text", "date","text","text","text","text"));
                $num_filas=contar_Registros("SELECT * FROM contactos WHERE nick=? AND nick_contacto=?", array($_SESSION['nombre'], $_SESSION['nick']));
                if($num_filas > 0){
                    $num_admitidos=contar_Registros("SELECT * FROM contactos WHERE nick=? AND nick_contacto=? AND admitir=2", array($_SESSION['nombre'], $_SESSION['nick']));

                    if($num_admitidos == 0 ){

                        echo "<p><div>Esperando Solicitud... | <a href='./perfil.php?cancelar=".$_SESSION['nick']."'>Cancelar</a></div></p>";

                    }else{
                        echo "<div>";
                        echo "<p><div><a href='./mensaje_priv.php?nick=".$_SESSION['nick']."'>Enviar Mensaje</a></div></p>";
                        echo "<p><div><a href='./perfil.php?eliminar=".$_SESSION['nick']."'>Eliminar Contacto</a></div></p>";
                        echo "<p><div><a href='./perfil.php?bloquear=".$_SESSION['nick']."'>Bloquear</a></div></p>";
                        echo "</div>";
                        

                    }
                }else{

                    if($_SESSION['nombre'] != $_SESSION['nick']){
                        echo "<p><div><a href='./perfil.php?solicitar'>Solicitar Amistad</a></div></p>";
                    }
                }
                echo "<h2>Filtrar:</h2>";
                echo "<form method='post' action=''>";
                echo "<input type='text' name='buscar'> <input type='submit' name='filtrar'>";
                echo "</form>";
                echo "<h2>Mensajes:</h2>";
            
                
                    $consulta2="SELECT * FROM grupos g INNER JOIN usuarios_grupo ug ON g.nombreG=ug.nombreG WHERE ug.nick_contacto=? AND ug.admitido=1 ORDER BY ug.nombreG DESC;"; 
                    imprime_perfil_bd($consulta2, array($_SESSION['nick']), array("nombreG","descripcion"), array("title", "text"));
                

           
            }
           
        }
    ?>
</body>
</html>