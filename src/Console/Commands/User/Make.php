<?php

namespace Merkeleon\Laravel\HttpAuth\Console\Commands\User;


use Illuminate\Console\Command;
use Merkeleon\Laravel\HttpAuth\Helper;

class Make extends Command
{
    protected $signature = 'http-auth:user:make {user?} {password?}';
    protected $description = 'Add or Update user';

    public function handle()
    {
        $username = $this->argument('user') ?: $this->ask('What is username?');
        $password = $this->argument('password') ?: $this->ask('What is password?');

        Helper::makeUser($username, $password);

        $this->info("User with credentials {$username}:{$password} successfully created");
    }
}