<p class="box__title">ایجاد نقش کاربری</p>
<form action="{{route('role-permissions.store')}}" method="post" class="padding-30">
    @csrf
    <input type="text" name="name" value="{{old('name')}}" id="title" placeholder="نقش کاربری" class="text">
    @error("name")
    <span class="invalid-feedback" role="alert">
        <strong>{{$message}}</strong>
    </span>
    @enderror
    <p class="box__title margin-bottom-15 mt-2">انتخاب مجوزها</p>
    @foreach($permissions as $permission)
    <label class="ui-checkbox pt-1 pr-3">
        <input type="checkbox" name="permissions[{{$permission->name}}]" value="{{$permission->name}}" class="sub-checkbox pt-1" data-id="1" @if(is_array(old('permissions')) && array_key_exists($permission->name,old('permissions'))) checked @endif>
        <span class="checkmark"></span>
        @lang($permission->name )
    </label>
    @endforeach
    @error("permissions")
    <span class="invalid-feedback" role="alert">
        <strong>{{$message}}</strong>
    </span>
    @enderror
    <hr>
    <button class="btn btn-webamooz_net mt-2">اضافه کردن</button>
</form>