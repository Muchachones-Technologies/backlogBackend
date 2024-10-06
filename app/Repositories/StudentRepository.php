<?php
namespace App\Repositories;

use App\Models\Student;

class StudentRepository
{
    public function getAll()
    {
        return Student::all();
    }

    public function find($id)
    {
        return Student::findOrFail($id);
    }

    public function create(array $data)
    {
        return Student::create($data);
    }

    public function update(Student $student, array $data)
    {
        $student->update($data);
        return $student;
    }

    public function delete(Student $student)
    {
        $student->delete();
    }
}
