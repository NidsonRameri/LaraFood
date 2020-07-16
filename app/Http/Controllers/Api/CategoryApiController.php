<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TenantFormRequest;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryService;

class CategoryApiController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function categoriesByTenant(TenantFormRequest $request){
        
        // uma das formas de validar  ==>TENANTFORMREQUEST
        // if(!$request->token_company){
        //     return response()->json(["message" => "Token Not Found"], 404);
        // }
        
        $categories = $this->categoryService->getCategoriesByUuid($request->token_company);
        return CategoryResource::collection($categories);
    }
}
