<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function __invoke()
    {
        $me = auth()->user();
        $mailsSent      = $me->messages()->count();
        $mailsReceived  = $me->recipients()->count();

        $userCount = $me->organization->allUsers()->count();

        $mediaItems = $me->getMedia($me->organization->getRoot()->name_short);
        $totalSize = $mediaItems->map(function ($item){return $item->size;})->sum();
        $memoryUsage = humanFileSize($totalSize);

        // $thisWeek = $me->messages()->get()->filter(function($value, $key){
        //     $startOfWeek = Carbon::now()->startOfWeek();
        //     $endOfWeek = Carbon::now()->endOfWeek();
        //     return $startOfWeek <= $value->created_at && $value->created_at <= $endOfWeek;
        // });

        // $lastWeek = $me->messages()->get()->filter(function($value, $key){
        //     $startOfLastWeek  = Carbon::now()->subDays(7)->startOfWeek();
        //     $endOfLastWeek  = Carbon::now()->subDays(7)->endOfWeek();
        //     return  $startOfLastWeek <= $value->created_at && $value->created_at <= $endOfLastWeek;
        // });
        // $thisWeekAvg = 0;
        // $lastWeekAvg = $lastWeek->count() / 7;

        // $daysSinceLastMonday = Carbon::now()->startOfWeek()->diffInDays(Carbon::now());
        // if($daysSinceLastMonday != 0)
        // {
        //   $thisWeekAvg = $thisWeek->count() / $daysSinceLastMonday;
        // }

        // $weeklyUsage = number_format($thisWeekAvg,2);
        // $isPercentage = false;
        // if($lastWeekAvg != 0)
        // {
        //     $weeklyUsage = number_format(($thisWeekAvg - $lastWeekAvg)/$lastWeekAvg * 100 ,2);
        //     $isPercentage = true;
        // }
        return view('dashboard', [
            'mailsSent'=>$mailsSent,
            'mailsReceived'=>$mailsReceived,
            // 'weeklyUsage'=>$weeklyUsage,
            'userCount'=>$userCount,
            'memoryUsage'=>$memoryUsage,
            // 'isPercentage'=>$isPercentage
        ]);
    }


}

