<?php
use Models\GroupsItems;
require './utils/dd.php';
require './Database/Database.php';
require './Models/GroupItems.php';
require './config.php';

$groupItems = new GroupsItems();

$levelOneResults = $groupItems->getByIdParent(0);

?>

<!DOCTYPE html>
<html lang="en">
<script src="js/list.js" defer></script>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./styles/style.css">
</head>

<body>
    <ul data-depth="<?= htmlspecialchars($listDepth) ?>">
        <?php foreach ($levelOneResults as $result): ?>
            <li>
                <span class="link">
                    <?= htmlspecialchars($result['name']) ?>
                    <span>id = <?= htmlspecialchars($result['id']) ?></span>
                </span>
            </li>
        <?php endforeach; ?>
    </ul>
</body>

</html>