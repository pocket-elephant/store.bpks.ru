<?php
namespace Deployer;

require 'recipe/laravel.php';

// Config

set('repository', 'git@github.com:pocket-elephant/store.bpks.ru.git');

set('bin/php', function () {
    return '/opt/php83/bin/php';
});

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts

host('37.140.241.105')
    ->set('remote_user', 'bpks')
    ->set('deploy_path', '~/www/store.bpks.ru');

task('build:clean', function () {
    run('cd {{release_path}} && rm -rf ./public/build');
});

task('npm:install', function () {
    run('cd {{release_path}} && npm i');
});

task('vite:build', function () {
    run('cd {{release_path}} && npm run build');
});

// Hooks

after('deploy:failed', 'deploy:unlock');
//after('deploy:vendors', 'build:clean');
//after('build:clean', 'npm:install');
//after('npm:install', 'vite:build');

//after('build:clean', 'npm:install');
