@extends('Dashboard::master')
@section('content')
@section('breadcrumb')
<li><a href="{{route('role-permissions.index')}}" title="نقش کاربری ها">نقش کاربری ها</a></li>
<li><a href="#" title="ویرایش نقش کاربری">ویرایش نقش کاربری
    </a></li>
@endsection
<div class="row no-gutters  ">

    <div class="col-6 bg-white">
        <p class="box__title">به روزرسانی نقش کاربری</p>

        <form action="{{route('role-permissions.update',$role->id)}}" method="post" class="padding-30">
            @csrf
            @method('patch')
            <input type="text" name="name" placeholder="نام نقش کاربری" class="text" value="{{$role->name}}">

            <p class="box__title margin-bottom-15">انتخاب مجوزها</p>
            @foreach($permissions as $permission)
            <label class="ui-checkbox pt-1 pr-3">
                <input type="checkbox" name="permissions[{{$permission->name}}]" value="{{$permission->name}}" class="sub-checkbox" data-id="1" @if($role->hasPermissionTo($permission->name)) checked @endif>
                <span class="checkmark"></span>
                @lang($permission->name )
            </label>
            @endforeach

            <button class="btn btn-webamooz_net mt-1">به روزرسانی</button>
        </form>
    </div>
</div>
@endsection