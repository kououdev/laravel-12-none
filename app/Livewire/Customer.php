<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Customer as CustomerModel;

class Customer extends Component
{
    public $customers;
    public $showModal = false;
    public $showDeleteModal = false;
    public $editMode = false;
    public $customerId;
    public $customerToDelete;

    // Form properties
    public $name;
    public $email;
    public $phone;
    public $address;

    public function rules()
    {
        return [
            'name' => 'required|min:2',
            'email' => [
                'required',
                'email',
                'unique:customers,email' . ($this->editMode && $this->customerId ? ',' . $this->customerId : '')
            ],
            'phone' => 'nullable|string',
            'address' => 'nullable|string'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Customer name is required.',
            'name.min' => 'Customer name must be at least 2 characters.',
            'email.required' => 'Email address is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address is already registered with another customer.',
        ];
    }

    public function mount()
    {
        $this->loadCustomers();
    }

    public function loadCustomers()
    {
        $this->customers = CustomerModel::latest()->get();
    }

    public function updated($propertyName)
    {
        // Real-time validation untuk email
        if ($propertyName === 'email') {
            $this->validateOnly('email');
        }
    }

    public function openModal()
    {
        $this->showModal = true;
        $this->editMode = false;
        $this->resetForm();
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
        $this->resetValidation();
    }

    public function resetForm()
    {
        $this->customerId = null;
        $this->name = '';
        $this->email = '';
        $this->phone = '';
        $this->address = '';
    }

    public function store()
    {
        try {
            $this->validate();

            if ($this->editMode) {
                $customer = CustomerModel::find($this->customerId);
                $customer->update([
                    'name' => $this->name,
                    'email' => $this->email,
                    'phone' => $this->phone,
                    'address' => $this->address
                ]);
                $message = 'Customer updated successfully!';
            } else {
                CustomerModel::create([
                    'name' => $this->name,
                    'email' => $this->email,
                    'phone' => $this->phone,
                    'address' => $this->address
                ]);
                $message = 'Customer created successfully!';
            }

            $this->closeModal();
            $this->loadCustomers();
            session()->flash('message', $message);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors (including unique email)
            throw $e;
        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred while saving the customer.');
        }
    }

    public function edit($id)
    {
        $customer = CustomerModel::find($id);

        $this->customerId = $customer->id;
        $this->name = $customer->name;
        $this->email = $customer->email;
        $this->phone = $customer->phone;
        $this->address = $customer->address;

        $this->editMode = true;
        $this->showModal = true;
    }

    public function confirmDelete($id)
    {
        $this->customerToDelete = CustomerModel::find($id);
        $this->showDeleteModal = true;
    }

    public function cancelDelete()
    {
        $this->showDeleteModal = false;
        $this->customerToDelete = null;
    }

    public function delete()
    {
        if ($this->customerToDelete) {
            $this->customerToDelete->delete();
            $this->loadCustomers();

            session()->flash('message', 'Customer deleted successfully!');
        }

        $this->cancelDelete();
    }
    public function render()
    {
        return view('livewire.customer')
            ->layout('layouts.app')
            ->title('Customer Management');
    }
}
