<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('form_progress', function (Blueprint $table) {
            $table->id();
            
            // Relación con contrato
            $table->foreignId('contract_id')
                  ->constrained('contracts')
                  ->onDelete('cascade');
            
            // Token de sesión para recuperar
            $table->string('session_token', 64)->unique();
            
            // Progreso del formulario
            $table->integer('current_step')->default(1);
            $table->json('completed_steps')->nullable()->comment('Array de pasos completados: [1,2,3]');
            
            // Datos temporales del formulario
            $table->json('form_data')->nullable()->comment('Datos no guardados aún');
            
            // Información de la sesión
            $table->ipAddress('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            
            // Control de expiración
            $table->timestamp('last_activity_at')->useCurrent();
            $table->timestamp('expires_at')->nullable()->comment('Expira después de 24-48 horas');
            
            $table->timestamps();
            
            // Índices
            $table->index('session_token');
            $table->index('contract_id');
            $table->index('expires_at');
            $table->index('last_activity_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('form_progress');
    }
};