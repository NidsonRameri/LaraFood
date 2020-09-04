<?php

namespace Tests\Feature\Api;

use App\Models\Category;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * Error get categories by Tenant.
     *
     * @return void
     */
    public function testGetAllCategoriesTenantError()
    {
        $response = $this->getJson('/api/v1/categories');

        $response->assertStatus(422);
    }

    /**
     * Error get categories by Tenant.
     *
     * @return void
     */
    public function testGetAllCategoriesByTenant()
    {
        $tenant = factory(Tenant::class)->create();

        $response = $this->getJson("/api/v1/categories?token_company={$tenant->uuid}");

        $response->assertStatus(200);
    }

    /**
     * Error Get Category by tenant.
     *
     * @return void
     */
    public function testErrorGetAllCategoriesByTenant()
    {
        $category = "fake_value";
        $tenant = factory(Tenant::class)->create();

        $response = $this->getJson("/api/v1/categories/{$category}?token_company={$tenant->uuid}");

        $response->assertStatus(404);
    }
    
    /**
     * Error Get Category by tenant.
     *
     * @return void
     */
    public function testGetCategoryByTenant()
    {
        $category = factory(Category::class)->create();
        $tenant = factory(Tenant::class)->create();

        $response = $this->getJson("/api/v1/categories/{$category->uuid}?token_company={$tenant->uuid}");

        $response->assertStatus(200);
    }
}
