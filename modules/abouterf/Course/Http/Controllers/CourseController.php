<?php

namespace abouterf\Course\Http\Controllers;

use abouterf\Course\Http\Requests\CourseRequest;
use abouterf\Category\Repositories\CategoryRepo;
use abouterf\Category\Responses\AjaxResponse;
use abouterf\Course\Models\Course;
use abouterf\Course\Repositories\CourseRepo;
use abouterf\Media\Services\MediaFileService;
use abouterf\User\Repositories\UserRepo;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    public function index(CourseRepo $courseRepo)
    {
        $this->authorize('manage', Course::class);

        $courses = $courseRepo->paginate();

        return view('Courses::index', compact('courses'));
    }

    public function create(UserRepo $userRepo, CategoryRepo $categoryRepo)
    {
        $this->authorize('create', Course::class);

        $teachers = $userRepo->getTeachers();
        $categories = $categoryRepo->all();
        return view('Courses::create', compact('teachers', 'categories'));
    }

    public function store(CourseRequest $request, CourseRepo $courseRepo)
    {
        $request->request->add(['banner_id' => MediaFileService::upload($request->file('image'))->id]);

        $courseRepo->store($request);
        return redirect()->route('courses.index');
    }

    public function edit($id, CourseRepo $courseRepo, UserRepo $userRepo, CategoryRepo $categoryRepo)
    {

        $teachers = $userRepo->getTeachers();

        $categories = $categoryRepo->all();
        $course = $courseRepo->findById($id);
        $this->authorize('edit', $course);

        // dd($course->category_id);
        return view('Courses::edit', compact('course', 'categories', 'course', 'teachers'));
    }

    public function update($id, CourseRequest $request, CourseRepo $courseRepo)
    {
        $course = $courseRepo->findById($id);
        if ($request->hasFile('image')) {
            $request->request->add(['banner_id' => MediaFileService::upload($request->file('image'))->id]);
            $course->banner->delete();
        } else {
            $request->request->add(['banner_id' => $course->banner_id]);
        }

        $courseRepo->update($id, $request);

        return redirect(route('courses.index'));
    }

    public function destroy($id, CourseRepo $courseRepo)
    {

        $course = $courseRepo->findById($id);

        $this->authorize('destroy', $course);

        $course->banner ? $course->banner->delete() : null;

        $course->delete();

        return AjaxResponse::successResponse();
    }

    public function accept($id, CourseRepo $courseRepo)
    {
        $course = $courseRepo->findById($id);

        $this->authorize('accept', $course);

        if ($courseRepo->updateConfirmationStatus($id, Course::CONFIRMATION_STATUS_ACCEPTED)) {
            return AjaxResponse::successResponse();
        }

        return AjaxResponse::failedResponse();
    }
    public function reject($id, CourseRepo $courseRepo)
    {
        $course = $courseRepo->findById($id);

        $this->authorize('reject', $course);
        if ($courseRepo->updateConfirmationStatus($id, Course::CONFIRMATION_STATUS_REJECTED)) {
            return AjaxResponse::successResponse();
        }

        return AjaxResponse::failedResponse();
    }
    public function lock($id, CourseRepo $courseRepo)
    {
        $course = $courseRepo->findById($id);

        $this->authorize('lock', $course);
        if ($courseRepo->updateStatus($id, Course::CONFIRMATION_STATUS_LOCKED)) {
            return AjaxResponse::successResponse();
        }

        return AjaxResponse::failedResponse();
    }
}
