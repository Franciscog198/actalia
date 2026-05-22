<x-guest-layout>
    <div class="w-full max-w-md mx-auto">

        <!-- Logo / Header -->
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-gray-900">ACTALIA</h1>
            <p class="text-sm text-gray-500">Acceso al panel de administración</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="bg-white p-6 rounded-xl shadow-md space-y-5">
            @csrf

            <!-- Email -->
            <div>
                <x-input-label for="email" value="Correo electrónico" class="text-sm font-medium text-gray-700" />

                <x-text-input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    autocomplete="username"
                    class="block mt-1 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                />

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" value="Contraseña" class="text-sm font-medium text-gray-700" />

                <x-text-input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    class="block mt-1 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember + Forgot -->
            <div class="flex items-center justify-between">

                <label class="flex items-center gap-2 text-sm text-gray-600">
                    <input
                        type="checkbox"
                        name="remember"
                        class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                    >
                    Recordarme
                </label>

                @if (Route::has('password.request'))
                    <a
                        href="{{ route('password.request') }}"
                        class="text-sm text-indigo-600 hover:text-indigo-800 transition"
                    >
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif

            </div>

            <!-- Button -->
            <div>
                <button
                    type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2.5 rounded-lg transition shadow-sm"
                >
                    Iniciar sesión
                </button>
            </div>

        </form>

        <!-- Footer -->
        <p class="text-center text-xs text-gray-400 mt-6">
            © {{ date('Y') }} ACTALIA · Sistema de gestión
        </p>

    </div>
</x-guest-layout>
