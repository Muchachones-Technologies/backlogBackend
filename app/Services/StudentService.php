<?php

namespace App\Services;

use App\Models\Student;
use App\Repositories\StudentRepository;

class StudentService
{
    protected $studentRepository;

    public function __construct(StudentRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }
    public function create(array $data)
    {
        session(['name'=>'carlos']);

        return $this->studentRepository->create($data);
    }
}
