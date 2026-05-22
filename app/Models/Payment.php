<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Payment extends Model
{
    protected $fillable = [
        'contract_id',
        'amount',
        'currency',
        'payment_method',
        'payment_provider_id',
        'payment_provider_status',
        'status',
        'payment_link',
        'proof_path',
        'submitted_at',
        'paid_at',
        'verified_at',
        'verified_by',
        'verification_notes',
        'payment_data',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'submitted_at' => 'datetime',
            'paid_at' => 'datetime',
            'verified_at' => 'datetime',
            'payment_data' => 'array',
            'proof_path' => 'array',
        ];
    }

    // Relaciones
    public function contract(): BelongsTo
    {
        return $this->belongsTo(Contract::class);
    }

    public function verifier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    // Accessors
    public function getProofUrlAttribute()
    {
        if (!$this->proof_path) {
            return null;
        }
    
        return [
            'locador' => isset($this->proof_path['locador'])
                ? asset('storage/' . $this->proof_path['locador'])
                : null,
            'locatario' => isset($this->proof_path['locatario'])
                ? asset('storage/' . $this->proof_path['locatario'])
                : null,
        ];
    }
    //public function getProofUrlAttribute()
    //{
    //    return $this->proof_path ? asset('storage/' . $this->proof_path) : null;
    //}

    // Métodos de estado
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isVerified(): bool
    {
        return $this->status === 'verified';
    }

    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeVerified($query)
    {
        return $query->where('status', 'verified');
    }
}