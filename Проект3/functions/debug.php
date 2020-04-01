<?php
/**
 * Debug
 * 
 * @var array $array
 */
function d( array $array ): void {
    echo '<pre>';
    print_r( $array);
    echo '</pre>';
}

/**
 * Variable dump.
 * 
 * @var mixed $value
 */
function vd( $value ): void {
    echo '<pre>';
    var_dump( $value);
    echo '</pre>';
}

/**
 * Variable export.
 * 
 * @var mixed $value
 */
function ve( $value ): void {
    echo '<pre>';
    var_export( $value);
    echo '</pre>';
}