<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function showRegister()
    {
        return view('pages.register');
    }

    public function showLogin()
    {
        return view('pages.login');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'name' => ['required', 'string', 'max:255'],
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'name' => $request->name,
            'user_type' => 'user', // Default user type
        ]);

        Auth::login($user);

        return redirect()->route('user.dashboard');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            
            // Redirect based on user type
            if (Auth::user()->user_type === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('user.dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    /**
     * Get all users for admin management
     */
    public function getUsers(Request $request)
    {
        $query = User::query();
        
        // Filter by user type if specified
        if ($request->has('user_type') && $request->user_type !== 'all') {
            $query->where('user_type', $request->user_type);
        }
        
        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%");
            });
        }
        
        $users = $query->orderBy('created_at', 'desc')->get();
        
        return response()->json([
            'success' => true,
            'users' => $users->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'username' => $user->username ?? $user->name,
                    'email' => $user->email,
                    'user_type' => $user->user_type,
                    'status' => 'active', // You can add a status field to the database if needed
                    'created_at' => $user->created_at->format('M d, Y'),
                    'polls_created' => $user->createdPolls()->count(),
                    'votes_count' => $user->votes()->count(),
                ];
            }),
        ]);
    }

    /**
     * Update user details
     */
    public function updateUser(Request $request, User $user)
    {
        // Prevent users from editing themselves or other admins (unless they're super admin)
        if ($user->id === Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'You cannot edit your own account through this interface.',
            ], 403);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'username' => ['nullable', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'user_type' => ['required', Rule::in(['user', 'admin'])],
            'password' => ['nullable', 'string', 'min:8'],
        ]);

        try {
            $updateData = [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'user_type' => $validated['user_type'],
            ];

            if (!empty($validated['username'])) {
                $updateData['username'] = $validated['username'];
            }

            if (!empty($validated['password'])) {
                $updateData['password'] = Hash::make($validated['password']);
            }

            $user->update($updateData);

            return response()->json([
                'success' => true,
                'message' => 'User updated successfully!',
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'username' => $user->username ?? $user->name,
                    'email' => $user->email,
                    'user_type' => $user->user_type,
                    'status' => 'active',
                ],
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update user. Please try again.',
            ], 500);
        }
    }

    /**
     * Delete user
     */
    public function deleteUser(User $user)
    {
        // Prevent deletion of own account
        if ($user->id === Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'You cannot delete your own account.',
            ], 403);
        }

        // Check if user has created polls or votes
        $pollsCount = $user->createdPolls()->count();
        $votesCount = $user->votes()->count();

        if ($pollsCount > 0 || $votesCount > 0) {
            return response()->json([
                'success' => false,
                'message' => "Cannot delete user. They have {$pollsCount} polls and {$votesCount} votes associated with their account.",
            ], 400);
        }

        try {
            $user->delete();

            return response()->json([
                'success' => true,
                'message' => 'User deleted successfully!',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete user. Please try again.',
            ], 500);
        }
    }

    /**
     * Create new user (admin only)
     */
    public function createUser(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['nullable', 'string', 'max:255', 'unique:users'],
            'user_type' => ['required', Rule::in(['user', 'admin'])],
            'password' => ['required', 'string', 'min:8'],
        ]);

        try {
            $userData = [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'user_type' => $validated['user_type'],
                'password' => Hash::make($validated['password']),
            ];

            if (!empty($validated['username'])) {
                $userData['username'] = $validated['username'];
            }

            $user = User::create($userData);

            return response()->json([
                'success' => true,
                'message' => 'User created successfully!',
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'username' => $user->username ?? $user->name,
                    'email' => $user->email,
                    'user_type' => $user->user_type,
                    'status' => 'active',
                    'created_at' => $user->created_at->format('M d, Y'),
                    'polls_created' => 0,
                    'votes_count' => 0,
                ],
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create user. Please try again.',
            ], 500);
        }
    }

    /**
     * Get user statistics
     */
    public function getUserStats()
    {
        $totalUsers = User::count();
        $adminUsers = User::where('user_type', 'admin')->count();
        $regularUsers = User::where('user_type', 'user')->count();
        $recentUsers = User::where('created_at', '>=', now()->subDays(30))->count();

        return response()->json([
            'success' => true,
            'stats' => [
                'total_users' => $totalUsers,
                'admin_users' => $adminUsers,
                'regular_users' => $regularUsers,
                'recent_users' => $recentUsers,
            ],
        ]);
    }
}
