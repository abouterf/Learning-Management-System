<?php

namespace abouterf\Course\Providers;

use Illuminate\Support\ServiceProvider;

class CourseServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/courses_routes.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'Courses');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    public function boot()
    {
        config()->set('sidebar.items.courses', [
            'icon' => 'i-courses',
            'title' => 'دوره ها',
            'url' => route('courses.index')
        ]);
    }
}
