<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Models\Student;
use App\Services\StudentService;
use Exception;
class studentController extends Controller
{
    protected $studentService;

    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }
    //
    public function index(){
        try{
            $students = Student::all();
            if($students->isEmpty()){
                return response()->json(['message'=> 'No hay estudiantes registrados'], 404);
            }
            return response()->json($students, 200);
        }catch(Exception $e){
            return response()->json(['message'=> $e->getMessage()], 404);

        }
     
    }

    public function store(StoreStudentRequest $request){
     
        try{
            $validator = $request->validated();
            $student =  $this->studentService->create($validator);
            if(!$student){
                $data = [
                    'message'=> 'Error al crear estudiante',
                    'status'=> '500'
                ];
                return response()->json($data,500);
            }
            $data = [
                'student'=> $student,
                'message'=> 'Estudiante creado correctamente',
                'status'=> '201'
            ];
            return response()->json($data,201);
        }catch(Exception $e){
            $data = [
                'message'=> $e->getMessage(),
                'status'=> '201'
            ];
            return response()->json($data,201);
        }
      

    }
}
