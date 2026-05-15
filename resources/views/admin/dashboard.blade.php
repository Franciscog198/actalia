<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin - ACTALIA</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="bg-gray-50">

<div class="min-h-screen">

    <!-- Header -->
    <header class="bg-white shadow">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">

            <div class="flex justify-between items-center">

                <h1 class="text-2xl font-bold text-gray-900">
                    Panel de Administración - ACTALIA
                </h1>

                <div class="flex items-center gap-4">

                    <span class="text-sm text-gray-600">
                        Admin
                    </span>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button class="text-sm text-red-600 hover:text-red-800">
                            Cerrar Sesión
                        </button>
                    </form>

                </div>

            </div>

        </div>

    </header>

    <!-- Alerts -->
    @if(session('success'))

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">

            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>

        </div>

    @endif

    @if(session('error'))

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">

            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                {{ session('error') }}
            </div>

        </div>

    @endif

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Estadísticas -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">

            <!-- Total -->
            <div class="bg-white rounded-lg shadow p-6">

                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-sm text-gray-600">
                            Total Contratos
                        </p>

                        <p class="text-3xl font-bold text-gray-900">
                            {{ $stats['total'] }}
                        </p>
                    </div>

                    <iconify-icon
                        icon="lucide:file-text"
                        class="text-4xl text-blue-500">
                    </iconify-icon>

                </div>

            </div>

            <!-- Pendientes -->
            <div class="bg-white rounded-lg shadow p-6">

                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-sm text-gray-600">
                            Pendientes
                        </p>

                        <p class="text-3xl font-bold text-yellow-600">
                            {{ $stats['completed'] }}
                        </p>
                    </div>

                    <iconify-icon
                        icon="lucide:clock"
                        class="text-4xl text-yellow-500">
                    </iconify-icon>

                </div>

            </div>

            <!-- Activos -->
            <div class="bg-white rounded-lg shadow p-6">

                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-sm text-gray-600">
                            Activos
                        </p>

                        <p class="text-3xl font-bold text-blue-600">
                            {{ $stats['active'] ?? 0 }}
                        </p>
                    </div>

                    <iconify-icon
                        icon="lucide:badge-check"
                        class="text-4xl text-blue-500">
                    </iconify-icon>

                </div>

            </div>

            <!-- Finalizados -->
            <div class="bg-white rounded-lg shadow p-6">

                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-sm text-gray-600">
                            Finalizados
                        </p>

                        <p class="text-3xl font-bold text-red-600">
                            {{ $stats['cancelled'] ?? 0 }}
                        </p>
                    </div>

                    <iconify-icon
                        icon="lucide:x-circle"
                        class="text-4xl text-red-500">
                    </iconify-icon>

                </div>

            </div>

        </div>

        <!-- Filtros -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">

            <form method="GET" class="flex flex-wrap gap-4">

                <div class="flex-1 min-w-[200px]">

                    <input
                        type="text"
                        name="search"
                        placeholder="Buscar por dirección, propietario, inquilino, email, teléfono"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    >

                </div>

                <div>

                    <select
                        name="status"
                        class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">

                        <option value="">
                            Todos los estados
                        </option>

                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>
                            Pendiente
                        </option>

                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>
                            Activo
                        </option>

                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>
                            Finalizado
                        </option>

                    </select>

                </div>

                <button
                    type="submit"
                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">

                    Filtrar

                </button>

                <a
                    href="{{ route('admin.dashboard') }}"
                    class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">

                    Limpiar

                </a>

            </form>

        </div>

        <!-- Tabla -->
        <div class="bg-white rounded-lg shadow overflow-hidden">

            <table class="min-w-full divide-y divide-gray-200">

                <thead class="bg-gray-50">

                <tr>

                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        ID
                    </th>

                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Propiedad
                    </th>

                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Propietario
                    </th>

                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Inquilino
                    </th>

                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Fechas
                    </th>

                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Estado
                    </th>

                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Acciones
                    </th>

                </tr>

                </thead>

                <tbody class="bg-white divide-y divide-gray-200">

                @forelse($contracts as $contract)

                    @php
                        $propietario = $contract->users
                            ->where('pivot.role_in_contract', 'propietario')
                            ->first();

                        $inquilino = $contract->users
                            ->where('pivot.role_in_contract', 'inquilino')
                            ->first();
                    @endphp

                    <tr>

                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            #{{ $contract->id }}
                        </td>

                        <td class="px-6 py-4 text-sm text-gray-900">

                            <div class="font-medium">
                                {{ $contract->address }}
                            </div>

                            <div class="text-gray-500">
                                {{ $contract->city }},
                                {{ $contract->province }}
                            </div>

                        </td>

                        <td class="px-6 py-4 text-sm text-gray-900">

                            @if($inquilino)

                                @php
                                    $message = rawurlencode(
                                        "Hola {$inquilino->name},\n\n" .
                                        "Te compartimos el acceso a tu contrato registrado.\n\n" .
                                        "Token: {$contract->unique_token}\n\n" .
                                        "Link de acceso:\n" .
                                        route('contracts.show', $contract->unique_token) .
                                        "\n\nACTALIA"
                                    );

                                    $cleanPhone = preg_replace('/[^0-9]/', '', $inquilino->phone ?? '');

                                    if ($cleanPhone && !str_starts_with($cleanPhone, '54')) {
                                        $cleanPhone = '54' . $cleanPhone;
                                    }
                                @endphp

                                <div class="font-medium">
                                    {{ $inquilino->name }}
                                </div>
                            
                                <!-- EMAIL -->
                                <a
                                    href="mailto:{{ $inquilino->email }}?subject=Acceso%20a%20tu%20contrato%20registrado&body={{ $message }}"
                                    class="text-blue-600 hover:text-blue-800 text-xs flex items-center gap-1 mt-1"
                                >
                                    <iconify-icon
                                        icon="lucide:mail"
                                        class="text-[12px]">
                                    </iconify-icon>
                                
                                    {{ $inquilino->email }}
                                </a>
                            
                                <!-- WHATSAPP -->
                                @if($cleanPhone)
                                    <a
                                        href="https://wa.me/{{ $cleanPhone }}?text={{ $message }}"
                                        target="_blank"
                                        class="text-green-600 hover:text-green-800 text-xs flex items-center gap-1 mt-1"
                                    >
                                        <iconify-icon
                                            icon="logos:whatsapp-icon"
                                            class="text-[12px]">
                                        </iconify-icon>
                                    
                                        {{ $inquilino->phone }}
                                    </a>
                                @endif
                                
                            @else
                                
                                <span class="text-gray-400">-</span>
                                
                            @endif
                                
                        </td>

                        <td class="px-6 py-4 text-sm text-gray-900">

                            @if($propietario)
                                                
                                @php
                                    $message = rawurlencode(
                                        "Hola {$propietario->name},\n\n" .
                                        "Te compartimos el acceso a tu contrato registrado.\n\n" .
                                        "Token: {$contract->unique_token}\n\n" .
                                        "Link de acceso:\n" .
                                        route('contracts.show', $contract->unique_token) .
                                        "\n\nACTALIA"
                                    );
                                                
                                    $cleanPhone = preg_replace('/[^0-9]/', '', $propietario->phone ?? '');
                                                
                                    if ($cleanPhone && !str_starts_with($cleanPhone, '54')) {
                                        $cleanPhone = '54' . $cleanPhone;
                                    }
                                @endphp
                        
                                <div class="font-medium">
                                    {{ $propietario->name }}
                                </div>
                            
                                <!-- EMAIL -->
                                <a
                                    href="mailto:{{ $propietario->email }}?subject=Acceso%20a%20tu%20contrato%20registrado&body={{ $message }}"
                                    class="text-blue-600 hover:text-blue-800 text-xs flex items-center gap-1 mt-1"
                                >
                                    <iconify-icon
                                        icon="lucide:mail"
                                        class="text-[12px]">
                                    </iconify-icon>
                                
                                    {{ $propietario->email }}
                                </a>
                            
                                <!-- WHATSAPP -->
                                @if($cleanPhone)
                                    <a
                                        href="https://wa.me/{{ $cleanPhone }}?text={{ $message }}"
                                        target="_blank"
                                        class="text-green-600 hover:text-green-800 text-xs flex items-center gap-1 mt-1"
                                    >
                                        <iconify-icon
                                            icon="logos:whatsapp-icon"
                                            class="text-[12px]">
                                        </iconify-icon>
                                    
                                        {{ $propietario->phone }}
                                    </a>
                                @endif
                                
                            @else
                                
                                <span class="text-gray-400">-</span>
                                
                            @endif
                                
                        </td>

                        <td class="px-6 py-4 text-sm text-gray-900">

                            <div>
                                {{ $contract->start_date->format('d/m/Y') }}
                            </div>

                            <div>
                                {{ $contract->end_date->format('d/m/Y') }}
                            </div>

                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">

                            @if($contract->status == 'completed')

                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    ⏳ Pendiente
                                </span>

                            @elseif($contract->status == 'active')

                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                    ✓ Activo
                                </span>

                            @elseif($contract->status == 'cancelled')

                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                    ✗ Finalizado
                                </span>

                            @else

                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                    📝 Borrador
                                </span>

                            @endif

                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">

                            <div class="flex items-center gap-3">
                            
                                <!-- VER CONTRATO -->
                                <a
                                    href="{{ route('contracts.show', $contract->unique_token) }}"
                                    target="_blank"
                                    class="shadow-sm hover:shadow-md w-9 h-9 rounded-lg bg-yellow-100 text-yellow-600 hover:bg-yellow-200 flex items-center justify-center transition"
                                    title="Ver contrato">
                            
                                    <iconify-icon
                                        icon="lucide:eye"
                                        class="text-lg">
                                    </iconify-icon>
                                
                                </a>
                            
                                <!-- COPIAR LINK -->
                                <button
                                    onclick="copyLink('{{ route('contracts.show', $contract->unique_token) }}')"
                                    class="shadow-sm hover:shadow-md w-9 h-9 rounded-lg bg-blue-100 text-blue-600 hover:bg-blue-200 flex items-center justify-center transition"
                                    title="Copiar link">
                            
                                    <iconify-icon
                                        icon="lucide:link"
                                        class="text-lg">
                                    </iconify-icon>
                                
                                </button>
                            
                                <!-- ACEPTAR -->
                                <form
                                    action="{{ route('admin.contract.approve', $contract->id) }}"
                                    method="POST">
                            
                                    @csrf
                            
                                    <button
                                        type="submit"
                                        class="shadow-sm hover:shadow-md w-9 h-9 rounded-lg bg-emerald-100 text-emerald-600 hover:bg-emerald-200 flex items-center justify-center transition"
                                        title="Aceptar contrato">
                            
                                        <iconify-icon
                                            icon="lucide:check"
                                            class="text-lg">
                                        </iconify-icon>
                                    
                                    </button>
                                
                                </form>
                            
                                <!-- RECHAZAR -->
                                <form
                                    action="{{ route('admin.contract.reject', $contract->id) }}"
                                    method="POST">
                            
                                    @csrf
                            
                                    <button
                                        type="submit"
                                        class="shadow-sm hover:shadow-md w-9 h-9 rounded-lg bg-red-100 text-red-600 hover:bg-red-200 flex items-center justify-center transition"
                                        title="Finalizar contrato">
                            
                                        <iconify-icon
                                            icon="lucide:x"
                                            class="text-lg">
                                        </iconify-icon>
                                    
                                    </button>
                                
                                </form>
                            
                            </div>
                        
                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                            No hay contratos que mostrar
                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

            <!-- Paginación -->
            <div class="px-6 py-4 bg-gray-50">
                {{ $contracts->links() }}
            </div>

        </div>

    </div>

</div>

<script>
    function copyLink(link) {

        navigator.clipboard.writeText(link)
            .then(() => {

                alert('✓ Link copiado:\n' + link);

            })
            .catch(() => {

                alert('Error al copiar el link');

            });
    }
</script>

</body>
</html>