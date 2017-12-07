<?php

namespace Merkeleon\Laravel\HttpAuth\Console\Commands\User;


use Illuminate\Console\Command;
use Merkeleon\Laravel\HttpAuth\Helper;

class Show extends Command
{
    protected $signature = 'http-auth:user:show';
    protected $description = 'Show list of users';

    public function handle()
    {
        $users = Helper::getUsers();
        if (empty($users))
        {
            $this->warn('Authentication disabled');
            return;
        }

        $this->info('List of users:');
        foreach ($users as $key => $value)
        {
            $this->warn($key . ' ' . $value);
        }
    }
}