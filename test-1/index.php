<?php

use Core\Database;
require './helpers.php';
require './db/Database.php';

$db = new Database('mysql', 'db', 'database', 'root', 'root');
$results = $db->query('SELECT * from groups')->get();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <ul>
        <?php foreach ($results as $result): ?>
            <li> <?= htmlspecialchars($result['name']) ?> </li>
        <?php endforeach; ?>
    </ul>
</body>

</html>