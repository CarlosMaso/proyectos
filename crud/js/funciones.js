function oculta1(){ //muestra 1 trimestre y oculta otros 2
    document.getElementById('nuevaTabla').classList.remove('noLoVeo');
    document.getElementById('nuevaTabla').classList.add('loVeo');

    document.getElementById('nuevaTabla2').classList.remove('loVeo');
    document.getElementById('nuevaTabla3').classList.remove('loVeo');

    document.getElementById('nuevaTabla2').classList.add('noLoVeo');
    document.getElementById('nuevaTabla3').classList.add('noLoVeo');
}
function oculta2(){//muestra 2 trimestre y oculta otros 2
    document.getElementById('nuevaTabla2').classList.remove('noLoVeo');
    document.getElementById('nuevaTabla2').classList.add('loVeo');

    document.getElementById('nuevaTabla').classList.remove('loVeo');
    document.getElementById('nuevaTabla3').classList.remove('loVeo');

    document.getElementById('nuevaTabla').classList.add('noLoVeo');
    document.getElementById('nuevaTabla3').classList.add('noLoVeo');
}
function oculta3(){ //muestra 3 trimestre y oculta otros 2
    document.getElementById('nuevaTabla3').classList.remove('noLoVeo');
    document.getElementById('nuevaTabla3').classList.add('loVeo');

    document.getElementById('nuevaTabla2').classList.remove('loVeo');
    document.getElementById('nuevaTabla').classList.remove('loVeo');

    document.getElementById('nuevaTabla2').classList.add('noLoVeo');
    document.getElementById('nuevaTabla').classList.add('noLoVeo');
}
//==========================================================================================================================================================================
function imprimeTodo(){ //Esta función imprime las tablas en DETALLE, se ejecuta después de que el usuario se valide

    $.ajax({ //llamada ajax
        type:'GET',
        dataType:'JSON',
        url:'../controladores/alumnos.php'
    }).done(function(datos)
    { 

        //recojo cada mes en una variable diferente
        var oct=datos['octubre'];
        var nov=datos['noviembre'];
        var dic= datos['diciembre'];
        var ene=datos['enero'];
        var feb=datos['febrero'];
        var mar= datos['marzo'];
        var ab=datos['abril'];
        var may=datos['mayo'];
        var jun= datos['junio'];

        let anios=[];

       for(var i=0; i<datos['alumnos'].length; i++){ //Recojo todos los años de la base de datos alumnos
            anios[i]=datos['alumnos'][i]['any'];
       }
       
       let result = anios.filter((item,index)=>{ //Esto filtra los años, quita repetidos y nos indica el numero de veces que itera el bucle
        return anios.indexOf(item) === index;
      })

      var tablaTemplate="";

      for(var j=0; j<result.length; j++){ //Por cada año, imprimo a los alumnos (tabla #1 trimestre)

        tablaTemplate+="<table id='tabla"+j+"'><th class='any' onfocusout='vaciosAlert(1)'><span contenteditable='true'>"+result[j]+"</span></th><tr class='meses'><th colspan='1'></th><th colspan='6'><strong>Octubre</strong></th><th colspan='6'><strong>Noviembre</strong></th><th colspan='6'><strong>Diciembre</strong></th><th><strong>Total Anual</strong></th><th></th></tr>";
        tablaTemplate+="<tr class='editable'><th>Nombre y Apellidos</th>";
    
        for($i=0; $i<3;$i++){ //imprime los titulos de las pruebas 3 veces (una por cada mes)
            tablaTemplate+="<th>Kicho/Poomsae</th><th>Destreza</th><th>Salto</th><th>Combate</th><th>Extra</th><th>Total</th>";
        }

        tablaTemplate+="</tr>";

        for (var v= 0; v < datos["alumnos"].length; v++) {  //imprimo a los alumnos y los puntos de cada prueba de cada mes
        
            if(datos['alumnos'][v]["any"]==result[j]){
           
                tablaTemplate+=" <tr id='terLinea' class='editable'> <td class='nom' onfocusout='vaciosAlert(1)'><span contenteditable='true'>"+datos['alumnos'][v]["nom"]+"</span></td>";
           
                for(var a=0; a<oct.length; a++){
                    if(datos["alumnos"][v]["id"]==oct[a]["idAlumno"]){
                        tablaTemplate+="<td onfocusout='vaciosAlert(1)'><span contenteditable='true'>"+oct[a]['kichoPoomsae']+"</span></td><td onfocusout='vaciosAlert(1)'><span contenteditable='true'>"+oct[a]['destreza']+"</span></td><td onfocusout='vaciosAlert(1)'><span contenteditable='true'>"+oct[a]['salto']+"</span></td><td onfocusout='vaciosAlert(1)'><span contenteditable='true'>"+oct[a]['combate']+"</span></td><td onfocusout='vaciosAlert(1)'><span contenteditable='true'>"+oct[a]['extra']+"</span></td><td class='total'>"+oct[a]['total']+"</td>";
                    }  
                }
                for(var b=0; b<nov.length; b++){
                    if(datos["alumnos"][v]["id"]==nov[b]["idAlumno"]){
                        tablaTemplate+="<td onfocusout='vaciosAlert(1)'><span contenteditable='true'>"+nov[b]['kichoPoomsae']+"</span></td><td onfocusout='vaciosAlert(1)'><span contenteditable='true'>"+nov[b]['destreza']+"</span></td><td onfocusout='vaciosAlert(1)'><span contenteditable='true'>"+nov[b]['salto']+"</span></td><td onfocusout='vaciosAlert(1)'><span contenteditable='true'>"+nov[b]['combate']+"</span></td><td onfocusout='vaciosAlert(1)'><span contenteditable='true'>"+nov[b]['extra']+"</span></td><td class='total'>"+nov[b]['total']+"</td>";
                    }  
                }
                for(var c=0; c<dic.length; c++){
                    if(datos["alumnos"][v]["id"]==dic[c]["idAlumno"]){
                        tablaTemplate+="<td onfocusout='vaciosAlert(1)'><span contenteditable='true'>"+dic[c]['kichoPoomsae']+"</span></td><td onfocusout='vaciosAlert(1)'><span contenteditable='true'>"+dic[c]['destreza']+"</span></td><td onfocusout='vaciosAlert(1)'><span contenteditable='true'>"+dic[c]['salto']+"</span></td><td onfocusout='vaciosAlert(1)'><span contenteditable='true'>"+dic[c]['combate']+"</span></td><td onfocusout='vaciosAlert(1)'><span contenteditable='true'>"+dic[c]['extra']+"</span></td><td class='total'>"+dic[c]['total']+"</td>";
                    }  
                }
                tablaTemplate+="<td class='total'>"+datos['alumnos'][v]["total"]+"</td><th><button class='quitaAlumno' type='button' id='quitaAlumnoA"+v+"' onclick='quitaAlumno("+v+")'></button></th></tr>";
            }    
        }
    
        tablaTemplate+="</table><div class='divBotones' id='divBotones"+j+"'><button type='button' onclick='nuevaFila("+j+")'><img src='../../img/mas.png' alt='mas' width='15px'></button><button type='button' id='filaMenos' onclick='restarFila("+j+")'><img src='../../img/menos.png' alt='menos' width='15px'></button><button type='button' id='borrar' onclick='quitarTabla("+j+")'>Borrar Tabla</button><br><hr></div>";

      }

      //Inserto todo en la pagina web
       var nueva=document.getElementById("nuevaTabla");
       nueva.innerHTML+=tablaTemplate;

       //====================================================================================================================================

       var tablaTemplate2="";

      for(var j=0; j<result.length; j++){ //Por cada año, imprimo a los alumnos (tabla #2 trimestre)

        tablaTemplate2+="<table id='tablaB"+j+"'><th class='any' onfocusout='vaciosAlert(2)'><span contenteditable='true'>"+result[j]+"</span></th><tr class='meses'><th colspan='1'></th><th colspan='6'><strong>Enero</strong></th><th colspan='6'><strong>Febrero</strong></th><th colspan='6'><strong>Marzo</strong></th><th><strong>Total Anual</strong></th><th></th></tr>";
        tablaTemplate2+="<tr class='editable'><th>Nombre y Apellidos</th>";
    
        for($i=0; $i<3;$i++){ //imprime los titulos de las pruebas 3 veces (una por cada mes)
            tablaTemplate2+="<th>Kicho/Poomsae</th><th>Destreza</th><th>Salto</th><th>Combate</th><th>Extra</th><th>Total</th>";
        }

        tablaTemplate2+="</tr>";

        for (var v= 0; v < datos["alumnos"].length; v++) { //imprimo a los alumnos y los puntos de cada prueba de cada mes
        
            if(datos['alumnos'][v]["any"]==result[j]){
           
                tablaTemplate2+=" <tr id='terLinea2' class='editable'> <td class='nom' onfocusout='vaciosAlert(2)'><span>"+datos['alumnos'][v]["nom"]+"</span></td>";
           
                for(var a=0; a<ene.length; a++){
                    if(datos["alumnos"][v]["id"]==ene[a]["idAlumno"]){
                        tablaTemplate2+="<td onfocusout='vaciosAlert(2)'><span contenteditable='true'>"+ene[a]['kichoPoomsae']+"</span></td><td onfocusout='vaciosAlert(2)'><span contenteditable='true'>"+ene[a]['destreza']+"</span></td><td onfocusout='vaciosAlert(2)'><span contenteditable='true'>"+ene[a]['salto']+"</span></td><td onfocusout='vaciosAlert(2)'><span contenteditable='true'>"+ene[a]['combate']+"</span></td><td onfocusout='vaciosAlert(2)'><span contenteditable='true'>"+ene[a]['extra']+"</span></td><td class='total'>"+ene[a]['total']+"</td>";
                    }  
                }
                for(var b=0; b<feb.length; b++){
                    if(datos["alumnos"][v]["id"]==feb[b]["idAlumno"]){
                        tablaTemplate2+="<td onfocusout='vaciosAlert(2)'><span contenteditable='true'>"+feb[b]['kichoPoomsae']+"</span></td><td onfocusout='vaciosAlert(2)'><span contenteditable='true'>"+feb[b]['destreza']+"</span></td><td onfocusout='vaciosAlert(2)'><span contenteditable='true'>"+feb[b]['salto']+"</span></td><td onfocusout='vaciosAlert(2)'><span contenteditable='true'>"+feb[b]['combate']+"</span></td><td onfocusout='vaciosAlert(2)'><span contenteditable='true'>"+feb[b]['extra']+"</span></td><td class='total'>"+feb[b]['total']+"</td>";
                    }  
                }
                for(var c=0; c<mar.length; c++){
                    if(datos["alumnos"][v]["id"]==mar[c]["idAlumno"]){
                        tablaTemplate2+="<td onfocusout='vaciosAlert(2)'><span contenteditable='true'>"+mar[c]['kichoPoomsae']+"</span></td><td onfocusout='vaciosAlert(2)'><span contenteditable='true'>"+mar[c]['destreza']+"</span></td><td onfocusout='vaciosAlert(2)'><span contenteditable='true'>"+mar[c]['salto']+"</span></td><td onfocusout='vaciosAlert(2)'><span contenteditable='true'>"+mar[c]['combate']+"</span></td><td onfocusout='vaciosAlert(2)'><span contenteditable='true'>"+mar[c]['extra']+"</span></td><td class='total'>"+mar[c]['total']+"</td>";
                    }  
                }
                tablaTemplate2+="<td class='total'>"+datos['alumnos'][v]["total"]+"</td><th><button class='quitaAlumno' type='button' id='quitaAlumnoB"+v+"' onclick='quitaAlumno("+v+")'></button></th></tr>";
            }    
        }
        
        tablaTemplate2+="</table><div class='divBotones' id='divBotonesB"+j+"'><button type='button' onclick='nuevaFila("+j+")'><img src='../../img/mas.png' alt='mas' width='15px'></button><button type='button' id='filaMenos2' onclick='restarFila("+j+")'><img src='../../img/menos.png' alt='menos' width='15px'></button><button type='button' id='borrar2' onclick='quitarTabla("+j+")'>Borrar Tabla</button><br> <hr></div>";
      }

      //Inserto todo en la pagina web
       var nueva2=document.getElementById("nuevaTabla2");
       nueva2.innerHTML+=tablaTemplate2;


       //=======================================================================================================================================================================
    
       var tablaTemplate3="";

       for(var j=0; j<result.length; j++){ //Por cada año, imprimo a los alumnos (tabla #3 trimestre)
 
         tablaTemplate3+="<table id='tablaC"+j+"'><th class='any' onfocusout='vaciosAlert(3)'><span contenteditable='true'>"+result[j]+"</span></th><tr class='meses'><th colspan='1'></th><th colspan='6'><strong>Abril</strong></th><th colspan='6'><strong>Mayo</strong></th><th colspan='6'><strong>Junio</strong></th><th><strong>Total Anual</strong></th><th></th></tr>";
         tablaTemplate3+="<tr class='editable'><th>Nombre y Apellidos</th>";
     
         for($i=0; $i<3;$i++){ //imprime los titulos de las pruebas 3 veces (una por cada mes)
             tablaTemplate3+="<th>Kicho/Poomsae</th><th>Destreza</th><th>Salto</th><th>Combate</th><th>Extra</th><th>Total</th>";
         }
 
         tablaTemplate3+="</tr>";
 
         for (var v= 0; v < datos["alumnos"].length; v++) { //imprimo a los alumnos y los puntos de cada prueba de cada mes
         
             if(datos['alumnos'][v]["any"]==result[j]){
            
                 tablaTemplate3+=" <tr id='terLinea3' class='editable'> <td class='nom' onfocusout='vaciosAlert(3)'><span>"+datos['alumnos'][v]["nom"]+"</span></td>";
            
                 for(var a=0; a<ab.length; a++){
                     if(datos["alumnos"][v]["id"]==ab[a]["idAlumno"]){
                         tablaTemplate3+="<td onfocusout='vaciosAlert(3)'><span contenteditable='true'>"+ab[a]['kichoPoomsae']+"</span></td><td onfocusout='vaciosAlert(3)'><span contenteditable='true'>"+ab[a]['destreza']+"</span></td><td onfocusout='vaciosAlert(3)'><span contenteditable='true'>"+ab[a]['salto']+"</span></td><td onfocusout='vaciosAlert(3)'><span contenteditable='true'>"+ab[a]['combate']+"</span></td><td onfocusout='vaciosAlert(3)'><span contenteditable='true'>"+ab[a]['extra']+"</span></td><td class='total'>"+ab[a]['total']+"</td>";
                     }  
                 }
                 for(var b=0; b< may.length; b++){
                     if(datos["alumnos"][v]["id"]==may[b]["idAlumno"]){
                         tablaTemplate3+="<td onfocusout='vaciosAlert(3)'><span contenteditable='true'>"+may[b]['kichoPoomsae']+"</span></td><td onfocusout='vaciosAlert(3)'><span contenteditable='true'>"+may[b]['destreza']+"</span></td><td onfocusout='vaciosAlert(3)'><span contenteditable='true'>"+may[b]['salto']+"</span></td><td onfocusout='vaciosAlert(3)'><span contenteditable='true'>"+may[b]['combate']+"</span></td><td onfocusout='vaciosAlert(3)'><span contenteditable='true'>"+may[b]['extra']+"</span></td><td class='total'>"+may[b]['total']+"</td>";
                     }  
                 }
                 for(var c=0; c<jun.length; c++){
                     if(datos["alumnos"][v]["id"]==jun[c]["idAlumno"]){
                         tablaTemplate3+="<td onfocusout='vaciosAlert(3)'><span contenteditable='true'>"+jun[c]['kichoPoomsae']+"</span></td><td onfocusout='vaciosAlert(3)'><span contenteditable='true'>"+jun[c]['destreza']+"</span></td><td onfocusout='vaciosAlert(3)'><span contenteditable='true'>"+jun[c]['salto']+"</span></td><td onfocusout='vaciosAlert(3)'><span contenteditable='true'>"+jun[c]['combate']+"</span></td><td onfocusout='vaciosAlert(3)'><span contenteditable='true'>"+jun[c]['extra']+"</span></td><td class='total'>"+jun[c]['total']+"</td>";
                     }  
                 }
                 tablaTemplate3+="<td class='total'>"+datos['alumnos'][v]["total"]+"</td><th><button class='quitaAlumno' type='button' id='quitaAlumnoC"+v+"' onclick='quitaAlumno("+v+")'></button></th></tr>";
             }    
         }
         
         tablaTemplate3+="</table><div class='divBotones' id='divBotonesC"+j+"'><button type='button' onclick='nuevaFila("+j+")'><img src='../../img/mas.png' alt='mas' width='15px'></button><button type='button' id='filaMenos3' onclick='restarFila("+j+")'><img src='../../img/menos.png' alt='menos' width='15px'></button><button type='button' id='borrar3' onclick='quitarTabla("+j+")'>Borrar Tabla</button><br><hr></div>";
 
       }
 
       //Inserto todo en la pagina web
        var nueva3=document.getElementById("nuevaTabla3");
        nueva3.innerHTML+=tablaTemplate3;

    }).fail(function( jqXHR, textStatus, errorThrown ) {console.log( "La solicitud ha fallado: " +  textStatus + errorThrown);});

}
//===============================================================================================================================================
function imprimeClasi(){

    $.ajax({ //llamada ajax
        type:'GET',
        dataType:'JSON',
        url:'../controladores/imprimeClass.php'
    }).done(function(datos)
    { 
        var tablaClassi=document.getElementById("tablaClass");//cojo el id de donde voy a ponerlo

        let anios=[];

        for(var i=0; i<datos.length; i++){ //recojo todos los años

            for(var j=0; j<datos[i].length; j++){
                anios[i]=datos[i][j]['any'];
            } 
        }
 
        let result = anios.filter((item,index)=>{ //Esto filtra los años, quita repetidos y nos indica el numero de veces que itera el bucle
            return anios.indexOf(item) === index;
        })

        var imprimeTablas=""; //inicializo la cadena
 
        for(var j=0; j<result.length; j++){ //Por cada año, imprimo a los alumnos y sus puntuaciones, ordenados de mayora menor puntuación 
      
            imprimeTablas+="<table class='tablaClassi'><th colspan='2' class='any'>"+result[j]+"</th>";  
            imprimeTablas+="<tr><th class='yellow'>Nombre y Apellidos</th> <th class='yellow'>Puntuación Total</th></tr>";
      
            for (var v= 0; v < datos[j].length; v++) { 
                 
                if(datos[j][v]["any"]==result[j]){
     
                    imprimeTablas+="<tr><td><span>"+datos[j][v]["nom"]+"</span></td><td class='total'><span>"+datos[j][v]["total"]+"</span></td></tr>";
                }    
            }
     
            imprimeTablas+="</table>"; //cierro la tabla
        }
     
        tablaClassi.innerHTML+=imprimeTablas; //Lo añado a la tabla de Classificació
       
    });
}
//===============================================================================================================================================
var v=0; //esta variable es para poder añadirsela al nombre de las tablas y tener el control de estas

function nuevaTabla(){ //Esta función crea una nueva tabla y la añade
    v=v+1;

    var tablaTemplate="<table id='nuevaTablaExtra"+v+"' id='extraTabla'><th class='any' onfocusout='vaciosAlert(4)'><span contenteditable='true'>2000</span></th><tr class='meses'><th colspan='1'></th><th colspan='6'><strong>Octubre</strong></th><th colspan='6'><strong>Noviembre</strong></th><th colspan='6'><strong>Diciembre</strong></th><th><strong>Total Anual</strong></th><th></th></tr>";
    tablaTemplate+="<tr class='editable'><th>Nombre y Apellidos</th>";

    for(var i=0; i<3;i++){ //imprime 3 veces los titulos de las pruebas (una vez por cada mes)
        tablaTemplate+="<th>Kicho/Poomsae</th><th>Destreza</th><th>Salto</th><th>Combate</th><th>Extra</th><th>Total</th>";
    }
    tablaTemplate+="</tr>";

    for (var j= 0; j < 5; j++) { //creo 5 alumnos con los botones correspondientes
        tablaTemplate+="<tr id='terNuevo' class='editable'><td onfocusout='vaciosAlert(4)'><span contenteditable='true'>Nombre"+j+"</span></td>";

        for(var p=0; p<3; p++){ //repito tres veces (1 trimestre)

            for(var n=0; n<5; n++){ //repito 5 veces el td de los puntos

                tablaTemplate+="<td onfocusout='vaciosAlert(4)'><span contenteditable='true'>0</span></td>";
            }
            tablaTemplate+="<td class='total'>0</td>";
        }
        tablaTemplate+="<td class='total'>0</td><th><button class='quitaAlumno' type='button' id='quitaAlumnoNueva' onclick='quitaAlumnoNueva()'></button></th></tr>";
    }
   
    tablaTemplate+="</table><div class='divBotones' id='divBotonesNewTabla"+v+"'><button type='button' onclick='nuevaFilaNuevaTabla("+v+")'><img src='../../img/mas.png' alt='mas' width='15px'></button><button type='button' id='filaMenos' onclick='restarFilaNuevaTabla("+v+")'><img src='../../img/menos.png' alt='menos' width='15px'></button><button type='button' id='borrar' onclick='quitarTablaNuevaTabla("+v+")'>Borrar Tabla</button><br><hr></div>";
    
    var nuevaExtra=document.getElementById("tablaExtra");
    nuevaExtra.innerHTML+=tablaTemplate;
}
//===============================================================================================================================================
function nuevaFila(num){ //Esta función sirve para insertar una nueva fila en las tablas de los trimestres

    // recojo el id de las tablas
    var tabla=$('#tabla'+num+'');
    var tabla2=$('#tablaB'+num+'');
    var tabla3=$('#tablaC'+num+'');


    //creo una posición para poder borrarlo después
    var max= 999;
    var min= 100;
    var pos= Math.round(Math.random() * (max - min) + min);

    //añado una nueva fila a cada tabla trimestre
    tabla.append("<tr class='editable'> <td onfocusout='vaciosAlert(1)'><span contenteditable='true'>Nombre</span></td><td onfocusout='vaciosAlert(1)'><span contenteditable='true'>0</span></td><td onfocusout='vaciosAlert(1)'><span contenteditable='true'>0</span></td><td onfocusout='vaciosAlert(1)'><span contenteditable='true'>0</span></td><td onfocusout='vaciosAlert(1)'><span contenteditable='true'>0</span></td><td onfocusout='vaciosAlert(1)'><span contenteditable='true'>0</span></td><td class='total'>0</td><td contenteditable='true's><span>0</span></td><td onfocusout='vaciosAlert(1)'><span contenteditable='true'>0</span></td><td onfocusout='vaciosAlert(1)'><span contenteditable='true'>0</span></td><td onfocusout='vaciosAlert(1)'><span contenteditable='true'>0</span></td><td onfocusout='vaciosAlert(1)'><span contenteditable='true'>0</span></td><td class='total'>0</td><td onfocusout='vaciosAlert(1)'><span contenteditable='true'>0</span></td><td onfocusout='vaciosAlert(1)'><span contenteditable='true'>0</span></td><td onfocusout='vaciosAlert(1)'><span contenteditable='true'>0</span></td><td onfocusout='vaciosAlert(1)'><span contenteditable='true'>0</span></td><td onfocusout='vaciosAlert(1)'><span contenteditable='true'>0</span></td><td class='total'>0</td><td class='total'>0</td><th><button class='quitaAlumno' type='button' id='quitaAlumnoA"+pos+"' onclick='quitaAlumno("+pos+")'></button></th></tr>");
    tabla2.append("<tr class='editable'> <td onfocusout='vaciosAlert(2)'><span>Nombre</span></td><td onfocusout='vaciosAlert(2)'><span contenteditable='true'>0</span></td><td onfocusout='vaciosAlert(2)'><span contenteditable='true'>0</span></td><td onfocusout='vaciosAlert(2)'><span contenteditable='true'>0</span></td><td onfocusout='vaciosAlert(2)'><span contenteditable='true'>0</span></td><td onfocusout='vaciosAlert(2)'><span contenteditable='true'>0</span></td><td class='total'>0</td><td contenteditable='true's><span>0</span></td><td onfocusout='vaciosAlert(2)'><span contenteditable='true'>0</span></td><td onfocusout='vaciosAlert(2)'><span contenteditable='true'>0</span></td><td onfocusout='vaciosAlert(2)'><span contenteditable='true'>0</span></td><td onfocusout='vaciosAlert(2)'><span contenteditable='true'>0</span></td><td class='total'>0</td><td onfocusout='vaciosAlert(2)'><span contenteditable='true'>0</span></td><td onfocusout='vaciosAlert(2)'><span contenteditable='true'>0</span></td><td onfocusout='vaciosAlert(2)'><span contenteditable='true'>0</span></td><td onfocusout='vaciosAlert(2)'><span contenteditable='true'>0</span></td><td onfocusout='vaciosAlert(2)'><span contenteditable='true'>0</span></td><td class='total'>0</td><td class='total'>0</td><th><button class='quitaAlumno' type='button' id='quitaAlumnoA"+pos+"' onclick='quitaAlumno("+pos+")'></button></th></tr>");
    tabla3.append("<tr class='editable'> <td onfocusout='vaciosAlert(3)'><span>Nombre</span></td><td onfocusout='vaciosAlert(3)'><span contenteditable='true'>0</span></td><td onfocusout='vaciosAlert(3)'><span contenteditable='true'>0</span></td><td onfocusout='vaciosAlert(3)'><span contenteditable='true'>0</span></td><td onfocusout='vaciosAlert(3)'><span contenteditable='true'>0</span></td><td onfocusout='vaciosAlert(3)'><span contenteditable='true'>0</span></td><td class='total'>0</td><td contenteditable='true's><span>0</span></td><td onfocusout='vaciosAlert(3)'><span contenteditable='true'>0</span></td><td onfocusout='vaciosAlert(3)'><span contenteditable='true'>0</span></td><td onfocusout='vaciosAlert(3)'><span contenteditable='true'>0</span></td><td onfocusout='vaciosAlert(3)'><span contenteditable='true'>0</span></td><td class='total'>0</td><td onfocusout='vaciosAlert(3)'><span contenteditable='true'>0</span></td><td onfocusout='vaciosAlert(3)'><span contenteditable='true'>0</span></td><td onfocusout='vaciosAlert(3)'><span contenteditable='true'>0</span></td><td onfocusout='vaciosAlert(3)'><span contenteditable='true'>0</span></td><td onfocusout='vaciosAlert(3)'><span contenteditable='true'>0</span></td><td class='total'>0</td><td class='total'>0</td><th><button class='quitaAlumno' type='button' id='quitaAlumnoA"+pos+"' onclick='quitaAlumno("+pos+")'></button></th></tr>");
}
//===============================================================================================================================================
function restarFila(num){ //Esta función elimina la última fila de las tablas de los trimestres

    $('#tabla'+num+' tr:last').remove(); 
    $('#tablaB'+num+' tr:last').remove(); 
    $('#tablaC'+num+' tr:last').remove(); 
}
//===============================================================================================================================================
function quitarTabla(num){ //Esta función elimina una tabla de trimestre (junto a las otros dos trimestres)
    //Quito las tablas
    $('#tabla'+num).remove(); 
    $('#tablaB'+num).remove(); 
    $('#tablaC'+num).remove(); 
    //Quito los botones
    $('#divBotones'+num+'').remove();
    $('#divBotonesB'+num+'').remove();
    $('#divBotonesC'+num+'').remove();
}
//===============================================================================================================================================
function nuevaFilaNuevaTabla(num){ //añade una nueva fila a la tabla nueva

    //recojo el id de las tablas
    var tabla=$('#nuevaTablaExtra'+num+'');

    //añado la fila a la tabla
    tabla.append("<tr class='editable'> <td onfocusout='vaciosAlert(4)'><span contenteditable='true'>Nombre</span></td><td onfocusout='vaciosAlert(4)'><span contenteditable='true'>0</span></td><td onfocusout='vaciosAlert(4)'><span contenteditable='true'>0</span></td><td onfocusout='vaciosAlert(4)'><span contenteditable='true'>0</span></td><td onfocusout='vaciosAlert(4)'><span contenteditable='true'>0</span></td><td onfocusout='vaciosAlert(4)'><span contenteditable='true'>0</span></td><td class='total'>0</td><td contenteditable='true's><span>0</span></td><td onfocusout='vaciosAlert(4)'><span contenteditable='true'>0</span></td><td onfocusout='vaciosAlert(4)'><span contenteditable='true'>0</span></td><td onfocusout='vaciosAlert(4)'><span contenteditable='true'>0</span></td><td onfocusout='vaciosAlert(4)'><span contenteditable='true'>0</span></td><td class='total'>0</td><td onfocusout='vaciosAlert(4)'><span contenteditable='true'>0</span></td><td onfocusout='vaciosAlert(4)'><span contenteditable='true'>0</span></td><td onfocusout='vaciosAlert(4)'><span contenteditable='true'>0</span></td><td onfocusout='vaciosAlert(4)'><span contenteditable='true'>0</span></td><td onfocusout='vaciosAlert(4)'><span contenteditable='true'>0</span></td><td class='total'>0</td><td class='total'>0</td><td class='quitaAlumno'><button type='button' id='quitaAlumnoNueva' onclick='quitaAlumnoNueva()'><img src='../../img/equis.png' alt='equis' width='20px'></button></td></tr>");
}
//===============================================================================================================================================
function restarFilaNuevaTabla(num){ //esta función sirve para eliminar la última fila de la tabla nueva

    $('#nuevaTablaExtra'+num+' tr:last').remove(); 
}
//===============================================================================================================================================
function quitarTablaNuevaTabla(num){ //Esta función elimina la tabla nueva
    $('#nuevaTablaExtra'+num+'').remove(); 
    $('#divBotonesNewTabla'+num+'').remove();
    $('#mensaje'+num+'').remove();
}
//===============================================================================================================================================
function quitaAlumno(num){ //Esta función elimina la fila seleccionada

    $("#quitaAlumnoA"+num+"").closest("tr").remove(); 
    $("#quitaAlumnoB"+num+"").closest("tr").remove(); 
    $("#quitaAlumnoC"+num+"").closest("tr").remove(); 
}
function quitaAlumnoNueva(){//Esta función elimina la fila seleccionada de la tabla nueva

    $(document).on("click", "#quitaAlumnoNueva", function()
    {
        $(this).closest("tr").remove(); 
    });

}
//===============================================================================================================================================
function vaciosAlert(num){ //Esta funcion es para marcar en rojo si hay algún campo vacio, desactiva el botón guardar hasta que no estén rellenados

    switch (num) {
        case 1:
            var tabla1=document.getElementById("nuevaTabla"); //recojo las tablas

            var ter1=tabla1.getElementsByTagName("td");//recojo los td (corresponden a los nombres y puntos)

            var teh1=document.getElementsByClassName("any"); //recojo los th (corresponden a los años)

            //instancio arrays necesarios
            var data1=[]; //array que contendrá lo de dentro de los td
            var dataVacia1=[]; //tendrá las posiciones vacias del array anterior
            var dataAny1=[];//para los años
            var vacioAny1=[];//tendrá las posiciones vacias del array anterior

            //boolean para ver si se deben pintar o no
            var desPintado1=true; 
            var fondoVerde1=true;

            for(var i=0; i<ter1.length; i++){ //Meto en un array los td (nombres y puntos)
                data1[i]=ter1[i].textContent;
            }

            for(var a=0; a<teh1.length; a++){ //Meto en un array los th (años)
                dataAny1[a]=teh1[a].textContent;
            }

            for(var j=0; j<data1.length; j++){ //comrpuebo los campos vacios y los meto en los arrays de nombres/puntos
                
                if(data1[j]=="" || data1[j]=="<br>"){ //si está vacío o ha sido substituido por un br
                    
                    dataVacia1.push(data1[j]); //metemelo en el array dataVacia

                }else{ 

                    if(isNaN(data1[j])){ //si es un nombre

                        if(data1[j].length<=4){ //y no cumple con el formato de nombre

                            dataVacia1.push(data1[j]); //metemelo en el array dataVacia
                        }
                    }
    
                    if(!isNaN(data1[j])){ //Si es un punto
    
                        if(data1[j].length>4){ //y no cumple con el formato de punto
                            
                            dataVacia1.push(data1[j]); //metemelo en el array dataVacia
                        }
    
                    }
                }

            }

            for(var y=0; y<dataAny1.length; y++){ //Recojo los datos y lo meto en el array de años

                if(dataAny1[y]=="" || dataAny1[y]=="<br>" || dataAny1[y].length>4 || dataAny1[y].length<4 || isNaN(dataAny1[y])){
                    vacioAny1.push(dataAny1[y]); //metemelo en el array
                }
            }
  
            for(var v=0; v<dataVacia1.length; v++){ //comrpobamos todas las posiciones de data vacia en los nombres/puntos

                if(dataVacia1[v]=="" || dataVacia1[v]=="<br>"){ //si no tiene el formato que debe

                    desPintado1=false;

                }else{

                    if(isNaN(dataVacia1[v])){ //si es un nombre

                        if(dataVacia1[v].length<=4){ //y no cumple con el formato de nombre

                            desPintado1=false;
                            
                        }
                    }else if(!isNaN(dataVacia1[v])){ //Si es un punto
    
                        if(dataVacia1[v].length>4){ //y no cumple con el formato de punto
                            
                           desPintado1=false;
                        }
    
                    }else{
                        desPintado1=true;
                    }
                }

            }

            for(var v=0; v<vacioAny1.length; v++){ //comrpobamos todas las posiciones de data vacia en los años

                if(vacioAny1[v]=="" || vacioAny1[v]=="<br>" || vacioAny1[v].length>4 || vacioAny1[v].length<4 || isNaN(vacioAny1[v])){ //si no tiene el formato que debe

                    fondoVerde1=false;
                }else{
                    fondoVerde1=true;
                }
            }

             //comprobaciones y acciones

            if(desPintado1==true && fondoVerde1==true){ //si está todo rellenado se puede guardar

                $("#terLinea td").css("border", "1px solid black");
                $("th.any").css("background-color", "rgb(112, 255, 112)");
                $("#enviar").css('display','block');

            }else{ //sino se vuelve roja la tabla y el año y se deshabilita el botón guardar

                if(desPintado1==false ){
                    $("#terLinea td").css("border", "2px solid red");
                }

                if(fondoVerde1==false){
                    $("th.any").css("background-color", "rgb(180, 0, 0)");
                }
                $("#enviar").css('display','none');
            }

            break;        
        case 2:
            var tabla2=document.getElementById("nuevaTabla2"); //recojo las tablas

            var ter2=tabla2.getElementsByTagName("td");//recojo los td (corresponden a los nombres y puntos)

            var teh2=document.getElementsByClassName("any"); //recojo los th (corresponden a los años)

            //instancio arrays necesarios
            var data2=[];
            var dataVacia2=[];
            var dataAny2=[];
            var vacioAny2=[];

            //boolean para ver si se deben pintar o no
            var desPintado2=true; 
            var fondoVerde2=true;

            for(var i=0; i<ter2.length; i++){ //Meto en un array los td (nombres y puntos)
                data2[i]=ter2[i].textContent;
            }

            for(var a=0; a<teh2.length; a++){ //Meto en un array los th (años)
                dataAny2[a]=teh2[a].textContent;
            }

            for(var j=0; j<data2.length; j++){ //comrpuebo los campos vacios y los meto en los arrays de nombres/puntos
                
                if(data2[j]=="" || data2[j]=="<br>"){ //si está vacío o ha sido substituido por un br
                    
                    dataVacia2.push(data2[j]); //metemelo en el array dataVacia

                }else{ 

                    if(isNaN(data2[j])){ //si es un nombre

                        if(data2[j].length<=4){ //y no cumple con el formato de nombre

                            dataVacia2.push(data1[j]); //metemelo en el array dataVacia
                        }
                    }
    
                    if(!isNaN(data2[j])){ //Si es un punto
    
                        if(data2[j].length>4){ //y no cumple con el formato de punto
                            
                            dataVacia2.push(data2[j]); //metemelo en el array dataVacia
                        }
    
                    }
                }

            }
            for(var y=0; y<dataAny2.length; y++){//comrpuebo los campos vacios y los meto en los arrays de años

                if(dataAny2[y]=="" || dataAny2[y]=="<br>" || dataAny2[y].length>4 || dataAny2[y].length<4 || isNaN(dataAny2[y])){ //si está vacio o ha sido substituido por br
                    
                    vacioAny2.push(dataAny2[y]); //metemelo en el array
                }
            }

            for(var v=0; v<dataVacia2.length; v++){ //comrpobamos todas las posiciones de data vacia en los nombres/puntos

                if(dataVacia2[v]=="" || dataVacia2[v]=="<br>"){ //si no tiene el formato que debe

                    desPintado2=false;

                }else{

                    if(isNaN(dataVacia2[v])){ //si es un nombre

                        if(dataVacia2[v].length<=4){ //y no cumple con el formato de nombre

                            desPintado2=false;
                            
                        }
                    }else if(!isNaN(dataVacia2[v])){ //Si es un punto
    
                        if(dataVacia2[v].length>4){ //y no cumple con el formato de punto
                            
                           desPintado2=false;
                        }
    
                    }else{
                        desPintado2=true;
                    }
                }

            }
            for(var v=0; v<vacioAny2.length; v++){ //comrpuebo los campos vacios y los meto en los arrays de años

                if(vacioAny2[v]=="" || vacioAny2[v]=="<br>" || vacioAny2[v].length>4 || vacioAny2[v].length<4 || isNaN(vacioAny2[v])){ //si está vacio
                    fondoVerde2=false;
                }else{
                    fondoVerde2=true;
                }
            }

            if(desPintado2==true && fondoVerde2==true){ //si está todo rellenado se puede guardar

                $("#terLinea2 td").css("border", "1px solid black");
                $("th.any").css("background-color", "rgb(112, 255, 112)");
                $("#enviar").css('display','block');

            }else{ //sino se vuelve roja la tabla y el año y se deshabilita el botón guardar

                if(desPintado2==false ){
                    $("#terLinea2 td").css("border", "2px solid red");
                }

                if(fondoVerde2==false){
                    $("th.any").css("background-color", "rgb(180, 0, 0)");
                }
                $("#enviar").css('display','none');
            }
            break;        
        case 3:

            var tabla3=document.getElementById("nuevaTabla3"); //recojo las tablas

            var ter3=tabla3.getElementsByTagName("td"); //recojo los td (corresponden a los nombres y puntos)

            var teh3=document.getElementsByClassName("any"); //recojo los th (corresponden a los años)

            //instancio arrays necesarios
            var data3=[];
            var dataVacia3=[];
            var dataAny3=[];
            var vacioAny3=[];

            //boolean para ver si se deben pintar o no
            var desPintado3=true; 
            var fondoVerde3=true;

            for(var i=0; i<ter3.length; i++){//Meto en un array los td (nombres y puntos)
                data3[i]=ter3[i].textContent;
            }
        
            for(var a=0; a<teh3.length; a++){ //Meto en un array los th (años)
                dataAny3[a]=teh3[a].textContent;
            }
            
            for(var j=0; j<data3.length; j++){ //comrpuebo los campos vacios y los meto en los arrays de nombres/puntos
                
                if(data3[j]=="" || data3[j]=="<br>"){ //si está vacío o ha sido substituido por un br
                    
                    dataVacia3.push(data3[j]); //metemelo en el array dataVacia

                }else{ 

                    if(isNaN(data3[j])){ //si es un nombre

                        if(data3[j].length<=4){ //y no cumple con el formato de nombre

                            dataVacia3.push(data3[j]); //metemelo en el array dataVacia
                        }
                    }
    
                    if(!isNaN(data3[j])){ //Si es un punto
    
                        if(data3[j].length>4){ //y no cumple con el formato de punto
                            
                            dataVacia3.push(data3[j]); //metemelo en el array dataVacia
                        }
    
                    }
                }

            }
            for(var y=0; y<dataAny3.length; y++){//comrpuebo los campos vacios y los meto en los arrays de años
        
                if(dataAny3[y]=="" || dataAny3[y]=="<br>" || dataAny3[y].length>4 || dataAny3[y].length<4 || isNaN(dataAny3[y])){ //si está vacio o ha sido substituido por br
                    
                    vacioAny3.push(dataAny3[y]); //metemelo en el array dataVacia
                }
            }
            for(var v=0; v<dataVacia3.length; v++){ //comrpobamos todas las posiciones de data vacia en los nombres/puntos

                if(dataVacia3[v]=="" || dataVacia3[v]=="<br>"){ //si no tiene el formato que debe

                    desPintado3=false;

                }else{

                    if(isNaN(dataVacia3[v])){ //si es un nombre

                        if(dataVacia3[v].length<=4){ //y no cumple con el formato de nombre

                            desPintado3=false;
                            
                        }
                    }else if(!isNaN(dataVacia3[v])){ //Si es un punto
    
                        if(dataVacia3[v].length>4){ //y no cumple con el formato de punto
                            
                           desPintado3=false;
                        }
    
                    }else{
                        desPintado3=true;
                    }
                }

            }
            for(var v=0; v<vacioAny3.length; v++){ //comrpuebo los campos vacios y los meto en los arrays de años
                
                if(vacioAny3[v]=="" || vacioAny3[v]=="<br>" || vacioAny3[v].length>4 || vacioAny3[v].length<4 || isNaN(vacioAny3[v])){ //si está vacio
                    fondoVerde3=false;
                }else{
                    fondoVerde3=true;
                }
            }
        
            if(desPintado3==true && fondoVerde3==true){ //si está todo rellenado se puede guardar

                $("#terLinea3 td").css("border", "1px solid black");
                $("th.any").css("background-color", "rgb(112, 255, 112)");
                $("#enviar").css('display','block');

            }else{ //sino se vuelve roja la tabla y el año y se deshabilita el botón guardar

                if(desPintado3==false ){
                    $("#terLinea3 td").css("border", "2px solid red");
                }

                if(fondoVerde3==false){
                    $("th.any").css("background-color", "rgb(180, 0, 0)");
                }
                $("#enviar").css('display','none');
            }
            break;        
        case 4:
            var tabla4=document.getElementById("tablaExtra"); //recojo las tablas

            var ter4=tabla4.getElementsByTagName("td");//recojo los td (corresponden a los nombres y puntos)

            var teh4=document.getElementsByClassName("any"); //recojo los th (corresponden a los años)

            //instancio arrays necesarios
            var data4=[]; //array que contendrá lo de dentro de los td
            var dataVacia4=[]; //tendrá las posiciones vacias del array anterior
            var dataAny4=[];//para los años
            var vacioAny4=[];//tendrá las posiciones vacias del array anterior

            //boolean para ver si se deben pintar o no
            var desPintado4=true; 
            var fondoVerde4=true;

            for(var i=0; i<ter4.length; i++){ //Meto en un array los td (nombres y puntos)
                data4[i]=ter4[i].textContent;
            }

            for(var a=0; a<teh4.length; a++){ //Meto en un array los th (años)
                dataAny4[a]=teh4[a].textContent;
            }

            for(var j=0; j<data4.length; j++){ //comrpuebo los campos vacios y los meto en los arrays de nombres/puntos
                
                if(data4[j]=="" || data4[j]=="<br>"){ //si está vacío o ha sido substituido por un br
                    
                    dataVacia4.push(data4[j]); //metemelo en el array dataVacia

                }else{ 

                    if(isNaN(data4[j])){ //si es un nombre

                        if(data4[j].length<=4){ //y no cumple con el formato de nombre

                            dataVacia4.push(data4[j]); //metemelo en el array dataVacia
                        }
                    }
    
                    if(!isNaN(data4[j])){ //Si es un punto
    
                        if(data4[j].length>4){ //y no cumple con el formato de punto
                            
                            dataVacia4.push(data4[j]); //metemelo en el array dataVacia
                        }
    
                    }
                }

            }

            for(var y=0; y<dataAny4.length; y++){ //comrpuebo los campos vacios y los meto en los arrays de años

                if(dataAny4[y]=="" || dataAny4[y]=="<br>" || dataAny4[y].length>4 || dataAny4[y].length<4 || isNaN(dataAny4[y])){ //si está vacio o ha sido substituido por br
                    
                    vacioAny4.push(dataAny4[y]); //metemelo en el array dataVacia
                }
            }
  
            for(var v=0; v<dataVacia4.length; v++){ //comrpobamos todas las posiciones de data vacia en los nombres/puntos

                if(dataVacia4[v]=="" || dataVacia4[v]=="<br>"){ //si no tiene el formato que debe

                    desPintado4=false;

                }else{

                    if(isNaN(dataVacia4[v])){ //si es un nombre

                        if(dataVacia4[v].length<=4){ //y no cumple con el formato de nombre

                            desPintado4=false;
                            
                        }
                    }else if(!isNaN(dataVacia4[v])){ //Si es un punto
    
                        if(dataVacia4[v].length>4){ //y no cumple con el formato de punto
                            
                           desPintado4=false;
                        }
    
                    }else{
                        desPintado4=true;
                    }
                }

            }

            for(var v=0; v<vacioAny4.length; v++){ //comrpobamos todas las posiciones de data vacia en los años

                if(vacioAny4[v]=="" || vacioAny4[v]=="<br>" || vacioAny4[v].length>4 || vacioAny4[v].length<4 || isNaN(vacioAny4[v])){ //si está vacio
                    fondoVerde4=false;
                }else{
                    fondoVerde4=true;
                }
            }

             //comprobaciones y acciones

             if(desPintado4==true && fondoVerde4==true){ //si está todo rellenado se puede guardar

                $("#terNuevo td").css("border", "1px solid black");
                $("th.any").css("background-color", "rgb(112, 255, 112)");
                $("#enviar").css('display','block');

            }else{ //sino se vuelve roja la tabla y el año y se deshabilita el botón guardar

                if(desPintado4==false ){
                    $("#terNuevo td").css("border", "2px solid red");
                }

                if(fondoVerde4==false){
                    $("th.any").css("background-color", "rgb(180, 0, 0)");
                }
                $("#enviar").css('display','none');
            }

            break;
    }
}
function borrarModal(num){
    if(num==1){
        $('#modalPass').remove();
    }else{
        $('#modalRecu').remove();
    }
    
}




