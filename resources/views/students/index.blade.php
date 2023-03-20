@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row ">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Students </div>

                    <div class="card-body">
                        <a class="btn btn-info" href="{{route("students.create")}}">Add new student</a>

                        <hr>
                        <form method="POST" action="{{ route("students.search") }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Name:</label>
                                <input class="form-control" name="name" value="{{ $searchStudentName }}">
                            </div>
                            <button class="btn btn-success">Search</button>
                        </form>
                        <hr>
                        <table class="table" >
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Surname</th>
                                <th>Year</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($students as $student)
                                <tr>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->surname }}</td>
                                    <td>{{ $student->year }}</td>
                                    <td>
                                        @foreach($student->grades as $grade)
                                            {{ $grade->grade }}
                                        @endforeach
                                    </td>
                                    <td style="width: 100px;">
                                        <a class="btn btn-success" href="{{ route("students.edit",$student->id) }}">Edit</a>
                                    </td>
                                    <td style="width: 100px;">
                                        <form method="post" action="{{ route('students.destroy',$student->id) }}">
                                            @csrf
                                            @method("delete")
                                            <button class="btn btn-danger">Delete</button>
                                        </form>
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
