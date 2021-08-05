@extends('layouts.app')
@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <h1>{{ $rssFeed->title }}</h1>
            <hr>
            <p>{{ $rssFeed->description }}</p>

            @foreach ($rssFeed->items as $item)
                {{-- {{dd($item->content)}} --}}
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 py-1 my-1">
                    <div class="card">
                        @isset($item->content['image'])
                            <img src="{{ $item->content['image'] }}" class="card-img-top" alt="Image">
                        @endisset
                        <div class="card-body">
                            @foreach ($item->content as $tag => $value)
                                @if ($tag == 'title')
                                    <h5 class="card-title">{{ $value }}</h5>
                                @else
                                    @if (isUrl($value))
                                        <a href="{{$value}}" target="_blank"> click here</a>
                                    @else
                                        
                                    @endif
                                    <p class="card-text">{{ $value }}</p>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
