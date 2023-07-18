<?php
    if(!isset($_SESSION['usuario'])){
      header("Location: ../controladores/principal.php");
    }
?>
<body onload='imprimeClasi()'>
<!-- ======================= CLASIFICACIÓN ========================================================== --> 
<div id="clasi" >
  <h1>Clasificación</h1>

  <div id="tablaClass" name="tablaClass"></div>
  
</div>
<br>