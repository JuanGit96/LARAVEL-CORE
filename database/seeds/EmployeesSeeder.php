<?php

use Illuminate\Database\Seeder;
use App\Profession;
use App\Employee;

class EmployeesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * CONSULTAS UTILIZANDO EL FRAMEWORK
         */

        //$professions = DB::select('SELECT id FROM professions WHERE title = ?',['
        //Desarrollador Back-end']);
        
        /*primer dato de la consulta(ultimo registro)
        $profession = DB::table('professions')->select('id')->first(); */
        $profession = Profession::select('id')->first();

        /* Mostrando todos los campos del registro
        
        $professionSeconthff = DB::table('professions')->where(
            'title','=','Desarrollador Front-end')->first();

        $professionSeconthff = DB::table('professions')->where([
            'title'=>'Desarrollador Front-end'
            ])->first(); 
            dd($professionSeconthff);            
        */  

        /*Consulta alternativa sin ORM
        $professionSeconth = DB::table('professions')->select('id')->where(
                                            'title','=','Desarrollador Front-end')->first();

        $professionTirthId = DB::table('professions')
                                    //->where(['title' => 'DBA'])
                                    ->whereTitle(['title' => 'DBA'])
                                    ->value('id');     */

        $professionSeconth = Profession::select('id')->where(
            'title','=','Desarrollador Front-end')->first();

            
        $professionTirthId = Profession::
                            //where(['title' => 'DBA'])
                            whereTitle(['title' => 'DBA'])
                            ->value('id');                         
                                    
                                    
                                    

        /*DB::table('users')->insert([
            //columnas o valores a guardar en la tabla
            'profession_id' => $profession->id,
            'name' => 'Juan',
            'email' => 'cardenas@gmail.com',
            'password' => bcrypt('laravel'),
        ]);*/

        //UTILIZANDO ELOQUENT (Insercion)

        Employee::create([
            //columnas o valores a guardar en la tabla
            'profession_id' => $profession->id,
            'name' => 'Juan',
            'email' => 'cardenas@gmail.com',
            'password' => bcrypt('laravel'),
        ]);

        Employee::Create([
            //columnas o valores a guardar en la tabla
            'profession_id' => $professionSeconth->id,
            'name' => 'Maria',
            'email' => 'maria@gmail.com',
            'password' => bcrypt('cool'),
        ]);   
        
        Employee::create([
            //columnas o valores a guardar en la tabla
            'profession_id' => $professionTirthId,
            'name' => 'Anita',
            'email' => 'kim@gmail.com',
            'password' => bcrypt('genialpass'),
        ]);         
        
        //creando registros con datos aleatorios

        factory(Employee::class)->create([
            //Datos a sobreescribir
            'profession_id' => $professionTirthId 
        ]);

        factory(Employee::class, 5)->create();
        
    }
}
