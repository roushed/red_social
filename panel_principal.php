<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
    <?php
        include "./seguridad.php";
        include "./f_modular.php";
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
            <div class="panel">
                <div class="fila">
                    <div class="column"><a href='./lista_grupos.php'><img src='./img/grupos.png' width="60%" height="60%"></a><p>Lista de Grupos</p></div><div class="column"><a href='./miembros.php'><img src='./img/miembros.jpg' width="60%" height="60%"></a><p>Miembros</p></div><div class="column"><a href='./mi_perfil.php'><img src='./img/miperfil.png' width="60%" height="60%"></a><p>Mi Perfil</p></div>
                </div>
                <div class="fila">
                    <div class="column"><a href='./mensajeria.php'><img src='./img/msg.png' width="50%" height="65%"></a><p>Mensajes</p></div><div class="column"><a href='./enviar_post.php'><img src='./img/crear_post.jpg' width="60%" height="60%"></a><p>Crear Post</p></div><div class="column"><a href='./novedades.php'><img src='./img/news.jpg' width="60%" height="60%"></a><p>Novedades</p></div>
                </div>
            </div>
        </div>

        <div class="pie">

            @copyright
        </div>


    </div>

</body>
</html>