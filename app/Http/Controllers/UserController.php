<?php

namespace App\Http\Controllers;
use App\models\User;
use Auth;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function users(Request $request)
    {
        // Total count of all “real” users (role 0 or 1)
        $total = User::whereIn('role', [0, 1])->count();

        // Pull filters from query string
        $role   = $request->query('role');
        $search = $request->query('search');

        // Base query: only roles 0 and 1
        $query = User::whereIn('role', [0, 1]);

        // Apply role filter if present
        if ($role !== null && $role !== '') {
            if (! in_array($role, ['0','1'], true)) {
                abort(400, 'Invalid role filter');
            }
            $query->where('role', $role);
        }

        // Apply search filter if present (searching against name here—you can add email, phone, etc.)
        if ($search) {
            $query->where('name', 'like', '%'.$search.'%');
        }

        // Paginate and keep query string for links
        $users = $query->paginate(10)->withQueryString();

        return view('users', [
            'users'             => $users,
            'total'             => $total,
            'currentRoleFilter' => $role,
            'currentSearch'     => $search,
        ]);
    }

    public function delete($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('users')->with('error', 'User not found.');
        }

        $user->delete();

        return redirect()->route('users')->with('success', 'User deleted successfully.');
    }
}
