<?php

spl_autoload_register(function($className) {
    if (strpos($className, OZON_LIB_NAMESPACE) === 0) {
        $classPath = implode(DIRECTORY_SEPARATOR, explode('\\', substr($className,10)));
        $filePath = __DIR__.DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.$classPath.'.php';

        if (is_readable($filePath) && file_exists($filePath))
            require_once $filePath;
    } elseif (strpos($className, OZON_NAMESPACE) === 0) {
        $classFile = strtr(substr(mb_strtolower($className),15), ['_' => '-']).'.class';
        $filePath = __DIR__.DIRECTORY_SEPARATOR.'classes'.DIRECTORY_SEPARATOR.$classFile.'.php';

        if (is_readable($filePath) && file_exists($filePath))
            require_once $filePath;
    }
});