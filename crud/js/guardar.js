function guardar(){ //recoje todos los datos de las tablas y se lo pasa al php

    document.getElementById('nuevaTabla').classList.remove('noLoVeo');
    document.getElementById('nuevaTabla').classList.add('loVeo');

    document.getElementById('nuevaTabla2').classList.remove('noLoVeo');
    document.getElementById('nuevaTabla2').classList.add('loVeo');

    document.getElementById('nuevaTabla3').classList.remove('noLoVeo');
    document.getElementById('nuevaTabla3').classList.add('loVeo');

    var tabla1=document.getElementById("nuevaTabla"); //recojo la tabla 1

    let ter=tabla1.getElementsByTagName("span"); //recojo los spans

    var datasion=[];

    for(var i=0; i<ter.length; i++){ //Los meto en un array
        datasion[i]=ter[i].innerHTML;
    }
    //=======================================================================

    var tabla2=document.getElementById("nuevaTabla2"); //recojo la tabla 2

    let ter2=tabla2.getElementsByTagName("span"); //recojo los spans

    var datasion2=[];

    for(var j=0; j<ter2.length; j++){ //Los meto en un array
        datasion2[j]=ter2[j].innerHTML;
    }

    //======================================================================

    var tabla3=document.getElementById("nuevaTabla3"); //recojo la tabla 3

    let ter3=tabla3.getElementsByTagName("span"); //recojo los spans

    var datasion3=[];

    for(var l=0; l<ter3.length; l++){ //Los meto en un array
        datasion3[l]=ter3[l].innerHTML;
    }

//=============================================================================================

    //Meto los tres en un array de arrays
    var megaDatasion=[];
    megaDatasion[0]=datasion;
    megaDatasion[1]=datasion2;
    megaDatasion[2]=datasion3;

    //Esto sirve para pasar por post a php desde javascript
    $.post("../controladores/insertar.php", {data:megaDatasion},function(data) {

        console.log(data);
    });


    //Si hay una tabla nueva, si hay un nombre en la casilla de nombres, recoger el año, el nombre y los puntos (añadirle 0 a los puntos de los 2 trimestres restantes)

    var tablaExt=document.getElementById("tablaExtra"); //recojo la tabla nueva

    let terExtra=tablaExt.getElementsByTagName("span"); //recojo los spans

    var cadena=[];

    for(var j=0; j<terExtra.length; j++){ //hasta la longitud de terExtra

        if(terExtra[j].innerHTML.length==4){ //meto el año
            cadena.push(terExtra[j].innerHTML);
        } 

        if(terExtra[j].innerHTML.length>4){ //si es un nombre (4= año, 3 o menos= puntos)

            cadena.push(terExtra[j].innerHTML); //mete el nombre dentro del array

            j=j+1;
            var ant=j;
            var sig= ant+14;
            
            for( p=ant; p<=sig; p++){ //mete los siguientes 5 espacios
                cadena.push(terExtra[p].innerHTML);
            }
        }
    }

    if(!cadena.length==0){
        setTimeout(function(){ 
            $.post("../controladores/insertarNuevaTabla.php", {data:cadena},function(data) {   //Esto sirve para pasar por post a php desde javascript
                console.log(data);
            });
        }, 100);
    }

    //Dejo visible la primera tabla y oculto las otras dos
    document.getElementById('nuevaTabla').classList.remove('noLoVeo');
    document.getElementById('nuevaTabla').classList.add('loVeo');

    document.getElementById('nuevaTabla2').classList.remove('loVeo');
    document.getElementById('nuevaTabla2').classList.add('noLoVeo');

    document.getElementById('nuevaTabla3').classList.remove('loVeo');
    document.getElementById('nuevaTabla3').classList.add('noLoVeo');

    setTimeout(function(){ //pongo un retardo de 0'01 segundo para que no de error y recarga la página
        location.reload();
    }, 100);
  
}    