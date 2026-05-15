<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            
            // Relación con contrato (nullable para logs generales)
            $table->foreignId('contract_id')
                  ->nullable()
                  ->constrained('contracts')
                  ->onDelete('cascade');
            
            // Relación polimórfica (para registrar acciones en cualquier modelo)
            $table->string('loggable_type')->nullable();
            $table->unsignedBigInteger('loggable_id')->nullable();
            
            // Usuario que ejecuta la acción (nullable para acciones públicas)
            $table->foreignId('user_id')
                  ->nullable()
                  ->constrained('users')
                  ->onDelete('set null');
            
            // Acción realizada
            $table->string('action')->comment('created, updated, viewed, paid, deleted, etc');
            $table->text('description')->nullable();
            
            // Información de la sesión
            $table->ipAddress('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            
            // Metadata adicional
            $table->json('metadata')->nullable()->comment('Datos adicionales de la acción');
            
            $table->timestamp('created_at')->useCurrent();
            
            // Índices
            $table->index('contract_id');
            $table->index('user_id');
            $table->index('action');
            $table->index('created_at');
            $table->index(['loggable_type', 'loggable_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};