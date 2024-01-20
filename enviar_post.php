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
        
            if(!isset($_POST['ngrupo']) && !isset($_POST['ncontacto']) && !isset($_POST['todos'])){

                echo "No se ha seleccionado ningún destinatario";
            }else{

                if (is_uploaded_file ($_FILES['imagen']['tmp_name'] )){
        
                    $nombreFichero = $_FILES['imagen']['name'];
                    $formato=pathinfo($nombreFichero, PATHINFO_EXTENSION);
                    $nombreDirectorio = "img/";
                    if (is_dir($nombreDirectorio)){ 
                        //$idUnico = time();
                        $nombreCompleto = $nombreDirectorio.$nombreFichero;
                        if($formato == "jpg" || $formato == "jpeg"){
                        move_uploaded_file ($_FILES['imagen']['tmp_name'],$nombreCompleto);
                        //print_r($lista);
                        $imagen=$nombreFichero; 
                        }else{
                            echo "Error del formato de la iamgen";
                        }
                    }
                }else{
                    
                    $imagen=null;

                }


                $fecha=date("Y-m-d");
                $consulta="INSERT INTO post VALUES (0, ?, ?, ?, ?, null)";
                inserta_Datos($consulta, array($_POST["asunto"], $_POST["texto"], $imagen, $fecha));
                header('Location:./panel_principal.php');
                
                if(isset($_POST['ngrupo'])){
                    
                    foreach($_POST['ngrupo'] as $valor){
                        

                        $ultima_id=sumar_Valores("SELECT MAX(idpost)  AS total FROM post", array());
                        $num_reg=contar_Registros("SELECT * FROM usuarios_grupo WHERE nombreG=? AND moderador=1 AND nick_contacto=?", array($valor, $_SESSION['nombre']));
                        
                        if($num_reg > 0){
                            $consultal="UPDATE usuarios u INNER JOIN usuarios_grupo ug ON u.nick=ug.nick_contacto SET u.no_leidos=u.no_leidos+1 WHERE ug.nombreG=?";
                            inserta_Datos($consultal, array($valor));
                            $num=2;
                        }else{
                            $num=1;
                        }
                        $consulta2="INSERT INTO post_grupos VALUES (?, ?, ?, ?)";
                        inserta_Datos($consulta2, array( $ultima_id ,$valor, $_SESSION['nombre'], $num));
                        
                        

                    }
                }
                if(!isset($_POST['todos'])){
                    if(isset($_POST['ncontacto'])){

                        foreach($_POST['ncontacto'] as $valor){
                        //$consulta="INSERT INTO post VALUES(0, null, ?, null, ?, null)";
                        //inserta_Datos($consulta, array($_POST['texto'], $fecha));
                        $ult_id=sumar_Valores("SELECT MAX(idpost)  AS total FROM post", array());
                        $consulta2="INSERT INTO post_usuarios VALUES(?, ?, ?, 0)";
                        inserta_Datos($consulta2, array($ult_id, $valor, $_SESSION['nombre']));
                        
                        }
                    }

                }else{

                    $lista=consultar_lista("SELECT * FROM contactos WHERE nick=? AND admitir=2", array("nick_contacto"), array($_SESSION['nombre']));

                    foreach($lista as $clave => $valor){
                        foreach($valor as $clave2 => $valor2){

                            $ult_id=sumar_Valores("SELECT MAX(idpost)  AS total FROM post", array());
                            $consulta2="INSERT INTO post_usuarios VALUES(?, ?, ?, 0)";
                            inserta_Datos($consulta2, array($ult_id, $valor2, $_SESSION['nombre']));

                        }
                    }
                    
                }
            }
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
            <div class="panel_r">
                <h2>Crear Post:</h2>
                <form action="" method="post"  enctype='multipart/form-data'>
                    <?php

                    $consulta="SELECT * FROM grupos g INNER JOIN usuarios_grupo ug ON g.nombreG=ug.nombreG WHERE ug.nick_contacto='".$_SESSION['nombre']."' AND ug.admitido=1 ORDER BY g.nombreG";
                    $reg1=hay_Registro($consulta, array());

                    $consultac="SELECT * FROM contactos WHERE nick='".$_SESSION['nombre']."' AND admitir=2 AND bloqueo=0";
                    $reg2=hay_Registro($consultac, array());

                    if($reg1 || $reg2){

                        crearFormularioText(array("asunto", "texto"), array("text", "textarea"));
                        echo "<p><input type='file' name='imagen'></p>";
                        if($reg1){
                        creacion_Selectm($consulta, "nombreG", "nombreG", "ngrupo");
                        }
                        if($reg2){
                        creacion_Selectm($consultac, "nick_contacto", "nick_contacto", "ncontacto");
                        }

                    ?>
                     <p class='p_form'><input type="checkbox" name="todos">Enviar a todos los usuarios</p>
                     <p class='p_form'><input type="submit" value="Publicar" name='envio'></p>
                    <?php
                    }else{
                        echo "<p>No se puede publicar ningún post no perteneces a un grupo ni contactos";
                    }
                        
                    ?>
                   
                </form>
            
            </div>
        </div>

        <div class="pie">

            @copyright
        </div>


    </div>

</body>
</html>