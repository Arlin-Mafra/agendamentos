<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Cliente') }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg p-6">
            <!-- Barra de ações -->
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-medium text-gray-900">Atualize os dados abaixo</h3>
                <a href="{{ route('clientes.index') }}"
                   class="bg-gray-200 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-300 transition">
                    ← Voltar
                </a>
            </div>

            <!-- Formulário -->
            <form method="POST" action="{{ route('clientes.update', $cliente) }}" class="space-y-4" novalidate>
                @csrf
                @method('PUT')

                <!-- Nome -->
                <div>
                    <label for="nome" class="block text-sm font-medium">Nome</label>
                    <input id="nome" type="text" name="nome" value="{{ old('nome', $cliente->nome) }}"
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 text-gray-900" required autofocus>
                    @error('nome') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Telefone -->
                <div>
                    <label for="telefone" class="block text-sm font-medium">Telefone</label>
                    <input id="telefone"
                           type="tel"
                           name="telefone"
                           value="{{ old('telefone', $cliente->telefone) }}"
                           inputmode="numeric"
                           autocomplete="tel"
                           maxlength="15"
                           pattern="^\(\d{2}\)\s\d{4,5}-\d{4}$"
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 text-gray-900"
                           placeholder="(00) 00000-0000" required>
                    @error('telefone') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    <p class="text-xs text-gray-500 mt-1">Formato aceito: (00) 0000-0000 ou (00) 00000-0000</p>
                </div>

                <!-- E-mail -->
                <div>
                    <label for="email" class="block text-sm font-medium">E-mail</label>
                    <input id="email" type="email" name="email" value="{{ old('email', $cliente->email) }}"
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 text-gray-900" required>
                    @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Senha -->
                <div>
                    <label for="password" class="block text-sm font-medium">Senha (deixe em branco para não alterar)</label>
                    <input id="password" type="password" name="password"
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 text-gray-900">
                    @error('password') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Confirmar Senha -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium">Confirmar Senha</label>
                    <input id="password_confirmation" type="password" name="password_confirmation"
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 text-gray-900">
                </div>

                <!-- Status -->
                <div class="min-w-0">
                    <label for="status" class="block text-sm font-medium">Status</label>
                    <select id="status" name="status"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option value="1" @selected(old('status', $cliente->user->status ?? 1) == 1)>Ativo</option>
                        <option value="0" @selected(old('status', $cliente->user->status ?? 1) == 0)>Inativo</option>
                    </select>
                </div>

                <!-- Botão -->
                <div class="flex justify-end">
                    <button type="submit"
                            class="bg-indigo-600 text-white px-6 py-2 rounded-md font-semibold hover:bg-indigo-700 transition">
                        Salvar Alterações
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script para máscara de telefone -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const telefoneInput = document.getElementById('telefone');

            // Função de aplicação da máscara com corte de tamanho
            function maskPhone(target) {
                let digits = target.value.replace(/\D/g, '');

                // Limita a no máximo 11 dígitos (DDD + 9)
                if (digits.length > 11) digits = digits.slice(0, 11);

                // Aplica máscara conforme o tamanho
                if (digits.length <= 10) {
                    digits = digits.replace(/(\d{0,2})(\d{0,4})(\d{0,4})/, function(_, a, b, c) {
                        let out = '';
                        if (a) out += `(${a}`;
                        if (a.length === 2) out += ') ';
                        if (b) out += b;
                        if (b.length === 4) out += '-';
                        if (c) out += c;
                        return out;
                    });
                } else {
                    digits = digits.replace(/(\d{0,2})(\d{0,5})(\d{0,4})/, function(_, a, b, c) {
                        let out = '';
                        if (a) out += `(${a}`;
                        if (a.length === 2) out += ') ';
                        if (b) out += b;
                        if (b.length === 5) out += '-';
                        if (c) out += c;
                        return out;
                    });
                }

                target.value = digits;
            }

            // Aplica máscara no carregamento (caso venha sem formatação do banco)
            maskPhone(telefoneInput);

            // Aplica máscara a cada digitação
            telefoneInput.addEventListener('input', function(e) {
                maskPhone(e.target);
            });
        });
    </script>
</x-app-layout>