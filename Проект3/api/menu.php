<?php

include('../functions/db.php');
include('../functions/debug.php');
include('../functions/response.php');

$query = 'SELECT 
mt.alias AS type,
m.name,
m.link,
m.sectionId
FROM `menu` m
JOIN `menu_types` mt ON m.typeId = mt.id
ORDER BY typeId, pos';
$data = dbSelectAllByQuery($query);

// d($data);

$result = [
    'header'       => [],
    'footerLeft'   => [],
    'footerCenter' => [],
];

foreach ($data as $datum) {
    $type = $datum['type'];
    unset($datum['type']);
    $result[$type][] = $datum;
}

// d($result);

sendJsonResponse($result);