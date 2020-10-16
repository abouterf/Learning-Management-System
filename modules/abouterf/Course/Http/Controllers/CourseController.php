<?php

namespace abouterf\Course\Http\Controllers;

use abouterf\Course\Http\Requests\CourseRequest;
use abouterf\Category\Repositories\CategoryRepo;
use abouterf\User\Repositories\UserRepo;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    public function index()
    {
        return 'courses';
    }

    public function create(UserRepo $userRepo, CategoryRepo $categoryRepo)
    {
        $teachers = $userRepo->getTeachers();
        $categories = $categoryRepo->all();
        return view('Courses::create', compact('teachers', 'categories'));
    }

    public function store(CourseRequest $request)
    {
    }
}
