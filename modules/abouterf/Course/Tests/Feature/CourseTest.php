<?php

namespace abouterf\Course\Tests\Feature;

use abouterf\Category\Models\Category as ModelsCategory;
use abouterf\Course\Models\Course as ModelsCourse;
use abouterf\RolePermissions\Models\Permission as ModelsPermission;
use abouterf\User\Models\User as ModelsUser;
use abouterf\Course\Database\Seeds\RolePermissionTableSeeder;
use abouterf\RolePermissions\Models\Permission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CourseTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    // permitted user can see curses index
    public function test_permitted_user_can_see_courses_index()
    {
        $this->actAsAdmin();
        $this->get(route('courses.index'))->assertOk();

        $this->actionAsSuperAdmin();
        $this->get(route('courses.index'))->assertOk();
    }

    public function test_normal_user_can_not_see_courses_index()
    {
        $this->actAsUser();
        $this->get(route('courses.index'))->assertStatus(403);
    }

    // permitted user can create course
    public function test_permitted_user_can_create_course()
    {
        $this->actAsAdmin();
        $this->get(route('courses.create'))->assertOk();

        $this->actAsUser();
        auth()->user()->givePermissionTo(ModelsPermission::PERMISSION_MANAGE_OWN_COURSES);
        $this->get(route('courses.create'))->assertOk();
    }

    public function test_normal_user_can_not_create_course()
    {
        $this->actAsUser();
        $this->get(route('courses.create'))->assertStatus(403);
    }

    // permitted user can store course
    public function test_permitted_user_can_store_course()
    {
        $this->actAsUser();
        auth()->user()->givePermissionTo([ModelsPermission::PERMISSION_MANAGE_OWN_COURSES, Permission::PERMISSION_TEACH]);
        Storage::fake('local');
        $response = $this->post(route('courses.store'), $this->courseData());
        $response->assertRedirect(route('courses.index'));
        $this->assertEquals(ModelsCourse::count(), 1);
    }

    // permitted user can edit course
    public function test_permitted_user_can_edit_course()
    {
        $this->actAsAdmin();
        $course = $this->createCourse();
        $this->get(route('courses.edit', $course->id))->assertOk();

        $this->actAsUser();
        $course = $this->createCourse();
        auth()->user()->givePermissionTo(ModelsPermission::PERMISSION_MANAGE_OWN_COURSES);
        $this->get(route('courses.edit', $course->id))->assertOk();
    }

    public function test_permitted_user_can_not_edit_other_users_courses()
    {
        $this->actAsUser();
        $course = $this->createCourse();
        $this->actAsUser();
        auth()->user()->givePermissionTo(ModelsPermission::PERMISSION_MANAGE_OWN_COURSES);
        $this->get(route('courses.edit', $course->id))->assertStatus(403);
    }

    public function test_normal_user_can_not_edit_course()
    {
        $this->actAsUser();
        $course = $this->createCourse();
        $this->get(route('courses.edit', $course->id))->assertStatus(403);
    }

    // permitted user can update course
    public function test_permitted_user_can_update_course()
    {
        $this->withoutExceptionHandling();
        $this->actAsUser();
        auth()->user()->givePermissionTo([Permission::PERMISSION_MANAGE_OWN_COURSES, Permission::PERMISSION_TEACH]);
        $course = $this->createCourse();
        $this->patch(route('courses.update', $course->id), [
            'title' => 'updated title',
            "slug" => 'updated slug',
            'teacher_id' => auth()->id(),
            'category_id' => $course->category->id,
            "priority" => 12,
            "price" => 1450,
            "percent" => 80,
            "type" => ModelsCourse::TYPE_CASH,
            "image" => UploadedFile::fake()->image('banner.jpg'),
            "status" => ModelsCourse::STATUS_COMPLETED,
        ])->assertRedirect(route('courses.index'));
        $course = $course->fresh();
        $this->assertEquals('updated title', $course->title);
    }

    public function test_normal_user_can_not_update_course()
    {
        $this->actAsAdmin();
        $course = $this->createCourse();

        $this->actAsUser();
        auth()->user()->givePermissionTo(ModelsPermission::PERMISSION_TEACH);

        $this->patch(route('courses.update', $course->id), [
            'title' => 'updated title',
            "slug" => 'updated slug',
            'teacher_id' => auth()->id(),
            "priority" => 12,
            "price" => 1450,
            "percent" => 80,
            "type" => ModelsCourse::TYPE_CASH,
            "status" => ModelsCourse::STATUS_COMPLETED,
            "confirmation_status" => ModelsCourse::CONFIRMATION_STATUS_REJECTED,

        ])->assertStatus(403);
    }

    // permitted user can delete course

    public function test_permitted_user_can_delete_course()
    {
        $this->actAsAdmin();
        $course = $this->createCourse();
        $this->delete(route('courses.destroy', $course->id))->assertOk();
        $this->assertEquals(0, ModelsCourse::count());
    }

    public function test_normal_user_can_not_delete_course()
    {
        $this->actAsAdmin();
        $course = $this->createCourse();
        $this->actAsUser();
        $this->delete(route('courses.destroy', $course->id))->assertStatus(403);
        $this->assertEquals(1, ModelsCourse::count());
    }
    // permitted user can accept course
    public function test_permitted_user_can_confirmation_status_courses()
    {
        $this->actAsAdmin();
        $course = $this->createCourse();
        $this->patch(route('courses.accept', $course->id), [])->assertOk();
        $this->patch(route('courses.reject', $course->id), [])->assertOk();
        $this->patch(route('courses.lock', $course->id), [])->assertOk();
    }

    public function test_normal_user_can_not_change_confirmation_status_courses()
    {
        $this->actAsAdmin();
        $course = $this->createCourse();

        $this->actAsUser();
        $this->patch(route('courses.accept', $course->id), [])->assertStatus(403);
        $this->patch(route('courses.reject', $course->id), [])->assertStatus(403);
        $this->patch(route('courses.lock', $course->id), [])->assertStatus(403);
    }

    private function createUser()
    {
        $this->actingAs(factory(ModelsUser::class)->create());
        $this->seed(RolePermissionTableSeeder::class);
    }

    private function actAsUser()
    {
        $this->createUser();
    }

    private function actAsAdmin()
    {
        $this->createUser();
        auth()->user()->givePermissionTo(ModelsPermission::PERMISSION_MANAGE_COURSES);
    }

    private function actionAsSuperAdmin()
    {
        $this->createUser();
        auth()->user()->givePermissionTo(ModelsPermission::PERMISSION_MANAGE_COURSES);
    }

    private function createCourse()
    {
        $data = $this->courseData() + ['confirmation_status' => ModelsCourse::CONFIRMATION_STATUS_PENDING,];
        unset($data['image']);
        return ModelsCourse::create($data);
    }

    private function createCategory()
    {
        return ModelsCategory::create(['title' => $this->faker->word, "slug" => $this->faker->word]);
    }

    private function courseData()
    {
        return [
            'title' => $this->faker->sentence(2),
            "slug" => $this->faker->sentence(2),
            'teacher_id' => auth()->id(),
            "priority" => 12,
            "price" => 1200,
            "percent" => 70,
            "type" => ModelsCourse::TYPE_FREE,
            "status" => ModelsCourse::STATUS_COMPLETED,
            "confirmation_status" => ModelsCourse::CONFIRMATION_STATUS_ACCEPTED,
        ];
    }
}
