<?php

namespace LumenSwagger\Console;

use Illuminate\Console\Command;
use LumenSwagger\Generator;

class GenerateDocsCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'lumen-swagger:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Regenerate docs';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->info('Regenerating docs');
        Generator::generateDocs();
    }
}
