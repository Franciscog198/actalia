<?php

namespace App\Services;

use App\Models\Contract;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfService
{
    /**
     * Generar PDF del contrato
     */
    public function generateContractPdf(Contract $contract)
    {
        // Cargar relaciones necesarias
        $contract->load(['users', 'documents', 'payments']);
        
        // Generar PDF
        $pdf = Pdf::loadView('pdfs.contract', [
            'contract' => $contract
        ]);
        
        // Configurar opciones
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOption('enable-local-file-access', true);
        
        return $pdf;
    }
    
    /**
     * Descargar PDF
     */
    public function downloadContractPdf(Contract $contract)
    {
        $pdf = $this->generateContractPdf($contract);
        
        $filename = 'contrato_' . $contract->unique_token . '_' . date('Ymd') . '.pdf';
        
        return $pdf->download($filename);
    }
    
    /**
     * Ver PDF en el navegador
     */
    public function streamContractPdf(Contract $contract)
    {
        $pdf = $this->generateContractPdf($contract);
        
        return $pdf->stream('contrato.pdf');
    }
}