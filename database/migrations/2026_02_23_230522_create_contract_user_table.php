<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contract_user', function (Blueprint $table) {
            $table->id();
            
            // Relaciones
            $table->foreignId('contract_id')
                  ->constrained('contracts')
                  ->onDelete('cascade');
                  
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');
            
            // Rol en el contrato
            $table->enum('role_in_contract', [
                'inquilino',
                'propietario',
                'garante_1',
                'garante_2'
            ]);
            
            // Orden (para múltiples garantes)
            $table->integer('order')->default(1);
            
            // Firma
            $table->timestamp('signed_at')->nullable();
            
            $table->timestamps();
            
            // Índices
            $table->index('contract_id');
            $table->index('user_id');
            $table->index('role_in_contract');
            
            // Un usuario no puede tener el mismo rol 2 veces en el mismo contrato
            $table->unique(['contract_id', 'user_id', 'role_in_contract'], 'contract_user_role_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contract_user');
    }
};