<?php
        
        include "./conectar.php";
        function creacion_Select($consulta, $valor, $nombre, $name){
            //echo "<p><label>".$name."</label></p>";
            echo "<select name='$name' required>";
            try{     
                
                $con=Conectar();
                $stmt=$con->prepare($consulta);
                //$stmt->bindValue(1, $cod);
                //$stmt->bindValue(2, $id);
                $stmt->execute();
                $num_filas=$stmt->rowCount();
                echo "<option value=''>Seleccionar</option>";
                while($fila=$stmt->fetch(PDO::FETCH_ASSOC)){

                    if(isset($_POST['envio'])){
                       
                        echo "<option value='".$fila[$valor]."'";
                        
                        if($_POST[$name] == $fila[$valor]){
                            
                            echo " SELECTED>".$fila[$nombre]."</option>";
        
                        }else{
        
                            echo ">".$fila[$nombre]."</option>";
                        }
        
        
                    }else{
                    
                        echo "<option value='".$fila[$valor]."'>".$fila[$nombre]."</option>";
                    
                    }
                    
                }
            }catch(PDOException $e){
                echo $e->getMessage();

            }
            echo "</select>";
            
           
        }


        function creacion_Selectm($consulta, $codigo, $nombre, $name){
            echo "<p class='p_form'><label>".$name."</label></p>";
            echo "<select multiple name='".$name."[]'>";
            try{     
                
                $con=Conectar();
                $stmt=$con->prepare($consulta);
                //$stmt->bindValue(1, $cod);
                //$stmt->bindValue(2, $id);
                $stmt->execute();
                $num_filas=$stmt->rowCount();
          
                while($fila=$stmt->fetch(PDO::FETCH_ASSOC)){

                    if(isset($_POST['envio'])){

                        echo "<option value='".$fila[$codigo]."'";
                        if(isset($_POST[$name])){
                            foreach($_POST[$name] as $valor){
            
                                if($valor == $fila[$codigo]){
            
                                    echo " SELECTED";
                
                                }
            
                            }
                        }
                            echo ">".$fila[$nombre]."</option>";
                        
                    }else{
                    
                        echo "<option value='".$fila[$codigo]."'>".$fila[$nombre]."</option>";
                    
                    }

     
                }
            
            }catch(PDOException $e){
                echo $e->getMessage();

            }
            echo "</select>";
               
        }


    function crearSelect_normal($name, $array_valor, $array_texto){
        echo "<p><label>".$name."</label></p>";
        echo "<p><select name='$name' required>";
        echo "<option value=''>Seleccionar</option>";
        for($i=0;$i<count($array_valor); $i++){
            
            if(isset($_POST['envio'])){

                echo "<option value='".$array_valor[$i]."'";

                if($_POST[$name] == $array_valor[$i]){

                    echo " SELECTED>".$array_texto[$i]."</option>";

                }else{

                    echo ">".$array_texto[$i]."</option>";
                }


            }else{
            
                echo "<option value='".$array_valor[$i]."'>".$array_texto[$i]."</option>";
            
            }


        }

        echo "</select></p>";


    }


    function crearSelect_normal_m($name, $array_valor, $array_texto){
        echo "<p><label>".$name."</label></p>";
        echo "<p><select multiple name='".$name."[]' required>";
       
        for($i=0;$i<count($array_valor); $i++){

            if(isset($_POST['envio'])){

                echo "<option value='".$array_valor[$i]."'";

                foreach($_POST[$name] as $valor){

                    if($valor == $array_valor[$i]){

                        echo " SELECTED";
    
                    }

                }
                echo ">".$array_texto[$i]."</option>";
                
            }else{
            
                echo "<option value='".$array_valor[$i]."'>".$array_texto[$i]."</option>";
            
            }

            


        }

        echo "</select></p>";


    }

    function crearRadios($nombre, $array_valor, $array_texto){

        echo "<p>";
        for($i=0; $i<count($array_texto); $i++){

            echo "<input type='radio' name='".$nombre."' required value='".$array_valor[$i]."'";
            if(isset($_POST['envio'])){

                if($_POST[$nombre] == $array_valor[$i]){

                    echo " CHECKED>".$array_texto[$i];

                }else{

                    echo ">".$array_texto[$i]; 
                }


            }else{

                echo "<input type='radio' name='".$nombre."' required value='".$array_valor[$i]."'>".$array_texto[$i];
            }     

        }
        echo "</p>";



    }




    function crearCheckbox($nombre, $array_valor, $array_texto){

        echo "<p>";
        
        for($i=0; $i<count($array_texto); $i++){

            
            if(isset($_POST['envio'])){
                echo "<input type='checkbox' multiple name='".$nombre."[]' value='".$array_valor[$i]."'";
                if(!empty($_POST[$nombre])){
                    foreach($_POST[$nombre] as $valor){

                        if($valor == $array_valor[$i]){
                            echo " CHECKED";    
                        }
                    }
                }
                echo ">".$array_texto[$i];
              

            }else{
                echo "<input type='checkbox' multiple name='".$nombre."[]' value='".$array_valor[$i]."'>".$array_texto[$i];
                
            }



        }
                      
        echo "</p>";

    }


    function imprimir_Checkbox($cadena, $name, $array_nombres){


        
            for($i=0; $i<strlen($cadena); $i++){

                if($cadena[$i] == "1"){

                    $checked=" CHECKED";
                }else{

                    $checked="";

                }

                echo "<input type='checkbox' multiple name='".$name."[]' value='".$i."' $checked>".$array_nombres[$i];
                
            }
            
    }

    function valores_Checkbox($cadena, $name){


        for($i=0; $i<strlen($cadena); $i++){
               
            $cadena[$i]="0";

        }

        if(isset($_POST[$name])){
            foreach($_POST[$name] as $valor){

            $cadena[$valor]="1";

            }
        }

        return $cadena;
   
    }




    function crearFormularioText($array_valores, $array_tipo){
        
      
        for($i=0;$i<count($array_valores); $i++){
            
            
            switch ($array_tipo[$i]) {
                
                case "textarea":
                    echo "<p class='p_form'><label>".$array_valores[$i]."</label>";
                    echo "<p class='p_form'><textarea name='".$array_valores[$i]."' cols='50' rows='20' required>";
                    if(isset($_POST['envio'])){
                                
                        echo $_POST[$array_valores[$i]];
    
                    }
                    echo "</textarea></p>";
                    break;

                case "checkbox":
                    echo "<input type='".$array_tipo[$i]."' required name='".$array_tipo[$i]."' value='".$array_valores[$i]."'>".$array_valores[$i];
                    break;

                case "radio":
                    echo "<p><input type='".$array_tipo[$i]."' required name='".$array_tipo[$i]."' value='".$array_valores[$i]."'>".$array_valores[$i]."</p>";
                    break;

                case "text":
                    echo "<p class='p_form'><label>".$array_valores[$i]."</label></p>";
                    echo "<p class='p_form'><input type='".$array_tipo[$i]."' placeholder='".$array_valores[$i]."' required name='".$array_valores[$i]."'";
                    if(isset($_POST['envio'])){
                            
                        echo "value='".$_POST[$array_valores[$i]]."'></p>";
                       

                    }else{
                        echo "></p>";

                    } 
                    break;

                case "number":
                    
                    echo "<p class='p_form'><label>".$array_valores[$i]."</label></p>";
                    echo "<p class='p_form'><input type='".$array_tipo[$i]."' placeholder='".$array_valores[$i]."' required name='".$array_valores[$i]."'";
                    if(isset($_POST['envio'])){
                                
                        echo "value='".$_POST[$array_valores[$i]]."'></p>";
    
                    }else{
                        echo "></p>";
    
                    } 
                    break;

                
                    case "date":
                    
                        echo "<p class='p_form'><label>".$array_valores[$i]."</label></p>";
                        echo "<p class='p_form'><input type='".$array_tipo[$i]."' placeholder='".$array_valores[$i]."' required name='".$array_valores[$i]."'";
                        if(isset($_POST['envio'])){
                                    
                            echo "value='".$_POST[$array_valores[$i]]."'></p>";
        
                        }else{
                            echo "></p>";
        
                        } 
                        break;
                    
                default:
                    echo "<p class='p_form'><label>".$array_valores[$i]."</label></p>";
                    echo "<p class='p_form'><input type='".$array_tipo[$i]."' placeholder='".$array_valores[$i]."' required name='".$array_valores[$i]."'></p>";
            }
               

        }
        
      
    }


    function inserta_Datos($consulta, $array_datos){
        try{
           
            $con=Conectar();
            $stmt=$con->prepare($consulta);
            for($i=0; $i<count($array_datos); $i++){

                $stmt->bindValue($i+1, $array_datos[$i]);

            }

            $stmt->execute();
            
        }catch(PDOException $e){
            echo $e->getMessage();
            

        }
    }


    

    function elimina_Datos($lista_id, $consulta){

        try{ 
           
            $con=Conectar();
            foreach($lista_id as $elemento){
                //$elemento=explode('#',$elemento);
                //$stmt=$con->prepare("DELETE FROM productos WHERE pr_id=?");
                $stmt=$con->prepare($consulta);
                $stmt->bindValue(1, $elemento);
                //$stmt->bindValue(2, $id);
                $stmt->execute();
                $num_filas=$stmt->rowCount();
                //unlink($elemento[1]);
            }
        }catch(PDOException $e){
            echo $e->getMessage();

        }

    }


   

    function consultar_lista($consulta, $array_atrib, $array_datos){
        
        $lista=array();
        try{     
           
            $con=Conectar();
            $stmt=$con->prepare($consulta);
            if(count($array_datos)>0){
                for($i=0; $i<count($array_datos); $i++){

                    $stmt->bindValue($i+1, $array_datos[$i]);
                }
            }
            
            $stmt->execute();
            $num_filas=$stmt->rowCount();
            $elementos="";

            if($num_filas != 0){
           
                if($num_filas > 1){
                    while($fila=$stmt->fetch(PDO::FETCH_ASSOC)){
                        
                        $elementos="";
                        for($i=0; $i<count($array_atrib); $i++){
                        
                                if($i != count($array_atrib)-1){
                                    $elementos.=$fila[$array_atrib[$i]]." ";
                                }else{
                                    $elementos.=$fila[$array_atrib[$i]];   
                                }
                                
                        }
                            
                        $e_lista=explode(" ",$elementos);
                        array_push($lista, $e_lista);
                    }
                }else{
                    $fila=$stmt->fetch(PDO::FETCH_ASSOC);
                    foreach($array_atrib as $valor){
                        
                        array_push($lista,$fila[$valor]);
                        
                    }
                    
                }
                return $lista;
            }else{

                return $num_filas;

            }
           
        }catch(PDOException $e){
            echo $e->getMessage();
    
        }

    }



    function consultar_lista_as($consulta, $array_atrib, $array_datos, $clave){
        
        $lista=array();
        try{     
           
            $con=Conectar();
            $stmt=$con->prepare($consulta);
            if(count($array_datos)>0){
                for($i=0; $i<count($array_datos); $i++){

                    $stmt->bindValue($i+1, $array_datos[$i]);
                }
            }
            //$stmt->bindValue(1, $cod);
            //$stmt->bindValue(2, $id);
            $stmt->execute();
            $num_filas=$stmt->rowCount();
            $elementos="";

            if($num_filas != 0){
            
                while($fila=$stmt->fetch(PDO::FETCH_ASSOC)){
                    
                    //array_push($lista_mascotas['Pl'],$fila['rasgo']);
                    $elementos="";
                    for($i=0; $i<count($array_atrib); $i++){
                       
                            if($i != count($array_atrib)-1){
                                $elementos.=$fila[$array_atrib[$i]]." ";
                            }else{
                                $elementos.=$fila[$array_atrib[$i]];   
                            }
                            
                    }
                      
                    $e_lista=explode(" ",$elementos);
                    $lista[$fila[$clave]]=$e_lista;
                }
            
                return $lista;
            }else{

                return $num_filas;
            }
        }catch(PDOException $e){
            echo $e->getMessage();
    
        }

    }



    function crear_Tabla($consulta, $array_atrib){
    
        try{     
           
            $con=Conectar();
            $stmt=$con->prepare($consulta);
            //$stmt->bindValue(1, $cod);
            //$stmt->bindValue(2, $id);
            $stmt->execute();
            $num_filas=$stmt->rowCount();
            $datos="<table border='1'>";
            while($fila=$stmt->fetch(PDO::FETCH_ASSOC)){
    
                //array_push($lista_mascotas['Pl'],$fila['rasgo']);
                $datos.="<tr>";
                foreach($array_atrib as $valor){
                    $datos.= "<td>".$fila[$valor]."</td>";
    
                }
                $datos.="</tr>";
            }
            $datos.="</table>";
            echo $datos;
        }catch(PDOException $e){
            echo $e->getMessage();
    
        }
    
    }


    function crear_Tabla_del($consulta, $array_atrib){
    
        try{     
           
            $con=Conectar();
            $stmt=$con->prepare($consulta);
            //$stmt->bindValue(1, $cod);
            //$stmt->bindValue(2, $id);
            $stmt->execute();
            $num_filas=$stmt->rowCount();
            $datos="<table border='1'>";
            
            $datos.="<tr><td colspan='".count($array_atrib)."'></td><td><input type='submit' value='Eliminar' name='elimina'></td></tr>";
            while($fila=$stmt->fetch(PDO::FETCH_ASSOC)){
    
                //array_push($lista_mascotas['Pl'],$fila['rasgo']);
                $datos.="<tr>";
                foreach($array_atrib as $valor){
                    $datos.= "<td>".$fila[$valor]."</td>";
    
                }
                $datos.= "<td><input type='checkbox' multiple name='eliminar[]' value='".$fila[$array_atrib[0]]."'></td>";
                $datos.="</tr>";
            
            }
            $datos.="</table>";
            echo $datos;
        }catch(PDOException $e){
            echo $e->getMessage();
    
        }
    
    }


    function crear_Tabla_l($lista){

        echo "<table border='1'>";
        
        if (is_array($lista) && is_array(array_values($lista)[0])) {
            foreach($lista as $clave => $valor){
                echo "<tr>";
                foreach($valor as $clave2 => $valor2){
    
                    echo "<td>$valor2</td>";
    
                }

                echo "<tr>";
            }
        }else{
            echo "<tr>";
    
            foreach($lista as $valor){

                echo "<td>$valor</td>";
            }
            echo "</tr>";
        }
        echo "</table>";

    }

    function crear_Div($consulta, $array_atrib){
        try{ 
            $con=Conectar();
            $stmt=$con->prepare($consulta);
            //$stmt->bindValue(1, $cod);
            //$stmt->bindValue(2, $id);
            $stmt->execute();
            $num_filas=$stmt->rowCount();
            $datos="<div>";
            while($fila=$stmt->fetch(PDO::FETCH_ASSOC)){
                $datos.="<p>";
                //array_push($lista_mascotas['Pl'],$fila['rasgo']);
                $datos.="<div>";
                    foreach($array_atrib as $valor){
                        $datos.= "<div>".$fila[$valor]."</div>";

                    }
                $datos.="</div>";
                $datos.="</p>";
            }
            $datos.="</div>";
            echo $datos;
        }catch(PDOException $e){
            echo $e->getMessage();

        }

    }



    function validacionFormulario($array_name, $array_tipo){
        
        $correcto=true;
        for($i=0;$i<count($array_name); $i++){
            
           
            switch ($array_tipo[$i]) {

                case "text":

                    if (is_numeric($array_name[$i])){
                        echo "<p>Solo se admite texto</p>";
                        $correcto=false;
        
                    }
                    break;
            

                case "password":
                    
                    if(ctype_alnum($array_name[$i])) {
                        echo "<p>Formato password incorrecto, debe contener un numero y símbolo</p>";
                        $correcto=false;
                            
                    }
                    break;

                case "number":

                    if (!is_numeric($array_name[$i])){
                        echo "<p>Solo se admite formato numerico</p>";
                        $correcto=false;
        
                    }
                    break;

                case "email":
                    
                    if(!filter_var($array_name[$i], FILTER_VALIDATE_EMAIL)){
                        echo "<p>Correo incorrecto</p>";
                        $correcto=false;
        
                    }
                    break;

                case "radio":
                    if(!isset($array_name[$i])){
                        $correcto=false;
        
                    }
                    break;


                case "checkbox":
     
                    if(empty($_POST[$array_name[$i]])){
                        echo "<p>Se debe de seleccionar checkbox</p>";
                            $correcto=false;
                
                    }
                    break;
            }
               
        }
        
        return $correcto;
      
    }




    function contar_Registros($consulta, $arr_condicion){

        try{     
            $con=Conectar();
            $stmt=$con->prepare($consulta);
            if(count($arr_condicion)>0){
                for($i=0; $i<count($arr_condicion); $i++){

                    $stmt->bindValue($i+1, $arr_condicion[$i]);

                }
            }
            //$stmt->bindValue(2, $id);
            $stmt->execute();
            $num_filas=$stmt->rowCount();
            return $num_filas;
        }catch(PDOException $e){
            echo $e->getMessage();
    
        }


    }


    function hay_Registro($consulta, $arr_condicion){

        try{     
            $con=Conectar();
            $stmt=$con->prepare($consulta);
            if(count($arr_condicion)>0){
                for($i=0; $i<count($arr_condicion); $i++){

                    $stmt->bindValue($i+1, $arr_condicion[$i]);

                }
            }
            //$stmt->bindValue(2, $id);
            $stmt->execute();
            $num_filas=$stmt->rowCount();
            if($num_filas != 0){
                return true;
            }else{
                return false;
            }
       
        }catch(PDOException $e){
            echo $e->getMessage();
    
        }

    }



    function sumar_Valores($consulta, $arr_condicion){

        try{     
            $con=Conectar();
            $stmt=$con->prepare($consulta);
            if(count($arr_condicion)>0){
                for($i=0; $i<count($arr_condicion); $i++){

                    $stmt->bindValue($i+1, $arr_condicion[$i]);

                }
            }
            //$stmt->bindValue(2, $id);
            $stmt->execute();
            $num_filas=$stmt->rowCount();
            $fila=$stmt->fetch(PDO::FETCH_ASSOC);
            $total=$fila['total'];

            return $total;
        }catch(PDOException $e){
            echo $e->getMessage();
    
        }

    }
    

    function crearHref($arr_enlace, $arr_texto){

        for($i=0;$i<count($arr_enlace); $i++){

            echo "<p><a href='./".$arr_enlace[$i]."'>".$arr_texto[$i]."</a></p>";
            
        }

    }


    function imprime_perfil($array_valor, $array_tipo){
        echo "<div class='perfil'>";
        for($i=0; $i<count($array_valor); $i++){

            switch($array_tipo[$i]){
                
                case "img":
                    echo "<div><img src='./img/".$array_valor[$i]."' width='20% height='20%''></div>";
                    break;
                
                case "url":
                    echo "<div> <a href='".$array_valor[$i]."'>".$array_valor[$i]."</a></div>";
                    break;

                case "title":
                    echo "<div><b>".$array_valor[$i]."</b></div>";
                    break;

                case "birth":
                                
                    $nacimiento = new DateTime($array_valor[$i]);
                    $ahora = new DateTime(date("Y-m-d"));
                    $diferencia = $ahora->diff($nacimiento);
                    echo "<div>".$diferencia->format("%y")." años</div>";

                    break;

                default:
                    
                    echo "<div>".$array_valor[$i]."</div>";
                

            }
            
        }
        echo "</div>";

    }


    function imprime_perfil_bd($consulta, $arr_condicion, $array_atrib, $array_tipo){

        try{ 
            $con=Conectar();
            $stmt=$con->prepare($consulta);
            if(count($arr_condicion)>0){
                for($i=0; $i<count($arr_condicion); $i++){

                    $stmt->bindValue($i+1, $arr_condicion[$i]);

                }
            }
            //$stmt->bindValue(1, $cod);
            //$stmt->bindValue(2, $id);
            $stmt->execute();
            $num_filas=$stmt->rowCount();
            $datos="<div>";
            while($fila=$stmt->fetch(PDO::FETCH_ASSOC)){
              
                //array_push($lista_mascotas['Pl'],$fila['rasgo']);
                    
                    for($i=0; $i<count($array_atrib); $i++){
                        
                        switch($array_tipo[$i]){
                
                            case "img":
                                $datos.= "<div><p><img src='./img/".$fila[$array_atrib[$i]]."' width='21%' height='21%'></p></div>";
                                break;
                            
                            case "url":
                                $datos.= "<div><p> <a href='./perfil.php?nick=".$fila[$array_atrib[$i]]."'>".$fila[$array_atrib[$i]]."</a></p></div>";
                                break;

                            case "title":
                                
                                $datos.= "<div><h3>".$fila[$array_atrib[$i]]."</h3></div>";
                                break;
            
                            case "text":
                                
                                $datos.= "<div><p>".$fila[$array_atrib[$i]]."</p></div>";
                                break;

                            case "date":
                        
                                $datos.= "<p><div><p>".date("d-m-Y", strtotime($fila[$array_atrib[$i]]))."</p></div>";

 
                                break;

                            case "birth":
                                if($fila[$array_atrib[$i]] != "0000-00-00"){
                                    $nacimiento = new DateTime($fila[$array_atrib[$i]]);
                                    $ahora = new DateTime(date("Y-m-d"));
                                    $diferencia = $ahora->diff($nacimiento);
                                    $datos.="<div><p>".$diferencia->format("%y")." años</p></div>";
                                }
                                break;
                            
                        }


                    }
               
            }
            $datos.="</div>";
            echo $datos;
        }catch(PDOException $e){
            echo $e->getMessage();

        }


    }



    function imprime_val_inputs($array_nombre, $array_valor, $array_tipo){

        for($i=0; $i<count($array_nombre); $i++){

            if($array_tipo[$i] == "textarea"){

                echo "<label>".$array_nombre[$i]."</label><p><textarea name='".$array_nombre[$i]."' cols='30' rows='10'>".$array_valor[$i]."</textarea></p>";

            }else{

            echo "<label>".$array_nombre[$i]."</label><p><input type='".$array_tipo[$i]."' name='".$array_nombre[$i]."' value='".$array_valor[$i]."'></p>";
            }
        }


    }


    function recoge_Post($array_post){
        $lista=array();
        
            foreach ($array_post as $valor){
                array_push($lista, $valor);

            }
            array_pop($lista);

        return $lista;

    }



    function generarUl($consulta, $array_atrib, $arr_condicion){

        try{ 
            $con=Conectar();
            $stmt=$con->prepare($consulta);
            if(count($arr_condicion)>0){
                for($i=0; $i<count($arr_condicion); $i++){

                    $stmt->bindValue($i+1, $arr_condicion[$i]);

                }
            }
            //$stmt->bindValue(1, $cod);
            //$stmt->bindValue(2, $id);
            $stmt->execute();
            $num_filas=$stmt->rowCount();
            $datos="";
            while($fila=$stmt->fetch(PDO::FETCH_ASSOC)){
               
                $datos.="<ul>";
                //array_push($lista_mascotas['Pl'],$fila['rasgo']);
              
                foreach($array_atrib as $valor){
                    $datos.= "<li>".$fila[$valor]."</li>";

                }
                $datos.="</ul>";
               
            }
            
           
            echo $datos;
        }catch(PDOException $e){
            echo $e->getMessage();

        }

    }



    function crearCheckbox_bd($consulta, $nombre, $valor, $texto){

        echo "<p>";

        try{

            $con=Conectar();
            $stmt=$con->prepare($consulta);
            //$stmt->bindValue(1, $cod);
            //$stmt->bindValue(2, $id);
            $stmt->execute();
            $num_filas=$stmt->rowCount();
            while($fila=$stmt->fetch(PDO::FETCH_ASSOC)){
                
                    if(isset($_POST['envio'])){
                        echo "<input type='checkbox' multiple name='".$nombre."[]' value='".$fila[$valor]."'";
                        if(!empty($_POST[$nombre])){
                            foreach($_POST[$nombre] as $v){
        
                                if($v == $fila[$valor]){
                                    echo " CHECKED";    
                                }
                            }
                        }
                        echo ">".$fila[$texto];
                      
        
                    }else{
                        echo "<input type='checkbox' multiple name='".$nombre."[]' value='".$fila[$valor]."'>".$fila[$texto];
                        
                    }
        

            }
        }catch(PDOException $e){
            echo $e->getMessage();
    
        }
        
        
                      
        echo "</p>";

    }



    function crearRadios_bd($consulta, $nombre, $valor, $texto){

        echo "<p>";

        try{     
            $con=Conectar();
            $stmt=$con->prepare($consulta);
            //$stmt->bindValue(1, $cod);
            //$stmt->bindValue(2, $id);
            $stmt->execute();
            $num_filas=$stmt->rowCount();
            while($fila=$stmt->fetch(PDO::FETCH_ASSOC)){
                echo "<input type='radio' name='".$nombre."' required value='".$fila[$valor]."'";
                if(isset($_POST['envio'])){
    
                    if($_POST[$nombre] == $fila[$valor]){
    
                        echo " CHECKED>".$fila[$texto];
    
                    }else{
    
                        echo ">".$fila[$texto]; 
                    }
    
    
                }else{
    
                    echo "<input type='radio' name='".$nombre."' required value='".$fila[$valor]."'>".$fila[$texto];
                }     
            }
        }catch(PDOException $e){
            echo $e->getMessage();
    
        }
       
        echo "</p>";


    }


    function consultar_lista2($consulta, $array_atrib, $array_datos){
        
        $lista=array();
        try{     
           
            $con=Conectar();
            $stmt=$con->prepare($consulta);
            if(count($array_datos)>0){
                for($i=0; $i<count($array_datos); $i++){

                    $stmt->bindValue($i+1, $array_datos[$i]);
                }
            }
            
            $stmt->execute();
            $num_filas=$stmt->rowCount();
            $elementos="";

            if($num_filas != 0){
           
                //if($num_filas > 1){
                    while($fila=$stmt->fetch(PDO::FETCH_ASSOC)){
                        
                        $elementos="";
                        for($i=0; $i<count($array_atrib); $i++){
                        
                                if($i != count($array_atrib)-1){
                                    $elementos.=$fila[$array_atrib[$i]]." ";
                                }else{
                                    $elementos.=$fila[$array_atrib[$i]];   
                                }
                                
                        }
                            
                        $e_lista=explode(" ",$elementos);
                        array_push($lista, $e_lista);
                    }
                    
                
                return $lista;
            }else{

                return $num_filas;

            }
           
        }catch(PDOException $e){
            echo $e->getMessage();
    
        }

    }



    function consultar_lista3($consulta, $array_atrib, $array_datos){
        
        $lista=array();
        try{     
           
            $con=Conectar();
            $stmt=$con->prepare($consulta);
            if(count($array_datos)>0){
                for($i=0; $i<count($array_datos); $i++){

                    $stmt->bindValue($i+1, $array_datos[$i]);
                }
            }
            
            $stmt->execute();
            $num_filas=$stmt->rowCount();
            $elementos="";

            if($num_filas != 0){
           
                //if($num_filas > 1){
                    while($fila=$stmt->fetch(PDO::FETCH_ASSOC)){
                        
                        for($i=0; $i<count($array_atrib); $i++){
                        
                            array_push($lista, $fila[$array_atrib[$i]]);
                                
                        }
                            
                    }
                    
                return $lista;
            }else{

                return $num_filas;

            }
           
        }catch(PDOException $e){
            echo $e->getMessage();
    
        }

    }


    function consultar_lista_1col($consulta, $atributo, $array_datos){
        
        $lista=array();
        try{     
           
            $con=Conectar();
            $stmt=$con->prepare($consulta);
            if(count($array_datos)>0){
                for($i=0; $i<count($array_datos); $i++){

                    $stmt->bindValue($i+1, $array_datos[$i]);
                }
            }
            
            $stmt->execute();
            $num_filas=$stmt->rowCount();

            if($num_filas != 0){
           
                //if($num_filas > 1){
                    while($fila=$stmt->fetch(PDO::FETCH_ASSOC)){

                        array_push($lista, $fila[$atributo]);
                    }
                    
                
                return $lista;
            }else{

                return $num_filas;

            }
           
        }catch(PDOException $e){
            echo $e->getMessage();
    
        }

    }
 
    

?>



