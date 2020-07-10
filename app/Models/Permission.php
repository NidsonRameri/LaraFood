<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];

    /**
     * Get Profile
     */
    public function profiles(){
        return $this->belongsToMany(Profile::class);    //Se tabela tivesse nome diferente ao tradicional criado pelo larave, passar aqui como segundo parametro
    }

    /**
     * Get Roles
     */
    public function roles(){
        return $this->belongsToMany(Role::class);    //Se tabela tivesse nome diferente ao tradicional criado pelo larave, passar aqui como segundo parametro
    }
}
