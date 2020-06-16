<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')
            ->namespace('Admin') //prefix do controller
            ->middleware('auth')
            ->group(function()   //prefix da rota
{
    /**
     * Product x Profiles
     * 
     * 
     */
    Route::get('products/{id}/category/{idCategory}/detach', 'CategoryProductController@detachCategoriesProduct')->name('products.categories.detach');
    Route::post('products/{id}/categories', 'CategoryProductController@attachCategoriesProduct')->name('products.categories.attach');
    Route::any('products/{id}/categories/create', 'CategoryProductController@categoriesAvailable')->name('products.categories.available');
    Route::get('products/{id}/categories', 'CategoryProductController@categories')->name('products.categories');
    Route::get('categories/{id}/products', 'CategoryProductController@products')->name('categories.products');
    

    /**
     * Plans x Profiles
     * 
     * 
     */
    Route::get('plans/{id}/profile/{idProfile}/detach', 'ACL\PlanProfileController@detachProfilesPlan')->name('plans.profiles.detach');
    Route::post('plans/{id}/profiles', 'ACL\PlanProfileController@attachProfilesPlan')->name('plans.profiles.attach');
    Route::any('plans/{id}/profiles/create', 'ACL\PlanProfileController@profilesAvailable')->name('plans.profiles.available');
    Route::get('plans/{id}/profiles', 'ACL\PlanProfileController@profiles')->name('plans.profiles');
    Route::get('profiles/{id}/plan', 'ACL\PlanProfileController@plans')->name('profiles.plans');
    
     /**
     * Permission x Profiles
     * 
     * 
     */
    Route::get('profiles/{id}/permissions/{idPermission}/detach', 'ACL\PermissionProfileController@detachPermissionsProfile')->name('profiles.permissions.detach');
    Route::post('profiles/{id}/permissions', 'ACL\PermissionProfileController@attachPermissionsProfile')->name('profiles.permissions.attach');
    Route::any('profiles/{id}/permissions/create', 'ACL\PermissionProfileController@permissionsAvailable')->name('profiles.permissions.available');
    Route::get('profiles/{id}/permissions', 'ACL\PermissionProfileController@permissions')->name('profiles.permissions');
    Route::get('permissions/{id}/profile', 'ACL\PermissionProfileController@profiles')->name('permissions.profiles');
    

    /**
     * Routes Details Plans
     */
    Route::get('plans/{url}/details/create', 'DetailPlanController@create')->name('details.plan.create');
    Route::put('plans/{url}/details/{idDetail}', 'DetailPlanController@update')->name('details.plan.update');
    Route::get('plans/{url}/details/{idDetail}/edit', 'DetailPlanController@edit')->name('details.plan.edit');
    Route::get('plans/{url}/details', 'DetailPlanController@index')->name('details.plan.index');
    Route::post('plans/{url}/details/', 'DetailPlanController@store')->name('details.plan.store');
    Route::get('plans/{url}/details/{idDetail}', 'DetailPlanController@show')->name('details.plan.show');
    Route::delete('plans/{url}/details/{idDetail}', 'DetailPlanController@destroy')->name('details.plan.destroy');
    
    
    /**
     * Routes Permissions
     */
    Route::any('permissions/search', 'ACL\PermissionController@search')->name('permissions.search');
    Route::resource('permissions', 'ACL\PermissionController');


    /**
     * Routes Profiles
     */
    Route::any('profiles/search', 'ACL\ProfileController@search')->name('profiles.search');
    Route::resource('profiles', 'ACL\ProfileController');

    /**
     * Routes Users
     */
    Route::any('users/search', 'UserController@search')->name('users.search');
    Route::resource('users', 'UserController');



     /**
     * Routes Categories
     */
    Route::any('categories/search', 'CategoryController@search')->name('categories.search');
    Route::resource('categories', 'CategoryController');

    /**
     * Routes Products
     */
    Route::any('products/search', 'ProductController@search')->name('products.search');
    Route::resource('products', 'ProductController');


    /**
     *  Routes Plans
     */
    Route::get('plans/create', 'PlanController@create')->name('plans.create');
    Route::put('plans/{url}', 'PlanController@update')->name('plans.update');
    Route::get('plans/{url}/edit', 'PlanController@edit')->name('plans.edit');
    Route::get('plans', 'PlanController@index')->name('plans.index');
    Route::post('plans', 'PlanController@store')->name('plans.store');
    Route::get('plans/{url}', 'PlanController@show')->name('plans.show');
    Route::delete('plans/{url}', 'PlanController@destroy')->name('plans.destroy');
    Route::any('plans/search', 'PlanController@search')->name('plans.search');
    
    /**
     * Home Dashboard
     */
    Route::get('/', 'PlanController@index')->name('admin.index');
});

/**
 * site
 */

Route::get('/plan/{url}', 'Site\SiteController@plan')->name('plan.subscription');
Route::get('/', 'Site\SiteController@index')->name('site.home');

/**
 * Auth Routes
 * Comandos para Authentication PADRÃO do Laravel{
 *   composer require laravel/ui
 *
 *   php artisan ui vue --auth}
 * 
 * Mas aqui, usada a autenticação do adminLTE
 * 
 * Ambas, conferir doc
 */
Auth::routes();

