<x-guest-layout>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Información de usuarios</title>
    
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    <script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>
    
    <style>
:root {
    --background: #ffffff;
    --foreground: #0b2540;
    --border: #00000014;
    --input: #f6faff;
    --primary: #0a5fb4;
    --primary-foreground: #ffffff;
    --secondary: #e9f8d9;
    --secondary-foreground: #1b4f00;
    --muted: #f3f5f7;
    --muted-foreground: #7a8692;
    --success: #ccf3a1;
    --success-foreground: #174e00;
    --accent: #a7e22f;
    --accent-foreground: #062500;
    --destructive: #ff4d4f;
    --destructive-foreground: #ffffff;
    --warning: #ffd580;
    --warning-foreground: #4a2b00;
    --card: #ffffff;
    --card-foreground: #0b2540;
    --sidebar: #f6fbff;
    --sidebar-foreground: #083056;
    --sidebar-primary: #0a5fb4;
    --sidebar-primary-foreground: #ffffff;
    --radius-sm: 4px;
    --radius-md: 6px;
    --radius-lg: 8px;
    --radius-xl: 12px;
    --font-family-body: Inter, sans-serif;
}

* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    background-color: var(--background);
    color: var(--foreground);
    -webkit-font-smoothing: antialiased;
    font-family: var(--font-family-body);
}

.app-wrapper {
    width: 100%;
    max-width: 375px;
    min-height: 100vh;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    background-color: var(--background);
}

.main-content {
    flex: 1;
    padding: 24px 20px 32px;
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.page-header {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.step-label {
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: var(--muted-foreground);
}

.page-title {
    font-size: 22px;
    font-weight: 600;
    color: var(--foreground);
}

.progress-track {
    margin-top: 12px;
    height: 4px;
    background-color: var(--muted);
    border-radius: 2px;
    overflow: hidden;
}

.progress-fill {
    width: 50%;
    height: 100%;
    background-color: var(--accent);
}

.editorial-block {
    background-color: var(--card);
    border-radius: var(--radius-lg);
    border: 1px solid var(--border);
    padding: 20px 16px 16px;
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.block-title {
    font-size: 13px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: var(--sidebar-foreground);
    padding-bottom: 8px;
    border-bottom: 1px solid var(--muted);
}

.section-subtitle {
    font-size: 14px;
    font-weight: 500;
    color: var(--muted-foreground);
}

.grid-choices {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-top: 8px;
}

.choice-card {
    border-radius: var(--radius-lg);
    border: 1px solid var(--border);
    background-color: var(--input);
    padding: 14px 14px 14px 12px;
    display: flex;
    align-items: center;
    gap: 12px;
}

.choice-card.is-primary {
    background-color: var(--sidebar-primary);
    border-color: var(--sidebar-primary);
    color: var(--sidebar-primary-foreground);
    box-shadow: 0 0 0 1px var(--accent);
}

.choice-card.is-primary .choice-label {
    color: var(--sidebar-primary-foreground);
}

.choice-card-icon,
.choice-card-icon-neutral {
    width: 40px;
    height: 40px;
    border-radius: 999px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.choice-card-icon {
    background-color: rgba(255, 255, 255, 0.9);
}

.choice-card-icon-neutral {
    background-color: var(--card);
}

.choice-label {
    font-size: 14px;
    font-weight: 500;
    color: var(--foreground);
    white-space: nowrap;
}

.choice-pill-accent {
    margin-left: auto;
    padding: 4px 8px;
    border-radius: var(--radius-xl);
    background-color: var(--accent);
    color: var(--accent-foreground);
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    white-space: nowrap;
}

.property-type-row {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin-top: 4px;
}

.property-type-label {
    font-size: 13px;
    font-weight: 600;
    color: var(--foreground);
}

.property-type-chips {
    display: flex;
    gap: 8px;
}

.chip {
    flex: 1;
    min-width: 0;
    border-radius: 999px;
    border: 1px solid var(--border);
    background-color: var(--card);
    padding: 8px 10px;
    display: flex;
    align-items: center;
    gap: 6px;
}

.chip.is-selected {
    border-color: var(--primary);
    background-color: var(--input);
    box-shadow: 0 0 0 1px var(--accent);
}

.chip-icon-wrapper {
    width: 22px;
    height: 22px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.chip-label {
    font-size: 13px;
    font-weight: 500;
    color: var(--foreground);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.form-grid {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.form-field {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.form-field.is-aligned {
    height: 100%;
}

.form-field.is-aligned .form-label {
    flex: 1;
    display: flex;
    align-items: flex-end;
}

.form-label {
    font-size: 13px;
    font-weight: 500;
    color: var(--muted-foreground);
}

.input-mock,
.input-real {
    width: 100%;
    border-radius: var(--radius-md);
    border: 1px solid var(--border);
    background-color: var(--input);
    padding: 11px 12px;
    font-size: 14px;
    color: var(--foreground);
    outline: none;
}

.input-real:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 2px rgba(10, 95, 180, 0.15);
}

.input-mock {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 8px;
}

.input-text {
    flex: 1;
    min-width: 0;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.input-placeholder {
    color: var(--muted-foreground);
}

.two-col-row {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 10px;
}

.bottom-bar {
    border-top: 1px solid var(--border);
    background-color: var(--card);
    padding: 16px 20px 28px;
}

.btn-primary {
    width: 100%;
    border-radius: var(--radius-lg);
    background-color: var(--primary);
    color: var(--primary-foreground);
    padding: 14px 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    font-size: 15px;
    font-weight: 500;
    border: none;
    cursor: pointer;
    box-shadow: 0 0 0 1px var(--accent);
    transition: 0.2s ease;
}

.btn-primary:hover {
    opacity: 0.95;
}

.btn-icon-wrapper {
    width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--accent);
}

.additional-user {
    position: relative;
    margin-top: 16px;
    padding-top: 18px;
    border-top: 1px dashed var(--border);
}

.remove-user-btn {
    position: absolute;
    top: 0;
    right: 0;
    width: 28px;
    height: 28px;
    border: none;
    border-radius: 999px;
    background: #fee2e2;
    color: #dc2626;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: .2s ease;
}

.remove-user-btn:hover {
    background: #fecaca;
    transform: scale(1.05);
}
    </style>
</head>
<body>
    <div class="app-wrapper">
        <main class="main-content">
            <header class="page-header">
                <div class="step-label">Paso 2 de 4</div>
                <h1 class="page-title">Información de usuarios</h1>
                <div class="progress-track">
                    <div class="progress-fill-50"></div>
                </div>
            </header>

            @if($errors->any())
                <div class="alert alert-danger">
                    <strong>Error:</strong>
                    <ul style="margin: 8px 0 0 20px; padding: 0;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('wizard.store', 2) }}" id="contractForm">
                @csrf
                <!-- SECCIÓN AGENTE (SOLO SI ES INMOBILIARIA) -->
                @if(session('registrant_type') == 'inmobiliaria')
                <section class="editorial-block">
                    <div class="user-header">
                        <div class="user-icon-wrapper">
                            <iconify-icon icon="lucide:briefcase" style="font-size: 24px; color: var(--primary)"></iconify-icon>
                        </div>
                        <div>
                            <div class="user-title">Agente Inmobiliario</div>
                            <div class="user-subtitle">Información del profesional interviniente</div>
                        </div>
                    </div>

                    <div class="form-grid">
                        <div class="form-field">
                            <div class="form-label">Matrícula profesional</div>
                            <input type="text" name="agente[matricula]" value="{{ old('agente.matricula') }}" placeholder="Ej. CUCICBA 1234" class="input-real">
                            @error('agente.matricula')
                                <div class="error-text">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-field">
                            <div class="form-label">Nombre completo</div>
                            <input type="text" name="agente[name]" value="{{ old('agente.name') }}" class="input-real">
                            @error('agente.name')
                                <div class="error-text">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="two-col-row">
                            <div class="form-field">
                                <div class="form-label">Correo electrónico</div>
                                <input type="email" name="agente[email]" value="{{ old('agente.email') }}" class="input-real">
                                @error('agente.email')
                                    <div class="error-text">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-field">
                                <div class="form-label">Teléfono</div>
                                <input type="tel" name="agente[phone]" value="{{ old('agente.phone') }}" class="input-real">
                                @error('agente.phone')
                                    <div class="error-text">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </section>
                @endif

                <section class="editorial-block">
                    <div class="user-header">
                        <div class="user-icon-wrapper">
                            <iconify-icon icon="lucide:user" style="font-size: 24px; color: var(--primary)"></iconify-icon>
                        </div>
                        <div>
                            <div class="user-title">Locador</div>
                            <div class="user-subtitle">Datos del propietario del inmueble</div>
                        </div>
                    </div>

                    <div id="locadores-container">
                        <div class="form-grid locador-item">
                            <div class="form-field">
                                <div class="form-label">Nombre completo</div>
                                <input type="text" name="propietario[0][name]" value="{{ old('propietario.0.name') }}"  class="input-real" required>
                            </div>

                            <div class="form-field">
                                <div class="form-label">DNI / CUIT</div>
                                <input type="text" name="propietario[0][dni_number]" value="{{ old('propietario.0.dni_number') }}"  class="input-real">
                            </div>

                            <div class="two-col-row">
                                <div class="form-field">
                                    <div class="form-label">Correo electrónico</div>
                                    <input type="email" name="propietario[0][email]" value="{{ old('propietario.0.email') }}" class="input-real" required>
                                </div>
                                <div class="form-field">
                                    <div class="form-label">Teléfono</div>
                                    <input type="tel" name="propietario[0][phone]" value="{{ old('propietario.0.phone') }}" class="input-real" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn-outline" onclick="agregarLocador()">
                        <iconify-icon icon="lucide:plus" style="font-size: 16px"></iconify-icon>
                        <span>Agregar otro locador</span>
                    </button>
                </section>

                <section class="editorial-block">
                    <div class="user-header">
                        <div class="user-icon-wrapper">
                            <iconify-icon icon="lucide:users" style="font-size: 24px; color: var(--primary)"></iconify-icon>
                        </div>
                        <div>
                            <div class="user-title">Locatario</div>
                            <div class="user-subtitle">Datos del inquilino titular</div>
                        </div>
                    </div>

                    <div id="locatarios-container">
                        <div class="form-grid locatario-item">
                            <div class="form-field">
                                <div class="form-label">Nombre completo</div>
                                <input type="text" name="inquilino[0][name]" value="{{ old('inquilino.0.name') }}"  class="input-real" required>
                            </div>

                            <div class="form-field">
                                <div class="form-label">DNI / CUIT</div>
                                <input type="text" name="inquilino[0][dni_number]" value="{{ old('inquilino.0.dni_number') }}"  class="input-real">
                            </div>

                            <div class="two-col-row">
                                <div class="form-field">
                                    <div class="form-label">Correo electrónico</div>
                                    <input type="email" name="inquilino[0][email]" value="{{ old('inquilino.0.email') }}" class="input-real" required>
                                </div>
                                <div class="form-field">
                                    <div class="form-label">Teléfono</div>
                                    <input type="tel" name="inquilino[0][phone]" value="{{ old('inquilino.0.phone') }}" class="input-real" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn-outline" onclick="agregarLocatario()">
                        <iconify-icon icon="lucide:plus" style="font-size: 16px"></iconify-icon>
                        <span>Agregar otro locatario</span>
                    </button>
                </section>
        </main>

        <footer class="bottom-bar">
            <div class="two-col-row" style="gap: 12px">
                <button type="button" class="btn-secondary" onclick="window.history.back()">
                    <span>Atrás</span>
                </button>
                <button type="submit" class="btn-primary">
                    <span>Continuar</span>
                    <div class="btn-icon-wrapper">
                        <iconify-icon icon="lucide:arrow-right" style="font-size: 18px; color: white;"></iconify-icon>
                    </div>
                </button>
            </div>
        </footer>
            </form>
    </div>

    <script>
    let locadorCount = 1;
    let locatarioCount = 1;

    function eliminarBloque(button) {
        button.closest('.additional-user').remove();
    }

    function agregarLocador() {
        const container = document.getElementById('locadores-container');

        const newLocador = document.createElement('div');

        newLocador.className = 'form-grid locador-item additional-user';

        newLocador.innerHTML = `
            <button type="button"
                class="remove-user-btn"
                onclick="eliminarBloque(this)">
                
                <iconify-icon icon="lucide:x" style="font-size:16px;"></iconify-icon>
            </button>

            <div class="form-field">
                <div class="form-label">Nombre completo</div>
                <input type="text" name="propietario[${locadorCount}][name]" class="input-real">
            </div>

            <div class="form-field">
                <div class="form-label">DNI / CUIT</div>
                <input type="text" name="propietario[${locadorCount}][dni_number]" class="input-real">
            </div>

            <div class="two-col-row">
                <div class="form-field">
                    <div class="form-label">Correo electrónico</div>
                    <input type="email" name="propietario[${locadorCount}][email]" class="input-real">
                </div>

                <div class="form-field">
                    <div class="form-label">Teléfono</div>
                    <input type="tel" name="propietario[${locadorCount}][phone]" class="input-real">
                </div>
            </div>
        `;

        container.appendChild(newLocador);

        locadorCount++;
    }

            function agregarLocatario() {

        const container = document.getElementById('locatarios-container');

        const newLocatario = document.createElement('div');

        newLocatario.className = 'form-grid locatario-item additional-user';

        newLocatario.innerHTML = `
            <button type="button"
                class="remove-user-btn"
                onclick="eliminarBloque(this)">
                
                <iconify-icon icon="lucide:x" style="font-size:16px;"></iconify-icon>
            </button>

            <div class="form-field">
                <div class="form-label">Nombre completo</div>
                <input type="text" name="inquilino[${locatarioCount}][name]" class="input-real">
            </div>

            <div class="form-field">
                <div class="form-label">DNI / CUIT</div>
                <input type="text" name="inquilino[${locatarioCount}][dni_number]" class="input-real">
            </div>

            <div class="two-col-row">
                <div class="form-field">
                    <div class="form-label">Correo electrónico</div>
                    <input type="email" name="inquilino[${locatarioCount}][email]" class="input-real">
                </div>

                <div class="form-field">
                    <div class="form-label">Teléfono</div>
                    <input type="tel" name="inquilino[${locatarioCount}][phone]" class="input-real">
                </div>
            </div>
        `;

        container.appendChild(newLocatario);

        locatarioCount++;
    }
</script>
</body>
</html>
</x-guest-layout>