<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormProgress extends Model
{
    use HasFactory;

    protected $table = 'form_progress';

    protected $fillable = [
        'contract_id',
        'session_token',
        'current_step',
        'completed_steps',
        'form_data',
        'ip_address',
        'user_agent',
        'last_activity_at',
        'expires_at',
    ];

    protected function casts(): array
    {
        return [
            'completed_steps' => 'array',
            'form_data' => 'array',
            'last_activity_at' => 'datetime',
            'expires_at' => 'datetime',
        ];
    }

    // RELACIONES

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    // HELPERS

    public function isExpired()
    {
        return $this->expires_at && $this->expires_at->isPast();
    }

    public function markStepCompleted($step)
    {
        $completed = $this->completed_steps ?? [];
        if (!in_array($step, $completed)) {
            $completed[] = $step;
            $this->completed_steps = $completed;
            $this->save();
        }
    }
}