<?php

namespace abouterf\Course\Http\Controllers;

use App\Http\Controllers\Controller;
use abouterf\Category\Repositories\CategoryRepo;
use abouterf\Common\Responses\AjaxResponse;
use abouterf\Common\Responses\AjaxResponses;
use abouterf\Course\Http\Requests\CourseRequest;
use abouterf\Course\Models\Course;
use abouterf\Course\Repositories\CourseRepo;
use abouterf\Media\Services\MediaFileService;
use abouterf\User\Repositories\UserRepo;

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
        $course = $courseRepo->findByid($id);
        $this->authorize('edit', $course);
        $teachers = $userRepo->getTeachers();
        $categories = $categoryRepo->all();
        return view('Courses::edit', compact('course', 'teachers', 'categories'));
    }

    public function update($id, CourseRequest $request, CourseRepo $courseRepo)
    {
        $course = $courseRepo->findByid($id);
        $this->authorize('edit', $course);
        if ($request->hasFile('image')) {
            $request->request->add(['banner_id' => MediaFileService::upload($request->file('image'))->id]);
            if ($course->banner) {
                $course->banner->delete();
            }
        } else {
            $request->request->add(['banner_id' => $course->banner_id]);
        }
        $courseRepo->update($id, $request);
        return redirect(route('courses.index'));
    }

    public function destroy($id, CourseRepo $courseRepo)
    {
        $course =  $courseRepo->findByid($id);
        $this->authorize('destroy', $course);

        if ($course->banner) {
            $course->banner->delete();
        }

        $course->delete();

        return AjaxResponse::SuccessResponse();
    }

    public function accept($id, CourseRepo $courseRepo)
    {
        $this->authorize('change_confirmation_status', Course::class);

        if ($courseRepo->updateConfirmationStatus($id, Course::CONFIRMATION_STATUS_ACCEPTED)) {
            return AjaxResponse::SuccessResponse();
        }

        return AjaxResponse::FailedResponse();
    }

    public function reject($id, CourseRepo $courseRepo)
    {
        $this->authorize('change_confirmation_status', Course::class);

        if ($courseRepo->updateConfirmationStatus($id, Course::CONFIRMATION_STATUS_REJECTED)) {
            return AjaxResponse::SuccessResponse();
        }

        return AjaxResponse::FailedResponse();
    }

    public function lock($id, CourseRepo $courseRepo)
    {
        $this->authorize('change_confirmation_status', Course::class);

        if ($courseRepo->updateStatus($id, Course::STATUS_LOCKED)) {
            return AjaxResponse::SuccessResponse();
        }

        return AjaxResponse::FailedResponse();
    }
}
