<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'tenant_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Tenant
     */
    public function tenant(){
        return $this->belongsTo(Tenant::class);
    }
    /**
     * The "booted" method of the model. ESCOPO GLOBAL
     *
     * @return void
     */
    // protected static function booted()
    // {
    //     static::addGlobalScope('tenant', function (Builder $builder) {
    //         $builder->where('tenant_id', auth()->user()->tenant_id); //trazer usuario cujo o tenant sejam o tenant do usuário autenticado
    //     });
    // }

    /**
     * Scope a query to only users by tenant. ESCOPO LOCAL
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeTenantUser(Builder $query){
        return $query->where('tenant_id', auth()->user()->tenant_id);
    }
}
