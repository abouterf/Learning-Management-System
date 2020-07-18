@extends('User::Front.master')

@section('content')

    <form action="{{ route('password.update') }}" class="form" method="post">
        @csrf
        <a class="account-logo" href="/">
            <img src="/img/weblogo.png" alt="">
        </a>
        <div class="form-content form-account">
            <input type="password" class="txt txt-l @error('password') is-invalid @enderror"
                   placeholder="رمز عبور" name="password" required autocomplete="new-password">
            <input id="password-confirm" type="password" class="txt txt-l"
                   placeholder="تایید رمز عبور" name="password_confirmation" required autocomplete="new-password">
            @error('password')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <span class="rules">
                    رمز عبور باید حداقل ۶ کاراکتر و ترکیبی از حروف بزرگ، حروف کوچک، اعداد و کاراکترهای غیر
                    الفبا مانند !@#$%^&*() باشد.
                </span>
            <br>
            <button class="btn continue-btn">ثبت نام و ادامه</button>
        </div>
        <div class="form-footer">
            <a href="{{route('login')}}">صفحه ورود</a>
        </div>
    </form>


@endsection
