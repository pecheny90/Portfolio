<?php
function sendJsonResponse($data, int $code = 200): void {
    sendResponse(json_encode($data), $code);
}

function sendResponse(string $message, int $code = 200): void {
    http_response_code($code);
    header("Content-Type: text/html");
    die($message);
}