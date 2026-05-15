<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #0a4f8a; color: white; padding: 20px; text-align: center; border-radius: 8px 8px 0 0; }
        .content { background-color: #f9f9f9; padding: 30px; border-radius: 0 0 8px 8px; }
        .section { background-color: white; padding: 20px; margin-bottom: 20px; border-radius: 8px; border-left: 4px solid #c7f02a; }
        .label { font-weight: bold; color: #0a4f8a; }
        .value { margin-bottom: 10px; }
        .button { display: inline-block; padding: 12px 24px; background-color: #0a4f8a; color: white; text-decoration: none; border-radius: 6px; margin-top: 20px; }
        .footer { text-align: center; margin-top: 30px; color: #666; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>💰 Nuevo Pago Recibido</h1>
            <p>Se ha registrado un nuevo pago pendiente de verificación</p>
        </div>
        
        <div class="content">
            <div class="section">
                <h2>📋 Datos del Contrato</h2>
                <div class="value">
                    <span class="label">ID Contrato:</span> #{{ $contract->id }}
                </div>
                <div class="value">
                    <span class="label">Propiedad:</span> {{ $contract->address }}, {{ $contract->city }}
                </div>
                <div class="value">
                    <span class="label">Tipo:</span> {{ ucfirst($contract->contract_type) }}
                </div>
                <div class="value">
                    <span class="label">Alquiler mensual:</span> ${{ number_format($contract->monthly_rent, 2, ',', '.') }}
                </div>
                <div class="value">
                    <span class="label">Fecha inicio:</span> {{ $contract->start_date->format('d/m/Y') }}
                </div>
                <div class="value">
                    <span class="label">Fecha fin:</span> {{ $contract->end_date->format('d/m/Y') }}
                </div>
            </div>

            <div class="section">
                <h2>👥 Partes del Contrato</h2>
                @foreach($contract->users as $user)
                    <div class="value">
                        <span class="label">{{ ucfirst(str_replace('_', ' ', $user->pivot->role_in_contract)) }}:</span>
                        {{ $user->name }} ({{ $user->email }})
                    </div>
                @endforeach
            </div>

            <div class="section">
                <h2>💵 Datos del Pago</h2>
                <div class="value">
                    <span class="label">Monto:</span> ${{ number_format($payment->amount, 2, ',', '.') }}
                </div>
                <div class="value">
                    <span class="label">Método:</span> {{ ucfirst($payment->payment_method) }}
                </div>
                <div class="value">
                    <span class="label">Fecha envío:</span> {{ $payment->submitted_at->format('d/m/Y H:i') }}
                </div>
                <div class="value">
                    <span class="label">Estado:</span> <strong style="color: #ff9800;">PENDIENTE DE VERIFICACIÓN</strong>
                </div>
            </div>

            <div style="text-align: center;">
                <a href="{{ route('admin.payments.verify', $contract->id) }}" class="button">
                    Ver Comprobante y Verificar
                </a>
            </div>

            <div class="section" style="margin-top: 30px; border-left-color: #ff9800;">
                <h3 style="color: #ff9800;">⚡ Acción Requerida</h3>
                <p>Por favor, verifica el comprobante de pago y actualiza el estado del contrato lo antes posible.</p>
            </div>
        </div>

        <div class="footer">
            <p>Este es un email automático del sistema Registrado</p>
            <p>© {{ date('Y') }} Registrado - Sistema de Registro Digital de Contratos</p>
        </div>
    </div>
</body>
</html>