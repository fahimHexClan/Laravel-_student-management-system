<div>
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-primary text-white">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2">
                <h4 class="mb-0">
                    <i class="fas fa-users"></i> 
                    <span class="d-none d-sm-inline">All Students</span>
                    <span class="d-inline d-sm-none">Students</span>
                    <span class="badge bg-light text-primary ms-2">{{ $students->count() }}</span>
                </h4>
                <!-- FIXED: Changed from route link to wire:click -->
                <button wire:click="openCreateModal" class="btn btn-light btn-sm">
                    <i class="fas fa-plus"></i> 
                    <span class="d-none d-sm-inline">Add New Student</span>
                    <span class="d-inline d-sm-none">Add</span>
                </button>
            </div>
        </div>
        
        <!-- Search Section -->
        <div class="card-body bg-light border-bottom">
            <div class="row g-2">
                <div class="col-12">
                    <div class="input-group">
                        <span class="input-group-text bg-white">
                            <i class="fas fa-search text-primary"></i>
                        </span>
                        <input 
                            type="text" 
                            wire:model.live.debounce.300ms="search"
                            class="form-control" 
                            placeholder="Search students... (live search)"
                        >
                        @if($search)
                        <button class="btn btn-outline-secondary" wire:click="$set('search', '')">
                            <i class="fas fa-times"></i>
                        </button>
                        @endif
                    </div>
                </div>
            </div>
            
            @if($search)
            <div class="mt-2">
                <span class="badge bg-secondary">
                    <i class="fas fa-filter"></i> Searching: "{{ $search }}"
                    <button class="btn-close btn-close-white ms-2" style="font-size: 0.6rem;" wire:click="$set('search', '')"></button>
                </span>
            </div>
            @endif
        </div>
        
        <!-- Main Content -->
        <div class="card-body p-0 p-md-3">
            
            @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif
            
            @if($students->count() > 0)
            
            <!-- Loading Indicator -->
            <div wire:loading class="text-center p-3">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-2 text-muted">Searching...</p>
            </div>
            
            <!-- Desktop Table View -->
            <div class="table-responsive d-none d-lg-block" wire:loading.remove>
                <table class="table table-hover table-striped mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th style="width: 5%;">#</th>
                            <th style="width: 20%;">Name</th>
                            <th style="width: 25%;">Email</th>
                            <th style="width: 15%;">Phone</th>
                            <th style="width: 15%;">Course</th>
                            <th style="width: 20%;" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $index => $student)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="fw-semibold">{{ $student->name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->phone }}</td>
                            <td><span class="badge bg-info">{{ $student->course }}</span></td>
                            <td>
                                <div class="d-flex justify-content-center gap-1">
                                    <button wire:click="showStudent({{ $student->id }})" class="btn btn-sm btn-info" title="View">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button wire:click="editStudentModal({{ $student->id }})" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button wire:click="confirmDelete({{ $student->id }})" class="btn btn-sm btn-danger" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Mobile Card View -->
            <div class="d-lg-none" wire:loading.remove>
                @foreach($students as $index => $student)
                <div class="card mb-2 border mx-3">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <h6 class="mb-1 fw-bold text-primary">{{ $student->name }}</h6>
                                <span class="badge bg-info">{{ $student->course }}</span>
                            </div>
                            <span class="badge bg-secondary">#{{ $index + 1 }}</span>
                        </div>
                        
                        <div class="small text-muted mb-2">
                            <div class="mb-1">
                                <i class="fas fa-envelope text-primary"></i> {{ $student->email }}
                            </div>
                            <div>
                                <i class="fas fa-phone text-success"></i> {{ $student->phone }}
                            </div>
                        </div>
                        
                        <div class="d-flex gap-1 flex-wrap">
                            <button wire:click="showStudent({{ $student->id }})" class="btn btn-sm btn-info flex-fill">
                                <i class="fas fa-eye"></i> View
                            </button>
                            <button wire:click="editStudentModal({{ $student->id }})" class="btn btn-sm btn-warning flex-fill">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button wire:click="confirmDelete({{ $student->id }})" class="btn btn-sm btn-danger flex-fill">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            @else
            
            <div class="alert alert-warning text-center m-3" wire:loading.remove>
                @if($search)
                    <i class="fas fa-search"></i> No results for "{{ $search }}"
                @else
                    <i class="fas fa-exclamation-triangle"></i> No students yet. 
                    <button wire:click="openCreateModal" class="btn btn-sm btn-primary ms-2">
                        <i class="fas fa-plus"></i> Add first student
                    </button>
                @endif
            </div>
            
            @endif
            
        </div>
    </div>

    <!-- CREATE MODAL -->
    <div class="modal fade" id="createModal" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-user-plus"></i> Add New Student
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" wire:click="resetEditForm"></button>
                </div>
                <form wire:submit.prevent="createStudent">
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" wire:model="name" class="form-control @error('name') is-invalid @enderror" placeholder="Full name">
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" wire:model="email" class="form-control @error('email') is-invalid @enderror" placeholder="email@example.com">
                                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                                <input type="text" wire:model="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Phone number">
                                @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label for="date_of_birth" class="form-label">Date of Birth <span class="text-danger">*</span></label>
                                <input type="date" wire:model="date_of_birth" class="form-control @error('date_of_birth') is-invalid @enderror">
                                @error('date_of_birth') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            
                            <div class="col-12">
                                <label for="course" class="form-label">Course <span class="text-danger">*</span></label>
                                <select wire:model="course" class="form-select @error('course') is-invalid @enderror">
                                    <option value="">-- Select Course --</option>
                                    <option value="Computer Science">Computer Science</option>
                                    <option value="Information Technology">Information Technology</option>
                                    <option value="Electronics">Electronics</option>
                                    <option value="Mechanical">Mechanical</option>
                                    <option value="Civil">Civil</option>
                                </select>
                                @error('course') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            
                            <div class="col-12">
                                <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                                <textarea wire:model="address" rows="3" class="form-control @error('address') is-invalid @enderror" placeholder="Full address"></textarea>
                                @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="resetEditForm">Cancel</button>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Save Student
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- VIEW MODAL -->
    @if($viewStudent)
    <div class="modal fade" id="viewModal" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-user"></i> Student Details
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="text-muted small text-uppercase mb-1">Full Name</label>
                            <p class="h6 mb-0 fw-bold">{{ $viewStudent->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted small text-uppercase mb-1">Email Address</label>
                            <p class="h6 mb-0">
                                <i class="fas fa-envelope text-primary"></i> 
                                {{ $viewStudent->email }}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted small text-uppercase mb-1">Phone Number</label>
                            <p class="h6 mb-0">
                                <i class="fas fa-phone text-success"></i> 
                                {{ $viewStudent->phone }}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted small text-uppercase mb-1">Date of Birth</label>
                            <p class="h6 mb-0">
                                <i class="fas fa-calendar text-danger"></i> 
                                {{ date('d M Y', strtotime($viewStudent->date_of_birth)) }}
                            </p>
                        </div>
                        <div class="col-12">
                            <label class="text-muted small text-uppercase mb-1">Course</label>
                            <p class="mb-0">
                                <span class="badge bg-info fs-6 px-3 py-2">
                                    <i class="fas fa-book"></i> {{ $viewStudent->course }}
                                </span>
                            </p>
                        </div>
                        <div class="col-12">
                            <label class="text-muted small text-uppercase mb-1">Address</label>
                            <p class="h6 mb-0">
                                <i class="fas fa-map-marker-alt text-warning"></i> 
                                {{ $viewStudent->address }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" wire:click="editStudentModal({{ $viewStudent->id }})" class="btn btn-warning" data-bs-dismiss="modal">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
    
    <!-- EDIT MODAL -->
    @if($editStudent)
    <div class="modal fade" id="editModal" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title">
                        <i class="fas fa-user-edit"></i> Edit Student
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="resetEditForm"></button>
                </div>
                <form wire:submit.prevent="updateStudent">
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" wire:model="name" class="form-control @error('name') is-invalid @enderror" placeholder="Full name">
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" wire:model="email" class="form-control @error('email') is-invalid @enderror" placeholder="email@example.com">
                                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                                <input type="text" wire:model="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Phone number">
                                @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label for="date_of_birth" class="form-label">Date of Birth <span class="text-danger">*</span></label>
                                <input type="date" wire:model="date_of_birth" class="form-control @error('date_of_birth') is-invalid @enderror">
                                @error('date_of_birth') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            
                            <div class="col-12">
                                <label for="course" class="form-label">Course <span class="text-danger">*</span></label>
                                <select wire:model="course" class="form-select @error('course') is-invalid @enderror">
                                    <option value="">-- Select Course --</option>
                                    <option value="Computer Science">Computer Science</option>
                                    <option value="Information Technology">Information Technology</option>
                                    <option value="Electronics">Electronics</option>
                                    <option value="Mechanical">Mechanical</option>
                                    <option value="Civil">Civil</option>
                                </select>
                                @error('course') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            
                            <div class="col-12">
                                <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                                <textarea wire:model="address" rows="3" class="form-control @error('address') is-invalid @enderror" placeholder="Full address"></textarea>
                                @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="resetEditForm">Cancel</button>
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-save"></i> Update Student
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
    
    <!-- DELETE MODAL -->
    <div class="modal fade" id="deleteModal" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-exclamation-triangle"></i> Confirm Delete
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0">Are you sure you want to delete this student? This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" wire:click="deleteStudent" class="btn btn-danger">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- JavaScript for Modal Control -->
    <script>
      document.addEventListener('livewire:init', () => {
            Livewire.on('show-create-modal', () => {
                new bootstrap.Modal(document.getElementById('createModal')).show();
            });
            
            Livewire.on('close-create-modal', () => {
                const createModal = bootstrap.Modal.getInstance(document.getElementById('createModal'));
                if (createModal) createModal.hide();
            });
            
            Livewire.on('show-view-modal', () => {
                new bootstrap.Modal(document.getElementById('viewModal')).show();
            });
            
            Livewire.on('show-edit-modal', () => {
                // Close view modal if open
                const viewModal = bootstrap.Modal.getInstance(document.getElementById('viewModal'));
                if (viewModal) viewModal.hide();
                
                new bootstrap.Modal(document.getElementById('editModal')).show();
            });
            
            Livewire.on('close-edit-modal', () => {
                const editModal = bootstrap.Modal.getInstance(document.getElementById('editModal'));
                if (editModal) editModal.hide();
            });
            
            Livewire.on('show-delete-modal', () => {
                new bootstrap.Modal(document.getElementById('deleteModal')).show();
            });
            
            Livewire.on('close-delete-modal', () => {
                const deleteModal = bootstrap.Modal.getInstance(document.getElementById('deleteModal'));
                if (deleteModal) deleteModal.hide();
            });
        });
    </script>
</div>