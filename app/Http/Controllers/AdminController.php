<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Dashboard principal
     */
    public function dashboard(Request $request)
{
    $query = Contract::with(['users', 'payments'])
        ->orderBy('created_at', 'desc');

   // Filtros
    if ($request->filled('search')) {

        $search = $request->search;

        $query->where(function ($q) use ($search) {

            $q->where('address', 'like', "%{$search}%")
              ->orWhere('property_name', 'like', "%{$search}%")
              ->orWhere('city', 'like', "%{$search}%")
              ->orWhere('province', 'like', "%{$search}%")
              ->orWhereHas('users', function ($q) use ($search) {

                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhereRaw(
                      "REPLACE(REPLACE(REPLACE(phone, ' ', ''), '-', ''), '+', '') LIKE ?",
                      ['%' . str_replace([' ', '-', '+'], '', $search) . '%']
                  );
            
            });

        });
    }

    // Filtro por estado
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // Filtro por payment status
    if ($request->filled('payment_status')) {
        $query->where('payment_status', $request->payment_status);
    }

    // Estadísticas
    $stats = [

        'total' => Contract::count(),

        'completed' => Contract::where('status', 'completed')->count(),

        'pending_payment' => Contract::where('status', 'pending_payment')->count(),

        'active' => Contract::where('status', 'active')->count(),

        'cancelled' => Contract::where('status', 'cancelled')->count(),
    ];

    // Contratos paginados
    $contracts = $query->paginate(20);

    return view('admin.dashboard', compact(
        'contracts',
        'stats'
    ));
}

    /**
     * Ver detalles del contrato
     */
    public function show($id)
    {
        $contract = Contract::with(['users', 'payments', 'documents'])
            ->findOrFail($id);

        return view('admin.contract-detail', compact('contract'));
    }

    /**
     * Aprobar contrato
     */
    public function approve($id)
    {
        $contract = Contract::findOrFail($id);
        
        $contract->update([
            'status' => 'active',
            'approved_at' => now(),
            'payment_status' => 'paid',
        ]);

    
        return back()->with('success', 'Contrato aprobado exitosamente');
    }

    /**
     * Rechazar contrato
     */
    public function reject(Request $request, $id)
    {
    
        $contract = Contract::findOrFail($id);
        
        $contract->update([
            'status' => 'cancelled',
            'rejected_at' => now(),
            'payment_status' => 'failed',
        ]);

        // Cancelar todos los pagos relacionados
         $contract->payments()->update([
             'status' => 'cancelled',
         ]);
        
             return back()->with('success', 'Contrato rechazado');
         }

    /**
     * Verificar pago
     */
    //public function verifyPayment(Request $request, $paymentId)
    //{
    //    $payment = Payment::findOrFail($paymentId);
    //    
    //    $payment->update([
    //        'status' => 'verified',
    //        'verified_at' => now(),
    //        'verified_by' => auth()->id(),
    //        'verification_notes' => $request->notes,
    //    ]);
//
    //    // Actualizar estado del contrato
    //    $contract = $payment->contract;
    //    
    //    // Verificar si todos los pagos están verificados
    //    $allPaymentsVerified = $contract->payments()
    //        ->where('status', '!=', 'verified')
    //        ->count() === 0;
//
    //    if ($allPaymentsVerified) {
    //        $contract->update([
    //            'status' => 'completed',
    //            'payment_status' => 'paid',
    //        ]);
    //    }
//
    //    return back()->with('success', 'Pago verificado exitosamente');
    //}
//
    ///**
    // * Rechazar pago
    // */
    //public function rejectPayment(Request $request, $paymentId)
    //{
    //    $request->validate([
    //        'rejection_reason' => 'required|string|max:500',
    //    ]);
//
    //    $payment = Payment::findOrFail($paymentId);
    //    
    //    $payment->update([
    //        'status' => 'cancelled',
    //        'verification_notes' => $request->rejection_reason,
    //        'verified_at' => now(),
    //        'verified_by' => auth()->id(),
    //    ]);
//
    //    return back()->with('error', 'Pago rechazado');
    //}

    /**
     * Copiar link del contrato
     */
    public function copyLink($id)
    {
        //$contract = Contract::findOrFail($id);
        //$link = route('contracts.show', $contract->unique_token);
//
        //return response()->json(['link' => $link]);
    }
}