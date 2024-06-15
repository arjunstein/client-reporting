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

    public static function getNewClient()
    {
        return self::where('is_client_new', true)->get();
    }

    public static function clientsWithPendingRequests()
    {
        $requestsNotDone = Request::where('status', '!=', 'Done')->pluck('client_id');
        return self::whereIn('id', $requestsNotDone)->pluck('client_name', 'id');
    }
}
