@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{ route('courses.index') }}" title="دوره ها">دوره ها</a></li>
    <li><a href="#" title="ویرایش دوره">ویرایش دوره</a></li>
@endsection
@section('content')
    <div class="row no-gutters  ">
        <div class="col-12 bg-white">
            <p class="box__title">بروزرسانی دوره</p>
            <form action="{{ route('courses.update', $course->id) }}" class="padding-30" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
            <x-input name="title" placeholder="عنوان دوره" value="{{$course->title}}" type="text" required/>
            <x-input type="text" name="slug" value="{{$course->slug}}" placeholder="نام انگلیسی دوره" class="text-left" required />


                <div class="d-flex multi-text">
                    <x-input type="text" value="{{$course->priority}}"
                         class="text-left mlg-15" name="priority" placeholder="ردیف دوره" />
                    <x-input type="text" value="{{$course->price}}"
                         placeholder="مبلغ دوره" name="price" class="text-left" required />
                    <x-input type="number" value="{{$course->percent}}"
                         placeholder="درصد مدرس" name="percent" class="text-left" required />
                </div>
                <x-select name="teacher_id" required>
                    <option value="">انتخاب مدرس دوره</option>
                    @foreach($teachers as $teacher)
                    <option value="{{ $teacher->id }}" @if($teacher->id == $course->teacher_id) selected @endif>{{ $teacher->name }}</option>
                    @endforeach
                </x-select>
                
                <x-validation-error field="teacher_id"/>
                <x-tag-select name="tags"></x-tag-select>
                <x-select name="type" required>
                    <option value="">نوع دوره</option>
                    @foreach(\abouterf\Course\Models\Course::$types as $type)
                        <option value="{{ $type }}"
                         @if($type == $course->type) selected @endif>@lang($type)
                        </option>
                    @endforeach
                </x-select>
                <x-validation-error field="type"/>
                <x-select name="status" required>
                    <option value="">وضعیت دوره</option>
                    @foreach(\abouterf\Course\Models\Course::$statuses as $status)
                        <option value="{{ $status }}" @if($status == $course->status) selected @endif> @lang($status)</option>
                    @endforeach
                </x-select>
                <x-select name="category_id" required>
                    <option value="">دسته بندی</option>
                    @foreach($categories  as $category)
                        <option value="{{ $category->id }}" @if($category->id == $course->category_id) selected @endif>{{ $category->title }}</option>
                    @endforeach
                </x-select>
                <x-validation-error field="category_id"/>
                <x-file placeholder="بروزرسانی بنر دوره" :value="$course->banner" name="image"/>
            <x-text-area name="body" placeholder="توضیحات دوره" value="{{$course->body}}" />
                <x-validation-error field="body"/>
                <button class="btn btn-webamooz_net">ایجاد دوره</button>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="/panel/js/tagsInput.js?v=12"></script>
@endsection
