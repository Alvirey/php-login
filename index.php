<?php
    session_start();

    require 'database.php';

    if (isset($_SESSION['user_id'])) {
        $records = $conn->prepare('SELECT id, email, contraseña FROM usuarios WHERE id = :id');
        $records->bindParam(':id', $_SESSION['user_id']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $user = null;

        if (count($results) > 0) {
            $user = $results;
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
    
    <?php if(!empty($user)): ?>
        <br>Bienvenido. <?= $user['email'] ?>
        <br>Inicio de sesión exitoso
        <br><img src="https://cdn-icons-png.flaticon.com/128/5972/5972778.png" alt="Descripción de la imagen">
        <a href="logout.php">Cerrar sesión</a>
    <?php else: ?>

        <h1>Por favor inicie sesión o regístrese</h1>

        <a href="login.php">Iniciar</a> or
        <a href="signup.php">Registrarse</a>
    <?php endif; ?>
</body>
</html>