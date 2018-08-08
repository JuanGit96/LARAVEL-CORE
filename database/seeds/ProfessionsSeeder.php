<?php

use Illuminate\Database\Seeder;
//use Illuminate\Support\Facades\DB;
use App\Profession; //para el uso de ELOQUENT

class ProfessionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       /* DB::insert('INSERT INTO professions (title) VALUES(:title)',[
            'title' => 'Desarrollador Back-end'
        ]);*/

        /*DB::table('professions')->insert([
            //columnas o valores a guardar en la tabla
            'title' => 'Desarrollador Back-end'
        ]);*/

        Profession::create([
            'title' => 'Desarrollador Back-end',
            'description' => 'es responsable por la programación del sitio en todos sus componentes 
            dinámicas. La programación de los diferentes componentes del sitio (páginas, 
            formularios, funcionalidades, bases de datos) y la estructuración de documentos, 
            que deberá enmarcarse a diferentes estándares. '
        ]);

        Profession::create([
            'title' => 'Desarrollador Front-end',
            'description' =>'permitirá darle vida al diseño visual estático, incorporando 
            las definiciones de etapas previas a un código fluido y semántico. Además, al 
            construir un HTML semántico el contenido obtendrá visibilidad para los usuarios y 
            optimización en buscadores.'
        ]);

        Profession::create([
            'title' => 'Diseñador web',
            'description' => ''
        ]);

        Profession::create([
            'title' => 'DBA',
            'description' => ''
        ]);

        /*factory(Profession::class, 5)->create();*/

    }
}
