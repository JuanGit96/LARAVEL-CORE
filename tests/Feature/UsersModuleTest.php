<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Profession;
use App\Company;

class UsersModuleTest extends TestCase
{
    /**
     * Ejecuta automaticamente las migraciones de la base dedatos de prueba
     * Ejecuta las pruebas en una "transaccion de la bd" lo que significa que puede
     * revertir la operacion al terminarcada prueba
     */
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */

    public function testExample()
    {
        factory(User::class)->create([
            'name' => 'Juan' 
        ]);

        //Simulando peticion get
        $this->get('/usuarios')
             ->assertStatus(200) // si existe la ruta
             ->assertSee('Usuarios') // se puede ver el texto usuarios
             ->assertSee('Juan');
    }

    public function testExampleEmpty()
    {
        //Simulando peticion get
        $this->get('/usuarios')
             ->assertStatus(200) // si existe la ruta
             ->assertSee('Noy Hay registros Aún'); // se puede ver el texto usuarios
    }

    public function test_it_displays_the_user_details()
    {

        $user = factory(User::class)->create([
            'name' => 'Mariana Pombo'
        ]);

        //simulando peticion get
        $this->get('/usuarios/'.$user->id)
             ->assertStatus(200) // se espera 200 de normalidad en la ruta
             ->assertSee('Mariana');
    }

    public function test_if_user_dont_exist()
    {
        $this->get('/usuarios/detalles/999')
           ->assertStatus(404)
           ->assertSee('Página no encontrada');
    }

    public function test_create_new_user()
    {
        //$this->withoutExceptionHandling();

        $this->post('/usuarios', [
            'name' => 'Juanda',
            'email' => 'juanda@example.com',
            'profession_id' => '',
            'company_id' => '',
            'password' => '123456'
        ])->assertRedirect(route('users.index'));

        $this->assertDatabaseHas('users',[
            'name' => 'Juanda',
            'email' => 'juanda@example.com',
            //'password' => '123456'            
        ]);

        $this->assertCredentials([
            //Para probar que las credenciales(Contraseña) guardadas son las correctas
            'name' => 'Juanda',
            'email' => 'juanda@example.com',
            'password' => '123456'
        ]);          
    }

    public function test_the_name_is_required()
    {

        $this->from('/usuarios/nuevo')
        ->post('/usuarios/', [
            'name' => '',
            'email' => 'juanda@example.com',
            'profession_id' => '',
            'company_id' => '',
            'password' => '123456'
        ])
        ->assertRedirect('usuarios/nuevo')
        ->assertSessionHasErrors(['name' => 'El campo nombre es obligatorio']);
            

        /*$this->assertDatabaseMissing('users',[
            'name' => 'Juanda',
            'email' => 'juanda@example.com',         
          ]);*/
        $this->assertEquals(0, User::count());
        //Esperamos que la base de datos siga vacia
    }

    public function test_the_email_is_required()
    {

        $this->from('/usuarios/nuevo')
        ->post('/usuarios/', [
            'name' => 'nombrecualquiera',
            'email' => '',
            'profession_id' => 'null',
            'company_id' => 'null',
            'password' => '123456'
        ])
        ->assertRedirect('usuarios/nuevo')
        ->assertSessionHasErrors(['email' => 'El campo email es obligatorio']);
            
        $this->assertEquals(0, User::count());
    }

    public function test_the_pass_is_required()
    {

        $this->from('/usuarios/nuevo')
        ->post('/usuarios/', [
            'name' => 'nombrecualquiera',
            'email' => 'correo@correo.com',
            'profession_id' => 'null',
            'company_id' => 'null',
            'password' => ''
        ])
        ->assertRedirect('usuarios/nuevo')
        ->assertSessionHasErrors(['password' => 'El campo password es obligatorio']);
            
        $this->assertEquals(0, User::count());
    } 
    
    public function test_the_email_must_be_valid()
    {

        $this->from('/usuarios/nuevo')
        ->post('/usuarios/', [
            'name' => 'nombrecualquiera',
            'email' => 'correo-no-valido',
            'profession_id' => 'null',
            'company_id' => 'null',
            'password' => '123456'
        ])
        ->assertRedirect('usuarios/nuevo')
        ->assertSessionHasErrors(['email' => 'El campo email no es valido']);
            
        $this->assertEquals(0, User::count());
    }    

    public function test_the_email_must_be_unique()
    {
        factory(User::class)->create([
            'name' => 'nombrePrueba',
            'email' => 'prueba@correo.com',
            'password' => '123456'    
        ]);

        $this->from('/usuarios/nuevo')
        ->post('/usuarios/', [
            'name' => 'nombrecualquiera',
            'email' => 'prueba@correo.com',
            'profession_id' => 'null',
            'company_id' => 'null',
            'password' => 'asffdf548'
        ])
        ->assertRedirect('usuarios/nuevo')
        ->assertSessionHasErrors(['email' => 'El correo ya está registrado']);
            
        $this->assertEquals(1, User::count());
    } 

    public function test_the_pass_contain_moresix_character()
    {
        $this->from('/usuarios/nuevo')
        ->post('/usuarios/', [
            'name' => 'nombrecualquiera',
            'email' => 'prueba@correo.com',
            'profession_id' => 'null',
            'company_id' => 'null',
            'password' => 'gf5'
        ])
        ->assertRedirect('usuarios/nuevo')
        ->assertSessionHasErrors(['password' => 'Contraseña debe contener 6 caracteres o mas']);
            
        $this->assertEquals(0, User::count());
    }   
    
    public function test_the_pass_contain_only_alphanumeric()
    {
        $this->from('/usuarios/nuevo')
        ->post('/usuarios/', [
            'name' => 'nombrecualquiera',
            'email' => 'prueba@correo.com',
            'profession_id' => 'null',
            'company_id' => 'null',
            'password' => 'kjkj*'
        ])
        ->assertRedirect('usuarios/nuevo')
        ->assertSessionHasErrors(['password' => 
        'Contraseña debe contener solo caracteres alfanumericos']);
            
        $this->assertEquals(0, User::count());
    }    

    public function test_load_edituser_page()
    {
        $user = factory(User::class)->create();

        $this->get("/usuarios/{$user->id}/editar") //usuarios/5/editar
        ->assertStatus(200)
        ->assertViewIs('users.edit')//compruebo que llama la vista
        ->assertSee("Editar usuario #{$user->id}")
        //->assertViewHas('user', function ($viewUser) use ($user) {
            //return $viewUser->id === $user->id;
        //})
        ->assertViewHas('user'); //compruebo que la vista tiene una variable llamada 'user'

    }

    public function test_edit_user()
    {
        //$this->withoutExceptionHandling();

        $user = factory(User::class)->create(); 

        $this->put("/usuarios/{$user->id}", [
            'name' => 'Juanda',
            'email' => 'juanda@example.com',
            'profession_id' => null,
            'company_id' => null,
            'password' => '123456'
        ])->assertRedirect("usuarios/{$user->id}");
        //redirecciona al detalle del usuario ya actualizado

        $this->assertDatabaseHas('users',[
            'name' => 'Juanda',
            'email' => 'juanda@example.com',
            //'password' => '123456'            
        ]);

        $this->assertCredentials([
            //Para probar que las credenciales(Contraseña) guardadas son las correctas
            'name' => 'Juanda',
            'email' => 'juanda@example.com',
            'password' => '123456'
        ]);          
    }   
    
    public function test_edit_user_name_required()
    {
        $user = factory(User::class)->create(); 

        $this->from("usuarios/{$user->id}/editar")->put("/usuarios/{$user->id}", [
            'name' => '',
            'email' => 'juanda@example.com',
            'profession_id' => null,
            'company_id' => null,
            'password' => '123456'
        ])
        //redirecciona al detalle del usuario ya actualizado
        ->assertRedirect("usuarios/{$user->id}/editar")
        ->assertSessionHasErrors(['name' => 'El campo nombre es obligatorio']);
            
        //esperamos que en la bd no se actualice el registro
        $this->assertDatabaseMissing('users',[
            'email' => 'juanda@example.com',         
          ]);
    }

    public function test_edit_user_pass_is_optional()
    {

        $CLAVE_ANTERIOR = 'clave_anterior';

        $user = factory(User::class)->create([
            'password' => bcrypt($CLAVE_ANTERIOR)
        ]);

        $this->put("/usuarios/{$user->id}", [
            'name' => 'Juandas',
            'email' => 'juanda@example.com',
            'profession_id' => null,
            'company_id' => null,
            'password' => ''
        ])->assertRedirect("usuarios/{$user->id}");
        //redirecciona al detalle del usuario ya actualizado

        $this->assertCredentials([
            //Para probar que las credenciales(Contraseña) guardadas son las correctas
            'name' => 'Juandas',
            'email' => 'juanda@example.com',
            'password' => $CLAVE_ANTERIOR
        ]);  

        $this->assertDatabaseHas('users',[
            'email' => 'juanda@example.com',          
        ]);
    }

    /**
     * Si no se modifica la contraseña vaidar que aunque no esté la regla de correo unico
     * no se pueda seleccionar el correo de otro usuario generando asi conflictos en la bd
     */

    public function test_edit_user_with_equal_email()
    {
        //$this->withoutExceptionHandling();

        $user = factory(User::class)->create([
            'email' => 'correo@example.com'
        ]);  

        $this->put("/usuarios/{$user->id}", [
            'name' => 'Juanda',
            'email' => 'correo@example.com',
            'profession_id' => null,
            'company_id' => null,
            'password' => '123456'
        ])->assertRedirect("usuarios/{$user->id}");
        //redirecciona al detalle del usuario ya actualizado

        $this->assertDatabaseHas('users',[
            'name' => 'Juanda',
            'email' => 'correo@example.com',
            //'password' => '123456'            
        ]);

        $this->assertCredentials([
            //Para probar que las credenciales(Contraseña) guardadas son las correctas
            'name' => 'Juanda',
            'email' => 'correo@example.com',
            'password' => '123456'
        ]);          
    } 

    public function test_if_email_isnt_update_validate_oters_email()
    {
        /*Marcando laprueba como incompleta
        self::markTestIncomplete();
        return;*/
        
        $user = factory(User::class)->create([
            'email' => 'paul@correo.com'
        ]);

        factory(User::class)->create([
            'email' => 'otro@correo.com'
        ]);

        $this->from("usuarios/{$user->id}/editar")
             ->put("/usuarios/{$user->id}", [
            'name' => 'Paul',
            'email' => 'otro@correo.com',//el correo ya exste
            'password' => ''
        ])->assertRedirect("usuarios/{$user->id}/editar")
          ->assertSessionHasErrors(['email' => 'El correo ya existe']);
        //Redirecciona a el mismo formulario de edicion con errores

        $this->assertDatabaseHas('users',[
            'email' => 'paul@correo.com',          
        ]);
    }

    /**
     * Pruebas para eliminar regustros
     */

     public function test_user_is_deleted()
     {
        $user = factory(User::class)->create();

        $this->delete("usuarios/eliminar/{$user->id}")
             ->assertRedirect('usuarios');

        $this->assertEquals(0, User::count());     
     } 

}