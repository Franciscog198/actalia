<x-guest-layout>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realizar Pago - Registrado</title>
    
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
            --success: #16a34a;
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
            text-align: center;
        }

        .step-label {
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--success);
        }

        .page-title {
            font-size: 24px;
            font-weight: 600;
            color: var(--foreground);
        }

        .page-subtitle {
            font-size: 15px;
            color: var(--muted-foreground);
            line-height: 1.5;
        }

        .editorial-block {
            background-color: var(--card);
            border-radius: var(--radius-lg);
            border: 1px solid var(--border);
            padding: 24px 20px;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .payment-header {
            display: flex;
            align-items: center;
            gap: 16px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--muted);
        }

        .payment-icon-wrapper {
            width: 56px;
            height: 56px;
            border-radius: var(--radius-md);
            background-color: var(--input);
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid var(--accent);
        }

        .payment-title {
            font-size: 16px;
            font-weight: 600;
            color: var(--foreground);
        }

        .qr-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 16px;
            padding: 24px;
            background-color: var(--input);
            border-radius: var(--radius-lg);
            border: 2px dashed var(--primary);
        }

        .qr-code {
            width: 250px;
            height: 250px;
            background-color: white;
            padding: 16px;
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .qr-code img {
            width: 100%;
            height: 100%;
        }

        .alias-box {
            width: 100%;
            background-color: white;
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            padding: 16px;
            text-align: center;
        }

        .alias-label {
            font-size: 13px;
            color: var(--muted-foreground);
            margin-bottom: 8px;
        }

        .alias-value {
            font-size: 20px;
            font-weight: 600;
            color: var(--primary);
            letter-spacing: 0.5px;
        }

        .copy-btn {
            margin-top: 8px;
            padding: 8px 16px;
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: var(--radius-md);
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .info-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 12px;
            background-color: var(--input);
            border-radius: var(--radius-md);
        }

        .info-item iconify-icon {
            color: var(--primary);
            font-size: 20px;
            flex-shrink: 0;
            margin-top: 2px;
        }

        .info-text {
            font-size: 14px;
            line-height: 1.5;
            color: var(--foreground);
        }

        .upload-section {
            margin-top: 8px;
        }

        .upload-area {
            border: 1px dashed var(--muted-foreground);
            border-radius: var(--radius-md);
            padding: 24px 16px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            background-color: var(--input);
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
        }

        .upload-area:hover {
            border-color: var(--primary);
            background-color: var(--card);
        }

        .upload-icon {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background-color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid var(--accent);
        }

        .upload-title {
            font-size: 15px;
            font-weight: 600;
            color: var(--foreground);
        }

        .upload-subtitle {
            font-size: 13px;
            color: var(--muted-foreground);
        }

        .preview-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
            margin-top: 12px;
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
        }

        .btn-primary {
            width: 100%;
            border-radius: var(--radius-lg);
            background-color: var(--primary);
            color: var(--primary-foreground);
            padding: 16px;
            font-size: 16px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 0 0 1px var(--accent);
            transition: all 0.2s;
        }

        .btn-primary:hover {
            background-color: #083d6e;
        }

        .btn-primary:disabled {
            background-color: var(--muted);
            color: var(--muted-foreground);
            cursor: not-allowed;
        }

        .alert {
            padding: 12px 16px;
            border-radius: var(--radius-lg);
            margin-bottom: 16px;
        }

        .alert-info {
            background-color: #dbeafe;
            color: #1e40af;
            border: 1px solid #93c5fd;
        }

        .alert-success {
            background-color: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .hidden-input {
            display: none;
        }

        /* ESTILOS ACORDEÓN */
        .accordion-item {
            background-color: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            overflow: hidden;
            margin-bottom: 12px;
        }

        .accordion-header {
            padding: 18px 20px;
            background-color: var(--card);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: all 0.2s;
            user-select: none;
        }

        .accordion-header:hover {
            background-color: var(--input);
        }

        .accordion-header.active {
            background-color: var(--primary);
            color: var(--primary-foreground);
        }

        .accordion-header-content {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .accordion-icon {
            width: 40px;
            height: 40px;
            border-radius: var(--radius-md);
            background-color: var(--input);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }

        .accordion-header.active .accordion-icon {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .accordion-icon iconify-icon {
            font-size: 20px;
            color: var(--primary);
        }

        .accordion-header.active .accordion-icon iconify-icon {
            color: white;
        }

        .accordion-label {
            font-size: 16px;
            font-weight: 600;
        }

        .accordion-chevron {
            transition: transform 0.3s;
        }

        .accordion-chevron.rotated {
            transform: rotate(180deg);
        }

        .accordion-body {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }

        .accordion-body.open {
            max-height: 2000px;
            transition: max-height 0.5s ease-in;
        }

        .accordion-content {
            padding: 20px;
            border-top: 1px solid var(--border);
        }

        .payment-amount {
            font-size: 28px;
            font-weight: 700;
            color: var(--primary);
            text-align: center;
            padding: 16px 0;
        }

        .link-btn {
            width: 100%;
            padding: 14px;
            background-color: var(--accent);
            color: var(--foreground);
            border: none;
            border-radius: var(--radius-lg);
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
            transition: all 0.2s;
            margin-top: 16px;
        }

        .link-btn:hover {
            background-color: #96d129;
        }
    </style>
</head>
<body>
    <div class="app-wrapper">
        <main class="main-content">
            <header class="page-header">
                <div class="step-label">✓ Documentos subidos</div>
                <h1 class="page-title">Realizar el pago</h1>
                <p class="page-subtitle">
                    Completá el pago del servicio de registro para finalizar el proceso
                </p>
            </header>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="alert alert-info">
                <strong>💡 Importante:</strong> Una vez realizado el pago, subí los comprobantes para que podamos verificarlos y activar tu contrato.
            </div>

            <!-- ACORDEÓN LOCADOR -->
            <div class="accordion-item">
                <div class="accordion-header" onclick="toggleAccordion('locador')">
                    <div class="accordion-header-content">
                        <div class="accordion-icon">
                            <iconify-icon icon="lucide:user"></iconify-icon>
                        </div>
                        <div class="accordion-label">Pago Locador</div>
                    </div>
                    <iconify-icon icon="lucide:chevron-down" class="accordion-chevron" id="chevron-locador" style="font-size: 24px;"></iconify-icon>
                </div>
                <div class="accordion-body" id="body-locador">
                    <div class="accordion-content">
                        <div class="payment-amount">$ 15.000,00</div>

                        <div class="qr-container">
                            <div class="qr-code">
                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data={{ urlencode('https://link.mercadopago.com.ar/registrado') }}" alt="QR Locador">
                            </div>
                            <div style="text-align: center;">
                                <div style="font-size: 14px; font-weight: 600; color: var(--foreground); margin-bottom: 8px;">
                                    Escaneá el código QR
                                </div>
                                <div style="font-size: 13px; color: var(--muted-foreground);">
                                    Con Mercado Pago, MODO o tu billetera
                                </div>
                            </div>
                        </div>

                        <a href="https://link.mercadopago.com.ar/registrado" target="_blank" class="link-btn">
                            <iconify-icon icon="lucide:external-link" style="font-size: 18px;"></iconify-icon>
                            Abrir link de pago
                        </a>

                        <div class="alias-box" style="margin-top: 16px;">
                            <div class="alias-label">O transferí a este alias</div>
                            <div class="alias-value" id="aliasValue">REGISTRADO.DIGITAL</div>
                            <button type="button" class="copy-btn" onclick="copyAlias()">
                                <iconify-icon icon="lucide:copy" style="font-size: 14px;"></iconify-icon>
                                Copiar alias
                            </button>
                        </div>

                        <ul class="info-list" style="margin-top: 16px;">
                            <li class="info-item">
                                <iconify-icon icon="lucide:info"></iconify-icon>
                                <div class="info-text">
                                    <strong>Titular:</strong> Registrado S.A.<br>
                                    <strong>CUIT:</strong> 30-12345678-9
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- ACORDEÓN LOCATARIO -->
            <div class="accordion-item">
                <div class="accordion-header" onclick="toggleAccordion('locatario')">
                    <div class="accordion-header-content">
                        <div class="accordion-icon">
                            <iconify-icon icon="lucide:users"></iconify-icon>
                        </div>
                        <div class="accordion-label">Pago Locatario</div>
                    </div>
                    <iconify-icon icon="lucide:chevron-down" class="accordion-chevron" id="chevron-locatario" style="font-size: 24px;"></iconify-icon>
                </div>
                <div class="accordion-body" id="body-locatario">
                    <div class="accordion-content">
                        <div class="payment-amount">$ 15.000,00</div>

                        <div class="qr-container">
                            <div class="qr-code">
                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data={{ urlencode('https://link.mercadopago.com.ar/registrado') }}" alt="QR Locatario">
                            </div>
                            <div style="text-align: center;">
                                <div style="font-size: 14px; font-weight: 600; color: var(--foreground); margin-bottom: 8px;">
                                    Escaneá el código QR
                                </div>
                                <div style="font-size: 13px; color: var(--muted-foreground);">
                                    Con Mercado Pago, MODO o tu billetera
                                </div>
                            </div>
                        </div>

                        <div class="alias-box" style="margin-top: 16px;">
                            <div class="alias-label">O transferí a este alias</div>
                            <div class="alias-value">REGISTRADO.DIGITAL</div>
                            <button type="button" class="copy-btn" onclick="copyAlias()">
                                <iconify-icon icon="lucide:copy" style="font-size: 14px;"></iconify-icon>
                                Copiar alias
                            </button>
                        </div>

                        <ul class="info-list" style="margin-top: 16px;">
                            <li class="info-item">
                                <iconify-icon icon="lucide:info"></iconify-icon>
                                <div class="info-text">
                                    <strong>Titular:</strong> Registrado S.A.<br>
                                    <strong>CUIT:</strong> 30-12345678-9
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- SECCIÓN DE COMPROBANTES -->
            <form method="POST" action="{{ route('payment.confirm', $contract->unique_token) }}" enctype="multipart/form-data" id="paymentForm">
                @csrf

                <section class="editorial-block">
                    <div class="payment-header">
                        <div class="payment-icon-wrapper">
                            <iconify-icon icon="lucide:receipt" style="font-size: 28px; color: var(--primary)"></iconify-icon>
                        </div>
                        <div>
                            <div class="payment-title">Subir comprobantes de pago</div>
                        </div>
                    </div>

                    <!-- Comprobante Locador -->
                    <div class="upload-section">
                        <div style="font-size: 14px; font-weight: 600; color: var(--foreground); margin-bottom: 8px;">
                            Comprobante del Locador
                        </div>
                        <div class="upload-area" onclick="document.getElementById('comprobanteLocador').click()">
                            <div class="upload-icon">
                                <iconify-icon icon="lucide:camera" style="font-size: 24px; color: var(--primary)"></iconify-icon>
                            </div>
                            <div class="upload-title">Subir comprobante</div>
                            <div class="upload-subtitle">Foto o captura del pago</div>
                        </div>
                        <input type="file" id="comprobanteLocador" name="comprobante_locador" accept="image/*,application/pdf" capture="environment" class="hidden-input" onchange="showPreview(this, 'previewLocador')" required>
                        <div id="previewLocador" class="preview-container"></div>
                    </div>

                    <!-- Comprobante Locatario -->
                    <div class="upload-section" style="margin-top: 20px;">
                        <div style="font-size: 14px; font-weight: 600; color: var(--foreground); margin-bottom: 8px;">
                            Comprobante del Locatario
                        </div>
                        <div class="upload-area" onclick="document.getElementById('comprobanteLocatario').click()">
                            <div class="upload-icon">
                                <iconify-icon icon="lucide:camera" style="font-size: 24px; color: var(--primary)"></iconify-icon>
                            </div>
                            <div class="upload-title">Subir comprobante</div>
                            <div class="upload-subtitle">Foto o captura del pago</div>
                        </div>
                        <input type="file" id="comprobanteLocatario" name="comprobante_locatario" accept="image/*,application/pdf" capture="environment" class="hidden-input" onchange="showPreview(this, 'previewLocatario')" required>
                        <div id="previewLocatario" class="preview-container"></div>
                    </div>

                    <ul class="info-list" style="margin-top: 16px;">
                        <li class="info-item">
                            <iconify-icon icon="lucide:clock"></iconify-icon>
                            <div class="info-text">
                                Los pagos serán verificados en un plazo de 72 horas hábiles
                            </div>
                        </li>
                    </ul>
                </section>

                <button type="submit" class="btn-primary" id="submitBtn" disabled>
                    <iconify-icon icon="lucide:check-circle" style="font-size: 20px;"></iconify-icon>
                    <span>Confirmar pagos realizados</span>
                </button>
            </form>
        </main>
    </div>

    <script>
        function toggleAccordion(type) {
            const body = document.getElementById('body-' + type);
            const chevron = document.getElementById('chevron-' + type);
            const header = event.currentTarget;

            // Toggle open/close
            body.classList.toggle('open');
            chevron.classList.toggle('rotated');
            header.classList.toggle('active');
        }

        function copyAlias() {
            const alias = document.getElementById('aliasValue').textContent;
            navigator.clipboard.writeText(alias).then(() => {
                alert('✓ Alias copiado: ' + alias);
            });
        }

        function showPreview(input, previewId) {
            const preview = document.getElementById(previewId);
            preview.innerHTML = '';

            if (input.files && input.files[0]) {
                const file = input.files[0];
                const reader = new FileReader();

                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'preview-item';
                    
                    if (file.type.startsWith('image/')) {
                        div.innerHTML = `
                            <img src="${e.target.result}" alt="Comprobante">
                            <button type="button" class="preview-remove" onclick="removePreview('${input.id}', '${previewId}')">✕</button>
                        `;
                    } else {
                        div.innerHTML = `
                            <div style="padding: 20px; text-align: center;">
                                <iconify-icon icon="lucide:file-text" style="font-size: 48px; color: var(--primary);"></iconify-icon>
                                <div style="margin-top: 8px; font-size: 12px;">PDF adjunto</div>
                            </div>
                            <button type="button" class="preview-remove" onclick="removePreview('${input.id}', '${previewId}')">✕</button>
                        `;
                    }
                    
                    preview.appendChild(div);
                };

                reader.readAsDataURL(file);
                checkSubmitButton();
            }
        }

        function removePreview(inputId, previewId) {
            document.getElementById(inputId).value = '';
            document.getElementById(previewId).innerHTML = '';
            checkSubmitButton();
        }

        function checkSubmitButton() {
            const locadorFile = document.getElementById('comprobanteLocador').files.length > 0;
            const locatarioFile = document.getElementById('comprobanteLocatario').files.length > 0;
            const submitBtn = document.getElementById('submitBtn');
            
            submitBtn.disabled = !(locadorFile && locatarioFile);
        }
    </script>
</body>
</html>
</x-guest-layout>