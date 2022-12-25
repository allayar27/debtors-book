<?php

namespace Database\Seeders;

use App\Models\Debtor;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(20)->create();
        Debtor::factory(25)->create();
        
    }
}
