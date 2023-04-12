<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit56a68257dfa4853920eb371e3c304fd1
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit56a68257dfa4853920eb371e3c304fd1::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit56a68257dfa4853920eb371e3c304fd1::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit56a68257dfa4853920eb371e3c304fd1::$classMap;

        }, null, ClassLoader::class);
    }
}