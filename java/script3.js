


const mensaje_Confirmar=(obj)=>{

    const lista=obj.id.split("#");
    //const prueba=`./mensaje_priv.php?id=${lista[0]}&nick=${lista[1]}`;
    //alert(prueba);

    
    let confirmar=confirm("¿Desea eliminar este mensaje?");

    if(confirmar){

        window.location.href=`./mensaje_priv.php?id=${lista[0]}&nick=${lista[1]}`;
    }


}


