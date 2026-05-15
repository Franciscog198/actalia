<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            
            // Datos de la propiedad
            $table->string('property_name')->nullable();
            $table->string('address');
            $table->string('unit')->nullable()->comment('pb, 3ro d, etc');
            $table->string('city');
            $table->string('province')->default('Córdoba');
            $table->string('postal_code')->nullable();
            
            // Fechas del contrato
            $table->date('start_date');
            $table->date('end_date');
            
            // Tipo y detalles
            $table->enum('contract_type', ['vivienda', 'cochera', 'comercial'])->default('vivienda');
            $table->enum('guarantee_type', ['propietaria', 'poliza', 'sin_garantia'])->default('propietaria');
            $table->enum('registrant_type', ['inmobiliaria', 'propietario'])->default('propietario');
            $table->decimal('monthly_rent', 10, 2)->nullable();
            
            // Estado del contrato
            $table->enum('status', [
                'draft',
                'pending_payment',
                'completed',
                'active',
                'expired',
                'cancelled'
            ])->default('draft');
            
            // Token único para acceso público
            $table->string('unique_token', 64)->unique();
            
            // Pago
            $table->enum('payment_status', ['pending', 'paid', 'failed'])->default('pending');
            $table->decimal('payment_amount', 10, 2)->default(15000.00);
            
            // Control de flujo del formulario
            $table->integer('current_step')->default(1)->comment('Paso actual: 1-7');
            $table->string('session_token')->nullable()->unique();
            
            // Metadata
            $table->json('metadata')->nullable()->comment('Datos adicionales');
            
            $table->timestamps();
            $table->softDeletes();
            
            // Índices
            $table->index('unique_token');
            $table->index('status');
            $table->index('payment_status');
            $table->index('created_at');

            //Poliza de garantia
            $table->string('poliza_aseguradora')->nullable();
            $table->string('poliza_numero')->nullable();
            $table->string('poliza_certificado')->nullable();
            $table->date('poliza_emision')->nullable();
            $table->date('poliza_vigencia_desde')->nullable();
            $table->date('poliza_vigencia_hasta')->nullable();
            $table->string('poliza_tomador')->nullable();
            $table->decimal('poliza_monto', 12, 2)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};