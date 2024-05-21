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

            <form action="{{ route('register', app()->getLocale()) }}" method="POST" style="width: 70%">
                @csrf
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label" for="nama">{{__('register.name') }}</label>
                        <input type="text" id="name" name="name" class="form-control styfc" value="{{ old('name') }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label" for="nim">{{__('register.nim') }}</label>
                        <input type="text" id="nim" name="nim" class="form-control styfc" value="{{ old('nim') }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label" for="email">{{__('register.email') }}</label>
                        <input type="email" id="email" name="email" class="form-control styfc" value="{{ old('email') }}">
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col">
                        <label class="form-label" for="password">{{__('register.password') }}</label>
                        <input type="password" id="password" name="password" class="form-control styfc" value="{{ old('password') }}">
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col">
                        <label class="form-label" for="cpassword">{{__('register.cpassword') }}</label>
                        <input type="password" id="cpassword" name="cpassword" class="form-control styfc" value="{{ old('cpassword') }}">
                    </div>
                </div>

                <div class="row mb-2">
                    <div id="submitbtn" style="margin-top: 12px">
                        <input type="submit" class="submit-btn" value="{{__('register.signup') }}">
                    </div>
                </div>

                <div class="row" id="last-row">
                    <div class="col"> {{__('register.account') }} <a href="{{ route('viewmasuk', app()->getLocale()) }}"><b>{{__('register.login') }}</b></a></div>
                </div>
            </form>
        </div>
    </div>
@endsection
