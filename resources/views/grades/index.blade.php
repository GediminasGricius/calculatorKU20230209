@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row ">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Students </div>

                    <div class="card-body">
                        <a class="btn btn-info" href="{{route("grades.create")}}">{{ __("Add new grade") }}</a>
                        <hr>
                        Out email is: [[email]]
                        <table class="table" >
                            <thead>
                            <tr>
                                <th>{{ __("Grade") }}</th>

                                <th>{{ __("Student") }}</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($grades as $grade)
                                <tr>
                                    <td>{{ $grade->grade }}</td>
                                    <td>{{ $grade->student->name }} {{ $grade->student->surname }}</td>


                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


