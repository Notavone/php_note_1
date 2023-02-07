<?php
session_start();
$inscrit_id = $_SESSION['inscrit_id'];
$choix = [];

include_once '../config.inc.php';

foreach ($_GET as $key => $value) {
    if (strpos($key, 'check_') !== false) {
        $choix[] = str_replace('check_', '', $key);
    }
}

delete('DELETE FROM theme_inscription WHERE inscription_id = ?', [$inscrit_id]);
foreach ($choix as $theme_id) {
    insert('INSERT INTO theme_inscription (inscription_id, theme_id) VALUES (?, ?)', [$inscrit_id, $theme_id]);
}

header('Location: /');
