<?php
require_once '../src/OAuthHandler.php';

if (isset($_GET['code']) && isset($_GET['state'])) {
    $code = $_GET['code'];
    $email = $_GET['state']; // El correo se pasa como estado

    $oauthHandler = new OAuthHandler();
    $oauthHandler->handleCallback($code, $email);

    echo "Token almacenado o actualizado correctamente.";
} else {
    echo "Error en la autenticación.";
}
?>
