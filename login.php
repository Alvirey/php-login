<?php

    session_start();

    require 'database.php';

    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $records = $conn->prepare('SELECT id, email, contraseña FROM usuarios WHERE email=:email');
        $records->bindParam(':email', $_POST['email']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $message = '';

        if (count($results) > 0 && password_verify($_POST['password'], $results['contraseña'])) {
            $_SESSION['user_id'] = $results['id'];
            header('Location: /php-login');
        } else {
            $message = 'Usuario o contraseña incorrecta';
        }
    }

?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    
    <?php require "partials/header.php" ?>
    
    <h1>Iniciar Sesión</h1>
    <span> o <a href="signup.php">Registrarse</a></span>

    <?php if (!empty($message)) : ?>
        <p><?= $message ?></p>
    <?php endif;?>

    <form action="login.php" method="post">
        <input type="text" name="email" placeholder="Ingrese su email">
        <input type="password" name="password" placeholder="Ingrese su contraseña">
        <input type="submit" value="Enviar">
    </form>
</body>
</html>