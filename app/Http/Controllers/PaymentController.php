<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Payment;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentReceivedNotification;
use Barryvdh\DomPDF\Facade\Pdf;

class PaymentController extends Controller
{
    /**
     * Mostrar página de pago
     */
    public function show($token)
    {
        $contract = Contract::where('unique_token', $token)->firstOrFail();

        return view('contracts.payment', compact('contract'));
    }

    /**
     * Confirmar pago realizado
     */
    public function confirm(Request $request, $token)
    {
        $contract = Contract::where('unique_token', $token)->firstOrFail();

        $request->validate([
            'comprobante_locador' => 'required|file|mimes:jpg,jpeg,png,pdf|max:10240',
            'comprobante_locatario' => 'required|file|mimes:jpg,jpeg,png,pdf|max:10240',
        ], [
            'comprobante_locador.required' => 'Debes subir el comprobante del locador.',
            'comprobante_locatario.required' => 'Debes subir el comprobante del locatario.',
        ]);

        try {

            /**
             * =====================================
             * RUTA BASE
             * =====================================
             */
            $path = "contracts/{$contract->id}/payments";
            
            /**
             * =====================================
             * LOCADOR
             * =====================================
             */
            $fileLocador = $request->file('comprobante_locador');
            
            $filenameLocador =
                time() .
                '_locador_' .
                uniqid() .
                '.' .
                $fileLocador->getClientOriginalExtension();
            
            /**
             * =====================================
             * STORAGE LARAVEL
             * =====================================
             */
            $laravelPath = storage_path(
                'app/public/' . $path
            );
            
            if (!file_exists($laravelPath)) {
                mkdir($laravelPath, 0777, true);
            }
            
            $fileLocador->move(
                $laravelPath,
                $filenameLocador
            );
            
            /**
             * =====================================
             * DUPLICAR EN PUBLIC_HTML
             * =====================================
             */
            $publicHtmlPath = base_path(
                '../public_html/app/storage/' . $path
            );
            
            if (!file_exists($publicHtmlPath)) {
                mkdir($publicHtmlPath, 0777, true);
            }
            
            copy(
                $laravelPath . '/' . $filenameLocador,
                $publicHtmlPath . '/' . $filenameLocador
            );
            
            /**
             * URL PUBLICA
             */
            $storedLocador =
                '/storage/' .
                $path .
                '/' .
                $filenameLocador;
            
            /**
             * =====================================
             * LOCATARIO
             * =====================================
             */
            $fileLocatario = $request->file('comprobante_locatario');
            
            $filenameLocatario =
                time() .
                '_locatario_' .
                uniqid() .
                '.' .
                $fileLocatario->getClientOriginalExtension();
            
            /**
             * STORAGE LARAVEL
             */
            $fileLocatario->move(
                $laravelPath,
                $filenameLocatario
            );
            
            /**
             * DUPLICAR EN PUBLIC_HTML
             */
            copy(
                $laravelPath . '/' . $filenameLocatario,
                $publicHtmlPath . '/' . $filenameLocatario
            );
            
            /**
             * URL PUBLICA
             */
            $storedLocatario =
                '/storage/' .
                $path .
                '/' .
                $filenameLocatario;
            /**
             * =====================================
             * CREAR PAGO
             * =====================================
             */
            $payment = Payment::create([
                'contract_id' => $contract->id,
                'amount' => 15000.00,
                'payment_method' => 'transferencia',
                'status' => 'pending',

                'proof_path' => [
                    'locador' => $storedLocador,
                    'locatario' => $storedLocatario,
                ],

                'submitted_at' => now(),
            ]);

            /**
             * =====================================
             * ACTUALIZAR CONTRATO
             * =====================================
             */
            $contract->update([
                'status' => 'completed',
                'payment_status' => 'pending',
            ]);

            /**
             * =====================================
             * LOG
             * =====================================
             */
            ActivityLog::create([
                'contract_id' => $contract->id,
                'action' => 'payment_submitted',
                'description' => 'Comprobantes subidos (locador y locatario)',
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            /**
             * =====================================
             * EMAIL
             * =====================================
             */
            $this->notifyAdmin($contract, $payment);

            return redirect()
                ->route('payment.success', $contract->unique_token)
                ->with('success', '¡Comprobantes enviados correctamente!');

        } catch (\Exception $e) {

            \Log::error('ERROR PAYMENT:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return back()->with(
                'error',
                'Error al guardar comprobantes: ' . $e->getMessage()
            );
        }
    }

    /**
     * Página de pago pendiente
     */
    public function pending($token)
    {
        $contract = Contract::where('unique_token', $token)->firstOrFail();

        return view('contracts.payment-pending', compact('contract'));
    }

    /**
     * Notificar admin
     */
    private function notifyAdmin($contract, $payment)
    {
        $adminEmail = config('mail.admin_email', 'admin@registrado.com');

        try {

            Mail::to($adminEmail)
                ->send(new PaymentReceivedNotification($contract, $payment));

        } catch (\Exception $e) {

            \Log::error(
                'Error al enviar email de pago: ' . $e->getMessage()
            );
        }
    }

    /**
     * Success
     */
    public function success($token)
    {
        $contract = Contract::where('unique_token', $token)->firstOrFail();

        return view('payment.confirm', compact('contract'));
    }

    /**
     * Descargar ticket
     */
    public function downloadTicket($token)
    {
        $contract = Contract::where('unique_token', $token)->firstOrFail();

        $pdf = Pdf::loadView('pdfs.ticket', compact('contract'));

        return $pdf->download(
            'constancia_' . $contract->id . '.pdf'
        );
    }
}