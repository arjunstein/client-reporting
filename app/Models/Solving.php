<?php

namespace App\Models;

use App\Models\Client;
use App\Models\DevelopedList;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as HttpRequest;

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

    public static function getYearlyDevelopedData(): Collection
    {
        return self::select(
            'developed_id',
            DB::raw('count(*) as count')
        )
            ->whereYear('created_at', now()->year)
            ->groupBy('developed_id')
            ->get();
    }
}
