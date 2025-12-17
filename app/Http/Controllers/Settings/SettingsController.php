<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Log as ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('settings.index', compact('user'));
    }

    public function profileSetting(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'role' => 'in:user,admin,superadmin',
            'department' => 'nullable|string|max:255',
        ]);

        $userId = Auth::user()->id;
        $ipAddress = $request->ip();
        $action = 'UPDATE_PROFILE';
        $city = 'Pune';

        try {
            $user = $user->update([
                'firstname' => $request->input('firstname'),
                'lastname' => $request->input('lastname'),
                'phone' => $request->input('phone'),
                'role' => $request->input('role'),
                'department' => $request->input('department'),
            ]);

            if($user) {
                $user = Auth::user();
            }else{
                dd('Failed to update profile.');
            }
            
            ActivityLog::create([
                'timestamp' => now(),
                'user_id' => $userId,
                'ipaddress' => $ipAddress,
                'action' => $action,
                'description' => "Profile updated successfully!",
                'location' => $city,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Profile updated successfully!',
            ], 200);
        } catch (\Exception $e) {
            $log = ActivityLog::create([
                'timestamp' => now(),
                'user_id' => $userId,
                'ipaddress' => $ipAddress,
                'action' => $action,
                'description' => $e->getMessage(),
                'location' => $city,
            ]);
            dd($log);

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create user.',
            ], 500);
        }
    }

    public function profileSecurity(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'two_factor_auth' => 'in:on,off',
            'session_timeout' => 'in:5,10,30',
        ]);

        if($request->filled('currentpassword') || $request->filled('newpassword') || $request->filled('newpassword_confirmation')) {
            $request->validate([
                'currentpassword' => 'required|string',
                'newpassword' => 'required|string|min:8|confirmed',
                'newpassword_confirmation' => 'required|string|min:8',
            ]);

             // Check if current password matches
            if (!Hash::check($request->input('currentpassword'), $user->password)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Current password is incorrect.',
                ], 400);
            }
        }

        $two_factor_auth = 0;
        if($request->two_factor_auth == 'on') {
            $two_factor_auth = 1;
        }
        
        $userId = Auth::user()->id;
        $ipAddress = $request->ip();
        $action = 'UPDATE_SECURITY';
        $city = 'Pune';

        $two_factor_auth = 0;
        if($request->two_factor_auth == 'on') {
            $two_factor_auth = 1;
        }

        try {
            $user->password = bcrypt($request->input('newpassword'));
            $user->two_factor_auth = $two_factor_auth;
            $user->session_timeout = $request->input('session_timeout', $user->session_timeout);


            $user->save();

            ActivityLog::create([
                'timestamp' => now(),
                'user_id' => $userId,
                'ipaddress' => $ipAddress,
                'action' => $action,
                'description' => "Password updated successfully!",
                'location' => $city,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Password updated successfully!',
            ], 200);
        } catch (\Exception $e) {
            ActivityLog::create([
                'timestamp' => now(),
                'user_id' => $userId,
                'ipaddress' => $ipAddress,
                'action' => $action,
                'description' => $e->getMessage(),
                'location' => $city,
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update password.',
            ], 500);
        }
    }
}
