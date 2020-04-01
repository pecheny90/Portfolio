<?php

function view( string $___viewPath, array $___data = [] ): string {
    extract($___data); // ['a' => 1, 'b' => 2] -> $a = 1; $b = 2;
    $___viewPath = $_SERVER['DOCUMENT_ROOT'] . '/' . $___viewPath;
    ob_start();
    include($___viewPath);
    return ob_get_clean();
}