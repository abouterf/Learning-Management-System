<?php

namespace abouterf\Category\Tests\Feature;

use abouterf\Category\Models\Category;
use abouterf\Course\Database\Seeds\RolePermissionTableSeeder;
use abouterf\RolePermissions\Models\Permission;
use abouterf\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function test_permitted_user_can_see_categories_panel()
    {
        $this->actionAsAdmin();
        $this->get(route('categories.index'))->assertOk();
    }
    public function test_normal_user_can_not_see_categories_panel()
    {
        $this->actionAsUser();
        $this->get(route('categories.index'))->assertStatus(403);
    }

    public function test_permitted_user_can_create_category()
    {
        $this->withoutExceptionHandling();
        $this->actionAsAdmin();
        $this->createCategory();

        $this->assertEquals(1, Category::all()->count());
    }

    public function test_permitted_user_can_update_category()
    {
        $newTitle =  'aasdf123';
        $this->actionAsAdmin();
        $this->createCategory();
        $this->assertEquals(1, Category::all()->count());
        $this->patch(route('categories.update', 1), ['title' => $newTitle, "slug" => $this->faker->word]);
        $this->assertEquals(1, Category::whereTitle($newTitle)->count());
    }

    public function test_user_can_delete_category()
    {
        $this->actionAsAdmin();
        $this->createCategory();
        $this->assertEquals(1, Category::all()->count());

        $this->delete(route('categories.destroy', 1))->assertOk();
    }

    private function actionAsAdmin()
    {
        $this->actingAs(factory(User::class)->create());
        $this->seed(RolePermissionTableSeeder::class);
        auth()->user()->givePermissionTo(Permission::PERMISSION_MANAGE_CATEGORIES);
    }
    private function actionAsUser()
    {
        $this->actingAs(factory(User::class)->create());
        $this->seed(RolePermissionTableSeeder::class);
    }

    private function createCategory()
    {
        return $this->post(route('categories.store'), ['title' => $this->faker->word, "slug" => $this->faker->word]);
    }
}
