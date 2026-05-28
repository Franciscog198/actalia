<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrato #{{ $contract->id }} - Admin</title>

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

                <div class="flex items-center gap-4">

                    <a href="{{ route('admin.dashboard') }}"
                       class="text-gray-600 hover:text-gray-900">

                        <iconify-icon
                            icon="lucide:arrow-left"
                            class="text-2xl">
                        </iconify-icon>

                    </a>

                    <h1 class="text-2xl font-bold text-gray-900">
                        Contrato #{{ $contract->id }}
                    </h1>

                </div>

                <button
                    onclick="copyLink()"
                    class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 flex items-center gap-2">

                    <iconify-icon icon="lucide:link"></iconify-icon>

                    Copiar Link

                </button>

            </div>

        </div>
    </header>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Información del Contrato -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">

            <h2 class="text-xl font-bold mb-4">
                Información del Contrato
            </h2>

            <div class="grid grid-cols-2 gap-4">

                <div>
                    <p class="text-sm text-gray-600">Propiedad</p>

                    <p class="font-semibold">
                        {{ $contract->address }}
                    </p>

                    <p class="text-sm text-gray-500">
                        {{ $contract->city }},
                        {{ $contract->province }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-600">Fechas</p>

                    <p class="font-semibold">
                        {{ $contract->start_date->format('d/m/Y') }}
                        -
                        {{ $contract->end_date->format('d/m/Y') }}
                    </p>
                </div>
                <h2 class="text-xl font-bold mb-4">
                Estado del Contrato
            </h2>

            <div class="flex items-center gap-3">

                @if($contract->status === 'pending_payment')

                    <span class="px-4 py-2 bg-yellow-100 text-yellow-800 rounded-full text-sm font-semibold">
                        Pendiente aprobación
                    </span>

                @elseif($contract->status === 'completed')

                    <span class="px-4 py-2 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold">
                        Completado
                    </span>

                @elseif($contract->status === 'active')

                    <span class="px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm font-semibold">
                        Activo
                    </span>

                @elseif($contract->status === 'cancelled')

                    <span class="px-4 py-2 bg-red-100 text-red-800 rounded-full text-sm font-semibold">
                        Cancelado
                    </span>

                @endif

            </div>

            </div>

        </div>

        <!-- Pagos -->
        @if($contract->payments->count() > 0)

            <div class="bg-white rounded-lg shadow p-6 mb-6">

                <h2 class="text-xl font-bold mb-4">
                    Pagos
                </h2>

                @foreach($contract->payments as $payment)
                    <div class="border rounded-lg p-4 mb-4">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <p class="font-semibold">
                                    {{ $payment->payer_type == 'locador' ? 'Locador' : 'Locatario' }}
                                </p>
                                <p class="text-2xl font-bold text-gray-900">
                                    ${{ number_format($payment->amount, 2) }}
                                </p>
                            </div>
                        </div>

                        @if($payment->proof_path && is_array($payment->proof_path))

                            <div class="mb-4 flex flex-wrap gap-4"> 
                                @foreach($payment->proof_path as $proof)                            
                                    @php
                                        $extension = strtolower(pathinfo($proof, PATHINFO_EXTENSION));
                                    @endphp
                                    <div class="w-40">                                  
                                        @if(in_array($extension, ['jpg', 'jpeg', 'png', 'webp']))
                                  
                                            <div
                                                class="cursor-pointer"
                                                onclick="openModal('{{ asset('storage/' . $proof) }}')"
                                            >
                                    
                                                <div class="overflow-hidden rounded-lg border bg-gray-100">
                                                
                                                    <img
                                                        src="{{ asset('storage/' . $proof) }}"
                                                        alt="Comprobante"
                                                        class="w-full h-40 object-cover"
                                                    >
                                                
                                                </div>
                                            
                                                <div class="text-xs text-gray-600 mt-2 text-center">
                                                    Comprobante
                                                </div>
                                            
                                            </div>
                                        
                                        @elseif($extension === 'pdf')
                                        
                                            <a
                                                href="{{ asset('storage/' . $proof) }}"
                                                target="_blank"
                                                class="flex items-center justify-center h-40 rounded-lg bg-red-600 text-white font-semibold hover:bg-red-700"
                                            >
                                                Ver PDF
                                            </a>
                                        
                                        @endif
                                        
                                    </div>
                                
                                @endforeach
                                
                            </div>
                        
                        @endif

                    </div>

                @endforeach

            </div>

        @endif

        <!-- Acciones -->
        @if(
            in_array($contract->status, ['completed', 'pending_payment'])
            && !$contract->approved_at
        )

            <div class="bg-white rounded-lg shadow p-6">

                <h2 class="text-xl font-bold mb-4">
                    Acciones
                </h2>

                <div class="flex gap-4">

                    <form
                        method="POST"
                        action="{{ route('admin.contract.approve', $contract->id) }}"
                        class="flex-1">

                        @csrf

                        <button
                            type="submit"
                            class="w-full px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 font-semibold">

                            ✓ Aprobar Contrato

                        </button>

                    </form>

                    <button
                        onclick="showRejectModal()"
                        class="flex-1 px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 font-semibold">

                        ✗ Rechazar Contrato

                    </button>

                </div>

            </div>

        @endif

    </div>

</div>

<!-- Modal Rechazar -->
<div
    id="rejectModal"
    class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4">

    <div class="bg-white rounded-lg p-6 max-w-md w-full">

        <h3 class="text-xl font-bold mb-4">
            Rechazar Contrato
        </h3>

        <form
            method="POST"
            action="{{ route('admin.contract.reject', $contract->id) }}">

            @csrf

            <div class="mb-4">

                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Motivo del rechazo
                </label>

                <textarea
                    name="rejection_reason"
                    rows="4"
                    required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500"
                    placeholder="Explica el motivo del rechazo..."></textarea>

            </div>

            <div class="flex gap-2">

                <button
                    type="button"
                    onclick="document.getElementById('rejectModal').classList.add('hidden')"
                    class="flex-1 px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">

                    Cancelar

                </button>

                <button
                    type="submit"
                    class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">

                    Rechazar

                </button>

            </div>

        </form>

    </div>

</div>

<script>
    function showRejectModal() {
        document
            .getElementById('rejectModal')
            .classList
            .remove('hidden');
    }

    function copyLink() {

        const link = "{{ route('contracts.show', $contract->unique_token) }}";

        navigator.clipboard.writeText(link);

        alert('✓ Link copiado:\n' + link);
    }
</script>

</body>
</html>