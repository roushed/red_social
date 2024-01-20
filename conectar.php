<?php

        
    function Conectar(){


        $c_dsn="mysql:host=localhost;dbname=red_social";
        $cod='MAD-ES';
        $con=new PDO($c_dsn, 'root', '');
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $con;




    }

?> 