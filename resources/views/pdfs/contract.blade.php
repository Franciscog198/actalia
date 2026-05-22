<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contrato {{ $contract->unique_token }}</title>

    <style>

        :root {
            --background: #ffffff;
            --foreground: #0b2340;
            --border: #00000014;
            --input: #f5f7fa;
            --primary: #0a5faa;
            --primary-foreground: #ffffff;
            --secondary: #f0f6ff;
            --muted: #f0f0f3;
            --muted-foreground: #6b7280;
            --accent: #92ffa5;
            --card: #ffffff;
            --radius-sm: 4px;
            --radius-md: 6px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        @page {
            margin: 10mm;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11pt;
            color: var(--foreground);
            background: white;
        }

        .page {
            width: 100%;
            max-width: 680px;
            margin: 0 auto;
        }

        .report-shell {
            width: 100%;
            background: white;
            padding: 20px 25px;
        }

        /*
        |--------------------------------------------------------------------------
        | HEADER
        |--------------------------------------------------------------------------
        */

        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid var(--primary);
        }

        .logo {
            max-width: 120px;
            height: auto;
            margin-bottom: 15px;
        }

        .title {
            font-size: 28pt;
            font-weight: 800;
            color: var(--primary);
            margin: 10px 0;
        }

        .subtitle {
            font-size: 12pt;
            font-weight: 500;
            color: var(--muted-foreground);
        }

        /*
        |--------------------------------------------------------------------------
        | MÉTRICAS
        |--------------------------------------------------------------------------
        */

        .metrics-grid {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .metric-card {
            width: 33.33%;
            border: 1px solid var(--border);
            padding: 12px;
            text-align: center;
            vertical-align: middle;
        }

        .metric-label {
            font-size: 10pt;
            font-weight: 500;
            color: var(--muted-foreground);
            margin-bottom: 5px;
        }

        .metric-value {
            font-size: 11pt;
            font-weight: 700;
            color: var(--foreground);
        }

        .status-pill {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 12px;
            background: var(--secondary);
            color: var(--primary);
            font-size: 10pt;
            font-weight: 700;
        }

        /*
        |--------------------------------------------------------------------------
        | SECTION
        |--------------------------------------------------------------------------
        */

        .section {
            margin-bottom: 20px;
            page-break-inside: avoid;
        }

        .section-head {
            background: var(--primary);
            color: white;
            padding: 10px 15px;
            font-size: 13pt;
            font-weight: 700;
        }

        .section-bars {
            display: inline-block;
            width: 4px;
            height: 14px;
            background: var(--accent);
            margin-right: 10px;
            vertical-align: middle;
        }

        .section-body {
            background: var(--muted);
            padding: 15px;
        }

        /*
        |--------------------------------------------------------------------------
        | TABLA INFO
        |--------------------------------------------------------------------------
        */

        .panel-table {
            width: 100%;
            border-collapse: collapse;
        }

        .row {
            border-bottom: 1px solid var(--border);
        }

        .row:last-child {
            border-bottom: none;
        }

        .row td {
            padding: 10px 0;
        }

        .key {
            font-size: 11pt;
            font-weight: 500;
            color: var(--muted-foreground);
            width: 40%;
        }

        .val {
            font-size: 11pt;
            font-weight: 700;
            color: var(--foreground);
            text-align: right;
        }

        /*
        |--------------------------------------------------------------------------
        | FIRMANTES
        |--------------------------------------------------------------------------
        */

        .signers {
            width: 100%;
            border-collapse: collapse;
        }

        .signer-card {
            width: 50%;
            background: white;
            border: 1px solid var(--border);
            padding: 12px;
            vertical-align: top;
        }

        .tag {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 12px;
            background: #e8f7ef;
            color: var(--foreground);
            font-size: 9pt;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .signer-name {
            font-size: 14pt;
            font-weight: 800;
            color: var(--foreground);
            margin: 5px 0;
        }

        .signer-line {
            font-size: 10pt;
            font-weight: 500;
            color: var(--muted-foreground);
            margin: 3px 0;
        }

        /*
        |--------------------------------------------------------------------------
        | DOCUMENTOS
        |--------------------------------------------------------------------------
        */

        .docs-grid {
            width: 100%;
            border-collapse: collapse;
        }

        .doc-card {
            width: 25%;
            padding: 8px;
            text-align: center;
            vertical-align: top;
        }

        .doc-box {
            background: white;
            border: 1px solid var(--border);
            padding: 6px;
        }

        .doc-thumb {
            width: 100%;
            height: 120px;
            background: white;
            border: 1px solid var(--border);
            overflow: hidden;
            text-align: center;
            vertical-align: middle;
        }

        /*
        |--------------------------------------------------------------------------
        | IMÁGENES SIN DEFORMAR
        |--------------------------------------------------------------------------
        */

        .doc-thumb img {
            max-width: 100%;
            max-height: 110px;
            width: auto;
            height: auto;
            display: inline-block;
        }

        .doc-label {
            font-size: 9pt;
            font-weight: 700;
            color: var(--foreground);
            margin-top: 6px;
            line-height: 1.3;
        }

        .doc-meta {
            margin-top: 5px;
            font-size: 8pt;
            color: var(--muted-foreground);
            line-height: 1.4;
        }

        /*
        |--------------------------------------------------------------------------
        | TOKEN
        |--------------------------------------------------------------------------
        */

        .token-text {
            font-size: 11pt;
            font-weight: 500;
            color: var(--muted-foreground);
            margin-bottom: 10px;
        }

        .token-box {
            background: white;
            border: 2px dashed var(--border);
            border-radius: var(--radius-sm);
            padding: 15px;
            text-align: center;
            color: var(--primary);
            font-size: 11pt;
            font-weight: 700;
            letter-spacing: 1px;
            word-break: break-all;
            font-family: monospace;
        }

        /*
        |--------------------------------------------------------------------------
        | FOOTER
        |--------------------------------------------------------------------------
        */

        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 2px solid var(--primary);
            text-align: center;
            font-size: 9pt;
            color: var(--muted-foreground);
            line-height: 1.6;
        }

    </style>
</head>
<body>

<div class="page">

    <div class="report-shell">

        <!-- HEADER -->
        <div class="header">

            @php
                $logoPath = public_path('assets/images/actalia.png');
            @endphp

            @if(file_exists($logoPath))
                <img src="{{ $logoPath }}" alt="Logo" class="logo">
            @endif

            <h1 class="title">
                Contrato Registrado
            </h1>

            <div class="subtitle">
                Constancia de Registro Digital
            </div>

        </div>

        <!-- MÉTRICAS -->
        <table class="metrics-grid">
            <tr>

                <td class="metric-card">
                    <div class="metric-label">
                        Tipo de alquiler
                    </div>

                    <div class="metric-value">
                        {{ ucfirst($contract->contract_type) }}
                    </div>
                </td>

                <td class="metric-card">
                    <div class="metric-label">
                        Estado
                    </div>

                    <div class="metric-value">

                        @if($contract->status == 'completed' || $contract->status == 'active')

                            <span class="status-pill">
                                Vigente
                            </span>

                        @elseif($contract->status == 'cancelled')

                            <span class="status-pill">
                                Finalizado
                            </span>

                        @else

                            <span class="status-pill">
                                Pendiente
                            </span>

                        @endif

                    </div>
                </td>

                <td class="metric-card">
                    <div class="metric-label">
                        Fecha de registro
                    </div>

                    <div class="metric-value">
                        {{ $contract->created_at->format('d/m/Y H:i') }}
                    </div>
                </td>

            </tr>
        </table>

        <!-- INFORMACIÓN -->
        <div class="section">

            <div class="section-head">
                <span class="section-bars"></span>
                Información del Contrato
            </div>

            <div class="section-body">

                <table class="panel-table">

                    <tr class="row">
                        <td class="key">Dirección:</td>
                        <td class="val">{{ $contract->address }}</td>
                    </tr>

                    <tr class="row">
                        <td class="key">Ciudad:</td>
                        <td class="val">{{ $contract->city }}</td>
                    </tr>

                    <tr class="row">
                        <td class="key">Provincia:</td>
                        <td class="val">{{ $contract->province }}</td>
                    </tr>

                    @if($contract->guarantee_type)
                    <tr class="row">
                        <td class="key">Tipo de garantía:</td>
                        <td class="val">
                            {{ ucfirst(str_replace('_', ' ', $contract->guarantee_type)) }}
                        </td>
                    </tr>
                    @endif

                    <tr class="row">
                        <td class="key">Inicio:</td>
                        <td class="val">
                            {{ $contract->start_date->format('d/m/Y') }}
                        </td>
                    </tr>

                    <tr class="row">
                        <td class="key">Fin:</td>
                        <td class="val">
                            {{ $contract->end_date->format('d/m/Y') }}
                        </td>
                    </tr>

                </table>

            </div>

        </div>

        <!-- FIRMANTES -->
        <div class="section">

            <div class="section-head">
                <span class="section-bars"></span>
                Firmantes del Contrato
            </div>

            <div class="section-body">

                <table class="signers">

                    @foreach($contract->users->chunk(2) as $userChunk)

                        <tr>

                            @foreach($userChunk as $user)

                                <td class="signer-card">

                                    <span class="tag">

                                        {{
                                            $user->pivot->role_in_contract == 'propietario'
                                            ? 'Locador'
                                            : (
                                                $user->pivot->role_in_contract == 'inquilino'
                                                ? 'Locatario'
                                                : ucfirst(str_replace('_', ' ', $user->pivot->role_in_contract))
                                            )
                                        }}

                                    </span>

                                    <div class="signer-name">
                                        {{ $user->name }}
                                    </div>

                                    <div class="signer-line">
                                        Email: {{ $user->email }}
                                    </div>

                                    <div class="signer-line">
                                        Teléfono: {{ $user->phone }}
                                    </div>

                                </td>

                            @endforeach

                            @if($userChunk->count() == 1)
                                <td class="signer-card"></td>
                            @endif

                        </tr>

                    @endforeach

                </table>

            </div>

        </div>

        <!-- DOCUMENTOS -->
        @if($contract->documents->count() > 0)

        <div class="section">

            <div class="section-head">
                <span class="section-bars"></span>
                Documentos e Imágenes ({{ $contract->documents->count() }})
            </div>

            <div class="section-body">

                <table class="docs-grid">

                    @foreach($contract->documents->chunk(4) as $docChunk)

                        <tr>

                            @foreach($docChunk as $doc)

                                @php
                                    $imagePath = public_path('storage/' . $doc->storage_path);

                                    $imageData = '';

                                    $mimeType = 'image/jpeg';

                                    if (file_exists($imagePath)) {

                                        $imageData = base64_encode(
                                            file_get_contents($imagePath)
                                        );

                                        $mimeType = mime_content_type($imagePath);
                                    }
                                @endphp

                                <td class="doc-card">

                                    <div class="doc-box">

                                        <div class="doc-thumb">

                                            @if($imageData)

                                                <img
                                                    src="data:{{ $mimeType }};base64,{{ $imageData }}"
                                                    alt="{{ $doc->document_type }}"
                                                >

                                            @else

                                                <div style="padding-top:40px; color:#999;">
                                                    Sin imagen
                                                </div>

                                            @endif

                                        </div>

                                        <div class="doc-label">

                                            {{ ucfirst(str_replace('_', ' ', $doc->document_type)) }}

                                        </div>

                                        @if($doc->document_type === 'poliza' && $doc->metadata)

                                            <div class="doc-meta">

                                                @if($doc->getMeta('aseguradora'))
                                                    <div>
                                                        <strong>Aseguradora:</strong>
                                                        {{ $doc->getMeta('aseguradora') }}
                                                    </div>
                                                @endif

                                                @if($doc->getMeta('numero'))
                                                    <div>
                                                        <strong>N°:</strong>
                                                        {{ $doc->getMeta('numero') }}
                                                    </div>
                                                @endif

                                                @if($doc->getMeta('vigencia_desde'))
                                                    <div>
                                                        <strong>Desde:</strong>
                                                        {{ \Carbon\Carbon::parse($doc->getMeta('vigencia_desde'))->format('d/m/Y') }}
                                                    </div>
                                                @endif

                                                @if($doc->getMeta('vigencia_hasta'))
                                                    <div>
                                                        <strong>Hasta:</strong>
                                                        {{ \Carbon\Carbon::parse($doc->getMeta('vigencia_hasta'))->format('d/m/Y') }}
                                                    </div>
                                                @endif

                                                @if($doc->getMeta('monto'))
                                                    <div>
                                                        <strong>Monto:</strong>
                                                        ${{ number_format($doc->getMeta('monto'), 0, ',', '.') }}
                                                    </div>
                                                @endif

                                            </div>

                                        @endif

                                    </div>

                                </td>

                            @endforeach

                        </tr>

                    @endforeach

                </table>

            </div>

        </div>

        @endif

        <!-- COMPROBANTES -->
        @if($contract->payments->count() > 0)

        <div class="section">

            <div class="section-head">
                <span class="section-bars"></span>
                Comprobantes de Pago
            </div>

            <div class="section-body">

                <table class="docs-grid">

                    @foreach($contract->payments as $payment)

                        @if($payment->proof_path)

                            <tr>

                                @foreach($payment->proof_path as $role => $proof)

                                    @php

                                        $proofPath = public_path(
                                            str_replace(
                                                asset('/'),
                                                '',
                                                $proof
                                            )
                                        );

                                        $proofData = '';

                                        if (file_exists($proofPath)) {

                                            $proofData = base64_encode(
                                                file_get_contents($proofPath)
                                            );
                                        }

                                    @endphp

                                    <td class="doc-card">

                                        <div class="doc-box">

                                            <div class="doc-thumb">

                                                @if($proofData)

                                                    <img
                                                        src="data:image/jpeg;base64,{{ $proofData }}"
                                                        alt="Comprobante"
                                                    >

                                                @endif

                                            </div>

                                            <div class="doc-label">
                                                {{ ucfirst($role) }}
                                            </div>

                                        </div>

                                    </td>

                                @endforeach

                            </tr>

                        @endif

                    @endforeach

                </table>

            </div>

        </div>

        @endif

        <!-- TOKEN -->
        <div class="section">

            <div class="section-head">
                <span class="section-bars"></span>
                Token del Contrato
            </div>

            <div class="section-body">

                <div class="token-text">
                    Guarda este token para acceder al contrato:
                </div>

                <div class="token-box">
                    {{ $contract->unique_token }}
                </div>

            </div>

        </div>

        <!-- FOOTER -->
        <div class="footer">

            <p>
                <strong>
                    Actalia - Registro Digital de Contratos
                </strong>
            </p>

            <p>
                Documento generado el
                {{ now()->format('d/m/Y H:i') }}
            </p>

            <p>
                © {{ date('Y') }} Actalia - Todos los derechos reservados
            </p>

        </div>

    </div>

</div>

</body>
</html>