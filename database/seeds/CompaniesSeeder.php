<?php

use Illuminate\Database\Seeder;
use App\Company;

class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::create([
            'name' => 'Google',
            'activity' => 'Buscadr web',
            'address' => 'Cll100 Bogotá colombia',
            'image' => 'https://static.iris.net.co/semana/upload/images/2013/9/26/358960_15458_1.jpg',
            'seo' => 'Juan'
        ]);

        Company::create([
            'name' => 'Logisticapp',
            'activity' => 'Logistica',
            'address' => 'Cll100 Bogotá colombia',
            'image' => 'https://i1.wp.com/www.blogdenuevayork.es/wp-content/uploads/2016/11/asi%CC%81s-son-las-oficinas-de-facebook-de-Nueva-York-1.jpg?resize=660%2C330&ssl=1',
            'seo' => 'Diego'
        ]);

        Company::create([
            'name' => 'Facebook',
            'activity' => 'Red Social',
            'address' => 'Cll100 Bogotá colombia',
            'image' => 'http://www.soolet.net/wp-content/uploads/2013/10/facebook1_1.jpg',
            'seo' => 'Mark'
        ]);
    }
}
