<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class APIdoc extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'APIdoc';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Generating API documentation...');

        // Execute o comando aglio
        exec('aglio -i documentation.apib -o documentation.html');

        $this->info('API documentation generated successfully!');
    }
}
