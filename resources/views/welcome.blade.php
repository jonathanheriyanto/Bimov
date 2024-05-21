@extends('layout.main')

@section('content')
    <div id="container-head">
        <div class="title">Binusian Movement.</div>
        <div class="desc">{{__('welcome.subtitle') }}</div>
        <img src="{{ asset('aset/Mailbox-bro.png') }}" alt="">
        <a href="{{ route('mulaiview', app()->getLocale()) }}">
            <div id="button-wht" style="margin-top: 24px; margin-bottom: 34px">
                {{__('welcome.start_petition') }}
            </div>
        </a>
    </div>

    <div id="container-body">
        @if (!Auth::user() || Auth::user()->role == 'member')
        <div id="tentang-kami">
            <div class="left">
                <img src="{{ asset('aset/Mail-bro.png') }}" style="width: 360px" alt="">
            </div>
            <div class="right">
                <div id="small">
                    {{__('welcome.about_us') }}
                </div>
                <div id="medium" class="mb-3">
                    {{__('welcome.what') }}
                </div>
                <div id="para" class="mb-4">
                    {{__('welcome.desc') }}
                    <br><br>
                    {{__('welcome.question') }}
                </div>

                <div class="tk-btn">
                    <div></div>
                    <div></div>
                    <div></div>
                    <a href="{{ route('mulaiview', app()->getLocale()) }}">
                        <div id="button-org">
                            {{__('welcome.start_petition') }}
                        </div>
                    </a>

                    <a href="{{ route('semuapetisi', app()->getLocale()) }}">
                        <div id="button-org">
                            {{__('welcome.all_petition') }}
                        </div>
                    </a>
                </div>
            </div>
        </div>
        @endif

        <div id="terkini">
            <div id="small">
                {{__('welcome.recent') }}
            </div>
            <div class="bar-ls">
                <div id="medium">
                    {{__('welcome.four_recent') }}
                </div>
                <a href="{{ route('semuapetisi', app()->getLocale()) }}">
                    <div id="light">{{__('welcome.more') }}</div>
                </a>
            </div>

            <div id="petisi" style="margin-top: 12px">
                @foreach ($terkini as $new)
                    <div class="card md-3" id="card-css">
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
                                {{__('welcome.signers') }} <br>
                                <b style="font-weight: 700">{{ $new->counter }}</b> <b style="font-weight: 500">BINUSIAN</b>
                            </p>

                            <a href="{{ route('detailpetisi', ['locale' =>app()->getLocale(), 'petisi' => $new->slugpet]) }}">
                                <div class="card-btn mb-2">
                                    {{__('welcome.detail') }}
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div id="terpopuler">
            <div id="small">
                {{__('welcome.popular') }}
            </div>
            <div class="bar-ls">
                <div id="medium">
                    {{__('welcome.four_popular') }}
                </div>
                <a href="{{ route('semuapetisi', app()->getLocale()) }}">
                    <div id="light">{{__('welcome.more') }}</div>
                </a>
            </div>

            <div id="petisi" style="margin-top: 12px">
                @foreach ($terpopuler as $pop)
                    <div class="card md-3" id="card-css" style="width: 20rem !important">
                        <div class="ca">{{ __('welcome.ca') }}
                            {{ $pop->created_at->isoFormat('D MMM Y') }}
                        </div>
                        <div class="card-image">
                            <img src="{{ Storage::URL('img/'.$pop->img) }}" class="card-img-top" alt="..." style="width: 100%; height: auto">
                        </div>
                        <div class="card-body">
                            @if (Str::length($pop->judul) <= 20)
                                <h5 class="card-title">{{ $pop->judul }}</h5>
                            @else
                                <h5 class="card-title">{{ $pop->sjudul }} . . .</h5>
                            @endif
                            <p class="card-text">
                                {{ $pop->sdesc }}. . .
                            </p>

                            <p class="text">
                                {{__('welcome.signers') }} <br>
                                <b style="font-weight: 700">{{ $pop->counter }}</b> <b style="font-weight: 500">BINUSIAN</b>
                            </p>
                            <a href="{{ route('detailpetisi', ['locale' =>app()->getLocale(), 'petisi' => $pop->slugpet]) }}">
                                <div class="card-btn mb-2">
                                    {{__('welcome.detail') }}
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
