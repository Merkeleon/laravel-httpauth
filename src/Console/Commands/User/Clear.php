<?php

namespace Merkeleon\Laravel\HttpAuth\Console\Commands\User;


use Merkeleon\Laravel\HttpAuth\Console\Commands\Base as Command;
use Merkeleon\Laravel\HttpAuth\Helper;

class Clear extends Command
{
    protected $signature = 'http-auth:user:clear';
    protected $description = 'Clear user list.';

    public function handle()
    {
        Helper::setUsers([]);
        $this->info('Users list cleared');
    }
}