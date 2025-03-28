<?php

namespace App\Console\Commands;

use Database\Seeders\TestDataSeeder;
use Illuminate\Console\Command;

class GenerateTestData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-test-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate test data for Civilizations and Leaders';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Generating test data for the application...');
        
        $this->call('db:seed', [
            '--class' => TestDataSeeder::class,
        ]);
        
        $this->info('Test data has been generated successfully!');
        
        return Command::SUCCESS;
    }
} 