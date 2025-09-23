<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClienteController extends Controller
{
    /**
     * Listagem de clientes
     */
    public function index()
    {
        $clientes = Cliente::with('user')->paginate(10);
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Mostra formulário de criação
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Armazena novo cliente + usuário
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome'     => 'required|string|max:255',
            'telefone' => 'required|string|min:14|max:15',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // role_id do cliente (ajustar conforme sua seed de roles)
        $roleCliente = Role::where('nome', 'cliente')->first();

        // cria usuário
        $user = User::create([
            'nome'       => $request->nome,
            'email'      => $request->email,
            'senha_hash' => Hash::make($request->password),
            'role_id'    => $roleCliente->id ?? null,
            'tenant_id'  => auth()->user()->tenant_id ?? null,
            'status'     => true
        ]);

        // cria cliente vinculado ao user
        $cliente = Cliente::create([
            'nome'     => $request->nome,
            'telefone' => $request->telefone,
            'email'    => $request->email,
            'user_id'  => $user->id
        ]);

        return redirect()->route('clientes.index')->with('success', 'Cliente cadastrado com sucesso!');
    }

    /**
     * Formulário de edição
     */
    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Atualiza cliente + usuário
     */
    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nome'     => 'required|string|max:255',
            'telefone' => 'required|string|min:14|max:15',
            'email'    => 'required|email|unique:users,email,' . $cliente->user_id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        // Atualiza usuário
        $user = $cliente->user;
        $user->update([
            'nome'     => $request->nome,
            'email'    => $request->email,
            'password' => $request->filled('password') ? Hash::make($request->password) : $user->password,
        ]);

        // Atualiza cliente
        $cliente->update([
            'nome'     => $request->nome,
            'telefone' => $request->telefone,
            'email'    => $request->email,
        ]);

        return redirect()->route('clientes.index')->with('success', 'Cliente atualizado com sucesso!');
    }

    /**
     * Remove cliente + usuário
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->user()->delete();
        $cliente->delete();

        return redirect()->route('clientes.index')->with('success', 'Cliente removido com sucesso!');
    }
}