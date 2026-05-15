<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Contract extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'property_name',
        'address',
        'unit',
        'city',
        'province',
        'postal_code',
        'start_date',
        'end_date',
        'contract_type',
        'monthly_rent',
        'status',
        'unique_token',
        'payment_status',
        'payment_amount',
        'current_step',
        'session_token',
        'metadata',
        'guarantee_type',
        'registrant_type',
        // 🔥 POLIZA
        'poliza_aseguradora',
        'poliza_numero',
        'poliza_certificado',
        'poliza_emision',
        'poliza_vigencia_desde',
        'poliza_vigencia_hasta',
        'poliza_tomador',
        'poliza_monto',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'monthly_rent' => 'decimal:2',
            'payment_amount' => 'decimal:2',
            'metadata' => 'array',

            // 🔥 POLIZA
            'poliza_emision' => 'date',
            'poliza_vigencia_desde' => 'date',
            'poliza_vigencia_hasta' => 'date',
            'poliza_monto' => 'decimal:2',
        ];
    }

    // EVENTOS (Auto-generar token)
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($contract) {
            if (empty($contract->unique_token)) {
                $contract->unique_token = Str::random(32);
            }
            if (empty($contract->session_token)) {
                $contract->session_token = Str::random(64);
            }
        });
    }

    // RELACIONES

    /**
     * Usuarios que participan en este contrato
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'contract_user')
                    ->withPivot('role_in_contract', 'order', 'signed_at')
                    ->withTimestamps();
    }

    /**
     * Obtener inquilino del contrato
     */
    public function inquilino()
    {
        return $this->users()
                    ->wherePivot('role_in_contract', 'inquilino')
                    ->first();
    }

    /**
     * Obtener propietario del contrato
     */
    public function propietario()
    {
        return $this->users()
                    ->wherePivot('role_in_contract', 'propietario')
                    ->first();
    }

    /**
     * Obtener garantes del contrato
     */
    public function garantes()
    {
        return $this->users()
                    ->wherePivotIn('role_in_contract', ['garante_1', 'garante_2'])
                    ->orderBy('contract_user.order');
    }

    /**
     * Documentos del contrato
     */
    public function documents()
    {
        return $this->hasMany(ContractDocument::class);
    }

    /**
     * Pagos del contrato
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Progreso del formulario
     */
    public function formProgress()
    {
        return $this->hasOne(FormProgress::class);
    }

    /**
     * Logs de actividad
     */
    public function activityLogs()
    {
        return $this->hasMany(ActivityLog::class);
    }

    // HELPERS

    /**
     * URL pública del contrato
     */
    public function getPublicUrlAttribute()
    {
        return route('contract.view', $this->unique_token);
    }

    /**
     * Verificar si el pago está completado
     */
    public function isPaid()
    {
        return $this->payment_status === 'paid';
    }

    /**
     * Verificar si está completo
     */
    public function isCompleted()
    {
        return $this->status === 'completed';
    }
}