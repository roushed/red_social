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

        if(isset($_GET['id'])){
            
            $consulta="DELETE FROM post WHERE idpost=? ";
            elimina_Datos(array($_GET['id']), $consulta);

        }    
    ?>
</head>
<body>
    <?php
       
        $consulta="SELECT * FROM perfiles WHERE nick=?";
        $lista=consultar_lista($consulta, array("nick", "foto", "nombre", "apellidos", "fecha_nacimiento", "ciudad", "pais", "url", "descripcion"), array($_SESSION['nombre']));
        
    ?>

    <div>
        
        <?php
            
            $propiedades=array("nick", "foto", "nombre", "apellidos", "fecha_nacimiento", "ciudad", "pais", "url", "descripcion");
            imprime_perfil($lista, array("text", "img","text","text","text","text","text","url", "text"));
            echo "<div><a href='./editar_perfil.php'>Editar Perfil</a></div>";
            echo "<h2>Mensajes:</h2>";
            //$consulta2="SELECT * FROM post p INNER JOIN post_grupos pg ON p.idpost=pg.idpost WHERE pg.nick_envia=? AND p.idpostR IS NULL AND pe.estado=2"; 
            try{     
             
                $con=Conectar();
                $stmt=$con->prepare("SELECT * FROM post p INNER JOIN post_grupos pg ON p.idpost=pg.idpost WHERE pg.nick_envia=? AND p.idpostR IS NULL AND pg.estado=2");
                $stmt->bindValue(1, $_SESSION['nombre']);
                //$stmt->bindValue(2, $id);
                $stmt->execute();
                //$num_filas=$stmt->rowCount();
                $datos="<div>";
                while($fila=$stmt->fetch(PDO::FETCH_ASSOC)){
                    $datos.="<p>";
                    //array_push($lista_mascotas['Pl'],$fila['rasgo']);
                    $datos.= "<div>";
                        $datos.="<h3>".$fila['nombreG']."</h3>";
                        $datos.= "<div><b>".$fila['subject']."</b></div>";
                        $datos.= "<div>".$fila['texto']."</div>";
                        $datos.= "<div>".$fila['fecha']."</div>";
                        $datos.="<div><p><a href='./comentarios.php?idpost=".$fila['idpost']."&grupo=".$fila['nombreG']."'>Comentarios";
                        $consulta="SELECT * FROM post p INNER JOIN post_grupos pg ON p.idpost = pg.idpost  WHERE p.idpostR=?";
                        $num_reg=contar_Registros($consulta, array($fila['idpost']));
                        $datos.="($num_reg)</a></p></div>";
                        $datos.= "<div><a href='edicion.php?id=".$fila['idpost']."'>Editar</a> | <a href='mi_perfil.php?id=".$fila['idpost']."'>Eliminar</a></div>";
                        $datos.="</div>";
                    $datos.= "</div>";
                    $datos.="</p>";
                    
                }
                $datos.="</div>";
                
                
                echo $datos;
            
                
            }catch(PDOException $e){
                echo $e->getMessage();
            
            }

           
        ?>
    </div>
</body>
</html>