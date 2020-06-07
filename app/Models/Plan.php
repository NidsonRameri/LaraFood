<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'name',
        'url',
        'price',
        'description'
    ];

    public function tenants(){
        return $this->hasMany(Tenant::class);
    }

    public function search($filter = null)
    {
        $results = $this
                    ->where("name", "LIKE", "%{$filter}%")
                    ->orWhere("description", "LIKE", "%{$filter}%")
                    ->paginate(5);
        return $results;            
    }

    public function details()
    {
        return $this->hasMany(DetailPlan::class);

    }

    public function profiles()
    {
        return $this->belongsToMany(Profile::class);
    }

    /**
     * Profiles not linked with this plan
     */
    public function profilesAvailable($filter = null)
    {
        $profiles = Profile::whereNotIn('profiles.id', function($query){ //subquery
            $query->select('plan_profile.profile_id');
            $query->from('plan_profile');
            $query->whereRaw("plan_profile.plan_id={$this->id}");
        }) //SELECT * FROM 'profiles' WHERE id NOT IN (SELECT permission_id FROM 'permission_profile' WHERE profile_id=2)
        ->where(function ($queryFilter) use ($filter){
            if($filter)
            $queryFilter->where('profiles.name', 'LIKE', "%{$filter}%");
        })        
        ->paginate();

        return $profiles;
    }
        
}
