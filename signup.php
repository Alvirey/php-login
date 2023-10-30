<?php
    require 'database.php';

    $message = '';

    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $sql = "INSERT INTO usuarios (email, contraseña) VALUES (:email, :password)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email',$_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $stmt->bindParam(':password',$password);

        if ($stmt->execute()) {
            $message = 'Registro de usuario exitoso';
        }else{
            $message = 'Lo sentimos hubo un error al resgistrarse';

        }
    }
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Evidencia Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    
    <?php require "partials/header.php" ?>

    <?php if(!empty($message)): ?>
        <p><?= $message ?></p>
    <?php endif; ?>


    <h1>Registrarse</h1>
    <span> o <a href="login.php">Iniciar sesión</a></span>

    <form action="signup.php" method="post">
        <input type="text" name="email" placeholder="Ingrese su email">
        <input type="password" name="password" placeholder="Ingrese su contraseña">
        <input type="password" name="confirm_password" placeholder="Confirmar contraseña">
        <input type="submit" value="Enviar">

    </form>
    
</body>
</html>