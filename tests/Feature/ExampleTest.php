<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest() //importante prefijo test
    {
        $response = $this->get('/'); //simula peticion http
        
        $response->assertStatus(200); // si existe la ruta 
    }
}
