<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpeningHour extends Model
{
    use HasFactory;

    protected $fillable = [
        'day_of_week',
        'name',
        'open_time',
        'close_time',
        'is_open',
    ];

    public static function isOpen()
    {
        $currentDay = strtolower(Carbon::now()->englishDayOfWeek);
        $currentTime = Carbon::now()->format('H:i:s');
        $openingHour = OpeningHour::where('day_of_week', $currentDay)->first();

        if (!$openingHour) {
            return false;
        }

        if (!$openingHour->is_open) {
            return false;
        }

        if ($currentTime >= $openingHour->open_time && $currentTime <= $openingHour->close_time) {
            return true;
        }
    }
}
