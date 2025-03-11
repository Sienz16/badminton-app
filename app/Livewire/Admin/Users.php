<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class Users extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedRole = 'umpire';
    public $verificationStatus = '';
    public $selectedUserId = null;

    public function verifyUser()
    {
        try {
            $user = User::findOrFail($this->selectedUserId);
            
            if (!$user->admin_verified_at) {
                $user->admin_verified_at = now();
                $user->email_verified_at = now();
                $user->save();
            }
            
            $this->selectedUserId = null;
            
            // Use JS dispatch to force modal close
            $this->js("document.querySelector('[data-modal=\"verify-user-modal\"]').close()");
            
        } catch (\Exception $e) {
            logger('Error verifying user: ' . $e->getMessage());
            throw $e;
        }
    }

    public function render()
    {
        $users = User::query()
            ->where('role_id', $this->selectedRole)
            ->when($this->selectedRole === 'admin', function ($query) {
                $query->where('id', '!=', Auth::id());
            })
            ->when($this->search, function ($query) {
                $query->where(function ($query) {
                    $query->where('name', 'like', '%'.$this->search.'%')
                        ->orWhere('email', 'like', '%'.$this->search.'%');
                });
            })
            ->when($this->verificationStatus, function ($query) {
                if ($this->verificationStatus === 'verified') {
                    $query->whereNotNull('admin_verified_at');
                } elseif ($this->verificationStatus === 'unverified') {
                    $query->whereNull('admin_verified_at');
                }
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Get counts for the current role
        $verifiedCount = User::query()
            ->where('role_id', $this->selectedRole)
            ->whereNotNull('admin_verified_at')
            ->when($this->selectedRole === 'admin', function ($query) {
                $query->where('id', '!=', Auth::id());
            })
            ->count();

        $pendingCount = User::query()
            ->where('role_id', $this->selectedRole)
            ->whereNull('admin_verified_at')
            ->when($this->selectedRole === 'admin', function ($query) {
                $query->where('id', '!=', Auth::id());
            })
            ->count();

        return view('livewire.admin.users.index', [
            'users' => $users,
            'verifiedCount' => $verifiedCount,
            'pendingCount' => $pendingCount,
            'umpireCount' => User::where('role_id', 'umpire')->count(),
            'playerCount' => User::where('role_id', 'player')->count(),
            'adminCount' => User::where('role_id', 'admin')->where('id', '!=', Auth::id())->count(),
        ]);
    }

    public function toggleUserStatus($userId)
    {
        $user = User::findOrFail($userId);
        $user->is_active = !$user->is_active;
        $user->save();
    }

    public function updating($field)
    {
        if (in_array($field, ['search', 'selectedRole', 'verificationStatus'])) {
            $this->resetPage();
        }
    }

    public function mount()
    {
        $this->selectedRole = 'umpire';
    }
}
