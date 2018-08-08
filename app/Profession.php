<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    //por si el nombre de la tabla es diferente al de la clase
    //protected $table = 'my_professions';

    //por si no queremos o no estan los campos de timestamp
    //protected $timestamps = false;

    /**
     * Array con las propiedades o atributos
     * que queremos permitir, sean cargados de forma masiva
     * Laravel ignora las demas insercionses como id principal etc
     */
    protected $fillable = [
        'title', 'description'
    ];

    public function employees(){
        return $this->hasMany(Employee::class);
    }
}
