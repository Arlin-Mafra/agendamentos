<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gerenciar Empresas') }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow sm:rounded-lg p-6">

            <!-- Barra de ações -->
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-medium text-gray-900">Lista de Empresas</h3>
                <a href="{{ route('tenants.create') }}"
                   class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition">
                    + Novo Tenant
                </a>
            </div>

            <!-- Mensagens de feedback -->
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-700 rounded-md">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-4 p-4 bg-red-100 border border-red-300 text-red-700 rounded-md">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Tabela de tenants -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 border border-gray-300 rounded-md">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Empresa</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Plano</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Status</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-700 uppercase">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($tenants as $tenant)
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $tenant->id }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $tenant->nome_empresa }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ ucfirst($tenant->plano) }}</td>
                                <td class="px-6 py-4 text-sm">
                                    @if($tenant->status === 'ativo')
                                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Ativo</span>
                                    @else
                                        <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">Inativo</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-right space-x-2">
                                    <a href="{{ route('tenants.edit', $tenant) }}" class="text-blue-600 hover:text-blue-800">Editar</a>
                                    <form action="{{ route('tenants.destroy', $tenant) }}" method="POST" class="inline-block" onsubmit="return confirm('Tem certeza que deseja excluir este tenant?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">Nenhum tenant cadastrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginação -->
            <div class="mt-4">
                {{ $tenants->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
