<?php
/**
 * Autoload Coinzone Request Objects
 * @param $className
 */
function autoloadRequest($className) {
    $filename = __DIR__ . '/request/' . $className . '.php';
    if (is_readable($filename)) {
        require_once($filename);
    }
}

/**
 * Autoload Coinzone Response Objects
 * @param $className
 */
function autoloadResponse($className) {
    $filename = __DIR__ . '/response/' . $className . '.php';
    if (is_readable($filename)) {
        require_once($filename);
    }
}

/**
 * Autoload Coinzone Client
 * @param $className
 */
function autoloadClasses($className) {
    $filename = __DIR__ . '/classes/' . $className . '.php';
    if (is_readable($filename)) {
        require_once($filename);
    }
}

/**
 * Autoload Coinzone Client
 * @param $className
 */
function autoloadException($className) {
    $filename = __DIR__ . '/exception/' . $className . '.php';
    if (is_readable($filename)) {
        require_once($filename);
    }
}

/** register autoload functions */
spl_autoload_register("autoloadRequest");
spl_autoload_register("autoloadResponse");
spl_autoload_register("autoloadClasses");
spl_autoload_register("autoloadException");
