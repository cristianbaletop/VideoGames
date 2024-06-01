<?php

define('__ROOT__', dirname(__FILE__, 2));

function getManager($classname) {
    $classname = str_replace('\\', '/', $classname);
    require_once(__ROOT__. '/'. $classname . '.php');
}

spl_autoload_register('getManager');

