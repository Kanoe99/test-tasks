<?php
require './Models/GroupItems.php';
require './Database/Database.php';

use Models\GroupsItems;

header('Content-Type: application/json');

try {
    $groupItems = new GroupsItems();
    $idParent = $_GET['id_parent'];
    $results = $groupItems->getByIdParent($idParent);

    echo json_encode([
        'status' => 'success',
        'data' => $results
    ]);
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
