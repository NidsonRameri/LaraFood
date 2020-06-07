<?php

use Illuminate\Database\Seeder;
use App\Models\{
    Tenant,
    Plan
};

class TenantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plan = Plan::first();

        $plan->tenants()->create([
            'cnpj' => '85.000/00001',
            'name' => 'EspecializaTi',
            'url' => 'especializati',
            'email' => 'especializati@hotmail.com'
        ]);
    }
}
