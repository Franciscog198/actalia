<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <style>
        @page {
            margin: 25px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            background: #ffffff;
            color: #1e293b;
            margin: 0;
            padding: 0;
            font-size: 13px;
            line-height: 1.5;
        }

        .container {
            width: 100%;
            max-width: 650px;
            margin: 0 auto;
        }

        /* =========================
           HEADER
        ========================= */

        .header {
            text-align: center;
            padding-bottom: 25px;
            margin-bottom: 30px;
            border-bottom: 3px solid #0a5faa;
        }

        .logo {
            width: 60px;
            margin-bottom: 8px;
            margin-top: 20px;
        }

        .title {
            font-size: 26px;
            font-weight: bold;
            color: #0a5faa;
            margin-bottom: 6px;
        }

        .subtitle {
            font-size: 13px;
            color: #64748b;
        }

        /* =========================
           CARD
        ========================= */

        .card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            overflow: hidden;
        }

        .card-header {
            background: #0a5faa;
            color: #ffffff;
            padding: 16px 22px;
            font-size: 15px;
            font-weight: bold;
        }

        .card-body {
            padding: 20px 24px 24px;
        }

        /* =========================
           ROWS
        ========================= */

        .row {
            padding: 12px 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .row:last-child {
            border-bottom: none;
        }

        .row-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .row-table td {
            vertical-align: top;
        }

        .label {
            width: 42%;
            font-size: 12px;
            font-weight: 500;
            color: #64748b;
            text-align: left;
            padding-right: 15px;
        }

        .value {
            width: 58%;
            font-size: 13px;
            font-weight: bold;
            color: #0f172a;
            text-align: right;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        /* =========================
           STATUS
        ========================= */

        .status-wrapper {
            text-align: center;
            margin-top: 28px;
        }

        .status {
            display: inline-block;
            background: #16a34a;
            color: #ffffff;
            padding: 10px 22px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: bold;
            letter-spacing: .5px;
        }

        .status.pending {
            background: #f59e0b;
        }

        /* =========================
           TOKEN
        ========================= */

        .token-box {
            margin-top: 24px;
            background: #ffffff;
            border: 1px dashed #94a3b8;
            border-radius: 10px;
            padding: 16px;
            text-align: center;
        }

        .token-label {
            font-size: 11px;
            color: #64748b;
            margin-bottom: 8px;
        }

        .token {
            font-size: 12px;
            font-weight: bold;
            color: #0a5faa;
            word-break: break-all;
            line-height: 1.6;
        }

        /* =========================
           FOOTER
        ========================= */

        .footer {
            margin-top: 35px;
            padding-top: 18px;
            border-top: 1px solid #dbe2ea;
            text-align: center;
            font-size: 11px;
            color: #64748b;
            line-height: 1.8;
        }

        .footer strong {
            color: #0f172a;
        }

    </style>
</head>

<body>

<div class="container">

    {{-- HEADER --}}
    <div class="header">

        @php
            $logoPath = public_path('assets/images/actalia.png');
            $logoData = '';
            
            if (file_exists($logoPath)) {
                $logoData = base64_encode(file_get_contents($logoPath));
            }
        @endphp
        
        <div class="logo-wrap">
            @if($logoData)
                <img
                    class="logo"
                    src="data:image/png;base64,{{ $logoData }}"
                    alt="Actalia"
                >
            @else
                <div style="width: 120px; height: 120px; background: #f0f0f0; margin-bottom: 15px;">
                    [Logo no disponible]
                </div>
            @endif
        </div>

        <div class="title">
            Constancia de Registro
        </div>

        <div class="subtitle">
            Registro Digital de Contratos
        </div>

    </div>

    {{-- CARD --}}
    <div class="card">

        <div class="card-header">
            Información del Contrato
        </div>

        <div class="card-body">

            <div class="row">
                <table class="row-table">
                    <tr>
                        <td class="label">
                            Número de contrato
                        </td>

                        <td class="value">
                            #{{ $contract->id }}
                        </td>
                    </tr>
                </table>
            </div>

            <div class="row">
                <table class="row-table">
                    <tr>
                        <td class="label">
                            Tipo de contrato
                        </td>

                        <td class="value">
                            {{ ucfirst($contract->contract_type) }}
                        </td>
                    </tr>
                </table>
            </div>

            <div class="row">
                <table class="row-table">
                    <tr>
                        <td class="label">
                            Dirección
                        </td>

                        <td class="value">
                            {{ $contract->address }}
                            @if($contract->unit)
                                , {{ $contract->unit }}
                            @endif
                        </td>
                    </tr>
                </table>
            </div>

            <div class="row">
                <table class="row-table">
                    <tr>
                        <td class="label">
                            Ciudad / Provincia
                        </td>

                        <td class="value">
                            {{ $contract->city }},
                            {{ $contract->province }}
                        </td>
                    </tr>
                </table>
            </div>

            <div class="row">
                <table class="row-table">
                    <tr>
                        <td class="label">
                            Fecha de registro
                        </td>

                        <td class="value">
                            {{ $contract->created_at->format('d/m/Y H:i') }}
                        </td>
                    </tr>
                </table>
            </div>

            {{-- STATUS --}}
            <div class="status-wrapper">

                <div class="status {{ $contract->status == 'pending_payment' ? 'pending' : '' }}">

                    @if($contract->status == 'completed')
                        CONTRATO ENVIADO
                    @elseif($contract->status == 'pending_payment')
                        PAGO PENDIENTE
                    @else
                        CONTRATO EN PROCESO
                    @endif

                </div>

            </div>

        </div>

    </div>

    {{-- FOOTER --}}
    <div class="footer">

        <div>
            <strong>Actalia - Registro Digital de Contratos</strong>
        </div>

        <div>
            admin@actalia.com.ar
        </div>

        <div>
            www.actalia.com.ar
        </div>

        <div style="margin-top: 10px;">
            Documento generado el
            {{ now()->format('d/m/Y H:i') }}
        </div>

    </div>

</div>

</body>
</html>