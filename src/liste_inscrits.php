<?php
session_start();
include_once '../config.inc.php';

if (isset($_POST['delete_inscrit_id'])) {
    $id = (int)$_POST['delete_inscrit_id'];
    delete("DELETE FROM theme_inscription WHERE inscription_id = ?", [$id]);
    delete("DELETE FROM inscription WHERE id = ?", [$id]);
}

if (isset($_POST['new_inscrit'])) {
    $new_inscrit = (string)$_POST['new_inscrit'];
    insert("INSERT INTO inscription (email) VALUES (?)", [$new_inscrit]);
}

if (isset($_POST['update_inscrit_id'])) {
    $id = (int)$_POST['update_inscrit_id'];
    $email = (string)$_POST['update_inscrit_email'];
    update("UPDATE inscription SET email = ? WHERE id = ?", [$email, $id]);
}

$inscriptions = select('SELECT * FROM inscription', []);
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Inscriptions</h1>
<h3><a href="admin.php">Retour à l'administration</a></h3>

<form action="" method="post">
    <input required placeholder="Email" type="text" name="new_inscrit">
    <button type="submit">Add</button>
</form>

<table>
    <thead>
    <tr>
        <th>Id</th>
        <th>Email</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($inscriptions as $inscription): ?>
        <tr>
            <td><?= $inscription['id'] ?></td>
            <td>
                <form action="" method="post">
                    <input type="hidden" name="update_inscrit_id" value="<?= $inscription['id'] ?>">
                    <input type="text" name="update_inscrit_email" value="<?= $inscription['email'] ?>">
                    <button type="submit">Update</button>
                </form>
            </td>
            <td>
                <form action="" method="post">
                    <input type="hidden" name="delete_inscrit_id" value="<?= $inscription['id'] ?>">
                    <button type="submit">&times;</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>
