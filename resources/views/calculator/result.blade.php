@extends("layouts.calculator")
@section("content")
    <div class="col-md-12 mt-5">
        <div class="card">
            <div class="card-body">
                <h1>Result: {{ $result }}</h1>
                <hr>
                <a class="btn btn-info" href="{{ route("form") }}">Back</a>
            </div>
        </div>
    </div>
@endsection
