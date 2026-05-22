<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'contract_id',
        'user_id',
        'document_type',

        // 👇 NUEVO
        'metadata',

        'original_filename',
        'storage_path',
        'public_url',
        'thumbnail_path',
        'file_size',
        'mime_type',
        'width',
        'height',
        'page_number',
        'order',
        'uploaded_from',
        'ip_address',
        'uploaded_at',
    ];

    protected function casts(): array
    {
        return [
            'uploaded_at' => 'datetime',

            // 👇 NUEVO
            'metadata' => 'array',
        ];
    }

    // RELACIONES

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // HELPERS

    /**
     * Obtener URL completa del archivo
     */
    public function getUrlAttribute()
    {
        return $this->public_url ?? asset('storage/' . $this->storage_path);
    }

    /**
     * Obtener URL del thumbnail
     */
    public function getThumbnailUrlAttribute()
    {
        return $this->thumbnail_path
            ? asset('storage/' . $this->thumbnail_path)
            : $this->url;
    }

    /**
     * Tamaño legible del archivo
     */
    public function getFileSizeHumanAttribute()
    {
        $bytes = $this->file_size;

        $units = ['B', 'KB', 'MB', 'GB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * Obtener metadata segura
     */
    public function getMeta(string $key, $default = null)
    {
        return data_get($this->metadata, $key, $default);
    }

    /**
     * Verificar si es imagen
     */
    public function isImage(): bool
    {
        return str_starts_with($this->mime_type, 'image/');
    }

    /**
     * Verificar si es PDF
     */
    public function isPdf(): bool
    {
        return $this->mime_type === 'application/pdf';
    }
}