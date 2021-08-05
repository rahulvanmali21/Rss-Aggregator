@extends('layouts.app')
@section('content')

    <div class="container">
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-8 col-sm-12 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <form class="form-validation" novalidate action="{{ route('feeds.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="xm_url" class="form-label">Please enter Url</label>
                                <input type="text" name="rss_url" required class="form-control" id="xm_url">
                                <div class="invalid-feedback">
                                    Please enter valid URL
                                </div>
                                @if ($errors->has('rss_url'))
                                    <div style="color: red;text-align: left !important;">{{ $errors->first('rss_url') }}
                                    </div>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary">add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script>
        (function() {
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
        })();
    </script>
@endpush
