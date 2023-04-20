<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;

class StudentController extends Controller
{
    public function __construct(){
       // $this->middleware('random');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $searchStudentName=$request->session()->get('searchStudentName');

        if ($searchStudentName!=null){
            $students=Student::where('name','like',"%$searchStudentName%")->with('grades')->get();
        }else{
            $students=Student::with('grades')->get();
        }

        return view("students.index",[
            "students"=>$students,
            "searchStudentName"=>$searchStudentName
            //"students"=>Student::with('grades')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view("students.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|min:2',
            'surname'=>'required|min:2',
            'year'=>'required|digits:4'
        ],[
            "name"=>__("Name is required and must be at least 2 characters"),
            "surname"=>__("Surname is required and must be at least 2 characters"),
            "year"=>__("Year must be provided and must have 4 digits")
        ]);

        $student=new Student();
        $student->name=$request->name;
        $student->surname=$request->surname;
        $student->year=$request->year;
        $student->save();
        return redirect()->route("students.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return Response
     */
    public function edit(Student $student)
    {
        return view("students.edit",[
           "student" =>$student
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return Response
     */
    public function update(Request $request, Student $student)
    {
        $student->name=$request->name;
        $student->surname=$request->surname;
        $student->year=$request->year;

        if ($request->file("image")!=null){
            if ($student->image!=null){
                unlink( storage_path()."/app/public/students/".$student->image );
            }
            $request->file("image")->store('/public/students');
            $student->image=$request->file('image')->hashName();
        }

        if ($request->file('agreement')!=null){
            if ($student->agreement!=null){
                unlink(storage_path()."/app/agreements/".$student->agreement);
            }
            $request->file('agreement')->store("/agreements");
            $student->agreement=$request->file('agreement')->hashName();
        }

        $student->save();
        return redirect()->route("students.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return Response
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route("students.index");
    }

    public function search(Request $request){
        $request->session()->put('searchStudentName', $request->name);
        return redirect()->route("students.index");


    }

    public function getAgreement($studentId){
        $student=Student::find($studentId);
        if ($student->agreement==null){
            return redirect()->route("students.index");
        }
        return response()->download(storage_path()."/app/agreements/".$student->agreement);
    }
}
