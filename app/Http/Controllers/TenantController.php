<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    public function index()
    {
        $tenants = Tenant::paginate(10);
        return view('admin.tenants.index', compact('tenants'));
    }

    public function create()
    {
        return view('admin.tenants.create');
    }

  
    public function store(Request $request) 
    
    { 
        $request->validate([
        'nome_empresa' => 'required|string|max:255|unique:tenants',
        'plano' => 'required|string|max:100',
        'status' => 'required|in:ativo,inativo',
        ]);

        Tenant::create($request->only('nome_empresa', 'plano', 'status'));

        return redirect()->route('tenants.index')->with('success', 'Tenant criado com sucesso!');
    }

    public function edit(Tenant $tenant)
    {
        return view('admin.tenants.edit', compact('tenant'));
    }

    public function update(Request $request, Tenant $tenant)
    {
        $request->validate([
            'nome_empresa' => 'required|string|max:255|unique:tenants,nome_empresa,' . $tenant->id,
            'plano' => 'required|string|max:100',
            'status' => 'required|in:ativo,inativo',
        ]);

        $tenant->update($request->only('nome_empresa', 'plano', 'status'));

        return redirect()->route('tenants.index')->with('success', 'Empresa atualizada!');
    }

    public function destroy(Tenant $tenant)
    {
        $tenant->delete();
        return redirect()->route('tenants.index')->with('success', 'Empresa removida!');
    }
}