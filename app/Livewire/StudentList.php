<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Student;
use Illuminate\Validation\Rule;

class StudentList extends Component
{
    public $search = '';
    public $students;
    
    // Delete Modal
    public $deleteId;
    
    // View Modal
    public $viewStudent;
    
    // Edit Modal
    public $editStudent;
    public $name;
    public $email;
    public $phone;
    public $date_of_birth;
    public $course;
    public $address;
    
    protected function rules()
    {
        return [
            'name' => 'required|min:3',
            'email' => ['required', 'email', Rule::unique('students')->ignore($this->editStudent->id ?? null)],
            'phone' => 'required',
            'date_of_birth' => 'required|date',
            'course' => 'required',
            'address' => 'required|min:5',
        ];
    }
    
    public function mount()
    {
        $this->loadStudents();
    }
    
    // Added Create Modal method
    public function openCreateModal()
    {
        $this->resetEditForm();
        $this->dispatch('show-create-modal');
    }
    
    // Added Create Student method
    public function createStudent()
    {
        $this->validate();
        
        Student::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'date_of_birth' => $this->date_of_birth,
            'course' => $this->course,
            'address' => $this->address,
        ]);
        
        $this->loadStudents();
        $this->resetEditForm();
        session()->flash('success', 'Student added successfully!');
        $this->dispatch('close-create-modal');
    }
    
    public function updatedSearch()
    {
        $this->loadStudents();
    }
    
    public function loadStudents()
    {
        $this->students = Student::when($this->search, function($query) {
            $query->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%')
                  ->orWhere('phone', 'like', '%' . $this->search . '%')
                  ->orWhere('course', 'like', '%' . $this->search . '%');
        })->latest()->get();
    }
    
    // View Student Modal
    public function showStudent($id)
    {
        $this->viewStudent = Student::find($id);
        $this->dispatch('show-view-modal');
    }
    
    // Edit Student Modal
    public function editStudentModal($id)
    {
        $this->editStudent = Student::find($id);
        
        if ($this->editStudent) {
            $this->name = $this->editStudent->name;
            $this->email = $this->editStudent->email;
            $this->phone = $this->editStudent->phone;
            $this->date_of_birth = $this->editStudent->date_of_birth;
            $this->course = $this->editStudent->course;
            $this->address = $this->editStudent->address;
            
            $this->dispatch('show-edit-modal');
        }
    }
    
    public function updateStudent()
    {
        $this->validate();
        
        if ($this->editStudent) {
            $this->editStudent->update([
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'date_of_birth' => $this->date_of_birth,
                'course' => $this->course,
                'address' => $this->address,
            ]);
            
            $this->loadStudents();
            $this->resetEditForm();
            session()->flash('success', 'Student updated successfully!');
            $this->dispatch('close-edit-modal');
        }
    }
    
    public function resetEditForm()
    {
        $this->editStudent = null;
        $this->name = '';
        $this->email = '';
        $this->phone = '';
        $this->date_of_birth = '';
        $this->course = '';
        $this->address = '';
        $this->resetValidation();
    }
    
    // Delete Student Modal
    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->dispatch('show-delete-modal');
    }
    
    public function deleteStudent()
    {
        if ($this->deleteId) {
            Student::find($this->deleteId)->delete();
            $this->deleteId = null;
            $this->loadStudents();
            session()->flash('success', 'Student deleted successfully!');
            $this->dispatch('close-delete-modal');
        }
    }
    
    public function render()
    {
        return view('livewire.student-list');
    }
}