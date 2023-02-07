<?php
session_start();
include_once '../config.inc.php';

if (isset($_POST['delete_admin_username'])) {
    $deleteUsername = (string)$_POST['delete_admin_username'];
    delete("DELETE FROM admin WHERE username = ?", [$deleteUsername]);
}

if (isset($_POST['update_admin_username']) && isset($_POST['update_admin_password'])) {
    $updatedUsername = (string)$_POST['updated_admin_username'];
    $updateUsername = (string)$_POST['update_admin_username'];
    $updatePassword = (string)$_POST['update_admin_password'];
    update("UPDATE admin SET username = ?, password = ? WHERE username = ?", [$updateUsername, $updatePassword, $updatedUsername]);
}

if (isset($_POST['new_admin_username']) && isset($_POST['new_admin_password'])) {
    $newUsername = (string)$_POST['new_admin_username'];
    $newPassword = (string)$_POST['new_admin_password'];
    insert("INSERT INTO admin (username, password) VALUES (?, ?)", [$newUsername, $newPassword]);
}

$admins = select('SELECT * FROM admin', []);
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Admins</h1>
<h3><a href="admin.php">Retour à l'administration</a></h3>

<form action="" method="post">
    <input required placeholder="Username" type="text" name="new_admin_username">
    <input required placeholder="Password" type="password" name="new_admin_password">
    <button type="submit">Add</button>
</form>

<table>
    <thead>
    <tr>
        <th>Username & mot de passe</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($admins as $admin): ?>
        <tr>
            <td>
                <form action="" method="post">
                    <input type="hidden" name="updated_admin_username" value="<?= $admin['username'] ?>">
                    <input type="text" name="update_admin_username" value="<?= $admin['username'] ?>">
                    <input type="password" name="update_admin_password" value="<?= $admin['password'] ?>">
                    <button type="submit">Update</button>
                </form>
            </td>
            <td>
                <?php if ($admin['username'] != $_SESSION['username']): ?>
                    <form action="" method="post">
                        <input type="hidden" name="delete_admin_username" value="<?= $admin['username'] ?>">
                        <button type="submit">&times;</button>
                    </form>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>