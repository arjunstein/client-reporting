<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function solving()
    {
        return $this->hasMany(Solving::class);
    }

    public static function countRequestNotDone()
    {
        return self::query()->where('status', 'Done')->count();
    }

    public static function notDoneRequests()
    {
        return self::where('status', '!=', 'Done')->pluck('issue', 'id');
    }
}
