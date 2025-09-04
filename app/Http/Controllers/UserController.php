<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create()
    {
        $roles = Role::all();
        $tenants = Tenant::all();
        return view('users.create', compact('roles', 'tenants'));
    }

    public function index()
    {
        $users = User::paginate(10); // paginação básica
        return view('users.index', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'role_id' => 'nullable|integer',
            'tenant_id' => 'nullable|integer',
            'status' => 'required|in:ativo,inativo',
        ]);

        User::create([
            'nome'       => $request->nome,
            'email'      => $request->email,
            'senha_hash' => Hash::make($request->password),
            'role_id'    => $request->role_id,
            'tenant_id'  => $request->tenant_id,
            'status'     => $request->status,
        ]);

        return redirect()->route('dashboard')->with('success', 'Usuário criado com sucesso!');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $tenants = Tenant::all();
        return view('users.edit', compact('user', 'roles', 'tenants'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|confirmed|min:6',
            'role_id' => 'nullable|integer',
            'tenant_id' => 'nullable|integer',
            'status' => 'required|in:ativo,inativo',
        ]);

        $data = $request->only(['nome', 'email', 'role_id', 'tenant_id', 'status']);

        if ($request->filled('password')) {
            $data['senha_hash'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso!');
    }
}