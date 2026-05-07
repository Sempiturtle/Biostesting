<?php

namespace App\Services;

use App\Models\User;
use App\Models\Schedule;
use App\Models\Attendance;
use Carbon\Carbon;

class ReliefService
{
    /**
     * Get professors who are scheduled to be in class right now but haven't scanned in.
     */
    public function getAbsentProfessors()
    {
        $now = Carbon::now();
        $day = $now->format('l');
        $time = $now->format('H:i:s');

        // 1. Find all schedules active right now
        $activeSchedules = Schedule::where('day', $day)
            ->where('start_time', '<=', $time)
            ->where('end_time', '>=', $time)
            ->with('user')
            ->get();

        $absent = [];

        foreach ($activeSchedules as $schedule) {
            // 2. Check if the user has a "time_in" for today that covers this schedule
            $hasScanned = Attendance::where('user_id', $schedule->user_id)
                ->whereDate('scanned_at', $now->toDateString())
                ->where('type', 'time_in')
                ->exists();

            if (!$hasScanned) {
                $absent[] = [
                    'user' => $schedule->user,
                    'schedule' => $schedule
                ];
            }
        }

        return $absent;
    }

    /**
     * Get professors who have NO scheduled classes during the current time block.
     */
    public function getAvailableSubstitutes()
    {
        $now = Carbon::now();
        $day = $now->format('l');
        $time = $now->format('H:i:s');

        // Find users who are NOT scheduled right now
        return User::where('role', 'user')
            ->whereDoesntHave('schedules', function ($query) use ($day, $time) {
                $query->where('day', $day)
                    ->where('start_time', '<=', $time)
                    ->where('end_time', '>=', $time);
            })
            ->get();
    }
}
