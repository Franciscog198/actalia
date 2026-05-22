<?php

use App\Http\Controllers\ContractController;
use App\Http\Controllers\ContractWizardController;
use App\Http\Controllers\DocumentUploadController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AdminController;



// Página de inicio
Route::get('/', function () {
    return view('welcome');
})->name('home');


// ==========================================
// 🚀 WIZARD DE CONTRATO (MULTI-STEP)
// ==========================================

// Redirige /register al wizard paso 1
Route::get('/register', function () {
    return redirect()->route('wizard.step', 1);
})->name('register');

// Wizard steps
Route::prefix('wizard')->group(function () {
    Route::get('/step/{step}', [ContractWizardController::class, 'show'])->name('wizard.step');
    Route::post('/step/{step}', [ContractWizardController::class, 'store'])->name('wizard.store');
});


// ==========================================
// CONTRATOS (lectura / acciones)
// ==========================================

// Lista
Route::get('/contracts', [ContractController::class, 'index'])->name('contracts.index');

// Ver contrato por token
Route::get('/contract/{token}', [ContractController::class, 'show'])->name('contracts.show');

// Página de éxito
//Route::get('/contract/{token}/success', [ContractController::class, 'success'])->name('contract.success');

// PDF
Route::get('/contract/{token}/pdf', [ContractController::class, 'downloadPdf'])->name('contracts.pdf');
Route::get('/contract/{token}/pdf/preview', [ContractController::class, 'viewPdf'])->name('contracts.pdfPreview');


// ==========================================
// DOCUMENTOS
// ==========================================

Route::get('/contract/{token}/upload', [DocumentUploadController::class, 'create'])->name('documents.create');
Route::post('/contract/{token}/upload', [DocumentUploadController::class, 'store'])->name('documents.store');

Route::post('/contracts/{token}/poliza', [ContractController::class, 'storePoliza'])
    ->name('contracts.poliza.store');

// Rutas de pago
Route::get('/contract/{token}/payment', [PaymentController::class, 'show'])->name('payment.show');
Route::post('/contract/{token}/payment/confirm', [PaymentController::class, 'confirm'])->name('payment.confirm');
Route::get('/contract/{token}/payment/pending', [PaymentController::class, 'pending'])->name('payment.pending');
Route::get('/contract/{token}/payment/success', [PaymentController::class, 'success'])->name('payment.success');


//constancia
Route::get('/contract/{token}/ticket', [PaymentController::class, 'downloadTicket'])
    ->name('payment.ticket');


// Rutas de Admin (protegidas por middleware auth y admin)
//Route::middleware(['auth'])->prefix('admin')->group(function () {
//    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
//    Route::get('/contracts/{id}', [AdminController::class, 'show'])->name('admin.contract.show');
//    Route::post('/contracts/{id}/approve', [AdminController::class, 'approve'])->name('admin.contract.approve');
//    Route::post('/contracts/{id}/reject', [AdminController::class, 'reject'])->name('admin.contract.reject');
//    Route::post('/payments/{id}/verify', [AdminController::class, 'verifyPayment'])->name('admin.payment.verify');
//    Route::post('/payments/{id}/reject', [AdminController::class, 'rejectPayment'])->name('admin.payment.reject');
//    Route::get('/contracts/{id}/copy-link', [AdminController::class, 'copyLink'])->name('admin.contract.copyLink');
//});    



// Rutas de Admin CON AUTH
//Route::middleware(['auth'])->prefix('admin')->group(function () {
require __DIR__.'/auth.php';

// Rutas públicas / auth
//Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

    Route::get('/contracts/{id}', [AdminController::class, 'show'])
        ->name('admin.contract.show');

    Route::post('/contracts/{id}/approve', [AdminController::class, 'approve'])
        ->name('admin.contract.approve');

    Route::post('/contracts/{id}/reject', [AdminController::class, 'reject'])
        ->name('admin.contract.reject');

    Route::get('/profile', function () {
        return 'Perfil';
    })->name('profile.edit');

//});

