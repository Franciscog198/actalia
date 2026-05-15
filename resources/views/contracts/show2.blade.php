<x-guest-layout>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrato {{ $contract->unique_token }} - Registrado</title>
    
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    <script src="https://code.iconify.design/iconify-icon/3.0.0/iconify-icon.min.js"></script>
    
    <style>
        :root {
            --background: #ffffff;
            --foreground: #0b2340;
            --border: #00000014;
            --input: #f5f7fa;
            --primary: #1e6fff;
            --primary-foreground: #ffffff;
            --secondary: #f0f6ff;
            --secondary-foreground: #0b2340;
            --muted: #f0f0f3;
            --muted-foreground: #6b7280;
            --success: #16a34a;
            --success-foreground: #ffffff;
            --accent: #f59e0b;
            --accent-foreground: #0b2340;
            --destructive: #dc2626;
            --destructive-foreground: #ffffff;
            --warning: #fbbf24;
            --warning-foreground: #0b2340;
            --card: #ffffff;
            --card-foreground: #0b2340;
            --radius-sm: 4px;
            --radius-md: 6px;
            --radius-lg: 8px;
            --radius-xl: 12px;
            --font-family-body: Inter;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background: var(--background);
            color: var(--foreground);
            font-family: var(--font-family-body), system-ui, sans-serif;
            padding: 56px 20px 72px;
        }

        .page {
            width: 100%;
            max-width: 920px;
            margin: 0 auto;
        }

        .report-shell {
            width: 100%;
            background: var(--card);
            border-radius: var(--radius-lg);
            box-shadow: 0 12px 36px rgba(11, 35, 64, 0.12);
            padding: 56px 76px 52px;
        }

        @media (max-width: 768px) {
            .report-shell {
                padding: 32px 20px;
            }
        }

        .header {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            margin-bottom: 36px;
        }

        .logo-wrap {
            margin-bottom: 18px;
        }

        .logo {
            width: 178px;
            height: auto;
        }

        .title {
            margin: 0;
            font-size: 32px;
            line-height: 1.15;
            font-weight: 800;
            color: var(--foreground);
        }

        .metrics-block {
            margin-bottom: 38px;
        }

        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
        }

        @media (max-width: 768px) {
            .metrics-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .metric {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .metric-icon {
            width: 46px;
            height: 46px;
            border-radius: 999px;
            border: 1px solid var(--border);
            background: var(--card);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .metric-copy {
            display: flex;
            flex-direction: column;
            gap: 2px;
            min-width: 0;
        }

        .metric-label {
            font-size: 13px;
            font-weight: 700;
            color: var(--foreground);
            white-space: nowrap;
        }

        .metric-value {
            font-size: 14px;
            font-weight: 600;
            color: var(--foreground);
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .status-pill {
            display: inline-flex;
            padding: 4px 10px;
            border-radius: var(--radius-xl);
            background: var(--secondary);
            color: var(--primary);
            font-size: 12px;
            font-weight: 700;
        }

        .status-pill.completed {
            background: #d1fae5;
            color: #065f46;
        }

        .status-pill.pending {
            background: #fff3cd;
            color: #856404;
        }

        .two-col {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
            margin-bottom: 38px;
        }

        @media (max-width: 768px) {
            .two-col {
                grid-template-columns: 1fr;
            }
        }

        .panel {
            background: var(--muted);
            overflow: hidden;
            border-radius: var(--radius-md);
        }

        .panel-title {
            background: var(--success);
            color: var(--success-foreground);
            padding: 14px 16px;
            font-size: 15px;
            font-weight: 700;
        }

        .panel-body {
            padding: 18px;
            min-height: 252px;
        }

        .table {
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        .row {
            display: grid;
            grid-template-columns: minmax(0, 1fr) auto;
            gap: 16px;
            padding: 11px 0;
            border-bottom: 1px solid var(--border);
            align-items: center;
        }

        .row:last-child {
            border-bottom: none;
        }

        .key {
            font-size: 14px;
            font-weight: 500;
            color: var(--muted-foreground);
        }

        .val {
            font-size: 14px;
            font-weight: 700;
            color: var(--foreground);
            text-align: right;
            white-space: nowrap;
        }

        .payment-split-body {
            padding: 16px;
            min-height: auto;
        }

        .payment-split {
            display: grid;
            grid-template-columns: 1fr;
            gap: 12px;
        }

        .payment-split-card {
            background: var(--card);
            border-radius: var(--radius-md);
            padding: 16px 14px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            min-height: 150px;
            justify-content: center;
        }

        .payment-role {
            font-size: 14px;
            font-weight: 700;
            color: var(--foreground);
            margin-bottom: 14px;
        }

        .split-amount {
            font-size: 28px;
            line-height: 1.05;
            font-weight: 800;
            color: var(--foreground);
        }

        .payment-caption {
            margin-top: 10px;
            font-size: 13px;
            line-height: 1.35;
            color: var(--muted-foreground);
        }

        .payment-pill {
            margin-top: 16px;
            padding: 7px 12px;
            font-size: 12px;
            border-radius: var(--radius-xl);
            background: var(--warning);
            color: var(--warning-foreground);
            font-weight: 700;
        }

        .payment-pill-success {
            background: var(--success);
            color: var(--success-foreground);
        }

        .section {
            position: relative;
            margin-bottom: 28px;
            padding-left: 26px;
        }

        .section:last-of-type {
            margin-bottom: 0;
        }

        .section-head {
            min-height: 48px;
            display: flex;
            align-items: center;
            padding: 0 24px 0 50px;
            font-size: 15px;
            font-weight: 700;
            color: var(--success-foreground);
            background: var(--success);
            border-radius: var(--radius-md);
        }

        .section-body {
            background: var(--muted);
            padding: 24px;
            border-radius: 0 0 var(--radius-md) var(--radius-md);
        }

        .section-dot {
            position: absolute;
            left: 0;
            top: -7px;
            width: 56px;
            height: 56px;
            border-radius: 999px;
            background: var(--success);
        }

        .signers {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        @media (max-width: 768px) {
            .signers {
                grid-template-columns: 1fr;
            }
        }

        .signer-card {
            background: var(--card);
            border-radius: var(--radius-md);
            padding: 16px;
            min-height: 140px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .tag {
            display: inline-flex;
            width: fit-content;
            padding: 4px 10px;
            border-radius: var(--radius-xl);
            font-size: 11px;
            font-weight: 700;
            color: var(--success-foreground);
            background: var(--success);
        }

        .signer-name {
            font-size: 18px;
            font-weight: 800;
            color: var(--foreground);
            margin: 0;
        }

        .signer-line {
            font-size: 13px;
            font-weight: 500;
            color: var(--muted-foreground);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .docs-row {
            display: flex;
            gap: 14px;
            overflow-x: auto;
            padding-bottom: 8px;
        }

        .doc-card {
            width: 132px;
            flex-shrink: 0;
            background: var(--card);
            border-radius: var(--radius-md);
            padding: 8px;
            display: flex;
            flex-direction: column;
            gap: 8px;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .doc-card:hover {
            transform: scale(1.05);
        }

        .doc-thumb {
            width: 100%;
            height: 92px;
            background: var(--input);
            border-radius: var(--radius-sm);
            overflow: hidden;
        }

        .doc-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .doc-label {
            font-size: 12px;
            font-weight: 500;
            color: var(--foreground);
            text-align: center;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .tip {
            margin-top: 20px;
            background: color-mix(in srgb, var(--warning) 32%, var(--card));
            color: var(--warning-foreground);
            padding: 12px 16px;
            border-radius: var(--radius-sm);
            font-size: 13px;
            font-weight: 500;
        }

        .token-text {
            font-size: 14px;
            font-weight: 500;
            color: var(--muted-foreground);
            margin-bottom: 14px;
        }

        .token-box {
            background: var(--card);
            border: 1px dashed var(--border);
            border-radius: var(--radius-sm);
            padding: 16px 20px;
            text-align: center;
            color: var(--destructive);
            font-size: 15px;
            font-weight: 700;
            letter-spacing: 1px;
            word-break: break-all;
        }

        .actions {
            width: 100%;
            display: flex;
            justify-content: center;
            margin-top: 44px;
        }

        .actions-inner {
            width: 100%;
            max-width: 654px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 14px;
        }

        .btn-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
            width: 100%;
        }

        @media (max-width: 768px) {
            .btn-row {
                grid-template-columns: 1fr;
            }
        }

        .btn {
            min-height: 48px;
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            padding: 0 20px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-red {
            background: var(--destructive);
            color: var(--destructive-foreground);
        }

        .btn-red:hover {
            background: #b91c1c;
        }

        .btn-outline {
            background: var(--card);
            color: var(--destructive);
            border: 1px solid var(--border);
        }

        .btn-outline:hover {
            background: var(--muted);
        }

        .btn-primary {
            width: 100%;
            background: var(--success);
            color: var(--success-foreground);
            min-height: 50px;
        }

        .btn-primary:hover {
            background: #15803d;
        }

        .btn-subtle {
            width: fit-content;
            background: var(--card);
            color: var(--muted-foreground);
            border: 1px solid var(--border);
        }

        .btn-subtle:hover {
            background: var(--muted);
        }

        .footer-logo {
            margin-top: 10px;
        }

        .footer-logo img {
            width: 90px;
            height: auto;
        }

        /* Modal */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.9);
            z-index: 9999;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .modal-overlay.active {
            display: flex;
        }

        .modal-image {
            max-width: 100%;
            max-height: 90vh;
            border-radius: 10px;
        }

        .modal-close {
            position: absolute;
            top: 20px;
            right: 20px;
            background: white;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            font-size: 24px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="page">
        <div class="report-shell">
            <!-- Header -->
            <div class="header">
                <div class="logo-wrap">
                    <img class="logo" src="{{ asset('/assets/images/actalia.png') }}" alt="Registrado">
                </div>
                <h1 class="title">Contrato Registrado</h1>
            </div>

            <!-- Métricas -->
            <div class="metrics-block">
                <div class="metrics-grid">
                    <div class="metric">
                        <div class="metric-icon">
                            <iconify-icon icon="lucide:{{ $contract->contract_type == 'vivienda' ? 'home' : ($contract->contract_type == 'cochera' ? 'car' : 'store') }}" style="font-size: 22px; color: var(--muted-foreground)"></iconify-icon>
                        </div>
                        <div class="metric-copy">
                            <span class="metric-label">Tipo de Alquiler:</span>
                            <span class="metric-value">{{ ucfirst($contract->contract_type) }}</span>
                        </div>
                    </div>

                    <div class="metric">
                        <div class="metric-icon">
                            <iconify-icon icon="lucide:calendar-clock" style="font-size: 22px; color: var(--muted-foreground)"></iconify-icon>
                        </div>
                        <div class="metric-copy">
                            <span class="metric-label">Duración:</span>
                            <span class="metric-value">{{ $contract->start_date->diffInMonths($contract->end_date) }} meses</span>
                        </div>
                    </div>

                    <div class="metric">
                        <div class="metric-icon">
                            <iconify-icon icon="lucide:info" style="font-size: 22px; color: var(--muted-foreground)"></iconify-icon>
                        </div>
                        <div class="metric-copy">
                            <span class="metric-label">Estado:</span>
                            @if($contract->status == 'completed')
                                <span class="status-pill completed">✓ Completo</span>
                            @elseif($contract->status == 'pending_payment')
                                <span class="status-pill pending">⏳ Pendiente</span>
                            @else
                                <span class="status-pill">📝 Borrador</span>
                            @endif
                        </div>
                    </div>

                    <div class="metric">
                        <div class="metric-icon">
                            <iconify-icon icon="lucide:map-pin" style="font-size: 22px; color: var(--muted-foreground)"></iconify-icon>
                        </div>
                        <div class="metric-copy">
                            <span class="metric-label">Dirección:</span>
                            <span class="metric-value">{{ $contract->city }}, {{ $contract->address }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dos columnas -->
            <div class="section">
                <!-- Panel Contrato -->
                <div class="panel">
                    <div class="panel-title">Información del Contrato</div>
                    <div class="panel-body">
                        <div class="table">
                            <div class="row">
                                <span class="key">Dirección:</span>
                                <span class="val">{{ $contract->address }}</span>
                            </div>
                            <div class="row">
                                <span class="key">Ciudad:</span>
                                <span class="val">{{ $contract->city }}</span>
                            </div>
                            <div class="row">
                                <span class="key">Provincia:</span>
                                <span class="val">{{ $contract->province }}</span>
                            </div>
                            <div class="row">
                                <span class="key">Inicio del Contrato:</span>
                                <span class="val">{{ $contract->start_date->format('d/m/Y') }}</span>
                            </div>
                            <div class="row">
                                <span class="key">Fin del Contrato:</span>
                                <span class="val">{{ $contract->end_date->format('d/m/Y') }}</span>
                            </div>
                            <div class="row">
                                <span class="key">Fecha de Registro:</span>
                                <span class="val">{{ $contract->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Panel Pago 
                <div class="panel">
                    <div class="panel-title">Información de Pago</div>
                    <div class="panel-body payment-split-body">
                        <div class="payment-split">
                            @foreach($contract->payments as $payment)
                                <div class="payment-split-card">
                                    <div class="payment-role">{{ $payment->payer_type == 'locador' ? 'Locador' : 'Locatario' }}</div>
                                    <p class="split-amount">${{ number_format($payment->amount, 2, ',', '.') }}</p>
                                    <div class="payment-caption">Monto correspondiente</div>
                                    <div class="payment-pill {{ $payment->status == 'verified' ? 'payment-pill-success' : '' }}">
                                        Estado: {{ $payment->status == 'verified' ? 'Pagado' : 'Pendiente' }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div> -->
            </div>

            <!-- Firmantes -->
            <div class="section">
                <div class="section-dot"></div>
                <div class="section-head">Firmantes del Contrato</div>
                <div class="section-body">
                    <div class="signers">
                        @foreach($contract->users as $user)
                            <div class="signer-card">
                                <span class="tag">{{ ucfirst(str_replace('_', ' ', $user->pivot->role_in_contract)) }}</span>
                                <h3 class="signer-name">{{ $user->name }}</h3>
                                <div class="signer-line">
                                    <iconify-icon icon="lucide:mail" style="font-size: 14px; color: var(--success)"></iconify-icon>
                                    {{ $user->email }}
                                </div>
                                <div class="signer-line">
                                    <iconify-icon icon="lucide:phone" style="font-size: 14px; color: var(--success)"></iconify-icon>
                                    {{ $user->phone }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Documentos -->
            @if($contract->documents->count() > 0)
            <div class="section">
                <div class="section-dot"></div>
                <div class="section-head">Documentos e Imágenes ({{ $contract->documents->count() }})</div>
                <div class="section-body">
                    <div class="docs-row">
                        @foreach($contract->documents as $doc)
                            <div class="doc-card" onclick="openModal('{{ asset('storage/' . $doc->storage_path) }}')">
                                <div class="doc-thumb">
                                    <img src="{{ asset('storage/' . ($doc->thumbnail_path ?? $doc->storage_path)) }}" alt="{{ $doc->document_type }}">
                                </div>
                                <div class="doc-label">{{ ucfirst(str_replace('_', ' ', $doc->document_type)) }}</div>
                            </div>
                        @endforeach
                    </div>
                    <div class="tip">💡 Tip: Toca cualquier imagen para verla en grande.</div>
                </div>
            </div>
            @endif

            <!-- Token -->
            <div class="section">
                <div class="section-dot"></div>
                <div class="section-head">Token del Contrato</div>
                <div class="section-body">
                    <div class="token-text">Guarda este token para acceder al contrato:</div>
                    <div class="token-box">{{ $contract->unique_token }}</div>
                </div>
            </div>

            <!-- Acciones -->
            <div class="actions">
                <div class="actions-inner">
                    <div class="btn-row">
                        <a href="{{ route('contracts.pdf', $contract->unique_token) }}" class="btn btn-red">
                            <iconify-icon icon="lucide:file-down" style="font-size: 18px;"></iconify-icon>
                            Descargar PDF
                        </a>
                        <a href="{{ route('contracts.pdfPreview', $contract->unique_token) }}" target="_blank" class="btn btn-outline">
                            <iconify-icon icon="lucide:file-search" style="font-size: 18px;"></iconify-icon>
                            Ver PDF
                        </a>
                    </div>
                    <a href="{{ route('register') }}" class="btn btn-primary">
                        <iconify-icon icon="lucide:plus" style="font-size: 18px;"></iconify-icon>
                        Crear Nuevo Contrato
                    </a>
                    <a href="{{ route('home') }}" class="btn btn-subtle">
                        <iconify-icon icon="lucide:home" style="font-size: 18px;"></iconify-icon>
                        Ir al Inicio
                    </a>
                    <div class="footer-logo">
                        <img src="{{ asset('/assets/images/actalia.png') }}" alt="Registrado">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal-overlay" id="imageModal" onclick="closeModal()">
        <button class="modal-close" onclick="closeModal()">×</button>
        <img src="" alt="Documento" class="modal-image" id="modalImage">
    </div>

    <script>
        function openModal(imageSrc) {
            document.getElementById('modalImage').src = imageSrc;
            document.getElementById('imageModal').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            document.getElementById('imageModal').classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeModal();
        });
    </script>
</body>
</html>
</x-guest-layout>