<div class="file-upload">
    <div class="i-file-upload">
    <span>{{$placeholder}}</span>
        <input type="file" class="file-upload" id="files" name="{{$name}}" required/>
    </div>
    <span class="filesize"></span>
@if(isset($value->thumb))
<span class="selectedFiles"><img width="80px" src="{{$value->thumb}}" alt=""></span>
@else
<span class="selectedFiles">فایلی انتخاب نشده است</span><br>

@endif
    <x-validation-error field="{{$name}}"/>
</div>