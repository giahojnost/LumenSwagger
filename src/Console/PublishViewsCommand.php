<?php

namespace LumenSwagger\Console;

use Illuminate\Console\Command;
use LumenSwagger\Console\Helpers\Publisher;

class PublishViewsCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'lumen-swagger:publish-views';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish views';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->info('Publishing view files');

        (new Publisher($this))->publishFile(
            realpath(__DIR__.'/../../resources/views/').'/index.blade.php',
            config('lumen-swagger.paths.views'),
            'index.blade.php'
        );
    }
}
