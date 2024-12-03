<?php
use Models\GroupsItems;
require './helpers.php';
require './Models/GroupItems.php';
require './Database/Database.php';


$groupItems = new GroupsItems();

$levelOneResults = $groupItems->getByIdParent(0);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./styles/style.css">
</head>

<body>
    <ul>
        <?php foreach ($levelOneResults as $result): ?>
            <li>
                <span class="link">
                    <?= htmlspecialchars($result['name']) ?>
                </span>
            </li>
        <?php endforeach; ?>
    </ul>
</body>

</html>