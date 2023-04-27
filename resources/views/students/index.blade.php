@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row ">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Students </div>

                    <div class="card-body">
                        @can('create', \App\Models\Student::class)
                        <a class="btn btn-info" href="{{route("students.create")}}">{{ __("Add new student") }}</a>
                        @endcan
                        <hr>
                        {{ __("auth.message") }}
                        <hr>


                        @can('search_student')
                            <form method="POST" action="{{ route("students.search") }}">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">{{ __("Name") }}:</label>
                                    <input class="form-control" name="name" value="{{ $searchStudentName }}">
                                </div>
                                <button class="btn btn-success">Search</button>
                            </form>
                        @endcan


                        <hr>
                        <table class="table" >
                            <thead>
                            <tr>
                                <th>Image</th>
                                <th>{{ __("Name") }}</th>
                                <th>{{ __("Surname") }}</th>
                                <th>{{ __("Year") }}</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($students as $student)
                                <tr>
                                    <td>
                                        @if ($student->image!=null)
                                            <img src=" {{ asset("/storage/students/".$student->image) }}" width="100">
                                        @endif
                                    </td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->surname }}</td>
                                    <td>{{ $student->year }}</td>
                                    <td>
                                        @foreach($student->grades as $grade)
                                            {{ $grade->grade }}
                                        @endforeach
                                    </td>
                                    <td>
                                        @if($student->agreement!=null)
                                            <a href="{{ route("students.agreement", $student->id) }}" class="btn btn-info">Agreement</a>
                                        @endif
                                    </td>
                                    <td style="width: 100px;">
                                            @can('update', $student)

                                                <a class="btn btn-success" href="{{ route("students.edit",$student->id) }}">{{ __("Edit") }}</a>
                                            @endcan
                                    </td>
                                    <td style="width: 100px;">
                                        @can('delete', $student)
                                            <form method="post" action="{{ route('students.destroy',$student->id) }}">
                                                @csrf
                                                @method("delete")
                                                <button class="btn btn-danger">{{ __("Delete") }}</button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    Contact phone: [[phone]]
@endsection
