<?php

namespace BachVendor\BachPackage\Console\Commands;

use Illuminate\Console\Command;

class BachCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bach:command';

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
        $this->info("bach test create command package");
    }
}
