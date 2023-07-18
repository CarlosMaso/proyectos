<?php
    if(!isset($_SESSION['usuario'])){
        header("Location: ../controladores/principal.php");
    }
?>
<script>
    window.onload = function() {
        imprimeTodo();
        seleccionador();
    };
    function seleccionador(){ //Recoje el botón que se ha pulsado y dependiendo de si es arriba, abajo, der, izq, mueve el focus de un lado a otro

        document.addEventListener('keydown', (event) => {

        // Obtén todos los elementos <tr>
            var filas = Array.from(document.querySelectorAll('tr'));

            // Crea un array para almacenar los elementos <tr> y sus elementos <td>
            var arrayFilas = [];

            filas.forEach(function(fila) { // Recorre cada fila
            
                var celdas = Array.from(fila.querySelectorAll('td')); // Obtén todos los elementos <td> dentro de la fila actual
                
                arrayFilas.push(celdas);// Agrega el array de celdas al array de filas
            });

            var key = event.key || event.keyCode;

            var focuseado= document.activeElement; //te recoge el elemento que tiene focus
            var padreFocus = focuseado.parentNode;

            for(var i=0; i<arrayFilas.length; i++){

                for (var j = 0; j < arrayFilas[i].length; j++) {

                    if(padreFocus== arrayFilas[i][j]){
                        var keyPadre= i;
                        var keyHijo= j;
                    }
                    
                }
            
            }
        
            switch (key) {
                case "ArrowUp":

                    var k=keyPadre-1;

                    if(k>=0){ //Si está en la fila de arriba de todo
                        arrayFilas[k][keyHijo].firstElementChild.focus();
                    }

                    break;
                case "ArrowDown":

                    var largaria=arrayFilas.length-1;
                    var k=keyPadre+1;

                    if(k<=largaria){ //Si no es la ultima fila se pueda bajar

                        arrayFilas[k][keyHijo].firstElementChild.focus();

                    }

                    break;
            }

        }, false);
    }
</script>
<body>
    <!-- ======================= DETALLE ========================================================== --> 
    <div id="detalle">
        <table id='tablaGuardar'>
            <tr>
                <td id='tdGuardar'><button type="button" id="enviar" onclick="guardar()"><img src="../../img/guardar.png" alt="guardar" width="30px"></button></td>
                <td id="centraTrimestres"><button id="btn1" type="button" onclick="oculta1()">1 trimestre</button><button id="btn2" type="button" onclick="oculta2()">2 trimestre</button><button id="btn3" type="button" onclick="oculta3()">3 trimestre</button></td>
                <td></td>
            </tr>
        </table>   
        <hr>
        <br><button id='btnTablaNueva' type="button" onclick="nuevaTabla()">Nueva tabla</button><br>
        <div id="tablaExtra"></div>
        <div id="nuevaTabla" name="nuevaTabla" class="loVeo"></div>
        <div id="nuevaTabla2" name="nuevaTabla2" class="noLoVeo"></div>
        <div id="nuevaTabla3" name="nuevaTabla3" class="noLoVeo"></div>
    </div>