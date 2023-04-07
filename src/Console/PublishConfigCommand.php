<?php

namespace LumenSwagger\Console;

use Illuminate\Console\Command;
use LumenSwagger\Console\Helpers\Publisher;

class PublishConfigCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'lumen-swagger:publish-config';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish config';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->info('Publish config files');

        (new Publisher($this))->publishFile(
            realpath(__DIR__.'/../../config/').'/lumen-swagger.php',
            base_path('config'),
            'lumen-swagger.php'
        );
    }
}
