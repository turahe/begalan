<?php
/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @modified    1/30/21, 3:18 PM
 * @author         Nur Wachid
 * @copyright      Copyright (c) 2021.
 */

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class SetupDevEnvironment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup:dev';

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
        $this->info('Setting up development environment');

        $this->migrateDatabase();
        $this->generateKey();
        $this->createPassportKeys();
        $this->createPassportClientPassword();
        $this->createPassportClientPersonal();
        $this->createDefaultUser();

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
    }

    /**
     * Create Passport Encryption keys.
     */
    public function createPassportKeys()
    {
        $this->call('passport:keys', [
            '--force' => true,
        ]);
    }

    /**
     * Create Password grant client.
     */
    public function createPassportClientPassword()
    {
        $this->call('passport:client', [
            '--password' => true,
            '--name'     => 'turahe',
        ]);

        $this->alert('Please copy these first password grant Client ID & Client secret above to your /.env file.');
    }

    /**
     * Create Personal access client.
     */
    public function createPassportClientPersonal()
    {
        $this->call('passport:client', [
            '--personal' => true,
            '--name'     => 'shared',
        ]);
    }

    /**
     * Create Default Products.
     */
    public function createDefaultUser()
    {
        $this->call('db:seed', ['--class' => 'PermissionsTableSeeder']);
        $this->call('db:seed', ['--class' => 'RolesTableSeeder']);
        $user = User::updateOrCreate([
            'name'     => 'Admin',
            'email'    => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => bcrypt($password = 'secret'),
            'remember_token' => Str::random(10),
            'registered_at' => now(),
        ])->assignRole('admin');

        $this->info('Test user created. Email: '.$user->email.' Password: '.$password);
    }
}
