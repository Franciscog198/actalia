<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ContractWizardController extends Controller
{
    public function show($step)
    {
        $allowedSteps = ['1', '2', '3', '3b'];

        if (!in_array((string)$step, $allowedSteps)) {
            return redirect()->route('wizard.step', 1);
        }

        $data = Session::get('contract_wizard', []);

        return view("contracts.steps.step{$step}", [
            'step' => $step,
            'data' => $data
        ]);
    }

    public function store(Request $request, $step)
    {
        $validated = $this->validateStep($request, $step);

         // 🧠 STEP 1 → lógica especial (LO QUE QUIERES APLICAR)
        if ($step == 1) {
    
            // Guardar en sesión (aunque ya se guarda luego en el merge)
            Session::put('registrant_type', $validated['registrant_type']);
    
            // OPCIONAL: crear contrato desde el inicio
            // ⚠️ Solo si tu lógica lo requiere
            // $contract = \App\Models\Contract::create([
            //     'registrant_type' => $validated['registrant_type'],
            // ]);
    
            // También podrías guardar el ID en sesión
            // Session::put('contract_id', $contract->id);
        }


        // 🧠 Si es step 3b, guardar archivo primero
        if ($step === '3b' && $request->hasFile('poliza_documento')) {
            $file = $request->file('poliza_documento');
            $path = $file->store('temp/polizas', 'public');

            $validated['poliza_documento'] = $path;
        }

        // 🧠 Traer sesión SIEMPRE antes del merge
        $data = Session::get('contract_wizard', []);

        // Merge correcto
        $data = array_merge($data, $validated);

        // Guardar en sesión
        Session::put('contract_wizard', $data);

        // 🔥 STEP 2 → decidir flujo
        if ($step == 2) {
            $guaranteeType = $data['guarantee_type'] ?? null;

            if ($guaranteeType === 'sin_garantia') {
                return app(ContractController::class)->storeFinal($data);
            }

            $nextStep = match ($guaranteeType) {
                'propietaria' => '3',
                'poliza' => '3b',
                default => 'final',
            };

            if ($nextStep === 'final') {
                return app(ContractController::class)->storeFinal($data);
            }

            return redirect()->route('wizard.step', $nextStep);
        }

        // 🔥 STEP 3 y 3b → finalizar
        if (in_array($step, ['3', '3b'])) {
            return app(ContractController::class)->storeFinal($data);
        }

        // 👉 fallback
        return redirect()->route('wizard.step', $step + 1);
    }
    private function validateStep(Request $request, $step)
    {
        
        switch ($step) {
            case 1:
                return $request->validate([
                    'contract_type' => 'required|in:vivienda,cochera,comercial',
                    'registrant_type' => 'required|in:inmobiliaria,propietario',
                    'address' => 'required|string',
                    'city' => 'required|string',
                    'province' => 'required|string',
                    'start_date' => 'required|date',
                    'end_date' => 'required|date',
                    'guarantee_type' => 'required|in:propietaria,poliza,sin_garantia',
                ]);

            case 2:

            $rules = [
                // Propietarios (siempre requeridos)
                'propietario.*.name' => 'required|string',
                'propietario.*.email' => 'required|email',
                'propietario.*.phone' => 'required|string',

                // Inquilinos (siempre requeridos)
                'inquilino.*.name' => 'required|string',
                'inquilino.*.email' => 'required|email',
                'inquilino.*.phone' => 'required|string',
            ];

            // 🔥 Solo si es inmobiliaria
            if ($request->registrant_type === 'inmobiliaria') {
                $rules['agente.matricula'] = 'required|string';
                $rules['agente.name'] = 'required|string';
                $rules['agente.email'] = 'required|email';
                $rules['agente.phone'] = 'required|string';
            }

            return $request->validate($rules);

            case 3:
                return $request->validate([
                    'garante1.name' => 'nullable|string',
                    'garante1.email' => 'nullable|email',
                ]);
            // 🔥 ESTE FALTABA
            case '3b':
                    
            $data = $request->validate([
                'poliza_aseguradora' => 'required|string|max:255',
                'poliza_aseguradora_otra' => 'nullable|string|max:255',
                    
                'poliza_numero' => 'required|string|max:255',
                'poliza_certificado' => 'nullable|string|max:255',
                    
                'poliza_emision' => 'required|date',
                    
                'poliza_vigencia_desde' => 'required|date',
                'poliza_vigencia_hasta' => 'required|date|after:poliza_vigencia_desde',
                    
                'poliza_tomador' => 'required|string|max:255',
                    
                'poliza_monto' => 'required|numeric|min:0',
                    
                'poliza_documento' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            ]);
                    
            // Si selecciona "Otra"
            if (($data['poliza_aseguradora'] ?? null) === 'Otra') {
                $data['poliza_aseguradora'] = $data['poliza_aseguradora_otra'];
            }
                    
            return $data;
            }
            
            // 🔥 fallback defensivo (MUY recomendable)
        return [];
    }
}