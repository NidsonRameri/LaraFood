<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{
    Category,
    Permission,
    Plan,
    Product,
    Profile,
    Role,
    Table,
    Tenant,
    User
};
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function home()
    {
        $tenant = auth()->user()->tenant;
        $totalUsers = User::where('tenant_id', $tenant->id)->count();
        $totalTables = Table::count(); //está linkado ao tenant, por isso sem 'where'
        $totalCategories = Category::count(); //está linkado ao tenant, por isso sem 'where'
        $totalProducts = Product::count(); //está linkado ao tenant, por isso sem 'where'
        $totalTenants = Tenant::count(); //está linkado ao tenant, por isso sem 'where'
        $totalPlans = Plan::count(); //está linkado ao tenant, por isso sem 'where'
        $totalRoles = Role::count(); //está linkado ao tenant, por isso sem 'where'
        $totalProfiles = Profile::count(); //está linkado ao tenant, por isso sem 'where'
        $totalPermissions = Permission::count(); //está linkado ao tenant, por isso sem 'where'


        return view('admin.pages.home.home', compact('totalUsers',
                                                     'totalTables', 
                                                     'totalCategories',
                                                     'totalProducts',
                                                     'totalTenants',
                                                     'totalPlans',
                                                     'totalRoles',
                                                     'totalProfiles',
                                                     'totalPermissions'
                                                    ));
    }
}
