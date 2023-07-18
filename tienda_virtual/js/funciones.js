//esta funcion redirige al lugar que le indicas dentro de la variable
function redirigeBotones(lugar){

    switch (lugar) {
        case "iniciar":
            window.location.href = "http://localhost/PHP%20project/php/controladores/validar.php";
            break;
        case "registrar":
            window.location.href = "http://localhost/PHP%20project/php/controladores/registrarse.php";
            break;
        case "principal":
            window.location.href = "http://localhost/PHP%20project/php/controladores/principal.php";
            break;
    }
}
