<?php
session_start();
include_once '../config.inc.php';

if (isset($_POST['delete_theme_id'])) {
    $id = (int)$_POST['delete_theme_id'];
    delete("DELETE FROM theme_inscription WHERE theme_id = ?", [$id]);
    delete("DELETE FROM theme WHERE id = ?", [$id]);
}

if (isset($_POST['new_theme'])) {
    $new_theme = (string)$_POST['new_theme'];
    insert("INSERT INTO theme (label) VALUES (?)", [$new_theme]);
}

if (isset($_POST['update_theme_id'])) {
    $id = (int)$_POST['update_theme_id'];
    $label = (string)$_POST['update_theme_label'];
    update("UPDATE theme SET label = ? WHERE id = ?", [$label, $id]);
}

$themes = select('SELECT * FROM theme', []);
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Themes</h1>
<h3><a href="admin.php">Retour à l'administration</a></h3>

<form action="" method="post">
    <input required placeholder="Theme" type="text" name="new_theme">
    <button type="submit">Add</button>
</form>

<table>
    <thead>
    <tr>
        <th>Id</th>
        <th>Theme</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($themes as $theme): ?>
        <tr>
            <td><?= $theme['id'] ?></td>
            <td>
                <form action="" method="post">
                    <input type="hidden" name="update_theme_id" value="<?= $theme['id'] ?>">
                    <input type="text" name="update_theme_label" value="<?= $theme['label'] ?>">
                    <button type="submit">Update</button>
                </form>
            </td>
            <td>
                <form action="" method="post">
                    <input type="hidden" name="delete_theme_id" value="<?= $theme['id'] ?>">
                    <button type="submit">&times;</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>