<?php

namespace abouterf\Course\Http\Requests;

use abouterf\Course\Models\Course;
use abouterf\Course\Rules\ValidTeacher;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class CourseRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check() == true;
    }

    public function rules()
    {
        return [
            'title' => 'required|min:3|max:190',
            'slug' => 'required|min:3|max:190|unique:courses,slug',
            'priority' => 'nullable|numeric',
            'price' => 'required|numeric|min:0|max:1000000',
            'percent' => 'required|min:0|max:100|numeric',
            'teacher_id' => ['required', 'exists:users,id', new ValidTeacher], // todo create isValidTeacher
            'type' => ['required', Rule::in(Course::$types)],
            'status' => ['required', Rule::in(Course::$statuses)],
            'category_id' => 'required|exists:categories,id',
            'image' => 'mimes:jpg,jpeg,png,svg,gif'
        ];
    }
}
