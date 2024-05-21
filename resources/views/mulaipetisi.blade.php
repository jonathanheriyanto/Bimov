@extends('layout.main')

@section('content')
    @auth
        <div class="header">
            <div id="large" style="font-weight: 200">
                {{__('mulaipetisi.title') }}
            </div>
            <div class="mt-3" style="font-size: 35px; font-weight: 700; display: flex; flex-direction: row">
                {{__('mulaipetisi.subtitle1') }} <div style="color: #F2951E; margin-left: 6px">{{__('mulaipetisi.subtitle2') }}</div>{{__('mulaipetisi.subtitle3') }}
            </div>
        </div>

        <div class="form-petisi">
            <div class="left">
                <img src="{{ asset('aset/notes.png') }}" alt="" style="width: 70%">
            </div>
            <div class="right-form" style="align-items: center; min-height: fit-content">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="width: 70%; font-size: small">
                        {{$errors->first()}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form enctype="multipart/form-data" action="{{ route('insertpetisi', app()->getLocale()) }}" method="POST" style="width: 70%">
                    @csrf
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label" for="image">{{__('mulaipetisi.image') }}</label>
                            <input type="file" id="image" name="image" class="form-control styfc">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label" for="title">{{__('mulaipetisi.petition_title') }}</label>
                            <input type="text" id="title" name="title" class="form-control styfc" value="{{ old('title') }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label" for="detail">{{__('mulaipetisi.petition_detail') }}</label>
                            <textarea name="detail" id="detail" name="detail" class="form-control styfc" cols="30" rows="10" style="min-height: 40vh"></textarea>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div id="submitbtn" style="margin-top: 12px">
                            <input type="submit" class="submit-btn" value="{{__('mulaipetisi.publish') }}">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @else
        <div id="container-body" style="display: flex; flex-direction: column; justify-content: center; align-items: center; min-height: 100vh; padding: 0px; background-color: #015581">
            @include('layout.lf')
        </div>
    @endauth
@endsection
