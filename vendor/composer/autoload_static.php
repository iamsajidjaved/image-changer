<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0baa35075dc9833470e3d6d9de352850
{
    public static $prefixesPsr0 = array (
        'G' => 
        array (
            'Gregwar\\Image' => 
            array (
                0 => __DIR__ . '/..' . '/gregwar/image',
            ),
            'Gregwar\\Cache' => 
            array (
                0 => __DIR__ . '/..' . '/gregwar/cache',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInit0baa35075dc9833470e3d6d9de352850::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
