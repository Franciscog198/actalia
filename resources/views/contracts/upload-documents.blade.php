<x-guest-layout>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Documentación y Firmas - Registrado</title>
    
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    <script src="https://code.iconify.design/iconify-icon/3.0.0/iconify-icon.min.js"></script>
    
    <style>
        :root {
            --background: #ffffff;
            --foreground: #072030;
            --border: #00000014;
            --input: #f4f7fa;
            --primary: #0a4f8a;
            --primary-foreground: #ffffff;
            --muted: #f3f5f7;
            --muted-foreground: #8f9aa3;
            --accent: #c7f02a;
            --card: #ffffff;
            --radius-md: 6px;
            --radius-lg: 8px;
            --font-family-body: Inter;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: var(--background);
            color: var(--foreground);
            font-family: var(--font-family-body), system-ui, -apple-system, sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        .app-wrapper {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            min-height: 100vh;
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
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--primary);
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
            width: 100%;
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
            gap: 16px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--muted);
            margin-bottom: 0;
        }

        .guarantee-icon-wrapper {
            width: 48px;
            height: 48px;
            border-radius: var(--radius-md);
            background-color: var(--input);
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid var(--accent);
            flex-shrink: 0;
        }

        .guarantee-title {
            font-size: 15px;
            font-weight: 600;
            color: var(--foreground);
        }

        .card-description {
            font-size: 14px;
            color: var(--muted-foreground);
            line-height: 1.5;
            padding-bottom: 8px;
        }

        .form-grid {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .form-field {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-label {
            font-size: 13px;
            font-weight: 500;
            color: var(--muted-foreground);
        }

        .upload-action-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 8px;
            border-radius: var(--radius-md);
            border: 1px solid var(--border);
            background-color: var(--input);
            font-size: 13px;
            font-weight: 500;
            color: var(--foreground);
            cursor: pointer;
            transition: all 0.2s;
        }

        .upload-action-btn:hover {
            background-color: var(--card);
            border-color: var(--primary);
        }

        .upload-action-btn iconify-icon {
            color: var(--primary);
            font-size: 16px;
        }

        .upload-area {
            border: 1px dashed var(--muted-foreground);
            border-radius: var(--radius-md);
            padding: 24px 16px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background-color: var(--input);
            text-align: center;
            margin-top: 4px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .upload-area:hover {
            border-color: var(--primary);
            background-color: var(--card);
        }

        .upload-icon {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background-color: var(--card);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 4px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            border: 2px solid var(--accent);
        }

        .upload-title {
            font-size: 14px;
            font-weight: 600;
            color: var(--foreground);
        }

        .page-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
            list-style: none;
            margin-top: 4px;
            margin-bottom: 8px;
        }

        .page-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 16px;
            border-radius: var(--radius-md);
            background-color: var(--input);
            border: 1px solid var(--border);
            font-size: 14px;
            font-weight: 500;
            color: var(--foreground);
        }

        .page-item-icon {
            color: #16a34a;
            font-size: 20px;
            display: flex;
        }

        .page-item.pending .page-item-icon {
            color: var(--muted-foreground);
        }

        .btn-outline {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px;
            border-radius: var(--radius-md);
            border: 1px dashed var(--primary);
            background-color: transparent;
            color: var(--primary);
            font-size: 14px;
            font-weight: 600;
            margin-top: 4px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-outline:hover {
            background-color: var(--input);
        }

        .help-text {
            font-size: 13px;
            color: var(--muted-foreground);
            text-align: center;
            margin-top: 4px;
            line-height: 1.4;
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
            box-shadow: 0 0 0 1px var(--accent);
            border: none;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-primary:hover {
            background-color: #083d6e;
        }

        .btn-secondary {
            width: 100%;
            border-radius: var(--radius-lg);
            background-color: transparent;
            border: 1px solid var(--border);
            color: var(--foreground);
            padding: 14px 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-secondary:hover {
            background-color: var(--input);
        }

        .btn-icon-wrapper {
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent);
        }

        .hidden-input {
            display: none;
        }

        .preview-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
            margin-top: 10px;
        }

        .preview-item {
            position: relative;
            border-radius: var(--radius-md);
            overflow: hidden;
            border: 1px solid var(--border);
        }

        .preview-item img {
            width: 100%;
            height: 120px;
            object-fit: cover;
        }

        .preview-remove {
            position: absolute;
            top: 4px;
            right: 4px;
            background: rgba(220, 53, 69, 0.9);
            color: white;
            border: none;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            cursor: pointer;
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .error-text {
            color: #dc3545;
            font-size: 12px;
            margin-top: 4px;
        }

        .alert {
            padding: 12px 16px;
            border-radius: var(--radius-lg);
            margin-bottom: 16px;
        }

        .alert-danger {
            background-color: #fee;
            color: #c00;
            border: 1px solid #fcc;
        }

        .alert-success {
            background-color: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }
    </style>
</head>
<body>
    <div class="app-wrapper">
        <main class="main-content">
            <header class="page-header">
                <div class="step-label">Paso 4 de 4</div>
                <h1 class="page-title">Documentación y firmas</h1>
                <div class="progress-track">
                    <div class="progress-fill"></div>
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

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('documents.store', $contract->unique_token) }}" enctype="multipart/form-data" id="uploadForm">
                @csrf

                <!-- Identidades de firmantes -->
                <section class="editorial-block">
                    <div class="guarantee-header">
                        <div class="guarantee-icon-wrapper">
                            <iconify-icon icon="lucide:id-card" style="font-size: 24px; color: var(--primary)"></iconify-icon>
                        </div>
                        <div>
                            <div class="guarantee-title">Identidades de los firmantes</div>
                        </div>
                    </div>
                    <p class="card-description">
                        Subí una foto del DNI de cada persona que firma el contrato.
                    </p>
                    <div class="form-grid">
                        <div class="form-field">
                            <div class="form-label">Frente DNI locador</div>
                            <div class="upload-action-btn" onclick="document.getElementById('dni_locador').click()">
                                <iconify-icon icon="lucide:camera"></iconify-icon>
                                <span>Tomar foto</span>
                            </div>
                            <input type="file" id="dni_locador" name="documents[dni_locador][]" accept="image/*" capture="environment" multiple class="hidden-input" onchange="handleFileUpload(this, 'preview_dni_locador')">
                            <div id="preview_dni_locador" class="preview-container"></div>
                        </div>

                        <div class="form-field">
                            <div class="form-label">Frente DNI locatario</div>
                            <div class="upload-action-btn" onclick="document.getElementById('dni_locatario').click()">
                                <iconify-icon icon="lucide:camera"></iconify-icon>
                                <span>Tomar foto</span>
                            </div>
                            <input type="file" id="dni_locatario" name="documents[dni_locatario][]" accept="image/*" capture="environment" multiple class="hidden-input" onchange="handleFileUpload(this, 'preview_dni_locatario')">
                            <div id="preview_dni_locatario" class="preview-container"></div>
                        </div>

                        <div class="form-field">
                            <div class="form-label">Frente DNI garante (si corresponde)</div>
                            <div class="upload-action-btn" onclick="document.getElementById('dni_garante').click()">
                                <iconify-icon icon="lucide:camera"></iconify-icon>
                                <span>Tomar foto</span>
                            </div>
                            <input type="file" id="dni_garante" name="documents[dni_garante][]" accept="image/*" capture="environment" multiple class="hidden-input" onchange="handleFileUpload(this, 'preview_dni_garante')">
                            <div id="preview_dni_garante" class="preview-container"></div>
                        </div>
                    </div>
                </section>

                <!-- Evidencia del momento de firma -->
                <section class="editorial-block">
                    <div class="guarantee-header">
                        <div class="guarantee-icon-wrapper">
                            <iconify-icon icon="lucide:users" style="font-size: 24px; color: var(--primary)"></iconify-icon>
                        </div>
                        <div>
                            <div class="guarantee-title">Evidencia del momento de firma</div>
                        </div>
                    </div>
                    <p class="card-description">
                        Sacá fotos de las partes durante la reunión de firma del contrato.
                    </p>
                    <div class="form-grid">
                        <div class="form-field">
                            <div class="form-label">Foto locador</div>
                            <div class="upload-action-btn" onclick="document.getElementById('foto_locador').click()">
                                <iconify-icon icon="lucide:camera"></iconify-icon>
                                <span>Tomar foto</span>
                            </div>
                            <input type="file" id="foto_locador" name="documents[foto_locador][]" accept="image/*" capture="environment" multiple class="hidden-input" onchange="handleFileUpload(this, 'preview_foto_locador')">
                            <div id="preview_foto_locador" class="preview-container"></div>
                        </div>

                        <div class="form-field">
                            <div class="form-label">Foto locatario</div>
                            <div class="upload-action-btn" onclick="document.getElementById('foto_locatario').click()">
                                <iconify-icon icon="lucide:camera"></iconify-icon>
                                <span>Tomar foto</span>
                            </div>
                            <input type="file" id="foto_locatario" name="documents[foto_locatario][]" accept="image/*" capture="environment" multiple class="hidden-input" onchange="handleFileUpload(this, 'preview_foto_locatario')">
                            <div id="preview_foto_locatario" class="preview-container"></div>
                        </div>

                        <div class="form-field">
                            <div class="form-label">Foto garante (si corresponde)</div>
                            <div class="upload-action-btn" onclick="document.getElementById('foto_garante').click()">
                                <iconify-icon icon="lucide:camera"></iconify-icon>
                                <span>Tomar foto</span>
                            </div>
                            <input type="file" id="foto_garante" name="documents[foto_garante][]" accept="image/*" capture="environment" multiple class="hidden-input" onchange="handleFileUpload(this, 'preview_foto_garante')">
                            <div id="preview_foto_garante" class="preview-container"></div>
                        </div>
                    </div>
                </section>

                <!-- Contrato firmado -->
                <section class="editorial-block">
                    <div class="guarantee-header">
                        <div class="guarantee-icon-wrapper">
                            <iconify-icon icon="lucide:file-signature" style="font-size: 24px; color: var(--primary)"></iconify-icon>
                        </div>
                        <div>
                            <div class="guarantee-title">Subir contrato firmado</div>
                        </div>
                    </div>
                    <p class="card-description">
                        Registrá todas las páginas del contrato firmado con fotos claras.
                    </p>
                    <div class="form-grid">
                        <div class="upload-area" onclick="document.getElementById('contrato_firmado').click()">
                            <div class="upload-icon">
                                <iconify-icon icon="lucide:camera" style="font-size: 20px; color: var(--primary)"></iconify-icon>
                            </div>
                            <div class="upload-title">Tomar fotos del contrato</div>
                        </div>
                        <input type="file" id="contrato_firmado" name="documents[contrato_firmado][]" accept="image/*" capture="environment" multiple class="hidden-input" onchange="handleContractUpload(this)">
                        
                        <ul class="page-list" id="contract_pages"></ul>
                        
                        <div class="help-text">Asegurate de que todas las páginas estén firmadas y sean legibles.</div>
                    </div>
                </section>
        </main>

        <footer class="bottom-bar">
            <div style="display:flex; gap:12px;">
                <button type="button" class="btn-secondary" style="flex:1" onclick="window.history.back()">
                    <span>Atrás</span>
                </button>
                <button type="submit" class="btn-primary" style="flex:2" id="submitBtn">
                    <span>Registrar contrato</span>
                    <div class="btn-icon-wrapper">
                        <iconify-icon icon="lucide:check-circle" style="font-size:18px"></iconify-icon>
                    </div>
                </button>
            </div>
        </footer>
            </form>
    </div>

    <script>
        document.getElementById('uploadForm').addEventListener('submit', function (e) {
            Object.keys(filesStorage).forEach(category => {
                const input = document.getElementById(category);
            
                if (input && filesStorage[category].length > 0) {
                    const dataTransfer = new DataTransfer();
                
                    filesStorage[category].forEach(file => {
                        dataTransfer.items.add(file);
                    });
                
                    input.files = dataTransfer.files;
                }
            });
        });
        // Almacenar archivos por categoría
        const filesStorage = {
            dni_locador: [],
            dni_locatario: [],
            dni_garante: [],
            foto_locador: [],
            foto_locatario: [],
            foto_garante: [],
            contrato_firmado: []
        };

        function handleFileUpload(input, previewId) {
            const category = input.id;
            const files = Array.from(input.files);
            
            // Agregar nuevos archivos
            filesStorage[category] = [...filesStorage[category], ...files];
            
            // Actualizar el input con todos los archivos
            updateInputFiles(input, filesStorage[category]);
            
            // Mostrar preview
            showPreview(previewId, filesStorage[category], category);
        }

        function handleContractUpload(input) {
            const files = Array.from(input.files);
            filesStorage.contrato_firmado = [...filesStorage.contrato_firmado, ...files];
            
            updateInputFiles(input, filesStorage.contrato_firmado);
            showContractPages();
        }

        function updateInputFiles(input, files) {
            const dataTransfer = new DataTransfer();
            files.forEach(file => dataTransfer.items.add(file));
            input.files = dataTransfer.files;
        }

        function showPreview(containerId, files, category) {
            const container = document.getElementById(containerId);
            container.innerHTML = '';
            
            files.forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'preview-item';
                    div.innerHTML = `
                        <img src="${e.target.result}" alt="Preview">
                        <button type="button" class="preview-remove" onclick="removeFile('${category}', ${index}, '${containerId}')">✕</button>
                    `;
                    container.appendChild(div);
                };
                reader.readAsDataURL(file);
            });
        }

        function showContractPages() {
            const container = document.getElementById('contract_pages');
            container.innerHTML = '';
            
            filesStorage.contrato_firmado.forEach((file, index) => {
                const li = document.createElement('li');
                li.className = 'page-item';
                li.innerHTML = `
                    <span>Página ${index + 1}</span>
                    <div style="display: flex; gap: 8px; align-items: center;">
                        <iconify-icon icon="lucide:check-circle-2" class="page-item-icon"></iconify-icon>
                        <button type="button" class="preview-remove" onclick="removeContractPage(${index})" style="position: static;">✕</button>
                    </div>
                `;
                container.appendChild(li);
            });
        }

        function removeFile(category, index, containerId) {
            filesStorage[category].splice(index, 1);
            const input = document.getElementById(category);
            updateInputFiles(input, filesStorage[category]);
            showPreview(containerId, filesStorage[category], category);
        }

        function removeContractPage(index) {
            filesStorage.contrato_firmado.splice(index, 1);
            const input = document.getElementById('contrato_firmado');
            updateInputFiles(input, filesStorage.contrato_firmado);
            showContractPages();
        }
    </script>
</body>
</html>
</x-guest-layout>