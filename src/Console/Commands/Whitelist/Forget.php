<?php

namespace Merkeleon\Laravel\HttpAuth\Console\Commands\Whitelist;


use File;
use Merkeleon\Laravel\HttpAuth\Console\Commands\Base as Command;
use Merkeleon\Laravel\HttpAuth\Helper;

class Forget extends Command
{
    protected $signature = 'http-auth:whitelist:forget {ip?}';
    protected $description = 'Remove one ip without http auth.';

    public function handle()
    {
        $ips    = Helper::getWhiteListIps();
        if (empty($ips)) {
            $this->warn('Nothing to forget');
            return;
        }
        $ip = $this->argument('ip') ?: $this->choice('What username forget?', $ips);

        Helper::forgetWhiteListIp($ip);
        $this->warn("{$ip} forgotten");
    }
}