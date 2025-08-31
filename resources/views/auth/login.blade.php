<x-guest-layout>
    <main class="flex flex-col items-center justify-center min-h-screen px-4">
        
        <!-- Card -->
        <div class="w-full max-w-md bg-gradient-to-r from-indigo-50 to-indigo-100 rounded-lg shadow-md p-8 text-gray-800">
            
            <!-- Logo + Branding -->
            <div class="text-center mb-6">
                <img src="{{ asset('images/logo.svg') }}" alt="Logo AgendaPro" class="mx-auto h-16 w-16">
                <h1 class="text-2xl font-bold mt-2 text-indigo-700">AgendaPro</h1>
            </div>

            <!-- Título -->
            <h2 class="text-xl font-semibold text-center mb-4 text-gray-700">Entrar</h2>

            <!-- Mensagens de erro -->
            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-3 rounded-md mb-4">
                    <ul class="text-sm list-disc list-inside">
                        @foreach ($errors->all() as $erro)
                            <li>{{ $erro }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Formulário -->
            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 text-gray-900 focus:ring-indigo-300 focus:border-indigo-300"
                        placeholder="seuemail@empresa.com" required autofocus>
                </div>

                <!-- Senha -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Senha</label>
                    <input id="password" type="password" name="password"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 text-gray-900 focus:ring-indigo-300 focus:border-indigo-300"
                        placeholder="••••••••" required>
                </div>

                <!-- Botão -->
                <button type="submit"
                        class="w-full bg-indigo-600 text-white py-2 px-4 rounded-lg font-semibold hover:bg-indigo-700 transition">
                    Entrar
                </button>
            </form>

            <!-- Links extras -->
            <div class="flex justify-between items-center mt-6 text-sm">
                <a href="{{ route('register') }}" class="text-indigo-600 hover:underline">Criar conta</a>
                <a href="{{ route('password.request') }}" class="text-indigo-600 hover:underline">Esqueci minha senha</a>
            </div>
        </div>
    </main>
</x-guest-layout>