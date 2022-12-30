<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitdece63131bf912583309bf9e244edd1f
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitdece63131bf912583309bf9e244edd1f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitdece63131bf912583309bf9e244edd1f::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitdece63131bf912583309bf9e244edd1f::$classMap;

        }, null, ClassLoader::class);
    }
}
