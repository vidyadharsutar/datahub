<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Log;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $roles = Role::whereNot('role', 'superadmin')->get();
        $superadminroleid = Role::where('role', 'superadmin')->first()->id;

        if($request->has('search') && !empty($request->input('search'))) {
            $searchTerm = $request->input('search');
            $users = User::where('status', 'active')
                ->where('role_id', '!=', null)
                ->whereNot('role_id', $superadminroleid)
                ->where(function ($query) use ($searchTerm) {
                    $query->where('firstname', 'like', '%' . $searchTerm . '%')
                          ->orWhere('lastname', 'like', '%' . $searchTerm . '%')
                          ->orWhere('email', 'like', '%' . $searchTerm . '%')
                          ->orWhere('department', 'like', '%' . $searchTerm . '%');
                })
                ->get();
        }else if($request->has('roles') && !empty($request->input('roles'))) {
            $roleId = $request->input('roles');
            $users = User::where('status', 'active')
                ->where('role_id', '!=', null)
                ->whereNot('role_id', $superadminroleid)
                ->where('role_id', $roleId)
                ->get();
        }else if($request->has('status') && !empty($request->input('status'))) {
            $status = $request->input('status');
            $users = User::where('status', 'active')
                ->where('role_id', '!=', null)
                ->whereNot('role_id', $superadminroleid)
                ->where('status', $status)
                ->get();
        } else {
            $users = User::where('status', 'active')->where('role_id', '!=', null)->whereNot('role_id', $superadminroleid)->get();
        }
        
        return view('users.index', compact('roles', 'users'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role_id' => 'required|exists:roles,id',
            'department' => 'nullable|string|max:255',
        ]);
        $password = ucfirst($request->firstname)."@1234";
        $validatedData['password'] = bcrypt($password);
        $validatedData['phone'] = null;

        $userId = Auth::user()->id;
        $ipAddress = $request->ip();
        $action = 'CREATE_USER';
        $city = 'Pune';
        
        try {
            User::create($validatedData);
            Log::create([
                'timestamp' => now(),
                'user_id' => $userId,
                'ipaddress' => $ipAddress,
                'action' => $action,
                'description' => "New user created successfully!",
                'location' => $city,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'New RFP created successfully!',
            ], 200);

        } catch (\Exception $e) {
            Log::create([
                'timestamp' => now(),
                'user_id' => $userId,
                'ipaddress' => $ipAddress,
                'action' => $action,
                'description' => $e->getMessage(),
                'location' => $city,
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create user.',
                'description' => $e->getMessage(),
            ], 500);
        }
    }
}
