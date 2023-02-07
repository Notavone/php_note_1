<?php
session_start();
include_once '../config.inc.php';

$themes = select('SELECT * FROM theme', []);
$themes_ids = array_column($themes, 'id');
$inscriptions_ids = [];

if (isset($_POST['inscrit_mail']) || isset($_SESSION['inscrit_email'])) {
    $inscrit_mail = $_POST['inscrit_mail'] ?? $_SESSION['inscrit_email'];
    $inscrit = select('SELECT * FROM inscription WHERE email = ?', [$inscrit_mail]);

    if (count($inscrit) <= 0) {
        header('Location: /');

        insert('INSERT INTO inscription (email) VALUES (?)', [$inscrit_mail]);
        $_SESSION['inscrit_email'] = $inscrit_mail;
        $inscrit_id = select('SELECT id FROM inscription WHERE email = ?', [$inscrit_mail])[0]['id'];
        foreach ($themes_ids as $theme_id) {
            insert('INSERT INTO theme_inscription (inscription_id, theme_id) VALUES (?, ?)', [$inscrit_id, $theme_id]);
        }
    } else {
        $_SESSION['inscrit_email'] = $inscrit_mail;
        $_SESSION['inscrit_id'] = $inscrit[0]['id'];
    }

    $inscriptions = select('SELECT * FROM theme_inscription WHERE inscription_id = ?', [$_SESSION['inscrit_id']]);
    $inscriptions_ids = array_column($inscriptions, 'theme_id');
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

<div>
    <form action="/src/admin.php" method="post">
        <input required placeholder="Username" type="text" name="username">
        <input required placeholder="Password" type="password" name="password">
        <button type="submit">Login</button>
    </form>
</div>

<?php if (!isset($_SESSION['inscrit_email'])): ?>
    <div>
        <form action="" method="post">
            <input required placeholder="Email" type="text" name="inscrit_mail">
            <button type="submit">Voir mes adhésions</button>
        </form>
    </div>
<?php else: ?>
    <div>
        <span><?php echo $_SESSION['inscrit_email'] ?></span>
        <a href="deconnexion.php">Déconnexion</a>
    </div>
<?php endif; ?>

<h1>Thèmes</h1>
<form action="maj_adhesions.php" method="get">
    <div style="display:flex; gap: 1rem">
        <?php foreach ($themes as $theme): ?>
            <div>
                <h2>
                    <label>
                        <?php echo $theme['label'] ?>
                        <?php if (isset($_SESSION['inscrit_email'])): ?>
                            <input type="checkbox"
                                   name="<?php echo 'check_' . $theme['id'] ?>"
                                <?php echo in_array($theme['id'], $inscriptions_ids) ? 'checked' : '' ?>
                            >
                        <?php endif; ?>
                    </label>
                </h2>
            </div>
        <?php endforeach; ?>
    </div>

    <?php if (isset($_SESSION['inscrit_email'])): ?>
        <button type="submit">Mettre à jour mes adhésions</button>
    <?php endif; ?>
</form>

</body>
</html>