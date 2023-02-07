<?php

if (isset($_POST['delete_inscrit_id'])) {
    $id = (int)$_POST['delete_inscrit_id'];
    $delete = delete("DELETE FROM inscription WHERE id = ?", [$id]);
}

if (isset($_POST['new_inscrit'])) {
    $new_inscrit = (string)$_POST['new_inscrit'];
    $insert = insert("INSERT INTO inscription (email) VALUES (?)", [$new_inscrit]);
}

if (isset($_POST['update_inscrit_id'])) {
    $id = (int)$_POST['update_inscrit_id'];
    $email = (string)$_POST['update_inscrit_email'];
    $update = update("UPDATE inscription SET email = ? WHERE id = ?", [$email, $id]);
}

$inscriptions = select('SELECT * FROM inscription', []);
?>

<h2>Inscriptions</h2>

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