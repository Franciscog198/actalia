<x-guest-layout>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrato Creado - Registrado</title>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .success-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            padding: 40px;
            text-align: center;
            max-width: 600px;
            width: 100%;
        }
        .success-icon {
            font-size: 80px;
            margin-bottom: 20px;
            animation: bounce 1s ease;
        }
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }
        .success-title {
            color: #667eea;
            font-weight: 700;
            margin-bottom: 15px;
        }
        .token-box {
            background: #f8f9fa;
            border: 2px dashed #667eea;
            border-radius: 10px;
            padding: 20px;
            margin: 20px 0;
            font-family: monospace;
            word-break: break-all;
            font-size: 14px;
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            padding: 12px 30px;
            color: white;
            text-decoration: none;
            display: inline-block;
            margin: 10px 5px;
            transition: transform 0.2s;
            font-weight: 600;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
            color: white;
        }
        .btn-outline {
            background: white;
            border: 2px solid #667eea;
            border-radius: 10px;
            padding: 12px 30px;
            color: #667eea;
            text-decoration: none;
            display: inline-block;
            margin: 10px 5px;
            transition: all 0.2s;
            font-weight: 600;
        }
        .btn-outline:hover {
            background: #667eea;
            color: white;
        }
        .info-list {
            text-align: left;
            margin: 20px 0;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="success-card">
        <div class="success-icon">✅</div>
        <h1 class="success-title">¡Contrato Registrado Exitosamente!</h1>
        <p class="text-muted">El contrato ha sido guardado correctamente en el sistema.</p>
        
        <div class="token-box">
            <strong class="d-block mb-2">🔑 Token del Contrato:</strong>
            <span class="text-primary">{{ $token }}</span>
        </div>
        
        <div class="info-list">
            <p class="mb-2"><strong>📋 Información del Contrato:</strong></p>
            <ul class="text-start">
                <li><strong>Dirección:</strong> {{ $contract->address }}</li>
                <li><strong>Ciudad:</strong> {{ $contract->city }}</li>
                <li><strong>Inicio:</strong> {{ $contract->start_date->format('d/m/Y') }}</li>
                <li><strong>Documentos subidos:</strong> {{ $contract->documents->count() }}</li>
            </ul>
        </div>
        
        <p class="mb-3">
            <small class="text-muted">
                Guarda este token para acceder al contrato más tarde.
            </small>
        </p>
        
        <div class="d-flex flex-wrap justify-content-center">
            <!-- Botón PDF -->
            <a href="{{ route('contracts.pdf', $token) }}" class="btn-primary">
                📄 Descargar PDF
            </a>
            
            <!-- Botones existentes -->
            <a href="{{ route('contracts.show', $token) }}" class="btn-primary">
                👁️ Ver Contrato Completo
            </a>
            <a href="{{ route('register') }}" class="btn-outline">
                ➕ Crear Nuevo Contrato
            </a>
        </div>
    </div>
</body>
</html>
</x-guest-layout>