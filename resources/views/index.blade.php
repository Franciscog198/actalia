<x-guest-layout>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contratos - Registrado</title>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1>📋 Contratos Registrados</h1>
                    <a href="{{ route('register') }}" class="btn btn-primary">
                        ➕ Nuevo Contrato
                    </a>
                </div>
                
                @if($contracts->count() > 0)
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Dirección</th>
                                            <th>Ciudad</th>
                                            <th>Tipo</th>
                                            <th>Inicio</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($contracts as $contract)
                                        <tr>
                                            <td>
                                                <strong>{{ $contract->address }}</strong>
                                                @if($contract->unit)
                                                    <br><small class="text-muted">{{ $contract->unit }}</small>
                                                @endif
                                            </td>
                                            <td>{{ $contract->city }}</td>
                                            <td>
                                                <span class="badge bg-info">
                                                    {{ ucfirst($contract->contract_type) }}
                                                </span>
                                            </td>
                                            <td>{{ $contract->start_date->format('d/m/Y') }}</td>
                                            <td>
                                                @if($contract->status == 'completed')
                                                    <span class="badge bg-success">Completo</span>
                                                @elseif($contract->status == 'pending_payment')
                                                    <span class="badge bg-warning">Pendiente Pago</span>
                                                @else
                                                    <span class="badge bg-secondary">Borrador</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('contracts.show', $contract->unique_token) }}" 
                                                   class="btn btn-sm btn-outline-primary">
                                                    👁️ Ver
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        {{ $contracts->links() }}
                    </div>
                @else
                    <div class="alert alert-info">
                        No hay contratos registrados aún.
                        <a href="{{ route('register') }}" class="alert-link">Crear el primero</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
</x-guest-layout>