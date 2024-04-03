<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitaf3dc021f1e20b0a36191b41df1ed44f
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
            $loader->prefixLengthsPsr4 = ComposerStaticInitaf3dc021f1e20b0a36191b41df1ed44f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitaf3dc021f1e20b0a36191b41df1ed44f::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitaf3dc021f1e20b0a36191b41df1ed44f::$classMap;

        }, null, ClassLoader::class);
    }
}
