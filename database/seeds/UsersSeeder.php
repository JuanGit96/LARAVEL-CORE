<?php

use Illuminate\Database\Seeder;
use App\User; //para el uso de ELOQUENT

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create();
    }
}
