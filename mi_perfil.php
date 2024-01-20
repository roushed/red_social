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
        
        if (isset($_GET['id'])){

            elimina_Datos(array($_GET['id']), "DELETE FROM post WHERE idpost=?");
            header('Location:./mi_perfil.php');  


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
        
            <div class="mi_perfil">
               
            <?php
       
                $consulta="SELECT * FROM perfiles WHERE nick=?";
                $lista=consultar_lista($consulta, array("nick", "foto", "nombre", "apellidos", "fecha_nacimiento", "ciudad", "pais", "url", "descripcion"), array($_SESSION['nombre'])); 
            ?>

   
       
        <?php
            
            $propiedades=array("nick", "foto", "nombre", "apellidos", "fecha_nacimiento", "ciudad", "pais", "url", "descripcion");
            imprime_perfil($lista, array("title", "img","text","text","birth","text","text","url", "text"));
            echo "<div class='perfil'><a href='./visitas.php'>Visitas</a></div>";
            echo "<div class='opciones_perfil'>";
            echo "<div class='perfil'><a href='./editar_perfil.php'>Editar Perfil</a></div>";
            echo "<div class='perfil'><a href='./cambiar_pass.php'>Cambiar Contraseña</a></div>";
            echo "</div>";
           
            
            //$consulta2="SELECT * FROM post p INNER JOIN post_grupos pg ON p.idpost=pg.idpost WHERE pg.nick_envia=? AND p.idpostR IS NULL AND pe.estado=2"; 
            try{     
                
                $con=Conectar();
                $consultag="SELECT * FROM post p INNER JOIN post_grupos pg ON p.idpost=pg.idpost WHERE pg.nick_envia=? AND p.idpostR IS NULL AND pg.estado=2";
                if(isset($_POST['filtrar'])){

                    $consultag.=" AND pg.nombreG LIKE '%".$_POST['ngrupo']."%'";
                }
                $consultag.=" ORDER BY p.fecha DESC";
                $stmt=$con->prepare($consultag);
                $stmt->bindValue(1, $_SESSION['nombre']);
                //$stmt->bindValue(2, $id);
                $stmt->execute();
                $num_f=$stmt->rowCount();
                
                $datos="<div class='mensajes'>";
                $consultalg="SELECT * FROM grupos g INNER JOIN usuarios_grupo ug ON g.nombreG=ug.nombreG WHERE ug.nick_contacto='".$_SESSION['nombre']."' AND ug.admitido=1 ORDER BY g.nombreG";
                echo "<div class='filtro'>";
                
                    echo "<form method='post' action=''>";
                    creacion_Select($consultalg, "nombreG", "nombreG", "ngrupo");
                    echo "<input type='submit' value='Filtrar Grupo' name='filtrar'>";
                    echo "</form>";
                    if($num_f == 0){
                        echo "<div>No se han escrito mensajes</div>";
                    }
                echo "</div>";
                

                //echo "<div class='filtro'><form method='post' action=''><input type='text' name='ngrupo'><input type='submit' value='Filtrar Grupo' name='filtrar'></form></div>";
                while($fila=$stmt->fetch(PDO::FETCH_ASSOC)){
                  
                    //array_push($lista_mascotas['Pl'],$fila['rasgo']);
                    $datos.= "<div class='msg_cuadro'>";
                        $datos.="<h3>".$fila['nombreG']."</h3>";
                        $datos.= "<div><b>".$fila['subject']."</b></div>";
                        $datos.= "<div>".$fila['texto']."</div>";
                        $datos.= "<div>".strftime("%d de %B, %G", strtotime($fila['fecha']))."</div>";
                        $datos.="<div><p><a href='./comentarios.php?idpost=".$fila['idpost']."&grupo=".$fila['nombreG']."'>Comentarios";
                        $consulta="SELECT * FROM post p INNER JOIN post_grupos pg ON p.idpost = pg.idpost  WHERE p.idpostR=? AND pg.estado=2";
                        $num_reg=contar_Registros($consulta, array($fila['idpost']));
                        $datos.="($num_reg)</a></p></div>";
                        $consulta2="SELECT * FROM usuarios_grupo WHERE nick_contacto=? AND nombreG=? AND admitido=1";
                        $usuariog=contar_Registros($consulta2, array($_SESSION['nombre'], $fila['nombreG']));
                        if($usuariog >0){
                            $datos.= "<div class='botones_edit'><div class='boton_e'><a href='edicion.php?id=".$fila['idpost']."'>Editar</a></div>  <div class='boton_e'><a href='mi_perfil.php?id=".$fila['idpost']."'>Eliminar</a></div></div>";
                        }else{
                            $datos.="<div>Ya no pertenece al grupo</div>";
                        }
                    $datos.= "</div>";
               
                    
                }
                $datos.="</div>";
                
                
                echo $datos;
            
                
            }catch(PDOException $e){
                echo $e->getMessage();
            
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