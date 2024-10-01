<?php
require_once '../src/OAuthHandler.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $oauthHandler = new OAuthHandler();
    $authUrl = $oauthHandler->getAuthorizationUrl($email);
    header('Location: ' . $authUrl);
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OAuth2 - Login con Microsoft</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="mt-5">Inicia sesión con Microsoft</h2>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="email">Correo Electrónico:</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Introduce tu correo" required>
                </div>
                <button type="submit" class="btn btn-primary">Autenticar con Microsoft</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
