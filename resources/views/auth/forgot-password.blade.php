<x-guest-layout>
    <!-- Título -->
    <h2 class="text-xl font-semibold text-center mb-4 text-gray-700">Recuperar Senha</h2>

    <!-- Descrição -->
    <div class="mb-6 text-sm text-gray-600 text-center">
        Esqueceu sua senha? Sem problema. Digite seu e-mail e enviaremos um link para redefinir sua senha.
    </div>

    <!-- Status da sessão (sucesso ao enviar email) -->
    @if (session('status'))
        <div class="bg-green-100 text-green-700 p-3 rounded-md mb-4 text-sm">
            {{ session('status') }}
        </div>
    @endif

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
    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 text-gray-900 focus:ring-indigo-300 focus:border-indigo-300"
                placeholder="seuemail@empresa.com" required autofocus>
        </div>

        <!-- Botão -->
        <button type="submit"
                class="w-full bg-indigo-600 text-white py-2 px-4 rounded-lg font-semibold hover:bg-indigo-700 transition">
            Enviar Link de Recuperação
        </button>
    </form>

    <!-- Link para voltar ao login -->
    <div class="flex justify-center mt-6 text-sm">
        <span class="text-gray-700">Lembrou da senha?</span>
        <a href="{{ route('login') }}" class="ml-2 text-indigo-600 hover:underline">
            Voltar ao Login
        </a>
    </div>
</x-guest-layout>