@extends('layout.main')

@section('content')
    @auth
    @if (Auth::user()->role == 'admin')
        <div class="header">
            <div id="large" style="font-weight: 200">
                {{__('semuapetisi.admin.header1') }} {{ Auth::user()->nama }}{{__('semuapetisi.admin.header2') }}
            </div>
            <div class="mt-3" style="font-size: 35px; font-weight: 700; display: flex; flex-direction: row">
                {{__('semuapetisi.admin.title1') }} <div style="color: #F2951E; margin-left: 6px">{{__('semuapetisi.admin.title2') }}</div>&nbsp;{{__('semuapetisi.admin.title3') }}
            </div>
        </div>
    @else
        <div class="header">
            <div id="large" style="font-weight: 200">
                {{__('semuapetisi.user.header') }}
            </div>
            <div class="mt-3" style="font-size: 35px; font-weight: 700; display: flex; flex-direction: row">
                {{__('semuapetisi.user.title1') }} <div style="color: #F2951E; margin-left: 6px">{{__('semuapetisi.user.title2') }}</div>&nbsp{{__('semuapetisi.user.title3') }} <div style="color: #F2951E; margin-left: 6px">{{__('semuapetisi.user.title4') }}</div>{{__('semuapetisi.user.title5') }}
            </div>
        </div>
    @endif
        <div id="container-body">
            <form class="d-flex" role="search" action="{{ route('semuapetisi', app()->getLocale()) }}" method="GET">
                <input class="form-control me-2" name="to_search" type="search" placeholder="{{ __('semuapetisi.phsearch') }}" aria-label="Search" value="{{ old('to_search') }}">
                <span class="input-group-append"><i class="fa fa-times"></i></span>
                <button class="btn" id="button-org" type="submit" style="border-radius: 5px">{{ __('semuapetisi.search') }}</button>
            </form>
            @if ($petisi->count()==0)
            <div class="empty">
                <img src="{{ asset('aset/404.png') }}" style="width:300px" alt="">
                <div class="notdesc" style="color: #d17700">
                    <b style="font-size: 1.4rem">{{ __('semuapetisi.nf') }}</b>
                    <br>{{ __('semuapetisi.nfd') }}
                </div>
            </div>
            @endif
            <div id="petisi" style="margin-top: 12px">
                @foreach ($petisi as $new)
                    <div class="card md-3" id="card-css" style="margin-bottom: 24px">
                        <div class="card-image">
                            <div class="ca">
                                {{ __('welcome.ca') }} {{ Carbon\Carbon::parse($new->created_at)->isoFormat('D MMM Y') }}
                            </div>
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
                                {{__('semuapetisi.signers') }} <br>
                                <b style="font-weight: 700">{{ $new->counter }}</b> <b style="font-weight: 500">BINUSIAN</b>
                            </p>

                            <div style="display: flex; flex-direction: row; justify-content: space-between">
                                <a href="{{ route('detailpetisi', ['locale' =>app()->getLocale(), 'petisi' => $new->slugpet]) }}">
                                    <div class="card-btn mb-2">
                                        {{__('semuapetisi.detail') }}
                                    </div>
                                </a>

                                @if (Auth::user()->role == 'admin')
                                    <a href="{{ route('hapuspetisiadmin', ['locale' =>app()->getLocale(), 'petisi' => $new->id]) }}">
                                        <div class="card-red-btn mb-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                            </svg>
                                            {{__('semuapetisi.delete') }}
                                        </div>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div style="margin-top: 14px">
                {{ $petisi->links() }}
            </div>
        </div>
    @else
        <div id="container-body" style="display: flex; flex-direction: column; justify-content: center; align-items: center; min-height: 100vh; padding: 0px; background-color: #015581">
            @include('layout.lf')
        </div>
    @endauth
@endsection
