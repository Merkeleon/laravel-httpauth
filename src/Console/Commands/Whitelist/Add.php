<?php

namespace Merkeleon\Laravel\HttpAuth\Console\Commands\Whitelist;


use File;
use Merkeleon\Laravel\HttpAuth\Console\Commands\Base as Command;
use Merkeleon\Laravel\HttpAuth\Helper;

class Add extends Command
{
    protected $signature = 'http-auth:whitelist:add {ip?}';
    protected $description = 'Creates white list of ips without http auth.';

    public function handle()
    {
        $ip = $this->argument('ip') ?: $this->ask('What is ip?');
        Helper::addWhiteListIp($ip);

        $this->info("Ip {$ip} added to whitelist");
    }
}