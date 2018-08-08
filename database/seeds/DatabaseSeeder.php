<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Vaciando tabla antes de llenarla de nuevo
         */
        $this->truncateTables([
            'professions',
            'users',
            'companies',
            'employees'
        ]);

        // Llamando todos los Seeders para la ejecucion
        $this->call(ProfessionsSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(CompaniesSeeder::class);
        $this->call(EmployeesSeeder::class);
    }

    protected function truncateTables(array $tables)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); //ignorar llaves foraneas

        foreach($tables as $table){
            DB::table($table)->truncate(); //vaciar la tabla
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1;'); //reactivar validacion dellave foranea
    }
}
