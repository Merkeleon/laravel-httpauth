<?php

namespace Merkeleon\Laravel\HttpAuth\Console\Commands\Redirect;


use Merkeleon\Laravel\HttpAuth\Console\Commands\Base as Command;
use Merkeleon\Laravel\HttpAuth\Helper;

class Make extends Command
{
    protected $signature = 'http-auth:redirect:make {target?}';
    protected $description = 'Make redirect to URL';

    public function handle()
    {
        $targetUrl = $this->argument('target') ?: $this->ask('What is target URL?');

        Helper::makeRedirect($targetUrl);

        $this->info("Redirect to {$targetUrl} successfully created");
    }
}