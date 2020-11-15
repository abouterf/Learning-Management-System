@extends('Dashboard::master')
@section('content')
    @section('breadcrumb')
        <li><a href="#" title="دسته بندی ها">دسته بندی ها</a></li>
    @endsection
    <div class="row no-gutters  ">
        <div class="col-12 margin-left-10 margin-bottom-15 border-radius-3">
            <p class="box__title">دوره ها</p>
            <div class="table__box">
                <table class="table">
                    <thead role="rowgroup">
                    <tr role="row" class="title-row">
                        <th>بنر </th>
                        <th>شناسه </th>
                        <th>ردیف</th>
                        <th>عنوان</th>
                        <th>مدرس</th>
                        <th>درصد مدرس</th>
                        <th>قیمت دوره</th>
                        <th>وضعیت</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($courses as $course)
                        <tr role="row" class="">
                            <td style="width: 80px"><img width="80px" src="{{$course->thumb}}" alt=""></td>
                            <td><a href="">{{$course->id}}</a></td>
                            <td><a href="">{{$course->priority}}</a></td>
                            <td><a href="">{{$course->title}}</a></td>
                            <td><a href="">{{$course->teacher->name}}</a></td>
                            <td>{{$course->percent}}%</td>
                            <td>{{number_format($course->price)}} تومان</td>
                            <td>@lang($course->status)</td>
                            <td>
                                <a href=""
                                   onclick="deleteItem(event,'{{route('categories.destroy',$course->id)}}')"
                                   class="item-delete mlg-15" title="حذف"></a>
                                <a href="" target="_blank" class="item-eye mlg-15" title="مشاهده"></a>
                                <a href="{{route('categories.edit' , $course->id)}}" class="item-edit "
                                   title="ویرایش"></a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
     
    </div>
@endsection



