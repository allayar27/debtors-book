<?php

namespace Database\Seeders;

use App\Models\Debtor;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**

     * @return void
     */
    public function run()
    {
        User::factory(2)->create();
        Debtor::factory(2)->create();

    }
}
