<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            background: #ffffff;
            color: #0b2340;
            padding: 40px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            text-align: center;
        }

        .logo {
            width: 140px;
            margin-bottom: 20px;
        }

        .title {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .subtitle {
            font-size: 13px;
            color: #6b7280;
            margin-bottom: 30px;
        }

        .card {
            background: #f5f7fa;
            border-radius: 10px;
            padding: 25px;
        }

        .row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #ddd;
        }

        .row:last-child {
            border-bottom: none;
        }

        .label {
            font-size: 13px;
            color: #6b7280;
        }

        .value {
            font-size: 14px;
            font-weight: bold;
        }

        .status {
            display: inline-block;
            margin-top: 20px;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            background: #20ad4b;
            color: #fff;
        }

        .footer {
            margin-top: 40px;
            font-size: 12px;
            color: #6b7280;
        }
    </style>
</head>
<body>

<div class="container">

    {{-- Logo --}}
    <img class="logo" src="/public/assets/images/actalia.png" />

    {{-- Título --}}
    <div class="title">Constancia de Registro</div>
    <div class="subtitle">Actalia - Registro digital de contratos</div>

    {{-- Card --}}
    <div class="card">

        <div class="row">
            <span class="label">Número de contrato</span>
            <span class="value">#{{ $contract->id }}</span>
        </div>

        <div class="row">
            <span class="label">Estado</span>
            <span class="value">
                Aprobación pendiente
            </span>
        </div>

        <div class="row">
            <span class="label">Fecha</span>
            <span class="value">
                {{ $contract->created_at->format('d/m/Y H:i') }}
            </span>
        </div>

        <div class="status">
            CONTRATO ENVIADO
        </div>

    </div>

    {{-- Footer --}}
    <div class="footer">
        contacto@actalia.com.ar<br>
        www.actalia.com.ar
    </div>

</div>

</body>
</html>