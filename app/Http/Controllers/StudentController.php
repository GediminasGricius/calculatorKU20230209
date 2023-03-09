<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StudentController extends Controller
{
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
}
