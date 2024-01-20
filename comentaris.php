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

        if(isset($_POST['envio'])){
           
            $consulta="INSERT INTO post VALUES (0, null, ?, ?, ?, ?)";
            $fecha=date("Y-m-d");
            
                inserta_Datos($consulta, array($_POST["comentario"], null, $fecha, $_SESSION['idpost']));
                $ultima_id=sumar_Valores("SELECT MAX(idpost)  AS total FROM post", array());
                
                $num_reg=contar_Registros("SELECT * FROM usuarios_grupo WHERE nombreG=? AND moderador=1 AND nick_contacto=?", array($_SESSION['grupo'], $_SESSION['nombre']));        
                if($num_reg > 0){
                    $num=2;
                }else{
                    $num=1;
                }

                $consulta2="INSERT INTO post_grupos VALUES (?, ?, ?, ?)";
                inserta_Datos($consulta2, array( $ultima_id , $_SESSION['grupo'], $_SESSION['nombre'], $num));
        }

        if(isset($_GET['eliminar'])){

            elimina_Datos(array($_GET['eliminar']), "DELETE FROM post WHERE idpost=?");
            header("Location:./comentarios.php?idpost=".$_SESSION['idpost']."&grupo=".$_SESSION['grupo']);
        }

       
    ?>
</head>
<body>
    <?php

        if(isset($_GET['idpost'])){

            $_SESSION['idpost']=$_GET['idpost'];
            $_SESSION['grupo']=$_GET['grupo'];
            //$consulta_t="SELECT * FROM post WHERE idpost=?";
            //$subject=consultar_lista2($consulta_t, array("subject"), array($_SESSION['idpost']));
            //$_SESSION['subject']=$subject;
  
            
            $consulta="SELECT * FROM post p INNER JOIN post_grupos pg ON p.idpost = pg.idpost WHERE p.idpost=? AND pg.nombreG=?";
            //$_SESSION['grupo']=consultar_lista($consulta, array("nombreG"), array($_GET['idpost']));
            imprime_perfil_bd($consulta, array($_SESSION['idpost'], $_SESSION['grupo']), array("subject", "texto", "fecha", "nick_envia", "imagen"), array("title","text","date","url","img"));





            try{     
        
                $con=Conectar();
                $stmt=$con->prepare("SELECT * FROM post p INNER JOIN post_grupos pg ON p.idpost = pg.idpost INNER JOIN usuarios u ON pg.nick_envia=u.nick INNER JOIN perfiles per ON per.nick=u.nick  WHERE p.idpostR=".$_SESSION['idpost']." AND pg.estado=2 ORDER BY p.idpost ASC");
                //$stmt->bindValue(1, $cod);
                //$stmt->bindValue(2, $id);
                $stmt->execute();
                $num_filas=$stmt->rowCount();
                
                $datos="<div>";
                $datos.="<h3>Comentarios:</h3>";
                while($fila=$stmt->fetch(PDO::FETCH_ASSOC)){
                    
                    //array_push($lista_mascotas['Pl'],$fila['rasgo']);
                  
                        $datos.="<div>";
                        $datos.="<p>";
                            $datos.= "<div><img src='./img/".$fila['foto']."' width='1%' height='1%'>".$fila['nick_envia'].":</div>";
                            $datos.= "<div>".$fila['texto']."</div>";
                            $num_ad=contar_Registros("SELECT * FROM usuarios_grupo WHERE nick_contacto=? AND nombreG=? AND moderador=? and admitido=?", array($_SESSION['nombre'],  $_SESSION['grupo'],1 ,1));
                            
                            if($num_ad > 0){

                                $datos.="<div><p>  <a href='./edicion_comentario.php?id=".$fila['idpost']."&grupo=". $_SESSION['grupo']."'>Editar </a> |<a href='./comentarios.php?eliminar=".$fila['idpost']."'> Eliminar </a></p></div>";

                            }else{

                            if($_SESSION['nombre'] == $fila['nick_envia']){
                                
                                $datos.="<div><p> <a href='./edicion_comentario.php?id=".$fila['idpost']."&grupo=".$_SESSION['grupo']."'>Editar</a> |<a href='./comentarios.php?eliminar=".$fila['idpost']."'> Eliminar </a></p></div>";
                            }


                            }
                        $datos.="</p>";  
                        $datos.="</div>";
                        
                        
                    
                }
                $datos.="</div>";
                
                
                echo $datos;
            }catch(PDOException $e){
                echo $e->getMessage();
        
            }


        }

        
    ?>
    <form action="" method="post">
        <input type="hidden" name="idpost" value="<?php if(isset($_GET['idpost'])) echo $_GET['idpost']  ?>">
        <textarea name="comentario" id="" cols="30" rows="10"></textarea>

        <p><input type="submit" value="Enviar Comentario" name="envio"></p>
    </form>
</body>
</html>