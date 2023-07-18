<?php
    require "../vistas/inicio.html"; //archivo con el doctype html, head con el link a los estilos e inicio del body
?>

<div id='confirmarPago'>
    
<p>Hola <?php echo $_SESSION['nombre'] ?>, el pago de su pedido se realizará por transferencia</p><br>

    <p class='rojo'>* Campos obligatorios</p>

    <form action="pagoTarjeta.php" method="post">
        <div>
            <label for="radioTarjeta">Elegir tipo de tarjeta:</label><br>
            <img src='../../img/logoVisa.png' id='imgConfirmar'> 
            <img src='../../img/logoMasterCard.png' id='imgConfirmar'> 
            <img src='../../img/logoElectron.png' id='imgConfirmar'> 
            <img src='../../img/logoAmerican.png' id='imgConfirmar'> <br>
            
            <input type="radio" name="visa" value="visa">
                <label for="visa">Visa</label><br>

            <input type="radio" name="master" value="master">
                <label for="master">Master Card</label><br>

            <input type="radio" name="electron" value="electron">
                <label for="electron">Visa Electron</label><br>

            <input type="radio" name="american" value="american">
                <label for="american">American Express</label><br>
            
        </div>
        <div>
            <p>Importe: </p> <input type="text" contenteditable ="false" value="<?php echo $_SESSION['totalCarrito']?>">
            <input type="text" contenteditable ="false" value="EUR"><br>
        </div>
        <h3 class='rojo'>Datos de pago con Tarjeta de Crédito</h3><br>
    
            <label for="nTarjeta">Nº de Tarjeta: <span class='rojo'>* </span></label><input type="text" name='nTarjeta' required><br>
            <label for="caducidad">Caducidad: <span class='rojo'>* </span></label><input type="text" name='caducidad' required><br>
            <label for="codSeguridad">Código de Seguridad/CVV2: <span class='rojo'>* </span></label><input type="text" name='codSeguridad' required><br>
            <label for="titular">Titular de la Tarjeta: <span class='rojo'>* </span></label><input type="text" name='titular' required><br>
            <label for="dir">Dirección: <span class='rojo'>* </span></label><input type="text" name='dir' required><br>
            <label for="ciudad">Ciudad: <span class='rojo'>* </span></label><input type="text" name='ciudad' required><br>
            <label for="prov">Provincia: <span class='rojo'>* </span></label><input type="text" name='prov' required><br>
            <label for="codPost">Código postal: <span class='rojo'>* </span></label><input type="text" name='codPost' required><br>
            <button type='submit' name='ingresar'>Ingresar</button>
        </form>
</div>

<?php
    require "../vistas/final.html"; //archivo que contiene las etiquetas de cierre del html y body
?>