<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Datos adicionales del usuario
            $table->string('phone')->nullable()->after('email');
            $table->string('dni_number', 20)->nullable()->after('phone');
            $table->text('address')->nullable()->after('dni_number');
            $table->string('occupation')->nullable()->after('address');
            
            // Control de acceso
            $table->boolean('is_admin')->default(false)->after('occupation');
            $table->boolean('can_login')->default(false)->after('is_admin');
            
            // Hacer password nullable para usuarios públicos
            $table->string('password')->nullable()->change();
            
            // Soft deletes
            $table->softDeletes()->after('remember_token');
            
            // Índices
            $table->index('dni_number');
            $table->index('phone');
            $table->index('is_admin');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'dni_number',
                'address',
                'occupation',
                'is_admin',
                'can_login'
            ]);
            $table->dropSoftDeletes();
        });
    }
};