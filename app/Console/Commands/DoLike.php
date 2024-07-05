<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class DoLike extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:dolike';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description: For testing the command';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Log::info('Command run success');
        return Command::SUCCESS;
    }
}
