<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Student::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
           'firstName' => 'required',
           'lastName' => 'required',
           'email' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        }
        $Student = Student::create($input);
        return response()->json([
            'success' => true,
            'message' => 'Student registered suuccessfully!',
            'student' => $Student
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Student::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Student::where('id', $id)->firstOrFail()) {
            $student = Student::findOrFail($id);
            $student->firstName = $request->firstName;
            $student->lastName = $request->lastName;
            $student->email = $request->email;
            $student->save();
            return response() ->json([
              'message' => 'Student Record Updated Successfully'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Student Record Not Found'
            ], 404);
        }        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Student::where('id', $id)->firstOrFail()){
        $student = Student::findOrFail($id);
        $student ->delete();
        return response()->json([
            'message' => 'Student Record Deleted Successfully'
        ], 200);
        } else {
            return response()->json([
                'message' => 'Student Record Not Found'
            ], 404);
        }        

    }
}
