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
                header("Location:./comentarios.php?idpost=".$_SESSION['idpost']."&grupo=".$_SESSION['grupo']."#ancla-2");
        }

        if(isset($_GET['eliminar'])){

            elimina_Datos(array($_GET['eliminar']), "DELETE FROM post WHERE idpost=?");
            header("Location:./comentarios.php?idpost=".$_SESSION['idpost']."&grupo=".$_SESSION['grupo']);
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
            <div class="panel_com">
                
            <?php

                if(isset($_GET['idpost'])){

                    $_SESSION['idpost']=$_GET['idpost'];
                    $_SESSION['grupo']=$_GET['grupo'];

                    $consultag="SELECT * FROM usuarios_grupo WHERE nick_contacto=? AND nombreG=? AND admitido=1";
                    $registros=contar_Registros($consultag, array($_SESSION['nombre'],  $_SESSION['grupo']));

                    if($registros == 0){
                        echo "<p><img src='./img/grupos.png'></p>";
                        echo "<p>Usted no tiene permiso del administrador para acceder a este grupo, debería de realizar una solicitud.</p>";
              
                    }else{
                    
                        //$consulta_t="SELECT * FROM post WHERE idpost=?";
                        //$subject=consultar_lista2($consulta_t, array("subject"), array($_SESSION['idpost']));
                        //$_SESSION['subject']=$subject;

                        echo "<h3><a href='./grupo.php?grupo=".$_SESSION['grupo']."'>".$_SESSION['grupo']."</a></h3>";
                        $consulta="SELECT * FROM post p INNER JOIN post_grupos pg ON p.idpost = pg.idpost INNER JOIN usuarios u ON pg.nick_envia=u.nick INNER JOIN perfiles per ON per.nick=u.nick WHERE p.idpost=? AND pg.nombreG=?";
                        //$_SESSION['grupo']=consultar_lista($consulta, array("nombreG"), array($_GET['idpost']));
                        echo "<div class='post'>";
                        imprime_perfil_bd($consulta, array($_SESSION['idpost'], $_SESSION['grupo']), array("subject", "texto", "fecha", "nick_envia", "foto"), array("title","text","date","url","img"));
                        echo "</div>";




                        try{     

                            $con=Conectar();
                            $stmt=$con->prepare("SELECT * FROM post p INNER JOIN post_grupos pg ON p.idpost = pg.idpost INNER JOIN usuarios u ON pg.nick_envia=u.nick INNER JOIN perfiles per ON per.nick=u.nick  WHERE p.idpostR=".$_SESSION['idpost']." AND pg.estado=2 ORDER BY p.idpost ASC");
                            //$stmt->bindValue(1, $cod);
                            //$stmt->bindValue(2, $id);
                            $stmt->execute();
                            $num_filas=$stmt->rowCount();
                            if($num_filas ==0){

                                $datos="No hay comentarios";
                            }else{
                            $datos="<h3>Comentarios:</h3>";
                            $datos.="<div class='comentarios'>";
                        
                            while($fila=$stmt->fetch(PDO::FETCH_ASSOC)){
                                
                                //array_push($lista_mascotas['Pl'],$fila['rasgo']);
                            
                                    $datos.="<div class='coment'>";
                                    $datos.="<p>";
                                        $datos.= "<div><img src='./img/".$fila['foto']."' width='10%' height='10%'><b>".$fila['nick_envia'].":</b></div>";
                                        $datos.= "<div>".$fila['texto']."</div>";
                                        $num_ad=contar_Registros("SELECT * FROM usuarios_grupo WHERE nick_contacto=? AND nombreG=? AND moderador=? and admitido=?", array($_SESSION['nombre'],  $_SESSION['grupo'],1 ,1));
                                        
                                        if($num_ad > 0){

                                            $datos.="<div><p>  <a href='./edicion_comentario.php?id=".urlencode(base64_encode($fila['idpost']))."&grupo=".urlencode(base64_encode($_SESSION['grupo']))."'>Editar </a> |<a href='./comentarios.php?eliminar=".$fila['idpost']."'> Eliminar </a></p></div>";

                                        }else{

                                        if($_SESSION['nombre'] == $fila['nick_envia']){
                                            
                                            $datos.="<div><p> <a href='./edicion_comentario.php?id=".$fila['idpost']."&grupo=".$_SESSION['grupo']."'>Editar</a> |<a href='./comentarios.php?eliminar=".$fila['idpost']."'> Eliminar </a></p></div>";
                                        }


                                        }
                                    $datos.="</p>";  
                                    $datos.="</div>";
                                    
                                     
                                
                            }
                            $datos.="</div>";
                            
                            }
                            echo $datos;
                        }catch(PDOException $e){
                            echo $e->getMessage();

                        }


                

                        echo "<a name='ancla-2'></a>";
                        echo "<form action='' method='post'>";
                            echo "<input type='hidden' name='idpost' value='".$_GET['idpost']."'>";
                            echo "<textarea name='comentario' id='' cols='60' rows='15'></textarea>";

                            echo "<p><input type='submit' value='Enviar Comentario' name='envio'></p>";
                        echo "</form>";
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