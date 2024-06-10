<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solving extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function developed()
    {
        return $this->belongsTo(DevelopedList::class);
    }

    public function request()
    {
        return $this->belongsTo(Request::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public static function countSolvingDone()
    {
        return self::query()->count();
    }
}
