<?php

use CodeIgniter\CodingStandard\CodeIgniter4;
use Nexus\CsConfig\Factory;
use PhpCsFixer\Finder;

$finder = Finder::create()
    ->files()
    ->in([__DIR__, 'app', 'public'])
    ->exclude([
        'build',
        'writable',
        'docker',
        'vendor',
    ])->append([__FILE__]);
$overrides = [
    'yoda_style' => [
        'equal'                => true,
        'identical'            => true,
        'less_and_greater'     => false,
        'always_move_variable' => false,
    ],
];
$options = [
    'finder'    => $finder,
    'cacheFile' => 'build/.php-cs-fixer.cache',
];

return Factory::create(new CodeIgniter4(), $overrides, $options)->forProjects();
