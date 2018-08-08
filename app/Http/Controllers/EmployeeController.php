<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Employee;
use App\Profession;
use App\Company;
use Illuminate\Validation\Rule;

/**
 * Logica de nuestro modulo de Empleados
 */
class employeeController extends Controller 
{
    /**
     * Pagina principal de nuestro modulo
     */
    public function index()
    {

        //$users = DB::table('users')->get();
        //$users = User::all(); sin paginación
        $employees = Employee::paginate(10); // con paginación
        /*foreach($users as $user){
            $us = $user->profession->title;
            $professionArray[] = $us;
            //dd($professionArray);
        }*/

        /*$title  = 'Usuarios';*/

        /*return view('users.index',[
            'users' => $users,
            'title' => 'Usuarios'
        ]);    */
        return view('employees.index',compact(/*'title',*/'employees'));    
        

    }

    public function detail(Employee $employee)
    {
        /*$user = User::find($id); //Encontrar usuario con ese id
        
        if($user == null){
            //return view('errors.404');
            return response()->view('errors.404',[],404);
        }  */      
        
        /*$user = User::findOrFail($id);//termina acción y envia a pagina de error*/

        return view('employees.detail')
                 ->with('title', 'Detalle del usuario: ')
                 ->with('employee', $employee);
                 //->with('id', $id);
    }   

    public function new()
    {
        $title = 'Nuevo Usuario';
        $professions = Profession::all();
        $companies = Company::all();
        return view('employees.new', compact('title', 'professions', 'companies'));
    }

    public function store()
    {
        /*$data = request()->all();

        if(empty($data['name'])){
            return redirect('usuarios/nuevo')->withErrors([
                'name' => 'El campo nombre es obligatorio'
            ]);
        }*/
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:employees,email',
            //aparte de ser requerido tiene regla de email valido 
            'profession_id' => '',
            'company_id' => '',
            'password' => 'required|alpha_num|between:6,14'
        ],[
            'name.required' => 'El campo nombre es obligatorio',
            'email.required' => 'El campo email es obligatorio',
            'email.unique' => 'El correo ya está registrado',
            'email.email' => 'El campo email no es valido',
            'password.required' => 'El campo password es obligatorio',
            'password.alpha_num' => 'Contraseña debe contener solo caracteres alfanumericos',
            'password.between' => 'Contraseña debe contener 6 caracteres o mas'
        ]);

        if($data['profession_id'] == "0"){
            $data['profession_id'] = null;
        }

        if($data['company_id'] == "0"){
            $data['company_id'] = null;
        }

        Employee::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'profession_id' => $data['profession_id'],
            'company_id' => $data['company_id'],
            'password' => bcrypt($data['password'])
        ]);

        //return redirect('usuarios');
        return redirect()->route('employees.index');
    }

    public function edit(Employee $employee)
    {
        $professions = Profession::all();
        $companies = Company::all();
        return view('employees.edit',compact('employee', 'professions','companies'));
        /*
          compact() convierte las variables directamente en un solo array asociativo
          Metodo para ver dicho array
          dd(compact('name','nickname')); "Similar a hacer un var_dump(arreglo);die();"
        */            
    }

    public function update(Employee $employee)
    {
        //$data = request()->all();//recibiendo datos PUT
        $data = request()->validate([
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('employees')//unique('employees','email')
                       ->ignore($employee->id)],
            //aparte de ser requerido tiene regla de email valido 
            //el correo no debe estar en la bd exeptuando el mismocorreo ya tomado por el usuario
            'profession_id' => '',
            'company_id' => '',
            'password' => ''
        ],[
            'name.required' => 'El campo nombre es obligatorio',
            'email.unique' => 'El correo ya existe',
            'email.required' => 'El campo email es obligatorio',
            'email.email' => 'El campo email no es valido',
        ]);

        if($data['profession_id'] == "0"){
            $data['profession_id'] = null;
        }

        if($data['company_id'] == "0"){
            $data['company_id'] = null;
        }

        if($data['password'] != null){ //si envian contraseña
            $data['password'] = bcrypt($data['password']);//encriptando contraseña
        }else{//si no..
            //se elimina elemento del data
            unset($data['password']);
        }  
        
        $employee->update($data);//actualizando datos con ELOQUENT

        //return redirect()->route('users.detail',['user'=>$user]);
        return redirect("empleados/{$employee->id}");//redireccion aldetalle de usuario
    }

    public function delete(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('employees.index');
    }
}