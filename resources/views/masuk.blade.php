@extends('layout.form')

@section('content')
    <div class="form-cont">
        <div class="left">
            <img src="{{ asset('aset/form.png') }}" alt="" style="width: 70%">
        </div>
        <div class="right-form" style="padding: 32px; align-items: center">
            <div class="row" style="margin-bottom: 52px">
                <img src="{{ asset('aset/logo.png') }}" alt="" style="width: 180px">
            </div>

            @if (session()->has('loginError'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="width: 70%; font-size: small">
                    {{ session('loginError') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="width: 70%; font-size: small">
                    {{$errors->first()}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="/login" method="POST" style="width: 70%">
                @csrf
                <div class="row mb-4">
                    <div class="col">
                        <label class="form-label" for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control styfc" value="{{Cookie::get('emailcookie') !== null ? Cookie::get('emailcookie') : ""}}">
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col">
                        <label class="form-label" for="password">Kata Sandi</label>
                        <input type="password" id="password" name="password" class="form-control styfc" value="{{Cookie::get('passcookie') !== null ? Cookie::get('passcookie') : ""}}">
                    </div>
                </div>

                <div class="remember mb-3">
                    <input type="checkbox" name="remember" id="remember"
                    checked={{Cookie::get('emailcookie') !== null}}> <label class="form-label" for="remember">Remember me</label>
                </div>

                <div class="row mb-2">
                    <div id="submitbtn">
                        <input type="submit" class="submit-btn" value="Masuk">
                    </div>
                </div>

                <div class="row" id="last-row">
                    <div class="col"> Belum memiliki akun? <a href="/daftar"><b>Daftar Sekarang!</b></a></div>
                </div>
            </form>
        </div>
    </div>
@endsection
