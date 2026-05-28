<x-guest-layout>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Información de Póliza - Actalia</title>
    
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
            max-width: 600px;
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

        .progress-fill-75 {
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

        .guarantee-header {
            display: flex;
            align-items: center;
            gap: 12px;
            padding-bottom: 12px;
            border-bottom: 1px solid var(--border);
        }

        .guarantee-icon-wrapper {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            background-color: var(--input);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .guarantee-title {
            font-size: 15px;
            font-weight: 600;
            color: var(--foreground);
        }

        .guarantee-subtitle {
            font-size: 13px;
            color: var(--muted-foreground);
            margin-top: 2px;
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

        .form-label {
            font-size: 13px;
            font-weight: 500;
            color: var(--muted-foreground);
        }

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

        .two-col-row {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 10px;
        }

        .upload-area {
            border: 2px dashed var(--border);
            border-radius: var(--radius-md);
            padding: 24px 16px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
            background-color: var(--input);
        }

        .upload-area:hover {
            border-color: var(--primary);
            background-color: rgba(10, 95, 180, 0.05);
        }

        .upload-icon {
            font-size: 32px;
            margin-bottom: 8px;
        }

        .upload-title {
            font-size: 14px;
            font-weight: 600;
            color: var(--foreground);
            margin-bottom: 4px;
        }

        .upload-subtitle {
            font-size: 12px;
            color: var(--muted-foreground);
        }

        .file-name {
            margin-top: 8px;
            font-size: 13px;
            color: var(--accent-foreground);
            font-weight: 500;
        }

        #fileInput {
            display: none;
        }

        .bottom-bar {
            border-top: 1px solid var(--border);
            background-color: var(--card);
            padding: 16px 20px 28px;
        }

        .btn-primary,
        .btn-secondary {
            border-radius: var(--radius-lg);
            padding: 14px 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 15px;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .btn-primary {
            width: 100%;
            background-color: var(--primary);
            color: var(--primary-foreground);
            box-shadow: 0 0 0 1px var(--accent);
        }

        .btn-primary:hover {
            opacity: 0.95;
        }

        .btn-secondary {
            flex: 1;
            background-color: var(--input);
            color: var(--foreground);
            border: 1px solid var(--border);
        }

        .btn-secondary:hover {
            background-color: var(--muted);
        }

        .btn-icon-wrapper {
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .error-text {
            font-size: 12px;
            color: var(--destructive);
            margin-top: 4px;
        }

        .alert {
            padding: 12px 14px;
            border-radius: var(--radius-md);
            font-size: 13px;
            margin-bottom: 12px;
        }

        .alert-danger {
            background-color: #fee2e2;
            border: 1px solid #fecaca;
            color: #991b1b;
        }

        /* SPINNER STYLES */
        .spinner-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            z-index: 9999;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .spinner-overlay.active {
            display: flex;
        }

        .spinner {
            width: 60px;
            height: 60px;
            border: 5px solid rgba(255, 255, 255, 0.3);
            border-top-color: #0a5faa;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .spinner-text {
            color: white;
            font-size: 16px;
            font-weight: 600;
            margin-top: 20px;
            text-align: center;
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

            <form method="POST" action="{{ route('wizard.store', '3b') }}" enctype="multipart/form-data" id="formPoliza">
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
                            <select 
                                name="poliza_aseguradora" 
                                id="poliza_aseguradora"
                                class="input-real"
                            >
                                <option value="">Seleccionar compañía</option>
                                <option value="Fianzas y Crédito" {{ old('poliza_aseguradora') == 'Fianzas y Crédito' ? 'selected' : '' }}>Fianzas y Crédito</option>
                                <option value="Berkley" {{ old('poliza_aseguradora') == 'Berkley' ? 'selected' : '' }}>Berkley</option>
                                <option value="Sancor Seguros" {{ old('poliza_aseguradora') == 'Sancor Seguros' ? 'selected' : '' }}>Sancor Seguros</option>
                                <option value="La Segunda" {{ old('poliza_aseguradora') == 'La Segunda' ? 'selected' : '' }}>La Segunda</option>
                                <option value="Otra" {{ old('poliza_aseguradora') == 'Otra' ? 'selected' : '' }}>Otra</option>
                            </select>
                            @error('poliza_aseguradora')
                                <div class="error-text">{{ $message }}</div>
                            @enderror
                        </div>

                        <div 
                            class="form-field" 
                            id="otra-aseguradora-field"
                            style="{{ old('poliza_aseguradora') == 'Otra' ? 'display:block;' : 'display:none;' }}"
                        >
                            <div class="form-label">Nombre de la aseguradora</div>
                            <input 
                                type="text"
                                name="poliza_aseguradora_otra"
                                value="{{ old('poliza_aseguradora_otra') }}"
                                placeholder="Ingrese la aseguradora"
                                class="input-real"
                            >
                        </div>

                        <div class="two-col-row">
                            <div class="form-field">
                                <div class="form-label">Número de póliza</div>
                                <input type="text" name="poliza_numero" value="{{ old('poliza_numero') }}" class="input-real" placeholder="Ej: 12345678">
                                @error('poliza_numero')
                                    <div class="error-text">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-field">
                                <div class="form-label">Número de certificado</div>
                                <input type="text" name="poliza_certificado" value="{{ old('poliza_certificado') }}" class="input-real" placeholder="Ej: ABC123">
                                @error('poliza_certificado')
                                    <div class="error-text">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-field">
                            <div class="form-label">Fecha de emisión</div>
                            <input type="date" name="poliza_emision" value="{{ old('poliza_emision') }}" class="input-real">
                            @error('poliza_emision')
                                <div class="error-text">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="two-col-row">
                            <div class="form-field">
                                <div class="form-label">Vigencia desde</div>
                                <input type="date" name="poliza_vigencia_desde" value="{{ old('poliza_vigencia_desde') }}" class="input-real">
                                @error('poliza_vigencia_desde')
                                    <div class="error-text">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-field">
                                <div class="form-label">Vigencia hasta</div>
                                <input type="date" name="poliza_vigencia_hasta" value="{{ old('poliza_vigencia_hasta') }}" class="input-real">
                                @error('poliza_vigencia_hasta')
                                    <div class="error-text">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-field">
                            <div class="form-label">Nombre del tomador del seguro</div>
                            <input type="text" name="poliza_tomador" value="{{ old('poliza_tomador') }}" class="input-real" placeholder="Nombre completo">
                            @error('poliza_tomador')
                                <div class="error-text">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-field">
                            <div class="form-label">Monto asegurado</div>
                            <input
                                type="text"
                                name="poliza_monto"
                                value="{{ old('poliza_monto') }}"
                                class="input-real money-input"
                                placeholder="$ 0,00"
                                inputmode="numeric"
                            >
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
                                <div class="upload-title">Adjuntar póliza</div>
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
            </form>
        </main>

        <footer class="bottom-bar">
            <div class="two-col-row" style="gap: 12px">
                <button type="button" class="btn-secondary" onclick="window.history.back()">
                    <span>Atrás</span>
                </button>
                <button type="submit" form="formPoliza" class="btn-primary">
                    <span>Continuar</span>
                    <div class="btn-icon-wrapper">
                        <iconify-icon icon="lucide:arrow-right" style="font-size: 18px; color: white;"></iconify-icon>
                    </div>
                </button>
            </div>
        </footer>
    </div>

    <!-- SPINNER OVERLAY -->
    <div id="spinnerOverlay" class="spinner-overlay">
        <div class="spinner"></div>
        <div class="spinner-text">
            Procesando datos...
            <br>
            <small style="font-size: 12px; margin-top: 8px; opacity: 0.8;">
                Por favor espera
            </small>
        </div>
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

            /**
             * =====================================
             * TOGGLE ASEGURADORA
             * =====================================
             */
            const select = document.querySelector('select[name="poliza_aseguradora"]');
            const otraField = document.getElementById('otra-aseguradora-field');

            function toggleOtra() {

                if (select.value === 'Otra') {

                    otraField.style.display = 'block';

                } else {

                    otraField.style.display = 'none';
                }
            }

            toggleOtra();

            select.addEventListener('change', toggleOtra);

            /**
             * =====================================
             * MONEY INPUT
             * =====================================
             */
            const moneyInputs = document.querySelectorAll('.money-input');

            moneyInputs.forEach(input => {

                function formatMoney(value) {

                    // eliminar todo excepto números
                    value = value.replace(/\D/g, '');

                    // vacío
                    if (value === '') {
                        return '$ ';
                    }

                    // formatear miles
                    return '$ ' + Number(value).toLocaleString('es-AR');
                }

                // mientras escribe
                input.addEventListener('input', function (e) {

                    e.target.value = formatMoney(
                        e.target.value
                    );
                });

                // valor inicial
                if (input.value) {

                    input.value = formatMoney(
                        input.value
                    );
                }
            });

            /**
             * =====================================
             * SPINNER + LIMPIAR MONEY
             * =====================================
             */
            const formPoliza = document.getElementById('formPoliza');
            const spinnerOverlay = document.getElementById('spinnerOverlay');

            formPoliza.addEventListener('submit', function(e) {

                const fileInput = document.getElementById('fileInput');


                // limpiar money inputs antes de enviar
                moneyInputs.forEach(input => {

                    let cleanValue = input.value;

                    cleanValue = cleanValue.replace(/\$/g, '');
                    cleanValue = cleanValue.replace(/\./g, '');
                    cleanValue = cleanValue.replace(/\s/g, '');

                    input.value = cleanValue;
                });

                // mostrar spinner
                spinnerOverlay.classList.add('active');
            });

        });

    </script>
</body>
</html>
</x-guest-layout>