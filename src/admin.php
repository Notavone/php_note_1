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

$compte_themes = select('SELECT * FROM theme', []);
$compte_inscrits = select('SELECT * FROM inscription', []);

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
<h3><?php echo $_SESSION['username'] ?> <a href="deconnexion.php">Déconnexion</a></h3>

<div style="display:flex; gap: 2rem">
    <h4><a href="liste_inscrits.php"><?php echo sizeof($compte_inscrits) ?> inscrits</a></h4>
    <h4><a href="liste_theme.php"><?php echo sizeof($compte_themes) ?> thèmes</a></h4>
    <h4><a href="liste_admins.php">Gestion des administrateurs</a></h4>
</div>

</body>
</html>