@extends('User::Front.master')

@section('content')
    <div class="account">
        <form action="{{route('password.checkVerifyCode')}}" class="form" method="post">
            @csrf
            <input type="hidden" id="email" name="email" value="{{request('email')}}">
            <a class="account-logo" href="/">
                <img src="/img/weblogo.png" alt="">
            </a>
            <div class="card-header">
                <p class="activation-code-title">کد فرستاده شده به ایمیل  <span>{{request('email')}}</span> را وارد کنید</p>
            </div>
            <div class="form-content form-content1">
                <input name="verify_code" required class="activation-code-input" placeholder="فعال سازی">
                @error('verify_code')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <br>
                <button class="btn i-t">تایید</button>
                <a href="#" onclick="event.preventDefault();document.getElementById('resend-code').submit()">ارسال مجدد کد فعالسازی</a>
            </div>
            <div class="form-footer">
                <a href="{{route('register')}}">صفحه ثبت نام</a>
            </div>
        </form>

        <form method="post" id="resend-code" action="{{route('verification.resend')}}">@csrf</form>
    </div>
@endsection
@section('js')
    <script src="/js/jquery-3.4.1.min.js"></script>
    <script src="/js/activation-code.js"></script>
@endsection
