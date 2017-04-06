<?php

namespace Merkeleon\Laravel\HttpAuth\Console\Commands\User;


use Illuminate\Console\Command;
use Merkeleon\Laravel\HttpAuth\Helper;

class Forget extends Command
{
    protected $signature = 'http-auth:user:forget {user?}';
    protected $description = 'Remove one user from list.';

    public function fire()
    {
        if (!Helper::isLocked())
        {
            $this->warn('Authentication disabled');
            return;
        }
        $users    = Helper::getUsers();
        $username = $this->argument('user') ?: $this->choice('What username forget?', array_keys($users));
        Helper::forgetUser($username);
        $this->info("User with credentials {$username} successfully forgotten");
    }
}