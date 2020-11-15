<?php

namespace abouterf\Course\Http\Controllers;

use abouterf\Course\Http\Requests\CourseRequest;
use abouterf\Category\Repositories\CategoryRepo;
use abouterf\Course\Repositories\CourseRepo;
use abouterf\Media\Services\MediaUploadService;
use abouterf\User\Repositories\UserRepo;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    public function index(CourseRepo $courseRepo)
    {
        $courses = $courseRepo->paginate();

        return view('Courses::index', compact('courses'));
    }

    public function create(UserRepo $userRepo, CategoryRepo $categoryRepo)
    {
        $teachers = $userRepo->getTeachers();
        $categories = $categoryRepo->all();
        return view('Courses::create', compact('teachers', 'categories'));
    }

    public function store(CourseRequest $request, CourseRepo $courseRepo)
    {
        $request->request->add(['banner_id' => MediaUploadService::upload($request->file('image'))->id]);

        $course = $courseRepo->store($request);
        return redirect()->route('courses.index');
    }
}
