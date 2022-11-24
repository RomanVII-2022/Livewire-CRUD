<?php

namespace App\Http\Livewire;

use Livewire\WithPagination;
use App\Models\Student;
use Livewire\Component;

class StudentWire extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $name;
    public $email;
    public $course;
    public $student_id;

    public $search = '';

    protected function rules()
    {
        return [
            'name' => 'required|min:6|string',
            'email' => ['required', 'email'],
            'course' => 'required|string',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }
 
    public function addStudent()
    {
        $validatedData = $this->validate();
 
        Student::create($validatedData);
        session()->flash('message', 'Student was added successfully');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function editStudentBtn(int $student_id)
    {
        $student = Student::find($student_id);
        if($student){
            $this->student_id = $student->id;
            $this->name = $student->name;
            $this->email = $student->email;
            $this->course = $student->course;
        } else {
            return redirect()->to('/students');
        }

    }

    public function updateStudent()
    {
        Student::where('id', $this->student_id)->update([
            'name' => $this->name,
            'email' => $this->email,
            'course' => $this->course,
        ]);
        session()->flash('message', 'Student was updated successfully');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function deleteStudentBtn(int $student_id)
    {
        $this->student_id = $student_id;
    }

    public function deleteStudent()
    {
        Student::find($this->student_id)->delete();
        session()->flash('message', 'Student was deleted successfully');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->name = '';
        $this->email='';
        $this->course='';
    }

    public function render()
    {
        $students = Student::orderBy('name')->where('name', 'like', '%'.$this->search.'%')->paginate(2);
        return view('livewire.student-wire', ['students'=>$students]);
    }
}
