<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Models\Player;
use App\Models\Umpire;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;  
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Users extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $search = '';
    public $selectedRole = 'umpire';
    public $verificationStatus = '';
    public $selectedUserId = null;

    // Form properties for creating new users
    public $name = '';
    public $email = '';
    public $phone_number = '';
    public $role_id = 'player';
    public $bio = '';
    public $profile_photo;
    public $password = '';

    // Player specific fields
    public $date_of_birth = '';
    public $gender = '';
    public $nationality = '';
    public $playing_hand = 'right';

    // Umpire specific fields
    public $status = 'available';

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'phone_number' => 'nullable|string|max:20',
        'role_id' => 'required|in:player,umpire',
        'bio' => 'nullable|string',
        'profile_photo' => 'nullable|image|max:1024', // max 1MB
        'password' => 'required|min:8',
        
        // Player validation rules
        'date_of_birth' => 'required_if:role_id,player|date',
        'gender' => 'required_if:role_id,player|in:male,female,other',
        'nationality' => 'required_if:role_id,player|string|max:50',
        'playing_hand' => 'required_if:role_id,player|in:right,left,ambidextrous',
        
        // Umpire validation rules
        'status' => 'required_if:role_id,umpire|in:available,unavailable',
    ];

    public function createUser()
    {
        $this->validate();

        try {
            DB::transaction(function () {
                // Create base user
                $user = User::create([
                    'name' => $this->name,
                    'email' => $this->email,
                    'password' => Hash::make($this->password),
                    'role_id' => $this->role_id,
                    'email_verified_at' => now(),
                    'admin_verified_at' => now(),
                ]);

                // Handle profile photo if uploaded
                $profile_photo_path = null;
                if ($this->profile_photo) {
                    $profile_photo_path = $this->profile_photo->store('profile-photos', 'public');
                }

                // Create related model based on role
                if ($this->role_id === 'player') {
                    Player::create([
                        'user_id' => $user->id,
                        'phone_number' => $this->phone_number,
                        'date_of_birth' => $this->date_of_birth,
                        'gender' => $this->gender,
                        'nationality' => $this->nationality,
                        'playing_hand' => $this->playing_hand,
                        'matches_played' => 0,
                        'matches_won' => 0,
                        'bio' => $this->bio,
                        'profile_photo' => $profile_photo_path,
                    ]);
                } else {
                    Umpire::create([
                        'user_id' => $user->id,
                        'phone_number' => $this->phone_number,
                        'status' => $this->status,
                        'bio' => $this->bio,
                        'profile_photo' => $profile_photo_path,
                    ]);
                }
            });

            $this->resetForm();
            $this->dispatch('user-created');
            $this->js("document.querySelector('[data-modal=\"create-user-modal\"]').close()");

        } catch (\Exception $e) {
            $this->addError('email', 'Error creating user. Please try again.');
        }
    }

    public function resetForm()
    {
        $this->reset([
            'name', 'email', 'phone_number', 'role_id', 'bio', 'profile_photo',
            'date_of_birth', 'gender', 'nationality', 'playing_hand',
            'status', 'password'
        ]);
        $this->resetValidation();
    }

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
