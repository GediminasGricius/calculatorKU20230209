@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit student</div>

                    <div class="card-body">
                        <form method="post" action="{{ route('students.update',$student->id) }}">
                            @csrf
                            @method("put")
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input  class="form-control" type="text" name="name" value="{{ $student->name }}">
                            </div>
                            <div class="mb-3">
                                <label l class="form-label" >Surname</label>
                                <input  class="form-control" type="text" name="surname" value="{{ $student->surname }}">
                            </div>
                            <div class="mb-3">
                                <label l class="form-label" >Year</label>
                                <input   class="form-control" type="text" name="year" value="{{ $student->year }}">
                            </div>
                            <button class="btn btn-success">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

