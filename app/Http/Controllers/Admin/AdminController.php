<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserActivity;

class AdminController extends Controller
{
    public function index()
    {
        $activity = UserActivity::with(['user.organization'])
            ->where('activity','login')
            ->latest()
            ->limit(10)
            ->get();
        return view('admin.index',compact('activity'));
    }
}
