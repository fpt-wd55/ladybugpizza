<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateOpeningHoursRequest;
use App\Models\OpeningHour;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class OpeningHourController extends Controller
{
    public function index()
    {
        $openingHours = OpeningHour::all();
        $startPeriod = Carbon::parse('00:05');
        $endPeriod   = Carbon::parse('23:55');

        $period = CarbonPeriod::create($startPeriod, '5 minutes', $endPeriod);
        $hours  = [];

        foreach ($period as $date) {
            $hours[] = $date->format('H:i');
        }

        // format time $openingHours
        foreach ($openingHours as $openingHour) {
            $openingHour->open_time = $openingHour->open_time ? Carbon::parse($openingHour->open_time)->format('H:i') : null;
            $openingHour->close_time = $openingHour->close_time ? Carbon::parse($openingHour->close_time)->format('H:i') : null;
        }

        return view('admins.open-hours.index', compact('openingHours', 'hours'));
    }

    public function update(UpdateOpeningHoursRequest $request)
    {
        $data = $request->validated();
        foreach ($data['opening_hours'] as $dayOfWeek => $item) {
            $openingHour = OpeningHour::where('day_of_week', $dayOfWeek)->first();

            // format time
            $item['open_time'] = $item['open_time'] ? Carbon::parse($item['open_time'])->format('H:i:s') : null;
            $item['close_time'] = $item['close_time'] ? Carbon::parse($item['close_time'])->format('H:i:s') : null;

            if ($openingHour) {
                $openingHour->update([
                    'open_time' => $item['open_time'] ?? null,
                    'close_time' => $item['close_time'] ?? null,
                    'is_open' => isset($item['is_open']) ? 1 : 0,
                ]);
            }
        }

        return redirect()->route('admin.opening-hours.index')->with('success', 'Cập nhật giờ mở cửa thành công!');
    }
}
