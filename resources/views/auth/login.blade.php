<x-guest-layout>
    <div style="width: 100%; max-width: 400px; margin: 0 auto; padding: 2rem;">

        <!-- Header -->
        <div style="text-align: center; margin-bottom: 2rem;">
            <img 
                src="{{ asset('assets/images/actalia.png') }}" 
                alt="Actalia" 
                style="width: 20%; height: auto; margin: 0 auto 1rem; display: block;"
            >
            <h1 style="font-size: 1.5rem; font-weight: 700; color: #0b2340; margin: 0; margin-bottom: 0.5rem;">
                ACTALIA
            </h1>
            <p style="font-size: 0.875rem; color: #6b7280; margin: 0;">
                Acceso al panel de administración
            </p>
        </div>

        <!-- Errores Sesión -->
        @if ($errors->any())
            <div style="background-color: #fee2e2; border: 1px solid #fecaca; color: #991b1b; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem; font-size: 0.875rem;">
                <strong>Error de acceso</strong>
                @foreach ($errors->all() as $error)
                    <p style="margin: 0.25rem 0;">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <!-- Formulario -->
        <form method="POST" action="{{ route('login') }}" style="display: flex; flex-direction: column; gap: 1.5rem;">
            @csrf

            <!-- Email -->
            <div>
                <label for="email" style="display: block; font-size: 0.875rem; font-weight: 600; color: #0b2340; margin-bottom: 0.5rem;">
                    Correo electrónico
                </label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="tu@email.com"
                    style="width: 100%; background-color: #e5e7eb; border: 1px solid #d1d5db; color: #0b2340; border-radius: 0.5rem; padding: 0.75rem; font-size: 1rem;"
                >
            </div>

            <!-- Contraseña -->
            <div>
                <label for="password" style="display: block; font-size: 0.875rem; font-weight: 600; color: #0b2340; margin-bottom: 0.5rem;">
                    Contraseña
                </label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    placeholder="••••••••"
                    style="width: 100%; background-color: #e5e7eb; border: 1px solid #d1d5db; color: #0b2340; border-radius: 0.5rem; padding: 0.75rem; font-size: 1rem;"
                >
            </div>

            <!-- Recordarme -->
            <div style="display: flex; align-items: center; gap: 0.5rem;">
                <input
                    type="checkbox"
                    id="remember"
                    name="remember"
                    style="width: 1rem; height: 1rem; cursor: pointer;"
                >
                <label for="remember" style="font-size: 0.875rem; color: #6b7280; cursor: pointer; margin: 0;">
                    Recordarme en este dispositivo
                </label>
            </div>

            <!-- Botón -->
            <button
                type="submit"
                style="width: 100%; background-color: #0a5faa; color: white; border: none; font-weight: 600; padding: 0.875rem; border-radius: 0.5rem; cursor: pointer; font-size: 1rem; transition: background-color 0.2s;"
                onmouseover="this.style.backgroundColor='#084c88'"
                onmouseout="this.style.backgroundColor='#0a5faa'"
            >
                Iniciar sesión
            </button>

        </form>

        <!-- Footer -->
        <div style="text-align: center; margin-top: 2rem; font-size: 0.75rem; color: #9ca3af; border-top: 1px solid #e5e7eb; padding-top: 1.5rem;">
            <p style="margin: 0;">© {{ date('Y') }} ACTALIA · Sistema de registro digital</p>
        </div>

    </div>
</x-guest-layout>