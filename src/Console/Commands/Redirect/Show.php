<?php

namespace Merkeleon\Laravel\HttpAuth\Console\Commands\Redirect;


use Merkeleon\Laravel\HttpAuth\Console\Commands\Base as Command;
use Merkeleon\Laravel\HttpAuth\Helper;

class Show extends Command
{
    protected $signature = 'http-auth:redirect:show';
    protected $description = 'Show current redirect URL';

    public function handle()
    {
        $redirectUrl = Helper::getRedirect();
        if (!$redirectUrl)
        {
            $this->warn('Redirect URL is empty');
            return;
        }

        $this->info('Redirect URL: ' . $redirectUrl);
    }
}