<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastrar Nova Empresa') }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow sm:rounded-lg p-6">
            <form action="{{ route('tenants.store') }}" method="POST">
                @csrf

                <!-- Nome da Empresa -->
                <div class="mb-4">
                    <label for="nome_empresa" class="block text-sm font-medium text-gray-700">Nome da Empresa</label>
                    <input type="text" name="nome_empresa" id="nome_empresa" value="{{ old('nome_empresa') }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                           required>
                    @error('nome_empresa')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Plano -->
                <div class="mb-4">
                    <label for="plano" class="block text-sm font-medium text-gray-700">Plano</label>
                    <select name="plano" id="plano"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            required>
                        <option value="">Selecione um plano</option>
                        <option value="basico" {{ old('plano') == 'basico' ? 'selected' : '' }}>Basico</option>
                        <option value="premium" {{ old('plano') == 'premium' ? 'selected' : '' }}>Premium</option>
                        <option value="enterprise" {{ old('plano') == 'enterprise' ? 'selected' : '' }}>Enterprise</option>
                    </select>
                    @error('plano')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" id="status"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            required>
                        <option value="ativo" {{ old('status') == 'ativo' ? 'selected' : '' }}>Ativo</option>
                        <option value="inativo" {{ old('status') == 'inativo' ? 'selected' : '' }}>Inativo</option>
                    </select>
                    @error('status')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Botões -->
                <div class="flex justify-end space-x-2">
                    <a href="{{ route('tenants.index') }}"
                       class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition">
                        Cancelar
                    </a>
                    <button type="submit"
                            class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">
                        Salvar
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
