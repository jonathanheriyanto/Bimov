@extends('layout.main')

@section('content')
    @auth
        <div class="header">
            <div id="large" style="font-weight: 200">
                {{__('editprofil.header') }}
            </div>
            <div class="mt-3" style="font-size: 35px; font-weight: 700; display: flex; flex-direction: row">
                {{__('editprofil.subtitle1') }} <div style="color: #F2951E; margin-left: 6px">{{__('editprofil.subtitle2') }}</div>!
            </div>
        </div>

        <div class="form-petisi" style="margin-top: 42px">
            <div class="left">
                <img src="{{ asset('aset/profile.png') }}" alt="" style="width: 70%">
            </div>
            <div class="right-form" style="align-items: center; min-height: fit-content">
                <div class="card" style="min-width: 600px; backdrop-filter: blur(70px); background-color: #005eab37; margin-bottom: 24px; border-radius: 24px">
                    <div class="card-body" style="display: flex; flex-direction: column; align-items: center">
                        <div id="large" class="role mt-2" style="width: 100px; background-image: linear-gradient(190deg, #015581 , #6fccff); blur(4px)"><b>{{ Str::upper(Auth::user()->role) }}</b></div>

                        <div class="info" style="margin-top:4%">
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="width: 470px; font-size: small">
                                    {{$errors->first()}}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                        </div>

                        <div class="info">
                            <form enctype="multipart/form-data" action="{{ route('editprofil', app()->getLocale()) }}" method="POST" style="width: 100%">
                                @csrf
                                <div class="profil">
                                    <div class="left mx-2">
                                        <div class="row mb-2">
                                            <div class="col">
                                                <label class="form-label" id="fl" for="nim">{{__('editprofil.nim') }}</label>
                                                <input type="text" id="nim" name="nim" class="form-control styfc" value="{{ Auth::user()->nim }}" disabled>
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col">
                                                <label class="form-label" id="fl" for="name">{{__('editprofil.name') }}</label>
                                                <input type="text" id="name" name="name" class="form-control styfc" value="{{ Auth::user()->nama }}">
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col">
                                                <label class="form-label" id="fl" for="fnama">{{__('editprofil.fnama') }}</label>
                                                <input type="text" id="fnama" name="fnama" class="form-control styfc" value="{{ Auth::user()->fnama }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="right mx-2">
                                        <div class="row mb-2">
                                            <div class="col">
                                                <label class="form-label" id="fl" for="email">{{__('editprofil.email') }}</label>
                                                <input type="text" id="email" name="email" class="form-control styfc" value="{{ Auth::user()->email }}" disabled>
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col">
                                                <label class="form-label" id="fl" for="pass">{{__('editprofil.pass') }}</label>
                                                <input type="password" id="pass" name="pass" class="form-control styfc">
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col">
                                                <label class="form-label" id="fl" for="cpass">{{__('editprofil.cpass') }}</label>
                                                <input type="password" id="cpass" name="cpass" class="form-control styfc">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="button" style="margin-top: 4%; margin-bottom: 2%; display: flex; justify-content: center">
                                    <input type="submit" id="button-org" style="border: none" value="{{ __('main.ep') }}">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div id="container-body" style="display: flex; flex-direction: column; justify-content: center; align-items: center; min-height: 100vh; padding: 0px; background-color: #015581">
            @include('layout.lf')
        </div>
    @endauth
@endsection
