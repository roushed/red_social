


window.addEventListener("load", function(event) {
    
    document.getElementById("filtrarf").addEventListener("click", ()=>{

        document.getElementById("cuadro_Fechas").style.display="block";

 
    });

    document.getElementById('x').addEventListener('click', ()=>{

        document.getElementById("cuadro_Fechas").style.display="none";

    });

    document.getElementById('filtrar').addEventListener('click', ()=>{

        document.getElementById("cuadro_Fechas").style.display="none";


    });
  });