<?php

namespace Merkeleon\Laravel\HttpAuth\Console\Commands\Whitelist;


use Illuminate\Console\Command;
use Merkeleon\Laravel\HttpAuth\Helper;

class Show extends Command
{
    protected $signature = 'http-auth:whitelist:show';
    protected $description = 'Show list of whitelisted ips';

    public function handle()
    {
        $ips = Helper::getWhiteListIps();
        if (empty($ips))
        {
            $this->warn('WhiteList is empty');
            return;
        }

        $this->info('List of whitelisted ips:');
        foreach ($ips as $ip)
        {
            $this->warn($ip);
        }
    }
}