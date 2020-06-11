<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Tenant\Traits\TenantTrait;

class Product extends Model
{
    use TenantTrait; //Produtos separados por tenant, então todos os models precisam

    protected $fillable = [
        'title',
        'description',
        'flag',
        'price',
        'image'
    ];

    public function categories(){
        $this->belongsToMany(Category::class);
    }
}
