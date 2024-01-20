<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
        include "./f_modular.php";
        include "./seguridad.php";

        if(isset($_GET['nick_a'])){

            $consulta="UPDATE contactos SET admitir=2 WHERE nick=? and nick_contacto=?";
            inserta_Datos($consulta, array($_GET['nick_a'], $_SESSION['nombre']));
            $consulta2="INSERT INTO contactos VALUES(?, ?, 2, 0)";
            inserta_Datos($consulta2, array($_SESSION['nombre'], $_GET['nick_a']));
           //header("Location:./mis_contactos.php");
        }

        if(isset($_GET['nick_c'])){

            $consulta="UPDATE contactos SET admitir=3 WHERE nick=? and nick_contacto=?";
            inserta_Datos($consulta, array($_GET['nick_c'], $_SESSION['nombre']));
            
        }
    ?>
</head>
<body>
    <?php
        
            try{     
               
                $con=Conectar();
                $stmt=$con->prepare("SELECT * FROM contactos WHERE nick_contacto=? AND admitir=1");
                $stmt->bindValue(1, $_SESSION['nombre']);
                //$stmt->bindValue(2, 1);
                $stmt->execute();
                $num_filas=$stmt->rowCount();
                if($num_filas !=0){
                    $datos="<div>";
                    while($fila=$stmt->fetch(PDO::FETCH_ASSOC)){
                        $datos.="<p>";
                        //array_push($lista_mascotas['Pl'],$fila['rasgo']);
                        $datos.= "<div>";
                            $datos.= "<div>".$fila['nick']." le acaba de pedir una solicitud de amistad</div>";
                            $datos.= "<div><a href='./pendiente_solicitud_c.php?nick_a=".$fila['nick']."'>Aceptar</a> |<a href='./pendiente_solicitud_c.php?nick_c=".$fila['nick']."'>Cancelar</a></div>";
                        $datos.= "</div>";
                        $datos.="</p>";
                        
                    }
                    $datos.="</div>";
                    
                    echo $datos;
                }else{
        
                    header("Location:./mis_contactos.php");
                }
        
                
            }catch(PDOException $e){
                echo $e->getMessage();
        
            }
        
        
    ?>
</body>
</html>