<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::paginate(10);
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255|unique:roles',
            'descricao' => 'required|string|max:500',
        ]);

        Role::create($request->only('nome', 'descricao'));

        return redirect()->route('roles.index')->with('success', 'Função criada com sucesso!');
    }

    public function edit(Role $role)
    {
        return view('admin.roles.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'nome' => 'required|string|max:255|unique:roles,nome,' . $role->id,
            'descricao' => 'required|string|max:500',
        ]);

        $role->update($request->only('nome', 'descricao'));

        return redirect()->route('roles.index')->with('success', 'Função atualizada!');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Função removida!');
    }
}
