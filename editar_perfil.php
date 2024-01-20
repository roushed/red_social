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

        if(isset($_POST['modificar'])){
        
            $lista=recoge_Post($_POST);
            
            if (is_uploaded_file ($_FILES['imagen']['tmp_name'] )){
             
                $nombreFichero = $_FILES['imagen']['name'];
                $formato=pathinfo($nombreFichero, PATHINFO_EXTENSION);
                $nombreDirectorio = "img/";
                if (is_dir($nombreDirectorio)){ 
                    //$idUnico = time();
                    $nombreCompleto = $nombreDirectorio.$nombreFichero;
                    if($formato == "jpg" || $formato == "jpeg"){
                    move_uploaded_file ($_FILES['imagen']['tmp_name'],$nombreCompleto);
                    print_r($lista);
                    
                    $consulta="UPDATE perfiles SET nombre=?, apellidos=?, fecha_nacimiento=?, ciudad=?, pais=?, url=?, descripcion=?, foto='".$nombreFichero."' WHERE nick='".$_SESSION['nombre']."'";
                    inserta_Datos($consulta, $lista);
                    header('Location:./mi_perfil.php');
                    }else{
                        echo "Error del formato de la iamgen";
                    }
                }
            }else{
                
                $consulta="UPDATE perfiles SET nombre=?, apellidos=?, fecha_nacimiento=?, ciudad=?, pais=?, url=?, descripcion=? WHERE nick='".$_SESSION['nombre']."'";
                inserta_Datos($consulta, $lista);
                header('Location:./mi_perfil.php');
    
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
             
            <h2>Editar Perfil</h2> 
                <?php
                    
                    $consulta="SELECT * FROM perfiles WHERE nick=?";
                    $lista=consultar_lista($consulta, array("nombre", "apellidos", "fecha_nacimiento", "ciudad", "pais", "url", "descripcion"), array($_SESSION['nombre']));

                ?>

                <form action="" method="post" enctype='multipart/form-data'>

                    <?php
                        imprime_val_inputs(array("nombre", "apellidos", "fecha_nacimiento", "ciudad", "pais", "url", "descripcion"), $lista, array("text", "text", "date","text", "text", "text", "textarea"));
                        
                    ?>
                    <p><input type="file" name="imagen"></p>
            
                    <p class='btn'><input type="submit" value="Editar" name="modificar"></p>

                </form>
            
            </div>
        </div>

        <div class="pie">

            @copyright
        </div>


    </div>

</body>
</html>