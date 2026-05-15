<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('contract_documents', function (Blueprint $table) {
            if (!Schema::hasColumn('contract_documents', 'width')) {
                $table->integer('width')->nullable();
            }
            if (!Schema::hasColumn('contract_documents', 'height')) {
                $table->integer('height')->nullable();
            }
            if (!Schema::hasColumn('contract_documents', 'page_number')) {
                $table->integer('page_number')->nullable();
            }
            if (!Schema::hasColumn('contract_documents', 'order')) {
                $table->integer('order')->default(0);
            }
            if (!Schema::hasColumn('contract_documents', 'uploaded_from')) {
                $table->string('uploaded_from')->nullable();
            }
            if (!Schema::hasColumn('contract_documents', 'ip_address')) {
                $table->string('ip_address')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contract_documents', function (Blueprint $table) {
            //
        });
    }
};
