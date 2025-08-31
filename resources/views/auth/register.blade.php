<x-guest-layout>
    <main class="flex flex-col items-center justify-center min-h-screen px-4">
        
        <!-- Card igual ao login -->
        <div class="w-full max-w-md bg-gradient-to-r from-indigo-50 to-indigo-100 rounded-lg shadow-md p-8 text-gray-800">
            <div class="text-center mb-6">
                <img src="{{ asset('images/logo.svg') }}" alt="Logo AgendaPro" class="mx-auto h-16 w-16">
                <h1 class="text-2xl font-bold mt-2 text-indigo-700">AgendaPro</h1>
            </div>

            <h2 class="text-xl font-semibold text-center mb-4 text-gray-700">Criar Conta</h2>

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <!-- Name -->
                <div>
                    <label for="nome" class="block text-sm font-medium">Nome</label>
                    <input id="nome" type="text" name="nome" value="{{ old('nome') }}"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 text-gray-900 focus:ring-indigo-300 focus:border-indigo-300"
                        required autofocus autocomplete="nome">
                    <x-input-error :messages="$errors->get('nome')" class="mt-2" />
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium">E-mail</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 text-gray-900 focus:ring-indigo-300 focus:border-indigo-300"
                        required autocomplete="username">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium">Senha</label>
                    <input id="password" type="password" name="password"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 text-gray-900 focus:ring-indigo-300 focus:border-indigo-300"
                        required autocomplete="new-password">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium">Confirmar Senha</label>
                    <input id="password_confirmation" type="password" name="password_confirmation"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 text-gray-900 focus:ring-indigo-300 focus:border-indigo-300"
                        required autocomplete="new-password">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Botão -->
                <button type="submit"
                        class="w-full bg-indigo-600 text-white py-2 px-4 rounded-lg font-semibold hover:bg-indigo-700 transition">
                    Registrar
                </button>
            </form>

            <!-- Link para Login -->
            <div class="flex justify-center mt-6 text-sm">
                <span class="text-gray-700">Já possui conta?</span>
                <a href="{{ route('login') }}" class="ml-2 text-indigo-600 hover:underline">
                    Entrar
                </a>
            </div>
        </div>
    </main>
</x-guest-layout>