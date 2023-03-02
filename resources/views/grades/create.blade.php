@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit student</div>

                    <div class="card-body">
                        <form method="post" action="{{ route('grades.store') }}">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Grade</label>
                                <input  class="form-control" type="number" name="grade" value="">
                            </div>
                            <div class="mb-3">
                                <label l class="form-label" >Student</label>

                                <select class="form-select" name="student_id">
                                    @foreach($students as $student)
                                        <option value="{{ $student->id }}">{{ $student->name  }} {{ $student->surname }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button class="btn btn-success">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

