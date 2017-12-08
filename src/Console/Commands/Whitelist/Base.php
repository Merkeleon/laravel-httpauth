<?php

namespace Merkeleon\Laravel\HttpAuth\Console\Commands\Whitelist;


use File;
use Merkeleon\Laravel\HttpAuth\Console\Commands\Base as Command;
use Merkeleon\Laravel\HttpAuth\Helper;

class Base extends Command
{
    protected $signature = 'http-auth:whitelist:base';
    protected $description = 'Creates white list of ips without http auth.';

    public function handle()
    {
        $baseIps = require __DIR__.'/../stubs/base-whitelist.php';
        $ip = gethostbyname(url()->to('/'));
        if (filter_var($ip, FILTER_VALIDATE_IP) !== false) {
            $baseIps[] = $ip;
        }
        Helper::setWhiteListIps($baseIps);
        $this->info('Default whitelist created');
    }
}