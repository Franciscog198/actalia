<x-guest-layout>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Información de Póliza - Registrado</title>
    
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
    width: 75%;
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
    </style>
</head>
<body>
    <div class="app-wrapper">
        <main class="main-content">
            <header class="page-header">
                <div class="step-label">Paso 3 de 4</div>
                <h1 class="page-title">Información de la póliza</h1>
                <div class="progress-track">
                    <div class="progress-fill-75"></div>
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

            <form method="POST" action="{{ route('wizard.store', '3b') }}" enctype="multipart/form-data">
            @csrf
                <section class="editorial-block">
                    <div class="guarantee-header">
                        <div class="guarantee-icon-wrapper">
                            <iconify-icon icon="lucide:shield-check" style="font-size: 24px; color: var(--primary)"></iconify-icon>
                        </div>
                        <div>
                            <div class="guarantee-title">Póliza de Caución</div>
                            <div class="guarantee-subtitle">Seguro de garantía para alquileres</div>
                        </div>
                    </div>

                    <div class="form-grid">
                        <div class="form-field">
                            <div class="form-label">Empresa aseguradora</div>
                            <select name="poliza_aseguradora" class="input-real" required>
                                <option value="">Seleccionar compañía</option>
                                <option value="Fianzas y Crédito" {{ old('poliza_aseguradora') == 'Fianzas y Crédito' ? 'selected' : '' }}>Fianzas y Crédito</option>
                                <option value="Berkley" {{ old('poliza_aseguradora') == 'Berkley' ? 'selected' : '' }}>Berkley</option>
                                <option value="Sancor Seguros" {{ old('poliza_aseguradora') == 'Sancor Seguros' ? 'selected' : '' }}>Sancor Seguros</option>
                                <option value="La Segunda" {{ old('poliza_aseguradora') == 'La Segunda' ? 'selected' : '' }}>La Segunda</option>
                                <option value="Otra" {{ old('poliza_aseguradora') == 'Otra' ? 'selected' : '' }}>Otra</option>
                            </select>
                            <div class="form-field" id="otra-aseguradora-field" style="display:none;">
                                <div class="form-label">Nombre de la aseguradora</div>
                                <input 
                                    type="text" 
                                    name="poliza_aseguradora_otra" 
                                    value="{{ old('poliza_aseguradora_otra') }}" 
                                    placeholder="Ingrese la aseguradora" 
                                    class="input-real"
                                >
                            </div>
                            @error('poliza_aseguradora')
                                <div class="error-text">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="two-col-row">
                            <div class="form-field">
                                <div class="form-label">Número de póliza</div>
                                <input type="text" name="poliza_numero" value="{{ old('poliza_numero') }}" placeholder="Ej. 0001234" class="input-real" required>
                                @error('poliza_numero')
                                    <div class="error-text">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-field">
                                <div class="form-label">Número de certificado</div>
                                <input type="text" name="poliza_certificado" value="{{ old('poliza_certificado') }}" placeholder="Opcional" class="input-real">
                                @error('poliza_certificado')
                                    <div class="error-text">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-field">
                            <div class="form-label">Fecha de emisión</div>
                            <input type="date" name="poliza_emision" value="{{ old('poliza_emision') }}" class="input-real" required>
                            @error('poliza_emision')
                                <div class="error-text">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="two-col-row">
                            <div class="form-field">
                                <div class="form-label">Vigencia desde</div>
                                <input type="date" name="poliza_vigencia_desde" value="{{ old('poliza_vigencia_desde') }}" class="input-real" required>
                                @error('poliza_vigencia_desde')
                                    <div class="error-text">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-field">
                                <div class="form-label">Vigencia hasta</div>
                                <input type="date" name="poliza_vigencia_hasta" value="{{ old('poliza_vigencia_hasta') }}" class="input-real" required>
                                @error('poliza_vigencia_hasta')
                                    <div class="error-text">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-field">
                            <div class="form-label">Nombre del tomador del seguro</div>
                            <input type="text" name="poliza_tomador" value="{{ old('poliza_tomador') }}" placeholder="Nombre completo" class="input-real" required>
                            @error('poliza_tomador')
                                <div class="error-text">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-field">
                            <div class="form-label">Monto asegurado</div>
                            <input type="number" name="poliza_monto" value="{{ old('poliza_monto') }}" placeholder="$ 0,00" step="0.01" class="input-real" required>
                            @error('poliza_monto')
                                <div class="error-text">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-field">
                            <div class="form-label">Subir documento de la póliza</div>
                            <div class="upload-area" onclick="document.getElementById('fileInput').click()">
                                <div class="upload-icon">
                                    <iconify-icon icon="lucide:file-text" style="font-size: 20px; color: var(--primary)"></iconify-icon>
                                </div>
                                <div class="upload-title">Adjuntar póliza escaneada</div>
                                <div class="upload-subtitle">PDF o JPG (Máx. 10MB)</div>
                            </div>
                            <input type="file" id="fileInput" name="poliza_documento" accept=".pdf,.jpg,.jpeg,.png" onchange="showFileName(this)">
                            <div id="fileName" class="file-name"></div>
                            @error('poliza_documento')
                                <div class="error-text">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
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
        function showFileName(input) {
            const fileName = input.files[0]?.name;
            const fileNameDiv = document.getElementById('fileName');
            if (fileName) {
                fileNameDiv.textContent = '✓ ' + fileName;
            } else {
                fileNameDiv.textContent = '';
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            const select = document.querySelector('select[name="poliza_aseguradora"]');
            const otraField = document.getElementById('otra-aseguradora-field');
                
            function toggleOtra() {
                if (select.value === 'Otra') {
                    otraField.style.display = 'block';
                } else {
                    otraField.style.display = 'none';
                }
            }
        
            // Ejecutar al cargar (por old())
            toggleOtra();
        
            // Ejecutar al cambiar
            select.addEventListener('change', toggleOtra);
        });
    </script>
</body>
</html>
</x-guest-layout>