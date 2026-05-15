<x-guest-layout>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrato {{ $contract->unique_token }} - Registrado</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://code.iconify.design/iconify-icon/3.0.0/iconify-icon.min.js"></script>
    
    <style>
        :root {
            --background: #ffffff;
            --foreground: #0b2340;
            --border: #00000014;
            --input: #f5f7fa;
            --primary: #0a5faa;
            --primary-foreground: #ffffff;
            --secondary: #f0f6ff;
            --secondary-foreground: #0b2340;
            --muted: #f0f0f3;
            --muted-foreground: #6b7280;
            --success: #0a5faa;
            --success-foreground: #ffffff;
            --accent: #92ffa5;
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
            min-height: 100vh;
            padding: 0 20px 72px;
            display: flex;
            justify-content: center;
        }

        .page {
            width: 100%;
            max-width: 1040px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .report-shell {
            width: 100%;
            background: var(--card);
            border-radius: var(--radius-lg);
            box-shadow: 0 12px 36px rgba(11, 35, 64, 0.12);
            padding: 28px 74px 56px;
        }

        @media (max-width: 768px) {
            body { padding: 0 12px 48px; }
            .report-shell { padding: 24px 20px 40px; }
        }

        .header {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            margin-bottom: 34px;
        }

        .logo-wrap {
            margin-bottom: 18px;
            display: flex;
            justify-content: center;
            width: 100%;
        }

        .logo {
            width: 180px;
            height: auto;
            display: block;
        }

        .title {
            margin: 0;
            font-size: 32px;
            line-height: 1.15;
            font-weight: 800;
            color: var(--foreground);
        }

        .subtitle {
            margin: 8px 0 0;
            font-size: 16px;
            line-height: 1.4;
            font-weight: 500;
            color: var(--muted-foreground);
        }

        .metrics-block {
            width: 100%;
            margin-bottom: 24px;
        }

        .metrics-grid {
            width: 100%;
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;
        }

        @media (max-width: 768px) {
            .metrics-grid { grid-template-columns: 1fr; }
        }

        .metric-card {
            min-width: 0;
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            padding: 16px 18px;
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .metric-icon {
            width: 42px;
            height: 42px;
            border-radius: 999px;
            background: var(--card);
            border: 1px solid color-mix(in srgb, var(--border) 90%, var(--card));
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            position: relative;
        }

        .metric-icon::after {
            content: "";
            position: absolute;
            top: -2px;
            right: -2px;
            width: 10px;
            height: 10px;
            border-radius: 999px;
            background: var(--accent);
            border: 2px solid var(--card);
        }

        .metric-copy {
            min-width: 0;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .metric-label {
            font-size: 13px;
            font-weight: 500;
            color: var(--muted-foreground);
            white-space: nowrap;
        }

        .metric-value {
            font-size: 14px;
            font-weight: 700;
            color: var(--foreground);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            width: fit-content;
            padding: 4px 10px;
            border-radius: var(--radius-xl);
            background: var(--secondary);
            color: var(--primary);
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
        }

        .status-pill::before {
            content: "";
            width: 8px;
            height: 8px;
            border-radius: 999px;
            background: var(--accent);
            flex: 0 0 auto;
        }

        .section {
    position: relative;
    margin-bottom: 22px;
    padding-left: 0;
}

.section-head {
    min-height: 56px;
    padding: 0 18px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    background: var(--primary);
    color: var(--primary-foreground);
    font-size: 15px;
    font-weight: 700;
    white-space: nowrap;
    border-radius: 0;
    cursor: pointer;
    user-select: none;
    transition: background 0.2s ease;
}

.section-head:hover {
    background: #084b87;
}

.section-title {
    display: flex;
    align-items: center;
    gap: 12px;
}

.section-bars {
    display: inline-flex;
    align-items: center;
    gap: 0;
    flex: 0 0 auto;
}

.section-bars span {
    display: block;
    width: 4px;
    height: 18px;
    background: var(--accent);
}

.section-title-text {
    display: inline-block;
}

.section-body {
    background: var(--muted);
    padding: 18px 22px 20px;
    overflow: hidden;
    max-height: 5000px;
    opacity: 1;
    transition:
        max-height 0.35s ease,
        opacity 0.25s ease,
        padding 0.25s ease;
}

.section.closed .section-body {
    max-height: 0;
    opacity: 0;
    padding-top: 0;
    padding-bottom: 0;
}

.accordion-icon {
    font-size: 20px;
    transition: transform 0.25s ease;
}

.section.closed .accordion-icon {
    transform: rotate(-90deg);
}

        .panel-table {
            display: flex;
            flex-direction: column;
        }

        .row {
            display: grid;
            grid-template-columns: minmax(0, 1fr) auto;
            gap: 16px;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid var(--border);
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

        .signers {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        @media (max-width: 768px) {
            .signers { grid-template-columns: 1fr; }
        }

        .signer-card {
            background: var(--card);
            border-radius: var(--radius-md);
            padding: 16px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            min-height: 132px;
        }

        .tag {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            width: fit-content;
            padding: 4px 10px;
            border-radius: var(--radius-xl);
            background: color-mix(in srgb, var(--accent) 38%, var(--card));
            color: var(--foreground);
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        .tag::before {
            content: "";
            width: 8px;
            height: 8px;
            border-radius: 999px;
            background: var(--accent);
            flex: 0 0 auto;
        }

        .signer-name {
            margin: 0;
            font-size: 18px;
            font-weight: 800;
            color: var(--foreground);
        }

        .signer-line {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            font-weight: 500;
            color: var(--muted-foreground);
            flex-wrap: wrap;
        }

        .docs-row {
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            gap: 14px;
        }

        @media (max-width: 768px) {
            .docs-row { 
                grid-template-columns: repeat(2, 1fr); 
                gap: 10px;
            }
        }

        .doc-card {
            background: var(--card);
            border-radius: var(--radius-md);
            padding: 8px;
            display: flex;
            flex-direction: column;
            gap: 8px;
            align-items: center;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .doc-card:hover {
            transform: scale(1.05);
        }

        .doc-thumb {
            width: 100%;
            aspect-ratio: 4 / 3;
            background: var(--input);
            border-radius: var(--radius-sm);
            overflow: hidden;
        }

        .doc-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .doc-label {
            width: 100%;
            text-align: center;
            font-size: 12px;
            font-weight: 500;
            color: var(--foreground);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .tip {
            margin-top: 18px;
            background: color-mix(in srgb, var(--warning) 38%, var(--card));
            color: var(--warning-foreground);
            border-radius: var(--radius-sm);
            padding: 12px 14px;
            font-size: 13px;
            font-weight: 500;
        }

        .token-text {
            margin-bottom: 14px;
            font-size: 14px;
            font-weight: 500;
            color: var(--muted-foreground);
        }

        .token-box {
            width: 100%;
            background: var(--card);
            border-radius: var(--radius-sm);
            padding: 16px 20px;
            text-align: center;
            color: var(--primary);
            font-size: 15px;
            font-weight: 700;
            letter-spacing: 1px;
            word-break: break-all;
            font-family: monospace;
        }

        .actions {
            width: 100%;
            display: flex;
            justify-content: center;
            margin-top: 40px;
        }

        .actions-inner {
            width: calc(100% - 84px);
            max-width: 620px;
            display: flex;
            flex-direction: column;
            gap: 14px;
            align-items: center;
        }

        @media (max-width: 768px) {
            .actions-inner { width: 100%; }
        }

        .btn-row {
            width: 100%;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        @media (max-width: 768px) {
            .btn-row { grid-template-columns: 1fr; }
        }

        .btn {
            min-height: 48px;
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 0 20px;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            white-space: nowrap;
            border: none;
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
            color: var(--primary);
            border: 1px solid color-mix(in srgb, var(--primary) 45%, var(--border));
        }

        .btn-outline:hover {
            background: var(--secondary);
        }

        .btn-primary {
            width: 100%;
            background: var(--primary);
            color: var(--primary-foreground);
        }

        .btn-primary:hover {
            background: #084b87;
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
            display: flex;
            justify-content: center;
            width: 100%;
            opacity: 0.7;
        }

        .footer-logo img {
            width: 92px;
            height: auto;
            display: block;
        }

        /* Modal */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.95);
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
            border-radius: var(--radius-lg);
            box-shadow: 0 20px 60px rgba(0,0,0,0.5);
        }

        .modal-close {
            position: absolute;
            top: 30px;
            right: 30px;
            background: white;
            border: none;
            border-radius: 50%;
            width: 48px;
            height: 48px;
            font-size: 28px;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
            transition: all 0.2s;
        }

        .modal-close:hover {
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    <div class="page">
        <div class="report-shell">
            <!-- Header -->
            <div class="header">
                <a href="{{ route('home') }}" >
                <div class="logo-wrap">
                    <img class="logo" src="{{ asset('/assets/images/actalia.png') }}" alt="Registrado">
                </div>
                </a>
                <h1 class="title">Contrato Registrado</h1>
                <div class="subtitle">Constancia de Registro Digital</div>
            </div>

            <!-- Métricas -->
            <div class="metrics-block">
                <div class="metrics-grid">
                    <div class="metric-card">
                        <div class="metric-icon">
                            <iconify-icon icon="lucide:{{ $contract->contract_type == 'vivienda' ? 'home' : ($contract->contract_type == 'cochera' ? 'car' : 'store') }}" style="font-size: 22px; color: var(--primary)"></iconify-icon>
                        </div>
                        <div class="metric-copy">
                            <div class="metric-label">Tipo de alquiler</div>
                            <div class="metric-value">{{ ucfirst($contract->contract_type) }}</div>
                        </div>
                    </div>

                    <div class="metric-card">
                        <div class="metric-icon">
                            <iconify-icon icon="lucide:shield-check" style="font-size: 22px; color: var(--primary)"></iconify-icon>
                        </div>
                        <div class="metric-copy">
                            <div class="metric-label">Estado</div>
                            @if($contract->status == 'completed' || $contract->status == 'active')
                                <div class="status-pill">Vigente</div>
                            @elseif($contract->status == 'cancelled')
                                <div class="status-pill">Finalizado</div>
                            @else
                                <div class="status-pill">Pendiente</div>
                            @endif
                        </div>
                    </div>

                    <div class="metric-card">
                        <div class="metric-icon">
                            <iconify-icon icon="lucide:calendar-check-2" style="font-size: 22px; color: var(--primary)"></iconify-icon>
                        </div>
                        <div class="metric-copy">
                            <div class="metric-label">Fecha de registro</div>
                            <div class="metric-value">{{ $contract->created_at->format('d/m/Y H:i') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Información del Contrato -->
            <div class="section">
                 <div class="section-head">
                     <div class="section-title">
                         <span class="section-bars"><span></span></span>
                         <span class="section-title-text">Información del Contrato</span>
                     </div>
                 
                     <iconify-icon
                         icon="lucide:chevron-down"
                         class="accordion-icon">
                     </iconify-icon>
                 </div>
                <div class="section-body">
                    <div class="panel-table">
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
                        @if($contract->guarantee_type)
                        <div class="row">
                            <span class="key">Tipo de garantía:</span>
                            <span class="val">{{ ucfirst(str_replace('_', ' ', $contract->guarantee_type)) }}</span>
                        </div>
                        @endif
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

            <!-- Firmantes -->
            <div class="section closed">
                 <div class="section-head">
                     <div class="section-title">
                         <span class="section-bars"><span></span></span>
                         <span class="section-title-text">Firmantes del Contrato</span>
                     </div>
                 
                     <iconify-icon
                         icon="lucide:chevron-down"
                         class="accordion-icon">
                     </iconify-icon>
                 </div>
                <div class="section-body">
                    <div class="signers">
                        @foreach($contract->users as $user)
                            <div class="signer-card">
                                <span class="tag">
                                    {{ $user->pivot->role_in_contract == 'propietario' ? 'Locador' : ($user->pivot->role_in_contract == 'inquilino' ? 'Locatario' : ucfirst(str_replace('_', ' ', $user->pivot->role_in_contract))) }}
                                </span>
                                <h3 class="signer-name">{{ $user->name }}</h3>
                                <div class="signer-line">
                                    <iconify-icon icon="lucide:mail" style="font-size: 14px; color: var(--primary)"></iconify-icon>
                                    {{ $user->email }}
                                </div>
                                <div class="signer-line">
                                    <iconify-icon icon="lucide:phone" style="font-size: 14px; color: var(--primary)"></iconify-icon>
                                    {{ $user->phone }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Documentos -->
            @if($contract->documents->count() > 0)
            <div class="section closed">
                <div class="section-head">
                    <div class="section-title">
                        <span class="section-bars"><span></span></span>
                        <span class="section-title-text">
                            Documentos e Imágenes ({{ $contract->documents->count() }})
                        </span>
                    </div>
                
                    <iconify-icon
                        icon="lucide:chevron-down"
                        class="accordion-icon">
                    </iconify-icon>
                </div>
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
                    <div class="tip">Tip: Toca cualquier imagen para verla en grande.</div>
                </div>
            </div>
            @endif
            @if($contract->payments->count() > 0)

<div class="section closed">

    <div class="section-head">
        <div class="section-title">
            <span class="section-bars"><span></span></span>

            <span class="section-title-text">
                Comprobantes de Pago
            </span>
        </div>

        <iconify-icon
            icon="lucide:chevron-down"
            class="accordion-icon">
        </iconify-icon>
    </div>

    <div class="section-body">

        <div class="docs-row">

            @foreach($contract->payments as $payment)

                @if($payment->proof_path)

                    @foreach($payment->proof_path as $role => $proof)

                        <div class="doc-card"
                             onclick="openModal('{{ asset('storage/' . $proof) }}')">

                            <div class="doc-thumb">

                                <img
                                    src="{{ asset('storage/' . $proof) }}"
                                    alt="Comprobante">

                            </div>

                            <div class="doc-label">
                                {{ ucfirst($role) }}
                            </div>

                        </div>

                    @endforeach

                @endif

            @endforeach

        </div>

    </div>

</div>

@endif

            <!-- Token -->
            <div class="section closed">
                <div class="section-head">
                    <div class="section-title">
                        <span class="section-bars"><span></span></span>
                        <span class="section-title-text">Token del Contrato</span>
                    </div>
                
                    <iconify-icon
                        icon="lucide:chevron-down"
                        class="accordion-icon">
                    </iconify-icon>
                </div>
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
                    <!--<a href="{{ route('home') }}" class="btn btn-subtle">
                        <iconify-icon icon="lucide:home" style="font-size: 18px;"></iconify-icon>
                        Ir al Inicio
                    </a>-->
                    <a href="{{ route('home') }}" >
                    <div class="footer-logo">
                        <img src="{{ asset('/assets/images/actalia.png') }}" alt="Registrado">
                    </div>
                    </a>
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

         const sections = document.querySelectorAll('.section');

            sections.forEach((section) => {
                const header = section.querySelector('.section-head');
            
                header.addEventListener('click', () => {
                
                    // si ya está abierto no hacer nada
                    if (!section.classList.contains('closed')) {
                        return;
                    }
                
                    // cerrar todos
                    sections.forEach((item) => {
                        item.classList.add('closed');
                    });
                
                    // abrir el actual
                    section.classList.remove('closed');
                });
                });
    </script>
</body>
</html>
</x-guest-layout>