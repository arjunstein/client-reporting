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
        return self::query();
    }

    public static function getAllDevelopedData($start, $end): Collection
    {
        return self::select(
            'developed_id',
            DB::raw('count(*) as count')
        )
            ->whereBetween('created_at', [$start, $end])
            ->groupBy('developed_id')
            ->get();
    }

    public function updateStatus()
    {
        $request = Request::find($this->request_id);
        if ($request) {
            $request->status = "Done";
            $request->save();
        }
    }

    protected static function boot()
    {
        parent::boot();

        static::saved(function ($solving) {
            $request = Request::find($solving->request_id);
            if ($request) {
                $request->finish_date = $solving->created_at;
                $request->save();
            }
        });
    }
}
