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

            <form action="/register" method="POST" style="width: 70%">
                @csrf
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label" for="nama">Nama</label>
                        <input type="text" id="nama" name="nama" class="form-control styfc" value="{{ old('nama') }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label" for="nim">NIM (Nomor Induk Mahasiswa)</label>
                        <input type="text" id="nim" name="nim" class="form-control styfc" value="{{ old('nim') }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label" for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control styfc" value="{{ old('email') }}">
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col">
                        <label class="form-label" for="password">Kata Sandi</label>
                        <input type="password" id="password" name="password" class="form-control styfc" value="{{ old('password') }}">
                    </div>
                </div>

                <div class="row mb-2">
                    <div id="submitbtn" style="margin-top: 12px">
                        <input type="submit" class="submit-btn" value="Daftar">
                    </div>
                </div>

                <div class="row" id="last-row">
                    <div class="col"> Sudah memiliki akun? <a href="/masuk"><b>Masuk Sekarang!</b></a></div>
                </div>
            </form>
        </div>
    </div>
@endsection
