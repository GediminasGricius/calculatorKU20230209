@extends("layouts.calculator")
@section("content")
         <div class="col-md-12 mt-5">
             <div class="card">
                 <div class="card-header">Calculator</div>
                 <div class="card-body">
                     <form action="{{ route("result") }}" method="post">
                         @csrf
                         <div class="mb-3">
                             <label class="form-label" >Number x:</label>
                             <input class="form-control" type="text" name="x" >
                         </div>
                         <div class="mb-3" >
                             <label class="form-label">Number y:</label>
                             <input class="form-control" type="text" name="y">
                         </div>
                         <button type="submit" class="btn btn-success" >Calculate</button>
                     </form>
                 </div>
             </div>
         </div>
@endsection
