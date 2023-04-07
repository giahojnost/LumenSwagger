<?php

namespace LumenSwagger\Console;

use Illuminate\Console\Command;

class PublishCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'lumen-swagger:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish config, views, assets';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->info('Publishing all files');
        $this->call('lumen-swagger:publish-config');
        $this->call('lumen-swagger:publish-views');
    }
}
