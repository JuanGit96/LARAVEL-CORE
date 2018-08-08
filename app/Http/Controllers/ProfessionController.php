<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Employee;
use App\Profession;
use Illuminate\Validation\Rule;


/**
 * Logica de nuestro modulo de usuarios
 */
class professionController extends Controller
{
    public function index()
    {
       // $professions = Profession::all();sin paginación
        $professions = Profession::paginate(10); // con paginación
        
        return view('professions.index',compact('professions'));
    }

    public function detail(Profession $profession)
    {
        return view('professions.detail')
                 ->with('title', 'Detalle del usuario: ')
                 ->with('profession', $profession);
    }

    public function new()
    {
        $title = 'Nueva Profesion';
        return view('professions.new', compact('title'));
    }

    public function store()
    {
        $data = request()->validate([
            'title' => 'required',
            'description' => ''
        ],[
            'title.required' => 'El campo titulo es obligatorio',
        ]);

        Profession::create([
            'title' => $data['title'],
            'description' => $data['description'],
        ]);

        return redirect()->route('professions.index');
    }

    public function edit(Profession $profession)
    {
        return view('professions.edit',compact('profession'));
    }

    public function update(Profession $profession)
    {
        $data = request()->validate([
            'title' => 'required',
            'description' => ''
        ],[
            'title.required' => 'El campo titulo es obligatorio',
        ]);  
        
        $profession->update($data);//actualizando datos con ELOQUENT

        return redirect("profesiones/{$profession->id}");//redireccion aldetalle de usuario
    }

    public function delete(Profession $profession)
    {
        $profession->delete();

        return redirect()->route('professions.index');
    }
}