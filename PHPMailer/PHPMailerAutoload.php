<?php
/**
 * PHPMailer SPL autoloader (fixed for PHP 7+ / 8+)
 * @package PHPMailer
 * @link https://github.com/PHPMailer/PHPMailer/
 */

/**
 * PHPMailer SPL autoloader.
 * @param string $classname The name of the class to load
 */
function PHPMailerAutoload($classname)
{
    $filename = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'class.' . strtolower($classname) . '.php';
    if (is_readable($filename)) {
        require $filename;
    }
}

// Always register with spl_autoload_register for PHP 7/8 compatibility
spl_autoload_register('PHPMailerAutoload', true, true);
