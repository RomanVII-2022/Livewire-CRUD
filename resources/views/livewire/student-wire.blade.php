<div>
    <div class="container">  
        @if (session()->has('message'))
            <h5 class="alert alert-success"> {{ session('message') }} </h5>
        @endif       
        <div class="card">
            <div class="card-header">
              Students
              <input type="search" wire:model="search" style="width: 230px; float: right;" placeholder="Search..." />
              <button type="button" class="btn btn-sm btn-secondary" style="float: right;" data-bs-toggle="modal" 
              data-bs-target="#addStudentModal">Add Student</button>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Course</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @forelse ($students as $student)
                        <tr>
                            <th scope="row">{{ $student->id }}</th>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->course }}</td>
                            <td><button wire:click="editStudentBtn({{ $student->id }})" type="button" class="btn btn-primary" data-bs-toggle="modal" 
                                data-bs-target="#editStudentModal">Update</button> -
                                <button wire:click="deleteStudentBtn({{ $student->id }})" type="button" class="btn btn-danger" data-bs-toggle="modal" 
                                data-bs-target="#deleteStudentModal">Delete</button></td>
                        </tr>
                        @empty
                        <tr>
                            <th scope="row" colspan="5" style="text-align: center;">No Data Found</th>
                        </tr>
                        @endforelse
                      
                    </tbody>
                  </table>
                  <div>
                    {{ $students->links() }}
                  </div>
            </div>
        </div>
    </div>

    <!-- Add Student Modal -->
    <div wire:ignore.self class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addStudentModalLabel">Add Student</h1>
                    <button wire:click="closeModal" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="addStudent">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Name</label>
                            <input type="text" class="form-control" wire:model="name">
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Email address</label>
                          <input type="email" class="form-control" wire:model="email">
                          @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Course</label>
                            <input type="text" class="form-control" wire:model="course">
                            @error('course') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Add Student</button>
                    </form>
                </div>
                <div class="modal-footer">
                    
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Student Modal -->
    <div wire:ignore.self class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="editStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editStudentModalLabel">Edit Student</h1>
                    <button wire:click="closeModal" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="updateStudent">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Name</label>
                            <input type="text" class="form-control" wire:model="name">
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Email address</label>
                          <input type="email" class="form-control" wire:model="email">
                          @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Course</label>
                            <input type="text" class="form-control" wire:model="course">
                            @error('course') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Update Student</button>
                    </form>
                </div>
                <div class="modal-footer">
                    
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Student Modal -->
    <div wire:ignore.self class="modal fade" id="deleteStudentModal" tabindex="-1" aria-labelledby="deleteStudentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteStudentModalLabel">Delete Student</h1>
                    <button wire:click="closeModal" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="deleteStudent">
                        <p class="text-danger"> Are you sure you want to delete this student? </p>
                        <button type="submit" class="btn btn-primary">Delete Student</button>
                    </form>
                </div>
                <div class="modal-footer">
                    
                </div>
            </div>
        </div>
    </div>
</div>
