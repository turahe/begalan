<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SetupProductionEnvironment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup:prod';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setting production environment';

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
        $this->info('Setting up production environment');

        $this->migrateDatabase();
        $this->generateKey();

        $this->info('Everything is done, congratulations! 🥳🥳🥳');
    }

    /**
     * Migrate database.
     */
    public function generateKey()
    {
        $this->call('key:generate');
    }

    /**
     * Migrate database.
     */
    public function migrateDatabase()
    {
        $this->call('migrate:fresh');
        $this->call('db:seed', ['--class' => 'UsersTableSeeder']);
        $this->info('Test user created. Email: developer@circlecreative.id Password: secret as Admin' );
        $this->info('Test user created. Email: instructor@circlecreative.id Password: secret as Instructor');
        $this->info('Test user created. Email: student@circlecreative.id Password: secret as Student');
    }
}
