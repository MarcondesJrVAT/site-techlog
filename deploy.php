<?php

require 'recipe/composer.php';

set('default_stage', 'test');
set('repository', 'git@gitlab.com:fabioassuncao/site-vat.git');
set('use_ssh2', false);

$servers = [
    'production' => [
        'name' => 'production',
        'address' => 'sb01.ip.tv',
        'port' => 3917,
        'user' => 'deploy',
        'password' => '!vatma@39!!',
        'path' => '/var/www/vat.com.br'
    ],

    'test' => [
        'name' => 'test',
        'address' => 'homolog.ip.tv',
        'port' => 22,
        'password' => '[PASSWORD HERE]',
        'user' => 'deploy',
        'path' => '/var/www/vat.com.br'
    ]
];

foreach ($servers as $server) {
    server($server['name'], $server['address'], $server['port'])
        ->user($server['user'])
        ->password($server['password'])
        ->stage($server['name'])
        ->env('deploy_path', $server['path']);
}

task('deploy:vendors', function () {
    write('Concluindo...');
});