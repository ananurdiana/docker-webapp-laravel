<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:test-worker')]
#[Description('Command description')]
class TestWorker extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        while(true) {
            $this->info('Before: ' . time());
    
            sleep(1); // delay 1 detik
            $this->info("1 detik dalam detik");
            usleep(1000000); // 1 detik (dalam microseconds)
            $this->info("1 detik dalam microseconds");
    
            $this->info('After: ' . time());
        }
    }
}
