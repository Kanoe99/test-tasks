<?php

use Models\GroupsItems;

$groupItems = new GroupsItems();

$listDepth = $groupItems->getDepth('id_parent');

json_encode(['listDepth' => $listDepth]);