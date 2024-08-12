<?php

namespace Aldoggutierrez\EloquentStates\Commands;

use Illuminate\Console\Command;

class EloquentStatesCommand extends Command
{
    public $signature = 'eloquent-states';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
