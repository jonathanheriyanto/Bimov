@extends('layout.main')

@section('content')
    <div class="header">
        <div id="large" style="font-weight: 200">
            {{__('detailpetisi.title') }}
        </div>
        <div class="mt-3" style="font-size: 35px; font-weight: 700; display: flex; flex-direction: row">
            {{__('detailpetisi.text1_1') }}
            <div style="color: #F2951E; margin-left: 6px">
                {{__('detailpetisi.text1_2') }}
            </div>&nbsp
            {{__('detailpetisi.text1_3') }}
        </div>
    </div>

    <div class="form-petisi">
        <div class="left">
            <img src="{{ asset('aset/detail.png') }}" alt="" style="width: 70%">
        </div>
        <div class="right-form" style="align-items: center; min-height: fit-content">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="width: 40rem; font-size: small">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="width: 40rem; font-size: small">
                    {{$errors->first()}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card md-3" id="card-css" style="width: 40rem">
                <div class="card-body">
                    <h5 class="card-title" style="font-size: x-large">{{ $petisi->judul }}</h5>
                    <div class="ca" style="border-radius: 7px">{{ __('welcome.ca') }}
                        {{ $petisi->created_at->isoFormat('D MMM Y') }}
                    </div>
                    <p class="card-text" style="font-size: medium; white-space: pre-line; margin-top: 4%">
                        {{ $petisi->desc }}
                    </p>

                    <p class="text" style="font-size: medium; color: rgb(0, 54, 82)">
                        <div style="font-weight: 400">{{__('detailpetisi.signers') }}</div>
                        <b style="font-weight: 700">{{ $petisi->counter }}</b> <b style="font-weight: 500">BINUSIAN</b>
                    </p>

                    @auth
                        <form action="{{ route('dukungpetisi', app()->getLocale()) }}" method="POST" style="width: 100%">
                            @csrf
                            <input type="hidden" name="petuser" value="{{ Auth::user()->id.$petisi->id }}">
                            <input type="hidden" name="petid" value="{{ $petisi->id }}">
                            <input type="submit" class="card-btn" value="{{__('detailpetisi.sign') }}">
                        </form>
                    @else
                        <div id="small" style="color: rgb(153, 51, 51)">{{__('detailpetisi.warning') }}</div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
@endsection
