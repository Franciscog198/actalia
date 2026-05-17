<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\ContractDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as InterventionImage;

class DocumentUploadController extends Controller
{
    public function create($token)
    {
        $contract = Contract::with('users')
            ->where('unique_token', $token)
            ->firstOrFail();

        return view('contracts.upload-documents', compact('contract'));
    }

    public function store(Request $request, $token)
    {
    //dd($request->file('documents'));   
    $contract = Contract::where('unique_token', $token)->firstOrFail();

        $request->validate([
            'documents' => 'required|array|min:1',
            'documents.*' => 'array',
            'documents.*.*' => 'image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        try {
            $uploadedCount = 0;

            $documents = $request->file('documents', []);

            if (empty($documents)) {
                \Log::error('NO HAY ARCHIVOS EN REQUEST');
                return back()->withErrors(['error' => 'No se recibieron archivos']);
            }
            
            foreach ($documents as $documentType => $files) {
            
                if (!is_array($files)) continue;
            
                foreach ($files as $index => $file) {
            
                    if (!$file || !$file->isValid()) continue;
            
                    $uploadedCount += $this->saveDocument(
                        $contract,
                        $file,
                        $documentType,
                        $index,
                        $request
                    );
                }
            }
    
                $contract->update([
                'current_step' => 3,
                'status' => 'pending_payment'
            ]);

            return redirect()
                ->route('payment.show', $contract->unique_token)
                ->with('success', "¡{$uploadedCount} documento(s) subido(s)!");

        } catch (\Exception $e) {

            \Log::error('UPLOAD ERROR', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            //dd($e->getMessage()); // DEBUG REAL
        }
    }

    private function saveDocument($contract, $file, $documentType, $index, $request)
{
    $filename = time() . '_' . $documentType . '_' . $index . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

    $path = "contracts/{$contract->id}/documents";

    // DATOS ANTES DEL MOVE
    $originalFilename = $file->getClientOriginalName();
    $fileSize = $file->getSize();
    $mimeType = $file->getMimeType();

    // Dimensiones
    $width = null;
    $height = null;

    try {
        $imageSize = getimagesize($file->getRealPath());

        $width = $imageSize[0] ?? null;
        $height = $imageSize[1] ?? null;

    } catch (\Exception $e) {
        \Log::warning($e->getMessage());
    }

    // Ruta real
    $destinationPath = base_path('../public_html/storage/' . $path);

    // Crear carpeta
    if (!file_exists($destinationPath)) {
        mkdir($destinationPath, 0777, true);
    }

    // MOVER ARCHIVO
    $file->move($destinationPath, $filename);

    // Ruta BD
    $storedPath = $path . '/' . $filename;

    // Thumbnail
    $thumbnailPath = null;

    // Guardar BD
    $doc = ContractDocument::create([
        'contract_id' => $contract->id,
        'user_id' => null,
        'document_type' => $this->mapDocumentType($documentType),
        'original_filename' => $originalFilename,
        'storage_path' => $storedPath,
        'public_url' => '/storage/' . $storedPath,
        'thumbnail_path' => $thumbnailPath,
        'file_size' => $fileSize,
        'mime_type' => $mimeType,
        'width' => $width,
        'height' => $height,
        'page_number' => $documentType === 'contrato_firmado' ? $index + 1 : null,
        'order' => $index,
        'uploaded_from' => 'mobile',
        'ip_address' => $request->ip(),
        'uploaded_at' => now(),
    ]);

    if (!$doc) {
        dd('ERROR GUARDANDO EN BD');
    }

    return 1;
}

    private function mapDocumentType($type)
    {
        return match ($type) {
            'dni_locador', 'dni_locatario', 'dni_garante' => 'dni_front',
            'foto_locador', 'foto_locatario', 'foto_garante' => 'selfie',
            'contrato_firmado' => 'contract_page',
            default => 'other',
        };
    }
}