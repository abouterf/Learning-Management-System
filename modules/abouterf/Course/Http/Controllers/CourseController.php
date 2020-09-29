<?php

namespace abouterf\Course\Http\Controllers;

use abouterf\User\Repositories\UserRepo;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    public function index()
    {
        return 'courses';
    }

    public function create(UserRepo $userRepo)
    {
        $teachers = $userRepo->getTeachers();
        return view('Courses::create', compact('teachers'));
    }

    public function store()
    {
    }
}
