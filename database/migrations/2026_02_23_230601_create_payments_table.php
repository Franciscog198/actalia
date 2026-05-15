<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            
            // Relación con contrato
            $table->foreignId('contract_id')
                  ->constrained('contracts')
                  ->onDelete('cascade');
            
            // Monto
            $table->decimal('amount', 10, 2);
            $table->string('currency', 3)->default('ARS');
            
            // Método de pago
            $table->enum('payment_method', [
                'mercadopago',
                'stripe',
                'transferencia',  // ← IMPORTANTE: Agregado
                'cash',
                'other'
            ])->default('transferencia');
            
            // Datos del proveedor de pago (MercadoPago, Stripe, etc)
            $table->string('payment_provider_id')->nullable()->comment('ID de MercadoPago, Stripe, etc');
            $table->string('payment_provider_status')->nullable();
            
            // Estado del pago
            $table->enum('status', [
                'pending',      // Subido comprobante, esperando verificación
                'processing',   // En proceso de verificación
                'verified',     // ← IMPORTANTE: Agregado (verificado por admin)
                'completed',    // Pago completado
                'failed',       // Pago fallido
                'rejected',     // ← IMPORTANTE: Agregado (rechazado por admin)
                'refunded',     // Reembolsado
                'cancelled'     // Cancelado
            ])->default('pending');
            
            // Link de pago (para MercadoPago/Stripe)
            $table->text('payment_link')->nullable();
            
            // Comprobante de pago (para transferencias manuales)
             // 🔥 CLAVE: múltiples comprobantes
            $table->json('proof_path')->nullable(); // ← IMPORTANTE: Agregado
            
            // Fechas importantes
            $table->timestamp('submitted_at')->nullable();  // ← IMPORTANTE: Agregado (cuando el usuario subió comprobante)
            $table->timestamp('paid_at')->nullable();       // Cuando se realizó el pago
            $table->timestamp('verified_at')->nullable();   // ← IMPORTANTE: Agregado (cuando admin verificó)
            
            // Verificación por admin
            $table->foreignId('verified_by')               // ← IMPORTANTE: Agregado
                  ->nullable()
                  ->constrained('users')
                  ->onDelete('set null');
            $table->text('verification_notes')->nullable(); // ← IMPORTANTE: Agregado
            
            // Metadata adicional (JSON del webhook de MercadoPago/Stripe)
            $table->json('payment_data')->nullable();
            
            $table->timestamps();
            
            // Índices
            $table->index('contract_id');
            $table->index('payment_provider_id');
            $table->index('status');
            $table->index('paid_at');
            $table->index('verified_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};