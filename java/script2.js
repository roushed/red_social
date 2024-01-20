
let contador=0;
document.querySelectorAll('.like').forEach(obj => obj.addEventListener('click', ()=>{

    
    if(contador != 0){
        document.getElementById(obj.children[0].id).src="./img/mano.png";
        contador=0;

    }else{
        document.getElementById(obj.children[0].id).src="./img/mano2.png";
        contador++;
    }
     


}));

document.querySelectorAll('.boton_e2').forEach(object =>{
    object.addEventListener('click', ()=>{
        //alert(object.children[0][0].value);

        object.children[0].submit();
        //document.getElementById('form1').submit();

    });

});





