<?php

namespace Merkeleon\Laravel\HttpAuth\Console\Commands\Redirect;


use Merkeleon\Laravel\HttpAuth\Console\Commands\Base as Command;
use Merkeleon\Laravel\HttpAuth\Helper;

class Clear extends Command
{
    protected $signature = 'http-auth:redirect:clear';
    protected $description = 'Remove redirect';

    public function handle()
    {
        Helper::makeRedirect('');
        $this->info('Redirect has been removed');
    }
}