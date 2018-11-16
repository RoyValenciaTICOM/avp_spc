<?php
$baseDir = dirname(dirname(__FILE__));
return [
    'plugins' => [
        'Bake' => $baseDir . '/vendor/cakephp/bake/',
        'CakePdf' => $baseDir . '/vendor/friendsofcake/cakepdf/',
        'DebugKit' => $baseDir . '/vendor/cakephp/debug_kit/',
        'Inspinia' => $baseDir . '/plugins/Inspinia/',
        'Josegonzalez/Upload' => $baseDir . '/vendor/josegonzalez/cakephp-upload/',
        'Migrations' => $baseDir . '/vendor/cakephp/migrations/',
        'Proffer' => $baseDir . '/vendor/davidyell/proffer/',
        'WyriHaximus/TwigView' => $baseDir . '/vendor/wyrihaximus/twig-view/',
        'cakephp-upload' => $baseDir . '/plugins/cakephp-upload/',
        'vendor' => $baseDir . '/plugins/vendor/'
    ]
];