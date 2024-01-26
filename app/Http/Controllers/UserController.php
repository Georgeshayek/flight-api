<?php

namespace App\Http\Controllers;

use App\Models\User;

use App\Models\Flight;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Validation\Rule;
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller
{

    public function index()
    {
        $users = QueryBuilder::for(User::class)
            ->allowedFilters(['name'])
            ->paginate(100);
        return response()->json(['users' => $users]);
    }
    public function show(User $user)
    {
        return response()->json(['user' => $user]);
    }
    public function store(Request $request)
    {
        $validated = $request
            ->validate([
                'name' => ['required', 'min:3'],
                'email' => ['required', 'email', Rule::unique('users', 'email')],
                'password' => ['required', 'min:6']
            ]);
        $validated['password'] = bcrypt($validated['password']);
        $user = User::create($validated);
        return response()->json(['message' => 'user successfully created'], 201);
    }
    public function update(User $user, Request $request)
    {
        if (!$user) {
            return response()->json(['message' => 'user not found'], 404);
        }
        $validated = $request
            ->validate([
                'name' => ['sometimes', 'min:3'],
                'email' => ['sometimes', 'email', Rule::unique('users', 'email')],
                'password' => ['sometimes', 'min:6']
            ]);
        if ($request->filled('password')) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            $validated['password'] = $user->password;
        }
        $user->update($validated);
        return response()->json(['message' => "user has been updated"], 200);
    }
    public function destroy(User $user)
    {
        if (!$user) {
            return response()->json(['message' => 'user not found'], 404);
        }
        $user->delete();
        return response()->json(['message' => 'user has been deleted'], 202);
    }
    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}
