<?php

namespace App;

//use Illuminate\Notifications\Notifiable;
//use Illuminate\Foundation\Auth\Employee as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'profession_id', 'company_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    protected $casts = [ //para cambiar tipo de dato con tinker (Al ver los datos en consola)
        'is_admin' => 'boolean' //muestra dato booleano al interactuar en consulta
    ];


    //Metodos para interactuar con ELOCUENT

    public function isAdmin()
    {
        return $this->is_admin; //muestra el valor en el modelo
    }

    protected static function findByEmail($email)
    {
          return static::where(compact('email'))->first();
          //return User::where(compact('email'))->first();
    }

    public function profession()
    { //profession_id(Convencion de laravel para la foreignKey)
        return $this->belongsTo(Profession::class);
        //Recibe el nombre de la clase que quiero vincular gracias a las ForeignKey
        //indico que un usuario pertenece a una profesion
        
        /*
        Por si las convenciones de llave no son las establecidas por Eloquent
        return $this->belongsTo(Profession::class, 'id_profession');*/
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
