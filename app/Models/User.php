<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'dni_number',
        'address',
        'occupation',
        'is_admin',
        'can_login',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
            'can_login' => 'boolean',
        ];
    }

    // RELACIONES
    
    /**
     * Contratos en los que participa este usuario
     */
    public function contracts()
    {
        return $this->belongsToMany(Contract::class, 'contract_user')
                    ->withPivot('role_in_contract', 'order', 'signed_at')
                    ->withTimestamps();
    }

    /**
     * Contratos donde es inquilino
     */
    public function contractsAsInquilino()
    {
        return $this->contracts()
                    ->wherePivot('role_in_contract', 'inquilino');
    }

    /**
     * Contratos donde es propietario
     */
    public function contractsAsPropietario()
    {
        return $this->contracts()
                    ->wherePivot('role_in_contract', 'propietario');
    }

    /**
     * Contratos donde es garante
     */
    public function contractsAsGarante()
    {
        return $this->contracts()
                    ->wherePivotIn('role_in_contract', ['garante_1', 'garante_2']);
    }

    /**
     * Documentos de este usuario
     */
    public function documents()
    {
        return $this->hasMany(ContractDocument::class);
    }

    /**
     * Logs de actividad
     */
    public function activityLogs()
    {
        return $this->hasMany(ActivityLog::class);
    }
}