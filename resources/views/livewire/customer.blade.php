<div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Customer</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button wire:click="openModal" class="btn btn-sm btn-outline-primary dropdown-toggle">
                <span data-feather="plus"></span>
                Add Customer
            </button>
        </div>
    </div>
    {{-- Header --}}
    {{-- Alert Messages --}}
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Customer Table --}}
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($customers as $customer)
                            <tr>
                                <td>{{ $customer->id }}</td>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->phone ?? '-' }}</td>
                                <td>{{ Str::limit($customer->address ?? '-', 30) }}</td>
                                <td>
                                    <button wire:click="edit({{ $customer->id }})" class="btn btn-sm btn-warning">
                                        <i data-feather="edit"></i>
                                    </button>
                                    <button wire:click="confirmDelete({{ $customer->id }})"
                                        class="btn btn-sm btn-danger">
                                        <i data-feather="trash-2"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    No customers found. <a href="#" wire:click="openModal">Add your first
                                        customer</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Modal --}}
    @if ($showModal)
        <div class="modal fade show d-block" tabindex="-1" style="background-color: rgba(0,0,0,0.5);">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            {{ $editMode ? 'Edit Customer' : 'Add New Customer' }}
                        </h5>
                        <button type="button" class="btn-close" wire:click="closeModal"></button>
                    </div>

                    <form wire:submit.prevent="store">
                        <div class="modal-body">
                            {{-- Name --}}
                            <div class="mb-3">
                                <label class="form-label">Name *</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    wire:model="name" placeholder="Enter customer name">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div class="mb-3">
                                <label class="form-label">Email *</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    wire:model="email" placeholder="Enter email address">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Phone --}}
                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                    wire:model="phone" placeholder="Enter phone number">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Address --}}
                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <textarea class="form-control @error('address') is-invalid @enderror" wire:model="address" rows="3"
                                    placeholder="Enter address"></textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" wire:click="closeModal">Cancel</button>
                            <button type="submit" class="btn btn-primary">
                                {{ $editMode ? 'Update Customer' : 'Save Customer' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    {{-- Delete Confirmation Modal --}}
    @if ($showDeleteModal)
        <div class="modal fade show d-block" tabindex="-1" style="background-color: rgba(0,0,0,0.5);">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-danger">
                            <i data-feather="alert-triangle" class="me-2"></i>
                            Confirm Delete
                        </h5>
                        <button type="button" class="btn-close" wire:click="cancelDelete"></button>
                    </div>

                    <div class="modal-body">
                        <div class="text-center">
                            <div class="mb-3">
                                <i data-feather="trash-2" class="text-danger" style="width: 48px; height: 48px;"></i>
                            </div>
                            <h5 class="mb-3">Are you sure?</h5>
                            <p class="text-muted">
                                You are about to delete customer
                                <strong>"{{ $customerToDelete->name ?? '' }}"</strong>.
                                <br>This action cannot be undone.
                            </p>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="cancelDelete">
                            <i data-feather="x" class="me-1"></i>
                            Cancel
                        </button>
                        <button type="button" class="btn btn-danger" wire:click="delete">
                            <i data-feather="trash-2" class="me-1"></i>
                            Yes, Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
