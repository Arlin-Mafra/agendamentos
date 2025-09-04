<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Criar Novo Usuário') }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg p-6">

            <!-- Barra de ações -->
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-medium text-gray-900">Preencha os dados abaixo</h3>
                <a href="{{ route('users.index') }}"
                   class="bg-gray-200 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-300 transition">
                    ← Voltar
                </a>
            </div>

            <!-- Formulário -->
            <form method="POST" action="{{ route('users.store') }}" class="space-y-4">
                @csrf

                <!-- Nome -->
                <div>
                    <label for="nome" class="block text-sm font-medium">Nome</label>
                    <input id="nome" type="text" name="nome"
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 text-gray-900" required autofocus>
                </div>

                <!-- E-mail -->
                <div>
                    <label for="email" class="block text-sm font-medium">E-mail</label>
                    <input id="email" type="email" name="email"
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 text-gray-900" required>
                </div>

                <!-- Senha -->
                <div>
                    <label for="password" class="block text-sm font-medium">Senha</label>
                    <input id="password" type="password" name="password"
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 text-gray-900" required>
                </div>

                <!-- Confirmar senha -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium">Confirmar Senha</label>
                    <input id="password_confirmation" type="password" name="password_confirmation"
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 text-gray-900" required>
                </div>

                <!-- Role -->
                <div>
                    <label for="role_id" class="block text-sm font-medium">Função (Role)</label>
                    <select id="role_id" name="role_id"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 text-gray-900">
                        <option value="">-- Selecione uma função --</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" @selected(old('role_id') == $role->id)>
                                {{ $role->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Tenant -->
                <div>
                    <label for="tenant_id" class="block text-sm font-medium">Tenant</label>
                    <select id="tenant_id" name="tenant_id"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 text-gray-900">
                        <option value="">-- Selecione um tenant --</option>
                        @foreach($tenants as $tenant)
                            <option value="{{ $tenant->id }}" @selected(old('tenant_id') == $tenant->id)>
                                {{ $tenant->nome_empresa }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium">Status</label>
                    <select id="status" name="status"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 text-gray-900">
                        <option value="ativo">Ativo</option>
                        <option value="inativo">Inativo</option>
                    </select>
                </div>

                <!-- Botão -->
                <div class="flex justify-end">
                    <button type="submit"
                            class="bg-indigo-600 text-white px-6 py-2 rounded-md font-semibold hover:bg-indigo-700 transition">
                        Criar Usuário
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>