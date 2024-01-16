<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4109c5c07d84c0e31fbbbf31bf17f1fe
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit4109c5c07d84c0e31fbbbf31bf17f1fe::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4109c5c07d84c0e31fbbbf31bf17f1fe::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit4109c5c07d84c0e31fbbbf31bf17f1fe::$classMap;

        }, null, ClassLoader::class);
    }
}
