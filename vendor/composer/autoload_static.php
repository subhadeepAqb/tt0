<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf393d9c5732a7d54532492ec70f2e8fa
{
    public static $prefixLengthsPsr4 = array (
        'a' => 
        array (
            'app\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf393d9c5732a7d54532492ec70f2e8fa::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf393d9c5732a7d54532492ec70f2e8fa::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitf393d9c5732a7d54532492ec70f2e8fa::$classMap;

        }, null, ClassLoader::class);
    }
}
