<?php


namespace abouterf\Category\Tests\Feature;

use abouterf\Category\Models\Category;
use abouterf\Course\Database\Seeds\RolePermissionTableSeeder;
use abouterf\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase

{
    use WithFaker;
    use RefreshDatabase;

    public function test_manage_categories_permission_holders_can_see_categories_panel()
    {
        $this->actingAsAdmin();
        $this->seed(RolePermissionTableSeeder::class);
        auth()->user()->givePermissionTo('manage cats');
        $this->get(route('categories.index'))->assertOk();
    }

    public function test_manage_categories_permission_holders_can_add_categories()
    {
        $this->actingAsAdmin();
        $this->seed(RolePermissionTableSeeder::class);
        auth()->user()->givePermissionTo('manage cats');
        $this->createCategory();
        $this->assertEquals(1, Category::all()->count());
    }

    public function test_authenticated_user_can_update_categories()
    {
        $newTitle = 'ascgrg2323';
        $this->actingAsAdmin();
        $this->seed(RolePermissionTableSeeder::class);
        auth()->user()->givePermissionTo('manage cats');
        $this->createCategory();
        $this->assertEquals(1, Category::all()->count());
        $this->patch(route('categories.update', 1), [
            'title' => $newTitle,
            'slug' => $this->faker->word
        ]);
        $this->assertEquals(1, Category::whereTitle($newTitle)->count());
    }

    public function test_authenticated_user_can_delete_category()
    {
        $this->actingAsAdmin();
        $this->seed(RolePermissionTableSeeder::class);
        auth()->user()->givePermissionTo('manage cats');
        $this->createCategory();
        $this->assertEquals(1, Category::all()->count());
        $this->delete(route('categories.destroy', 1))->assertOk();
    }

    private function actingAsAdmin()
    {
        $this->actingAs(factory(User::class)->create());
    }

    private function createCategory()
    {
        $this->post(route('categories.store'), [
            'title' => $this->faker->word,
            'slug' => $this->faker->word
        ]);
    }
}
