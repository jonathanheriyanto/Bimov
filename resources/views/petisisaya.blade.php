@extends('layout.main')

@section('content')
    <div class="header">
        <div id="large" style="font-weight: 200">
            {{__('petisisaya.title') }}
        </div>
        <div class="mt-3" style="font-size: 35px; font-weight: 700; display: flex; flex-direction: row">
            {{__('petisisaya.subtitle1') }} <div style="color: #F2951E; margin-left: 6px">{{__('petisisaya.subtitle2') }}</div>&nbsp{{__('petisisaya.subtitle3') }}<div style="color: #F2951E; margin-left: 6px">{{__('petisisaya.subtitle4') }}</div>{{__('petisisaya.subtitle5') }}
        </div>
    </div>

    <div id="container-body">
        @if ($petisi->count()==0)
            <div class="empty" style="margin: 0px">
                    <div class="notdesc" style="display: flex; flex-direction: column; justify-content: center; align-items: center; color: #cd7400">
                        <img src="{{ asset('aset/nodata.png') }}" style="width:470px; margin:32px" alt="">
                        <b>{{ __('petisisaya.nf') }}</b>
                        {{ __('petisisaya.nf1') }}
                        <a href="{{ route('mulaiview', app()->getLocale()) }}">
                            <div class="card-btn mt-4">
                                {{ __('petisisaya.sp') }}
                            </div>
                        </a>
                    </div>
            </div>
        @else
        <div id="petisi" style="margin-top: 12px">
            @foreach ($petisi as $new)
                <div class="card md-3" id="card-css" style="margin-bottom: 24px">
                    <div class="ca">{{ __('welcome.ca') }}
                        {{ $new->created_at->isoFormat('D MMM Y') }}
                    </div>
                    <div class="card-image">
                        <img src="{{ Storage::URL('img/'.$new->img) }}" class="card-img-top" alt="...">
                    </div>
                    <div class="card-body">
                        @if (Str::length($new->judul) <= 20)
                            <h5 class="card-title">{{ $new->judul }}</h5>
                        @else
                            <h5 class="card-title">{{ $new->sjudul }} . . .</h5>
                        @endif

                        <p class="card-text mb-2">
                            {{ $new->sdesc }}. . .
                        </p>

                        <p class="text" style="margin-top: 12px">
                            {{__('petisisaya.signers') }} <br>
                            <b style="font-weight: 700">{{ $new->counter }}</b> <b style="font-weight: 500">BINUSIAN</b>
                        </p>

                        <div style="display: flex; flex-direction: row; justify-content: space-between">
                            <a href="{{ route('detailpetisi', ['locale' =>app()->getLocale(), 'petisi' => $new->slugpet]) }}">
                                <div class="card-btn mb-2">
                                    {{__('petisisaya.petition_detail') }}
                                </div>
                            </a>

                            <a href="{{ route('hapuspetisi', ['locale' =>app()->getLocale(), 'petisi' => $new->id]) }}">
                                <div class="card-red-btn mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                      </svg>
                                      {{__('petisisaya.delete') }}
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @endif
    </div>
@endsection
