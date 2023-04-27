<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit64cd7ddacf8ff43813b87a7000e3b021
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit64cd7ddacf8ff43813b87a7000e3b021::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit64cd7ddacf8ff43813b87a7000e3b021::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit64cd7ddacf8ff43813b87a7000e3b021::$classMap;

        }, null, ClassLoader::class);
    }
}
