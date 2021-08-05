@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row justify-content-center">

            @if (count($rssFeed) >0)
            @foreach ($rssFeed as $Feed)
            <div class="list-group">
                <a href="{{route('feeds.view',["rssFeed"=>$Feed])}}" class="list-group-item list-group-item-action">{{$Feed->title}}</a>
              </div>
            @endforeach
            @else
            No Feeds
              <div class="text-center py-3">
                <a href="{{route('feeds.create')}}" class="btn btn-sm btn-outline-primary">Add Url</a>
              </div>
            @endif
        </div>
    </div>

@endsection
@push('scripts')
    <script>
        var forms = document.querySelectorAll('.form-validation');
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    </script>
@endpush
