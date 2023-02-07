<?php
session_start();
include_once '../config.inc.php';

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $admin = select('SELECT * FROM admin WHERE username = ? AND password = ?', [$username, $password]);

    if (count($admin) <= 0) {
        header('Location: /');
    } else {
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
    }
}

if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];
    $admin = select('SELECT * FROM admin WHERE username = ? AND password = ?', [$username, $password]);

    if (count($admin) <= 0) {
        header('Location: /');
    }
}

?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<h1>Administration</h1>
<form action="deconnexion.php">
    <button type="submit">Déconnexion</button>
</form>

<div style="display:flex; gap: 2rem">
    <div><?php include_once 'liste_inscrits.php' ?></div>
    <div><?php include_once 'liste_theme.php' ?></div>
    <div><?php include_once 'liste_admins.php' ?></div>
</div>

</body>
</html>