<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrato {{ $contract->unique_token }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            font-size: 11pt;
            line-height: 1.6;
            color: #333;
        }
        
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
            margin-bottom: 30px;
        }
        
        .header h1 {
            font-size: 24pt;
            margin-bottom: 10px;
        }
        
        .header p {
            font-size: 10pt;
            margin: 5px 0;
        }
        
        .container {
            padding: 0 40px;
        }
        
        .section {
            margin-bottom: 30px;
            page-break-inside: avoid;
        }
        
        .section-title {
            font-size: 16pt;
            font-weight: bold;
            color: #667eea;
            border-bottom: 3px solid #667eea;
            padding-bottom: 8px;
            margin-bottom: 15px;
        }
        
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        
        .info-table td {
            padding: 8px 10px;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .info-table td:first-child {
            font-weight: bold;
            width: 35%;
            color: #666;
        }
        
        .user-card {
            background: #f8f9fa;
            border-left: 4px solid #667eea;
            padding: 15px;
            margin-bottom: 15px;
            page-break-inside: avoid;
        }
        
        .user-card.inquilino {
            border-left-color: #28a745;
        }
        
        .user-card.propietario {
            border-left-color: #17a2b8;
        }
        
        .user-card.garante {
            border-left-color: #ffc107;
        }
        
        .user-card h3 {
            font-size: 12pt;
            margin-bottom: 10px;
            color: #333;
        }
        
        .user-card .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 9pt;
            font-weight: bold;
            margin-bottom: 8px;
        }
        
        .badge-inquilino {
            background: #28a745;
            color: white;
        }
        
        .badge-propietario {
            background: #17a2b8;
            color: white;
        }
        
        .badge-garante {
            background: #ffc107;
            color: #333;
        }
        
        .user-info {
            font-size: 10pt;
            line-height: 1.8;
        }
        
        .user-info p {
            margin: 3px 0;
        }
        
        .documents-grid {
            display: table;
            width: 100%;
            margin-top: 15px;
        }
        
        .document-row {
            display: table-row;
        }
        
        .document-cell {
            display: table-cell;
            width: 50%;
            padding: 10px;
            vertical-align: top;
        }
        
        .document-item {
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
            text-align: center;
            background: #f8f9fa;
        }
        
        .document-item img {
            max-width: 100%;
            max-height: 200px;
            border-radius: 5px;
            margin-bottom: 8px;
        }
        
        .document-label {
            font-size: 9pt;
            color: #666;
            font-weight: bold;
        }
        
        .footer {
            margin-top: 40px;
            padding: 20px 40px;
            background: #f8f9fa;
            text-align: center;
            font-size: 9pt;
            color: #666;
            page-break-inside: avoid;
        }
        
        .token-box {
            background: #fff;
            border: 2px dashed #667eea;
            border-radius: 5px;
            padding: 15px;
            margin: 20px 0;
            text-align: center;
            font-family: monospace;
            font-size: 10pt;
            word-break: break-all;
        }
        
        .status-badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 12px;
            font-size: 9pt;
            font-weight: bold;
        }
        
        .status-completed {
            background: #d4edda;
            color: #155724;
        }
        
        .status-pending {
            background: #fff3cd;
            color: #856404;
        }
        
        .page-break {
            page-break-after: always;
        }
        
        @page {
            margin: 0;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        @if(file_exists(public_path('images/logo.png')))
            <img src="{{ public_path('images/logo.png') }}" alt="Logo" style="max-width: 100px; margin-bottom: 15px;">
        @endif
        <h1>📋 CONTRATO REGISTRADO</h1>
        <p>{{ $contract->address }}</p>
        <p>{{ $contract->city }}, {{ $contract->province }}</p>
        @if($contract->unit)
            <p>{{ $contract->unit }}</p>
        @endif
    </div>
    
    <div class="container">
        <!-- Información del Contrato -->
        <div class="section">
            <h2 class="section-title">🏠 Información del Contrato</h2>
            
            <table class="info-table">
                <tr>
                    <td>Tipo de Alquiler:</td>
                    <td><strong>{{ ucfirst($contract->contract_type) }}</strong></td>
                </tr>
                @if($contract->property_name)
                <tr>
                    <td>Nombre de la Propiedad:</td>
                    <td>{{ $contract->property_name }}</td>
                </tr>
                @endif
                <tr>
                    <td>Dirección Completa:</td>
                    <td>{{ $contract->address }}{{ $contract->unit ? ', ' . $contract->unit : '' }}</td>
                </tr>
                <tr>
                    <td>Ciudad:</td>
                    <td>{{ $contract->city }}</td>
                </tr>
                <tr>
                    <td>Provincia:</td>
                    <td>{{ $contract->province }}</td>
                </tr>
                @if($contract->postal_code)
                <tr>
                    <td>Código Postal:</td>
                    <td>{{ $contract->postal_code }}</td>
                </tr>
                @endif
                <tr>
                    <td>Fecha de Inicio:</td>
                    <td>{{ $contract->start_date->format('d/m/Y') }}</td>
                </tr>
                <tr>
                    <td>Fecha de Fin:</td>
                    <td>{{ $contract->end_date->format('d/m/Y') }}</td>
                </tr>
                <tr>
                    <td>Duración:</td>
                    <td>{{ $contract->start_date->diffInMonths($contract->end_date) }} meses ({{ $contract->start_date->diffInYears($contract->end_date) }} años)</td>
                </tr>
                @if($contract->monthly_rent)
                <tr>
                    <td>Alquiler Mensual:</td>
                    <td><strong>${{ number_format($contract->monthly_rent, 2, ',', '.') }}</strong></td>
                </tr>
                @endif
                <tr>
                    <td>Estado del Contrato:</td>
                    <td>
                        @if($contract->status == 'completed')
                            <span class="status-badge status-completed">✓ Completo</span>
                        @elseif($contract->status == 'pending_payment')
                            <span class="status-badge status-pending">⏳ Pendiente de Pago</span>
                        @else
                            <span class="status-badge">📝 {{ ucfirst($contract->status) }}</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Fecha de Registro:</td>
                    <td>{{ $contract->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            </table>
        </div>
        
        <!-- Firmantes -->
        <div class="section">
            <h2 class="section-title">👥 Firmantes del Contrato</h2>
            
            @foreach($contract->users as $user)
                @php
                    $roleClass = match($user->pivot->role_in_contract) {
                        'inquilino' => 'inquilino',
                        'propietario' => 'propietario',
                        default => 'garante'
                    };
                    
                    $badgeClass = match($user->pivot->role_in_contract) {
                        'inquilino' => 'badge-inquilino',
                        'propietario' => 'badge-propietario',
                        default => 'badge-garante'
                    };
                    
                    $roleLabel = match($user->pivot->role_in_contract) {
                        'inquilino' => 'Inquilino',
                        'propietario' => 'Propietario',
                        'garante_1' => 'Garante 1',
                        'garante_2' => 'Garante 2',
                        default => 'Firmante'
                    };
                @endphp
                
                <div class="user-card {{ $roleClass }}">
                    <span class="badge {{ $badgeClass }}">{{ $roleLabel }}</span>
                    <h3>{{ $user->name }}</h3>
                    <div class="user-info">
                        <p><strong>📧 Email:</strong> {{ $user->email }}</p>
                        <p><strong>📱 Teléfono:</strong> {{ $user->phone }}</p>
                        @if($user->dni_number)
                            <p><strong>🆔 DNI:</strong> {{ $user->dni_number }}</p>
                        @endif
                        @if($user->address)
                            <p><strong>📍 Domicilio:</strong> {{ $user->address }}</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- Documentos -->
        @if($contract->documents->count() > 0)
        <div class="section page-break">
            <h2 class="section-title">📁 Documentos Adjuntos ({{ $contract->documents->count() }})</h2>
            
            <div class="documents-grid">
                @foreach($contract->documents->chunk(2) as $chunk)
                    <div class="document-row">
                        @foreach($chunk as $doc)
                            <div class="document-cell">
                                <div class="document-item">
                                    @if(file_exists(public_path('storage/' . $doc->storage_path)))
                                        <img src="{{ public_path('storage/' . $doc->storage_path) }}" alt="{{ $doc->document_type }}">
                                    @else
                                        <p style="color: #999; padding: 40px;">Imagen no disponible</p>
                                    @endif
                                    <p class="document-label">{{ ucfirst(str_replace('_', ' ', $doc->document_type)) }}</p>
                                    <p style="font-size: 8pt; color: #999;">{{ number_format($doc->file_size / 1024 / 1024, 2) }} MB</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
        @endif
        
        <!-- Información de Pago -->
        @if($contract->payments->count() > 0)
        <div class="section">
            <h2 class="section-title">💳 Información de Pago</h2>
            
            <table class="info-table">
                @foreach($contract->payments as $payment)
                    <tr>
                        <td>Monto:</td>
                        <td><strong>${{ number_format($payment->amount, 2, ',', '.') }}</strong></td>
                    </tr>
                    <tr>
                        <td>Estado:</td>
                        <td>
                            @if($payment->status == 'completed')
                                <span class="status-badge status-completed">✓ Pagado</span>
                            @elseif($payment->status == 'pending')
                                <span class="status-badge status-pending">⏳ Pendiente</span>
                            @else
                                {{ ucfirst($payment->status) }}
                            @endif
                        </td>
                    </tr>
                    @if($payment->paid_at)
                    <tr>
                        <td>Fecha de Pago:</td>
                        <td>{{ $payment->paid_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    @endif
                @endforeach
            </table>
        </div>
        @endif
        
        <!-- Token -->
        <div class="section">
            <h2 class="section-title">🔑 Token del Contrato</h2>
            <div class="token-box">
                <p style="margin-bottom: 8px; font-size: 9pt; color: #666;">Token de acceso:</p>
                <strong style="font-size: 11pt;">{{ $contract->unique_token }}</strong>
            </div>
            <p style="font-size: 9pt; color: #666; text-align: center;">
                Accede al contrato en: {{ route('contracts.show', $contract->unique_token) }}
            </p>
        </div>
    </div>
    
    <!-- Footer -->
    <div class="footer">
        <p><strong>Registrado - Registro Digital de Contratos</strong></p>
        <p>Documento generado el {{ now()->format('d/m/Y H:i') }}</p>
        <p>Este documento es una copia digital del contrato registrado.</p>
        <p style="margin-top: 10px;">© {{ date('Y') }} Registrado - Todos los derechos reservados</p>
    </div>
</body>
</html>