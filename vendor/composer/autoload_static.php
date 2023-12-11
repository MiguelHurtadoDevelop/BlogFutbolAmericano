<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite875ae8441d070d7dda5f4b47a2117aa
{
    public static $files = array (
        '320cde22f66dd4f5d3fd621d3e88b98f' => __DIR__ . '/..' . '/symfony/polyfill-ctype/bootstrap.php',
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
        'a4a119a56e50fbb293281d9a48007e0e' => __DIR__ . '/..' . '/symfony/polyfill-php80/bootstrap.php',
    );

    public static $prefixLengthsPsr4 = array (
        'U' => 
        array (
            'Utils\\' => 6,
        ),
        'S' => 
        array (
            'Symfony\\Polyfill\\Php80\\' => 23,
            'Symfony\\Polyfill\\Mbstring\\' => 26,
            'Symfony\\Polyfill\\Ctype\\' => 23,
            'Services\\' => 9,
        ),
        'R' => 
        array (
            'Repositories\\' => 13,
        ),
        'P' => 
        array (
            'PhpOption\\' => 10,
            'Pagerfanta\\Twig\\' => 16,
            'Pagerfanta\\Solarium\\' => 20,
            'Pagerfanta\\Elastica\\' => 20,
            'Pagerfanta\\Doctrine\\PHPCRODM\\' => 29,
            'Pagerfanta\\Doctrine\\ORM\\' => 24,
            'Pagerfanta\\Doctrine\\MongoDBODM\\' => 31,
            'Pagerfanta\\Doctrine\\DBAL\\' => 25,
            'Pagerfanta\\Doctrine\\Collections\\' => 32,
            'Pagerfanta\\' => 11,
        ),
        'M' => 
        array (
            'Models\\' => 7,
            'Mh\\blog\\' => 8,
        ),
        'L' => 
        array (
            'Lib\\' => 4,
        ),
        'G' => 
        array (
            'GrahamCampbell\\ResultType\\' => 26,
        ),
        'D' => 
        array (
            'Dotenv\\' => 7,
        ),
        'C' => 
        array (
            'Controllers\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Utils\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Utils',
        ),
        'Symfony\\Polyfill\\Php80\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-php80',
        ),
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
        'Symfony\\Polyfill\\Ctype\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-ctype',
        ),
        'Services\\' => 
        array (
            0 => __DIR__ . '/../..' . '/services',
        ),
        'Repositories\\' => 
        array (
            0 => __DIR__ . '/../..' . '/repositories',
        ),
        'PhpOption\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpoption/phpoption/src/PhpOption',
        ),
        'Pagerfanta\\Twig\\' => 
        array (
            0 => __DIR__ . '/..' . '/pagerfanta/pagerfanta/lib/Twig',
        ),
        'Pagerfanta\\Solarium\\' => 
        array (
            0 => __DIR__ . '/..' . '/pagerfanta/pagerfanta/lib/Adapter/Solarium',
        ),
        'Pagerfanta\\Elastica\\' => 
        array (
            0 => __DIR__ . '/..' . '/pagerfanta/pagerfanta/lib/Adapter/Elastica',
        ),
        'Pagerfanta\\Doctrine\\PHPCRODM\\' => 
        array (
            0 => __DIR__ . '/..' . '/pagerfanta/pagerfanta/lib/Adapter/Doctrine/PHPCRODM',
        ),
        'Pagerfanta\\Doctrine\\ORM\\' => 
        array (
            0 => __DIR__ . '/..' . '/pagerfanta/pagerfanta/lib/Adapter/Doctrine/ORM',
        ),
        'Pagerfanta\\Doctrine\\MongoDBODM\\' => 
        array (
            0 => __DIR__ . '/..' . '/pagerfanta/pagerfanta/lib/Adapter/Doctrine/MongoDBODM',
        ),
        'Pagerfanta\\Doctrine\\DBAL\\' => 
        array (
            0 => __DIR__ . '/..' . '/pagerfanta/pagerfanta/lib/Adapter/Doctrine/DBAL',
        ),
        'Pagerfanta\\Doctrine\\Collections\\' => 
        array (
            0 => __DIR__ . '/..' . '/pagerfanta/pagerfanta/lib/Adapter/Doctrine/Collections',
        ),
        'Pagerfanta\\' => 
        array (
            0 => __DIR__ . '/..' . '/pagerfanta/pagerfanta/lib/Core',
        ),
        'Models\\' => 
        array (
            0 => __DIR__ . '/../..' . '/models',
        ),
        'Mh\\blog\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
        'Lib\\' => 
        array (
            0 => __DIR__ . '/../..' . '/lib',
        ),
        'GrahamCampbell\\ResultType\\' => 
        array (
            0 => __DIR__ . '/..' . '/graham-campbell/result-type/src',
        ),
        'Dotenv\\' => 
        array (
            0 => __DIR__ . '/..' . '/vlucas/phpdotenv/src',
        ),
        'Controllers\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Controllers',
        ),
    );

    public static $classMap = array (
        'Attribute' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/Attribute.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'PhpToken' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/PhpToken.php',
        'Stringable' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/Stringable.php',
        'UnhandledMatchError' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/UnhandledMatchError.php',
        'ValueError' => __DIR__ . '/..' . '/symfony/polyfill-php80/Resources/stubs/ValueError.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite875ae8441d070d7dda5f4b47a2117aa::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite875ae8441d070d7dda5f4b47a2117aa::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInite875ae8441d070d7dda5f4b47a2117aa::$classMap;

        }, null, ClassLoader::class);
    }
}
