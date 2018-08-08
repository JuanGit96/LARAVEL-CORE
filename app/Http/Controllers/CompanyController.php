<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Profession;
use App\Company;
use Illuminate\Validation\Rule;


/**
 * Logica de nuestro modulo de usuarios
 */
class companyController extends Controller
{
    public function index()
    {
        //$companies = Company::all(); sin paginación
        $companies = Company::paginate(10); // con paginación
        
        return view('companies.index',compact('companies'));
    }

    public function detail(Company $company)
    {
        return view('companies.detail')
                 ->with('title', 'Detalle de la compañia: ')
                 ->with('company', $company);
    }

    public function new()
    {
        $title = 'Nueva Comapñia';
        return view('companies.new', compact('title'));
    }

    public function store()
    {
        $data = request()->validate([
            'name' => 'required',
            'activity' => 'required', 
            'address' => 'required', 
            'seo' => 'required', 
            'image' => ''
        ],[
            'name.required' => 'El campo nombre es obligatorio',
            'activity.required' => 'El campo actividad es obligatorio',
            'address.required' => 'El campo direccion es obligatorio',
            'seo.required' => 'El campo seo es obligatorio',
        ]);

        Company::create([
            'name' => $data['name'],
            'activity' => $data['activity'],
            'address' => $data['address'],
            'seo' => $data['seo'],
            'image' => $data['image']
        ]);

        return redirect()->route('companies.index');
    }

    public function edit(Company $company)
    {
        return view('companies.edit',compact('company'));
    }

    public function update(Company $company)
    {
        $data = request()->validate([
            'name' => 'required',
            'activity' => 'required', 
            'address' => 'required', 
            'seo' => 'required', 
            'image' => ''
        ],[
            'name.required' => 'El campo nombre es obligatorio',
            'activity.required' => 'El campo actividad es obligatorio',
            'address.required' => 'El campo direccion es obligatorio',
            'seo.required' => 'El campo seo es obligatorio',
        ]);
        
        $company->update($data);//actualizando datos con ELOQUENT

        return redirect("compañias/{$company->id}");//redireccion aldetalle de compañia
    }

    public function delete(Company $company)
    {
        $company->delete();

        return redirect()->route('companies.index');
    }
}