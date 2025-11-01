<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterStudentRequest;
use App\Models\Book;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Traits\GetOne;
use PHPUnit\Framework\MockObject\Builder\Stub;

class StudentController extends Controller
{
    use GetOne;

    /**
     * Display a listing of the resource.
     */

    public function loginStudent(Request $request)
    {

        $student = Student::where('name', $request->name)->first();

        if (!$student) {
            return jsonResponse(null, 'No Stundent Was Found', 404);
        }

        if ($student->password !== $request->password) {
            return jsonResponse(null, 'Password does not match', 401);
        }

        $token = $student->createToken('Student', ['student-access'])->plainTextToken;
        $bookIds = $student->books->pluck('id')->toArray();

        return jsonResponse(['token' => $token, 'Student' => $student, 'count' => count($student->books), 'role' => 'student','bookIds' => $bookIds], 'Token has been created successfully', 201);
    }




    /**
     * Store a newly created resource in storage.
     */
    public function registerStudent(RegisterStudentRequest $request)
    {
        $name = $request->name;
        $old_name = Student::where('name', $name)->first();
        if ($old_name) {
            return jsonResponse($old_name, 'student already exists', 409);
        }

        $validatedData = $request->validated();


        if ($request->image) {
            $newImageName = time() . '-' . $request->name . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $newImageName);
        }
        $data = Student::create([
            'name' => $validatedData['name'],
            'password' => $validatedData['password'],
            'age' => $validatedData['age'],
            'gender' => $validatedData['gender'],
            'course' => $validatedData['course'],
            'image_path' => $newImageName ?? null

        ]);

        return jsonResponse($data, 'Student has been created succesfully', 201);
    }

    /**
     * Display the specified resource.
     */


    /**
     * Update the specified resource in storage.
     */

    /**
     * Remove the specified resource from storage.
     */


    public function rentBook(Request $request, $student_id)
    {

        Log::info($request);
        $student = Student::with('books')->where('student_id', $student_id)->first();

        $student->books()->syncwithoutDetaching($request->arrayId);

        $data = [
            'student' => $student->load('books'),
            'count' => count($student->books)   

        ];
        return jsonResponse($data, 'Books have been rented sucessfully', 201);
    }

    public function getStudentBooks($student_id)
    {
        $books = Book::all();

        $student = Student::with('books')->where('student_id', $student_id)->first();

        $bookIds = $student->books->pluck('id')->toArray();

        $data = ['books' => $books, 'bookIds' => $bookIds];

        return jsonResponse($data, 'list of all the books', 200);
    }

    public function getRentBooks($student_id)
    {
        // below is a lazy loading

        // $student = Student::findOrFail($student_id);
        // return jsonResponse($student,'Sucess',200);

        // bellow is eager loading
        // $student = Student::with('books')->findOrFail($student_id);

        $student = Student::with('books')->where('student_id', $student_id)->first();

        // $student->books
        return response()->json([
            'student' => $student,
            'count' => count($student->books)

        ]);
    }
}
