<?php

namespace Merkeleon\Laravel\HttpAuth\Console\Commands;


use Illuminate\Console\Command;
use Merkeleon\Laravel\HttpAuth\Helper;

abstract class Base extends Command
{
    public function fire()
    {
        return $this->handle();
    }

    abstract public function handle();
}