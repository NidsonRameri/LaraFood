<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPlan extends Model
{
    protected $table = 'details_plan'; //nome do plano do BD

    protected $fillable = ['name'];

    public function plan()
    {
        $this->belongsTo(Plan::class);
    }
}


