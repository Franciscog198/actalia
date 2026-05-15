<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contract_documents', function (Blueprint $table) {
            $table->id();
            
            // Relación con contrato
            $table->foreignId('contract_id')
                  ->constrained('contracts')
                  ->onDelete('cascade');
            
            // Relación opcional con usuario (para DNIs y fotos)
            $table->foreignId('user_id')
                  ->nullable()
                  ->constrained('users')
                  ->onDelete('cascade');
            
            // Tipo de documento
            $table->enum('document_type', [
                'contract_page',
                'dni_front',
                'dni_back',
                'selfie',
                'group_photo',
                'proof_income',
                'poliza',
                'addendum',
                'inventory',
                'other'
            ]);
            
            // Información del archivo
            $table->string('original_filename');
            $table->string('storage_path');
            $table->string('public_url')->nullable();
            $table->string('thumbnail_path')->nullable();
            
            // Metadata del archivo
            $table->unsignedBigInteger('file_size')->comment('Tamaño en bytes');
            $table->string('mime_type');
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            
            // Orden y paginación
            $table->integer('page_number')->nullable()->comment('Número de página del contrato');
            $table->integer('order')->default(1);
            
            // Origen de la subida
            $table->enum('uploaded_from', ['web', 'mobile', 'admin'])->default('web');
            $table->ipAddress('ip_address')->nullable();
            
            $table->timestamp('uploaded_at')->useCurrent();
            $table->timestamps();
            
            // Índices
            $table->index('contract_id');
            $table->index('user_id');
            $table->index('document_type');
            $table->index(['contract_id', 'document_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contract_documents');
    }
};