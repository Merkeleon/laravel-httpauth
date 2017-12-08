<?php

namespace Merkeleon\Laravel\HttpAuth\Console\Commands\Whitelist;


use File;
use Merkeleon\Laravel\HttpAuth\Console\Commands\Base as Command;
use Merkeleon\Laravel\HttpAuth\Helper;

class Clear extends Command
{
    protected $signature = 'http-auth:whitelist:clear';
    protected $description = 'Clear white list of ips without http auth.';

    public function handle()
    {
        Helper::setWhiteListIps([]);
        $this->warn("Whitelist cleared");
    }
}