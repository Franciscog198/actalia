<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\User;
use App\Models\ActivityLog;
use App\Services\PdfService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\ContractDocument;


class ContractController extends Controller
{
    /**
     * Listar todos los contratos (tabla)
     */
    public function index()
    {
        $contracts = Contract::with(['users'])
                            ->latest()
                            ->paginate(20);
        
        return view('contracts.index', compact('contracts'));
    }
    
    /**
     * Mostrar formulario de nuevo contrato
     */
    public function create()
    {
        return view('contracts.create');
    }
    
    /**
     * Guardar nuevo contrato
     */
    public function store(Request $request)
    {
        // Validación mejorada
        $validated = $request->validate([
            // Datos del contrato
            'guarantee_type' => 'required|in:propietaria,poliza,sin_garantia',
            'registrant_type' => 'required|in:inmobiliaria,propietario',
            'contract_type' => 'required|in:vivienda,cochera,comercial',
            'property_name' => 'nullable|string|max:255',
            'address' => 'required|string|max:255',
            'unit' => 'nullable|string|max:50',
            'city' => 'required|string|max:100',
            'province' => 'required|string|max:100',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'monthly_rent' => 'nullable|numeric|min:0',
            
            // Inquilino (requerido)
            'inquilino.name' => 'required|string|max:255',
            'inquilino.email' => 'required|email|max:255',
            'inquilino.phone' => 'required|string|max:50',
            'inquilino.dni_number' => 'nullable|string|max:20',
            
            // Propietario (requerido)
            'propietario.name' => 'required|string|max:255',
            'propietario.email' => [
                'required',
                'email',
                'max:255',
                'different:inquilino.email', // No puede ser el mismo email que inquilino
            ],
            'propietario.phone' => 'required|string|max:50',
            'propietario.dni_number' => 'nullable|string|max:20',
            
            // Garante 1 (opcional, pero si se llena nombre, email es requerido)
            'garante1.name' => 'nullable|string|max:255',
            'garante1.email' => [
                'nullable',
                'email',
                'max:255',
                'required_with:garante1.name', // Si hay nombre, email es obligatorio
                'different:inquilino.email',
                'different:propietario.email',
            ],
            'garante1.phone' => 'nullable|string|max:50',
            'garante1.dni_number' => 'nullable|string|max:20',
            
            // Garante 2 (opcional, pero si se llena nombre, email es requerido)
            'garante2.name' => 'nullable|string|max:255',
            'garante2.email' => [
                'nullable',
                'email',
                'max:255',
                'required_with:garante2.name', // Si hay nombre, email es obligatorio
                'different:inquilino.email',
                'different:propietario.email',
                'different:garante1.email',
            ],
            'garante2.phone' => 'nullable|string|max:50',
            'garante2.dni_number' => 'nullable|string|max:20',
        ], [
            // Mensajes personalizados
            'start_date.after_or_equal' => 'La fecha de inicio debe ser hoy o posterior.',
            'end_date.after' => 'La fecha de fin debe ser posterior a la fecha de inicio.',
            'propietario.email.different' => 'El propietario no puede tener el mismo email que el inquilino.',
            'garante1.email.required_with' => 'El email del garante 1 es obligatorio si ingresaste su nombre.',
            'garante1.email.different' => 'El garante 1 no puede tener el mismo email que otro firmante.',
            'garante2.email.required_with' => 'El email del garante 2 es obligatorio si ingresaste su nombre.',
            'garante2.email.different' => 'El garante 2 no puede tener el mismo email que otro firmante.',
        ]);
        
        try {
            DB::beginTransaction();
            
            // 1. Crear el contrato
            $contract = Contract::create([
                'registrant_type' => $validated['registrant_type'], // GUARDAR TIPO DE REGISTRANTE DE CONTRATO
                'contract_type' => $validated['contract_type'],
                'property_name' => $validated['property_name'],
                'address' => $validated['address'],
                'unit' => $validated['unit'],
                'city' => $validated['city'],
                'province' => $validated['province'],
                'start_date' => $validated['start_date'],
                'end_date' => $validated['end_date'],
                'monthly_rent' => $validated['monthly_rent'],
                'guarantee_type' => $validated['guarantee_type'], // GUARDAR TIPO DE GARANTÍA
                'status' => 'draft',
                'payment_status' => 'pending',
                'current_step' => 2, // Siguiente: subir documentos
            ]);
            
            // 2. Crear/obtener Inquilino
            $inquilino = $this->createOrUpdateUser($validated['inquilino']);
            
            $contract->users()->attach($inquilino->id, [
                'role_in_contract' => 'inquilino',
                'order' => 1,
            ]);
            
            // 3. Crear/obtener Propietario
            $propietario = $this->createOrUpdateUser($validated['propietario']);
            
            $contract->users()->attach($propietario->id, [
                'role_in_contract' => 'propietario',
                'order' => 1,
            ]);
            
            // 4. Garante 1 (si existe)
            if ($this->shouldCreateUser($validated['garante1'] ?? [])) {
                $garante1 = $this->createOrUpdateUser($validated['garante1']);
                
                $contract->users()->attach($garante1->id, [
                    'role_in_contract' => 'garante_1',
                    'order' => 1,
                ]);
            }
            
            // 5. Garante 2 (si existe)
            if ($this->shouldCreateUser($validated['garante2'] ?? [])) {
                $garante2 = $this->createOrUpdateUser($validated['garante2']);
                
                $contract->users()->attach($garante2->id, [
                    'role_in_contract' => 'garante_2',
                    'order' => 2,
                ]);
            }
            
            // 6. Registrar actividad
            ActivityLog::create([
                'contract_id' => $contract->id,
                'action' => 'created',
                'description' => 'Contrato creado',
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'metadata' => [
                    'address' => $contract->address,
                    'city' => $contract->city,
                    'type' => $contract->contract_type,
                ],
            ]);
            
            DB::commit();
            
            // Redirigir a subir documentos
            //return redirect()->route('documents.create', $contract->unique_token)
            //             ->with('success', '¡Datos guardados! Ahora sube las fotos.');
            
                           
            // REDIRIGIR SEGÚN EL TIPO DE GARANTÍA //
            if ($contract->guarantee_type === 'sin_garantia') {
                // Sin garantía - ir directo a subir documentos
                return redirect()->route('wizard.step', ['step' => '4']); // step3.blade.php
            } elseif ($contract->guarantee_type === 'poliza') {
                // Ir a formulario de póliza
                return redirect()->route('wizard.step', ['step' => '3b']); // step3b.blade.php
            } else {
                 // Ir a formulario de garantía propietaria
                return redirect()->route('wizard.step', ['step' => '3']); // step3c.blade.php
            }
            // FIN REDIRIGIR SEGÚN EL TIPO DE GARANTÍA //

            } catch (\Exception $e) {
                DB::rollBack();

                // Log del error para debugging
                \Log::error('Error al crear contrato: ' . $e->getMessage(), [
                    'trace' => $e->getTraceAsString()
                ]);

                return back()
                    ->withInput()
                    ->withErrors(['error' => 'Error al crear el contrato. Por favor intenta de nuevo.']);
        }
    }
    
    /**
     * Ver un contrato específico (por token)
     */
    public function show($token)
    {
        $contract = Contract::with(['users', 'documents', 'payments'])
                           ->where('unique_token', $token)
                           ->firstOrFail();
        
        // Registrar vista del contrato
        ActivityLog::create([
            'contract_id' => $contract->id,
            'action' => 'viewed',
            'description' => 'Contrato visualizado',
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
        
        return view('contracts.show', compact('contract'));
    }
    
    /**
     * Página de éxito
     */
    //public function success($token)
    //{
    //    $contract = Contract::where('unique_token', $token)->firstOrFail();
    //    
    //    return view('payment.confirm', [
    //        'token' => $token,
    //        'contract' => $contract
    //    ]);
    //}
    
    // ============================================
    // MÉTODOS AUXILIARES PRIVADOS
    // ============================================
    
    /**
     * Crear o actualizar usuario
     */
    private function createOrUpdateUser(array $data)
    {
        $user = User::where('email', $data['email'])->first();
        
        if ($user) {
            // Usuario existe, actualizar solo si los datos son diferentes
            $user->update([
                'name' => $data['name'],
                'phone' => $data['phone'],
                'dni_number' => $data['dni_number'] ?? $user->dni_number,
            ]);
        } else {
            // Crear nuevo usuario
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'dni_number' => $data['dni_number'] ?? null,
                'can_login' => false,
            ]);
        }
        
        return $user;
    }
    
    /**
     * Verificar si se debe crear un usuario (garante)
     */
    private function shouldCreateUser(array $data): bool
    {
        return !empty($data['name']) && !empty($data['email']);
    }

    /**
     * Descargar PDF del contrato
     */
    public function downloadPdf($token)
    {
        $contract = Contract::with(['users', 'documents', 'payments'])
                           ->where('unique_token', $token)
                           ->firstOrFail();
        
        try {
            $pdfService = new PdfService();
            
            // Registrar descarga en logs
            \App\Models\ActivityLog::create([
                'contract_id' => $contract->id,
                'action' => 'pdf_downloaded',
                'description' => 'PDF del contrato descargado',
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);
            
            return $pdfService->downloadContractPdf($contract);
            
        } catch (\Exception $e) {
            \Log::error('Error al generar PDF: ' . $e->getMessage());
            
            return back()->withErrors(['error' => 'Error al generar el PDF.']);
        }
    }
    
    /**
     * Ver PDF en el navegador
     */
    public function viewPdf($token)
    {
        $contract = Contract::with(['users', 'documents', 'payments'])
                           ->where('unique_token', $token)
                           ->firstOrFail();
        
        $pdfService = new PdfService();
        return $pdfService->streamContractPdf($contract);
    }
    
    //public function storeFinal(array $data)
    //{
    //    try {
    //        DB::beginTransaction();
    //
    //        $contract = Contract::create([
    //            'contract_type' => $data['contract_type'],
    //            'address' => $data['address'],
    //            'city' => $data['city'],
    //            'province' => $data['province'],
    //            'start_date' => $data['start_date'],
    //            'end_date' => $data['end_date'],
    //            'guarantee_type' => $data['guarantee_type'] ?? null,
    //            'registrant_type' => $data['registrant_type'] ?? null,
    //            'status' => 'draft',
    //            'payment_status' => 'pending',
    //            'current_step' => 2,
    //        ]);
    //
    //        // ✅ INQUILINOS
    //        if (!empty($data['inquilino'])) {
    //            foreach ($data['inquilino'] as $i => $inq) {
    //                $user = $this->createOrUpdateUser($inq);
    //
    //                $contract->users()->attach($user->id, [
    //                    'role_in_contract' => 'inquilino',
    //                    'order' => $i + 1,
    //                ]);
    //            }
    //        }
    //
    //        // ✅ PROPIETARIOS
    //        if (!empty($data['propietario'])) {
    //            foreach ($data['propietario'] as $i => $prop) {
    //                $user = $this->createOrUpdateUser($prop);
    //
    //                $contract->users()->attach($user->id, [
    //                    'role_in_contract' => 'propietario',
    //                    'order' => $i + 1,
    //                ]);
    //            }
    //        }
    //
    //        DB::commit();
    //
    //        Session::forget('contract_wizard');
    //
    //        return redirect()->route('contracts.success', $contract->unique_token);
    //
    //    } catch (\Exception $e) {
    //        DB::rollBack();
    //
    //        dd($e->getMessage()); // 👈 DEBUG REAL
    //    }
    //}
    public function storeFinal(array $data)
    {
        try {
    
            DB::beginTransaction();
    
            // =====================================
            // CREAR CONTRATO
            // =====================================
    
            $contract = Contract::create([
                'contract_type' => $data['contract_type'] ?? null,
                'address' => $data['address'],
                'city' => $data['city'],
                'province' => $data['province'],
                'start_date' => $data['start_date'],
                'end_date' => $data['end_date'],
    
                'guarantee_type' => $data['guarantee_type'] ?? null,
                'registrant_type' => $data['registrant_type'] ?? null,
    
                'status' => 'draft',
                'payment_status' => 'pending',
                'current_step' => 4,
            ]);
    
            // =====================================
            // INQUILINOS
            // =====================================
    
            foreach ($data['inquilino'] ?? [] as $i => $inq) {
    
                $user = $this->createOrUpdateUser($inq);
    
                $contract->users()->attach($user->id, [
                    'role_in_contract' => 'inquilino',
                    'order' => $i + 1,
                ]);
            }
    
            // =====================================
            // PROPIETARIOS
            // =====================================
    
            foreach ($data['propietario'] ?? [] as $i => $prop) {
    
                $user = $this->createOrUpdateUser($prop);
    
                $contract->users()->attach($user->id, [
                    'role_in_contract' => 'propietario',
                    'order' => $i + 1,
                ]);
            }
    
            // =====================================
            // GUARDAR POLIZA
            // =====================================
    
            if (
                !empty($data['poliza_documento']) &&
                Storage::disk('public')->exists($data['poliza_documento'])
            ) {
    
                // path temporal
                $tempPath = $data['poliza_documento'];
    
                // extension
                $extension = pathinfo($tempPath, PATHINFO_EXTENSION);
    
                // nombre final
                $filename =
                    time() .
                    '_poliza_' .
                    uniqid() .
                    '.' .
                    $extension;
    
                // ruta final
                $newPath = "contracts/{$contract->id}/documents/{$filename}";
    
                // mover archivo
                Storage::disk('public')->move($tempPath, $newPath);
    
                // path absoluto
                $absolutePath = Storage::disk('public')->path($newPath);
    
                // mime
                $mimeType = Storage::disk('public')->mimeType($newPath);
    
                // size
                $fileSize = Storage::disk('public')->size($newPath);
    
                // dimensiones
                $width = null;
                $height = null;
    
                if (str_starts_with($mimeType, 'image/')) {
    
                    try {
    
                        $imageSize = getimagesize($absolutePath);
    
                        $width = $imageSize[0] ?? null;
                        $height = $imageSize[1] ?? null;
    
                    } catch (\Exception $e) {
    
                        \Log::warning($e->getMessage());
                    }
                }
    
                // guardar documento
                ContractDocument::create([
    
                    'contract_id' => $contract->id,
    
                    'document_type' => 'poliza',
    
                    'metadata' => [
                        'aseguradora' => $data['poliza_aseguradora'] ?? null,
                        'numero' => $data['poliza_numero'] ?? null,
                        'certificado' => $data['poliza_certificado'] ?? null,
                        'emision' => $data['poliza_emision'] ?? null,
                        'vigencia_desde' => $data['poliza_vigencia_desde'] ?? null,
                        'vigencia_hasta' => $data['poliza_vigencia_hasta'] ?? null,
                        'tomador' => $data['poliza_tomador'] ?? null,
                        'monto' => $data['poliza_monto'] ?? null,
                    ],
    
                    'original_filename' => basename($newPath),
    
                    'storage_path' => $newPath,
    
                    'public_url' => Storage::url($newPath),
    
                    'file_size' => $fileSize,
    
                    'mime_type' => $mimeType,
    
                    'width' => $width,
                    'height' => $height,
    
                    'uploaded_from' => 'web',
    
                    'ip_address' => request()->ip(),
    
                    'uploaded_at' => now(),
                ]);
            }
    
            DB::commit();
    
            Session::forget('contract_wizard');
    
            return redirect()->route(
                'documents.create',
                $contract->unique_token
            );
    
        } catch (\Exception $e) {
    
            DB::rollBack();
    
            dd($e->getMessage());
        }
    }

}