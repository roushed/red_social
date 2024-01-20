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

        if(isset($_GET['grupo'])){

            $consulta="INSERT INTO usuarios_grupo VALUES(?,?, 0, 0, 0)";
            inserta_Datos($consulta, array($_SESSION['nombre'], $_GET['grupo']));
            echo "Has realizado la solicitud al grupo";

        }

        if(isset($_GET['grupos'])){

            $consulta="DELETE FROM usuarios_grupo WHERE nick_contacto=? AND nombreG=?";
            //Elimina
            inserta_Datos($consulta, array($_SESSION['nombre'], $_GET['grupos']));
            

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
        <h2>Lista de Grupos:</h2>
            <div class='filtro'><form method='post' action=''><input type="text" name="ngrupo"><input type="submit" value="Filtrar" name="filtrar"></form></div>
            <div class="panel_lg">
                
            <?php

                try{   
                    
                    $con=Conectar();
                    $num_reg=6;
                    $hasta=0;
                    $pagina='1';
                    if(isset($_GET['pagina'])){
                        
                        $pagina=$_GET['pagina'];
                        $hasta=intval($_GET['pagina']-1)*$num_reg;
                
                    }
                    $consulta="SELECT * FROM grupos g INNER JOIN usuarios_grupo ug ON g.nombreG=ug.nombreG  WHERE ug.moderador=?";
                    if(isset($_POST['filtrar'])){

                        $consulta.=" AND ug.nombreG LIKE '%".$_POST['ngrupo']."%' ";
                    }
                    $consulta.=" GROUP BY ug.nombreG ORDER BY g.nombreG DESC LIMIT $hasta, $num_reg";  
                    $stmt=$con->prepare($consulta);
                    $stmt->bindValue(1, 1);
                    //$stmt->bindValue(2, $id);
                    $stmt->execute();
                    $num_grupos=$stmt->rowCount();
                    $datos= "";

                    if($num_grupos > 0){
                    
                        while($fila=$stmt->fetch(PDO::FETCH_ASSOC)){
                        
                            //array_push($lista_mascotas['Pl'],$fila['rasgo']);
                            $datos.= "<div class='grupo'>";
                                $datos.= "<div><img src='./img/grupos.png'></div>";
                                $datos.= "<div><a href='./grupo.php?grupo=".$fila['nombreG']."'><b>".$fila['nombreG']."</b></a></div>";
                                $datos.= "<div>".$fila['descripcion']."</div>";
                                $datos.= "<div>Creado por <b><a href='./perfil.php?nick=".$fila['nick_contacto']."'>".$fila['nick_contacto']."</a></b></div>";
                                $stmtg=$con->prepare("SELECT * FROM usuarios_grupo WHERE nick_contacto=? AND nombreG=?");
                                $stmtg->bindValue(1, $_SESSION['nombre']);
                                $stmtg->bindValue(2, $fila['nombreG']);
                                $stmtg->execute();
                                $num_filas=$stmtg->rowCount();
                                $filag=$stmtg->fetch(PDO::FETCH_ASSOC);
                                if($num_filas != 0){
                                    if($filag['admitido'] != 1){

                                        $datos.="<div>Solicitado | <a href='./lista_gruposv2.php?grupos=".$fila['nombreG']."'>Cancelar</a></div>";
                                    }else{

                                        $datos.="<div><a href='./grupo.php?grupo=".$fila['nombreG']."'>Ver Grupo </a>";
                                        if($filag['moderador'] == 0){
                                        $datos.="| <a href='./lista_gruposv2.php?grupos=".$fila['nombreG']."'> Salir del Grupo</a>";
                                        }
                                        $datos.= "</div>";
                                    }
                                
                                    
                                }else{
                                    $datos.="<div><a href='./lista_gruposv2.php?grupo=".$fila['nombreG']."'>Solicitar</a></div>";
                                }
                            
                            $datos.= "</div>";
                        
                            
                        }
                    
                        $datos.="</div>";
                        $datos.="<div class='paginar'>";
                        //$num_pag=round($num_filas/$num_reg)+1;
                        $consult_total="SELECT * FROM grupos ORDER BY nombreG";
                        $num_grupos=contar_Registros($consult_total, array());
                        $num_pag=round($num_grupos/$num_reg,0, PHP_ROUND_HALF_UP);
                        //echo $num_pag;
                        $pag_anterior=intval($pagina)-1;
                        $pag_anterior=strval($pag_anterior);
                        if($pagina != "1"){
                
                            $datos.="<div class='div_estado'><a href='./lista_gruposv2.php?pagina=$pag_anterior'>Anterior</a></div>";
                
                        }      
                        for($i=0; $i<$num_pag; $i++){
                            
                                if($pagina == strval($i+1)){
                                    
                                    $datos.="&nbsp<div class='div_select'><a href='./lista_gruposv2.php?pagina=".strval($i+1)."'>".($i+1)."</a></div>";
                
                                }else{
                                    $datos.="&nbsp<div class='div_noselect'><a href='./lista_gruposv2.php?pagina=".strval($i+1)."'>".($i+1)."</a></div>";
                
                                }  
                        }
                        
                        $pag_siguiente=intval($pagina)+1;
                        $pag_siguiente=strval($pag_siguiente);
                        
                        if($pagina != strval($num_pag)){
                            $datos.="&nbsp<div class='div_estado'><a href='./lista_gruposv2.php?pagina=$pag_siguiente'>Siguiente</a></div>";
                
                        }
                        $datos.="</div>";

                }else{

                    echo "<p>No se ha podido encontrar ningún grupo</p>";
                }

                    $datos.="</div>";
                    echo $datos;

                    
                }catch(PDOException $e){
                    echo $e->getMessage();

                }

            ?>
            
            
        </div>

        <div class="pie">

            @copyright
        </div>


    </div>

</body>
</html>