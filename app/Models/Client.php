<?php

namespace App\Models;

use App\Models\Interfacing;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Client extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function interfacing(): BelongsTo
    {
        return $this->belongsTo(Interfacing::class);
    }

    public static function countClient()
    {
        return self::query()->count();
    }

    public function scopeNewclient($query)
    {
        return $query->whereHas('interfacing', function ($query) {
            $query->where('is_client_new', true);
        });
    }
}
