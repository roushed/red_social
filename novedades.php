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

        $consultapg="UPDATE usuarios SET no_leidos=0 WHERE nick=?";
        inserta_Datos($consultapg, array($_SESSION['nombre']));
            
        if(isset($_GET['idlike'])){
            $consulta="INSERT INTO likes VALUES (?, ?)";
            inserta_Datos($consulta, array($_GET['idlike'], $_SESSION['nombre']));
            header('Location:./novedades.php#ancla-'.$_GET['idlike']);
        }

        if(isset($_GET['idislike'])){
            $consulta="DELETE FROM likes WHERE id_post=? AND nick=?";
            inserta_Datos($consulta, array($_GET['idislike'], $_SESSION['nombre']));
            header('Location:./novedades.php?#ancla-'.$_GET['idislike']);
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
            <div class="panel_grp">
                

            <?php
        
        if(isset($_SESSION['nombre'])){
           

                try{     
                   
                    $con=Conectar();
                    $num_post=10;
                    $desde=0;
                    $pagina='1';
                    if(isset($_GET['pagina'])){
                        
                        $pagina=$_GET['pagina'];
                        $desde=intval($_GET['pagina']-1)*$num_post;
                
                    }
                    $consulta="SELECT * FROM post p INNER JOIN post_grupos pg ON p.idpost = pg.idpost INNER JOIN usuarios u ON pg.nick_envia=u.nick INNER JOIN perfiles per ON per.nick=u.nick INNER JOIN usuarios_grupo ug ON ug.nombreG=pg.nombreG WHERE ug.nick_contacto=? AND pg.estado=2 AND ug.admitido=1 AND p.idpostR IS NULL";
                    if(isset($_POST['filtrar'])){
                        $consulta.=" AND p.fecha BETWEEN '".$_POST['fecha1']."' AND '".$_POST['fecha2']."' ORDER BY p.fecha DESC, p.idpost DESC";
                    }else{
                        $consulta.=" ORDER BY p.fecha DESC, p.idpost DESC LIMIT $desde, $num_post";
                    }
                    $stmt=$con->prepare($consulta);
                    $stmt->bindValue(1,  $_SESSION['nombre']);
                    //$stmt->bindValue(2, $id);
                    $stmt->execute();
                    $num_filas=$stmt->rowCount();

                   
                    $datos="<div>";
                    if($num_filas != 0){
                        echo "<div class='boton' id='filtrarf'><a>Filtrar Fecha</a></div>";
                        while($fila=$stmt->fetch(PDO::FETCH_ASSOC)){
                            $datos.="<a name='ancla-".$fila['idpost']."'></a>";
                            $datos.="<p>";
                            //array_push($lista_mascotas['Pl'],$fila['rasgo']);
                            $datos.= "<div class='lista_posts'>";
                                $datos.= "<p><div class='title_nov'><a href='./grupo.php?grupo=".$fila['nombreG']."'><h1>".$fila['nombreG']."</h1></a></div></p>";
                                $datos.= "<p><div><b>".$fila['subject']."</b></div></p>";
                                $datos.= "<div class='post_texto'><p>".$fila['texto']."</p></div>";
                                if($fila['imagen'] != null){
                                    $datos.= "<div><img src='./img/".$fila['imagen']."' width='70%' height='70%'></div>";
                                }
                                $datos.= "<div>".strftime("%d de %B, %G", strtotime($fila['fecha']))."</div>";
                                $datos.= "<div><img src='./img/".$fila['foto']."' width='8%' height='8%'><br><a href='./perfil.php?nick=".$fila['nick_envia']."'>".$fila['nick_envia']."</a></br></div>";
                            
                                $datos.="<div class='div_coment'><div><a href='./comentarios.php?idpost=".$fila['idpost']."&grupo=".$fila['nombreG']."'>Comentarios";
                                $consulta="SELECT * FROM post p INNER JOIN post_grupos pg ON p.idpost = pg.idpost WHERE p.idpostR=? AND pg.estado=2 ";
                                $num_reg=contar_Registros($consulta, array($fila['idpost']));
                                $datos.="($num_reg)</a></div>";
                                $num_likes=contar_Registros("SELECT * FROM likes WHERE id_post=?", array($fila['idpost']));
                                $datos.="<div class='like'><span class='numlikes' id='numlikes'>$num_likes</span>";
                                $haylikes=hay_Registro("SELECT * FROM likes WHERE id_post=? AND nick=?", array($fila['idpost'], $_SESSION['nombre']));
                                if(!$haylikes){

                                    $datos.="<a href='novedades.php?idlike=".$fila['idpost']."'><img src='./img/mano.png'></a>";
                                }else{

                                    $datos.="<a href='novedades.php?idislike=".$fila['idpost']."'><img src='./img/mano2.png'></a> ";
                                }
                                $personas_like=consultar_lista_1col("SELECT * FROM likes WHERE id_post=?", "nick", array($fila['idpost']));

                                if($personas_like != 0){
                                    if(count($personas_like) > 3){

                                        $datos.="A&nbsp <b>".implode(", ", array_slice($personas_like, 0, 3))."</b>&nbsp y más les ha gustado";
                                    }else{
                                        
                                        $datos.="A&nbsp <b>".implode(", ", $personas_like)."</b>&nbsp le ha gustado";
                                    }
                                    
                                }

                                
                                $datos.="</div>";
                                
                                
                            $datos.= "</div>";
                            $datos.= "</div>";
                            $datos.="</p>";
                            
                        }
                        if(!isset($_POST['filtrar'])){
                            $datos.="<div class='paginar'>";
                            //$num_pag=round($num_filas/$num_reg)+1;
                            $consult_total="SELECT * FROM post p INNER JOIN post_grupos pg ON p.idpost = pg.idpost INNER JOIN usuarios_grupo ug ON ug.nombreG=pg.nombreG WHERE ug.nick_contacto=? AND pg.estado=2 AND ug.admitido=1 AND p.idpostR IS NULL";
                            $num_grupos=contar_Registros($consult_total, array($_SESSION['nombre']));
                            $num_pag=round($num_grupos/$num_post,0, PHP_ROUND_HALF_UP);
                            //echo $num_pag;
                            $pag_anterior=intval($pagina)-1;
                            $pag_anterior=strval($pag_anterior);
                            if($pagina != "1"){
                    
                                $datos.="<div class='div_estado'><a href='./novedades.php?pagina=$pag_anterior'>Anterior</a></div>";
                    
                            }      
                            for($i=0; $i<$num_pag; $i++){
                                
                                    if($pagina == strval($i+1)){
                                        
                                        $datos.="&nbsp<div class='div_select'><a href='./novedades.php?pagina=".strval($i+1)."'>".($i+1)."</a></div>";
                    
                                    }else{
                                        $datos.="&nbsp<div class='div_noselect'><a href='./novedades.php?pagina=".strval($i+1)."'>".($i+1)."</a></div>";
                    
                                    }  
                            }
                            
                            $pag_siguiente=intval($pagina)+1;
                            $pag_siguiente=strval($pag_siguiente);
                            
                            if($pagina != strval($num_pag)){
                                $datos.="&nbsp<div class='div_estado'><a href='./novedades.php?pagina=$pag_siguiente'>Siguiente</a></div>";
                    
                            }
                        }
                        $datos.="</div>";
                    }else{
                        $datos.="<p>No se ha realizado ninguna actividad</p>";
                    }
                    $datos.="</div>";
                                
                    echo $datos;
                
                    
                }catch(PDOException $e){
                    echo $e->getMessage();
                
                }
            }
        
        
          
        ?>
        
        <div class="cuadro_fechas" id="cuadro_Fechas">
        <div class="x"><a id='x'>X</a></div>
            <form action="" method="post">

                <p><label>Desde:</label></p>
                <p><input type="date" name="fecha1" id="fecha1"></p>
                <p><label>Hasta</label></p>
                <p><input type="date" name="fecha2" id="fecha2"></p>
                <p><input type="submit" value="Filtrar" name='filtrar' id='filtrar'></p>
                

            </form>
        </div>
            
            
        </div>
        </div>

        <div class="pie">

            @copyright
        </div>


    </div>
    
        <script src="./java/script.js" defer></script>
        <script src="./java/script2.js"></script>
</body>
</html>