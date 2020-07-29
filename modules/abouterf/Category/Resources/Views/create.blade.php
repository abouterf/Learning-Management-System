<p class="box__title">ایجاد دسته بندی جدید</p>
<form action="{{route('categories.store')}}" method="post" class="padding-30">
    @csrf
    <input type="text" name="title" id="title" placeholder="نام دسته بندی" class="text">
    <input type="text" name="slug" id="slug" placeholder="نام انگلیسی دسته بندی" class="text">
    <p class="box__title margin-bottom-15">انتخاب دسته پدر</p>
    <select name="parent" id="parent">
        <option value="0">ندارد</option>
        @foreach($categories as $category)
            <option value="{{$category->id}}">{{$category->title}}</option>
        @endforeach
    </select>
    <button class="btn btn-webamooz_net">اضافه کردن</button>
</form>

