<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.app')]
#[Title('User Management')]
class Users extends Component
{
    use WithPagination;

    public string $search = '';
    public string $role = '';
    public string $status = '';
    
    public function render()
    {
        $users = User::query()
            ->when($this->search, function ($query) {
                $query->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->role, function ($query) {
                $query->where('role_id', $this->role);
            })
            ->when($this->status, function ($query) {
                if ($this->status === 'verified') {
                    $query->whereNotNull('email_verified_at');
                } elseif ($this->status === 'unverified') {
                    $query->whereNull('email_verified_at');
                }
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.admin.users', [
            'users' => $users
        ]);
    }

    public function verifyUser($userId)
    {
        $user = User::findOrFail($userId);
        $user->email_verified_at = now();
        $user->save();
    }

    public function toggleUserStatus($userId)
    {
        $user = User::findOrFail($userId);
        // Here we'll add a new column 'is_active' to handle user status
        $user->is_active = !$user->is_active;
        $user->save();
    }
}