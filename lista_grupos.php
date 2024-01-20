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
            <div class='filtro'><form method='post' action=''><input type="text" name="ngrupo" required><input type="submit" value="Filtrar" name="filtrar"></form></div>
            <div class="panel_lg">
                
            <?php

                try{   
                    
                    $con=Conectar();
                    $consulta="SELECT * FROM grupos g INNER JOIN usuarios_grupo ug ON g.nombreG=ug.nombreG  WHERE ug.moderador=?";

                    if(isset($_POST['filtrar'])){

                        $consulta.=" AND ug.nombreG LIKE '%".$_POST['ngrupo']."%' ";
                    }
                    $consulta.=" GROUP BY ug.nombreG ORDER BY g.nombreG DESC";  
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

                                        $datos.="<div>Solicitado | <a href='./lista_grupos.php?grupos=".$fila['nombreG']."'>Cancelar</a></div>";
                                    }else{

                                        $datos.="<div><a href='./grupo.php?grupo=".$fila['nombreG']."'>Ver Grupo </a>";
                                        if($filag['moderador'] == 0){
                                        $datos.="| <a href='./lista_grupos.php?grupos=".$fila['nombreG']."'> Salir del Grupo</a>";
                                        }
                                        $datos.= "</div>";
                                    }
                                
                                    
                                }else{
                                    $datos.="<div><a href='./lista_grupos.php?grupo=".$fila['nombreG']."'>Solicitar</a></div>";
                                }
                            
                            $datos.= "</div>";
                        
                            
                        }
                    
                        
                        echo $datos;

                    }else{

                        echo "<p>No se ha podido encontrar ningún grupo</p>";
                    }

                    
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