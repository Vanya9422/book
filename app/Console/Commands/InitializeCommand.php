<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class InitializeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'initialize';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Prepare project: install migrations, seeds, install passport, etc.';
    
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->call('migrate');
        $this->call('db:seed');
        $this->call('passport:install');
    }
}
