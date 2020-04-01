<?php

include('../functions/db.php');
include('../functions/debug.php');
include('../functions/response.php');

$query = 'SELECT id, name FROM `sections` ORDER BY `pos`;';
$data = dbSelectAllByQuery($query);

sendJsonResponse($data);