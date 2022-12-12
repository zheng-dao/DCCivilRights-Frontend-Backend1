<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Landmark;
use Illuminate\Http\Request;

class AdminDashboard extends Controller
{
    public function getDashboard(){
        // $count['userCount'] = User::role('CLIENT')->count();
        // $count['activeUserCount'] = User::role('CLIENT')->whereActive(1)->count();
        // $count['blockedUserCount'] = User::role('CLIENT')->whereActive(0)->count();
        // $user = User::role('CLIENT')->latest()->limit(5)->get();
        $count['totalLandmark'] = Landmark::get()->count();
        $count['activeLandmark'] = Landmark::where('is_active',1)->count();
        $count['blockLandmark'] = Landmark::where('is_active',0)->count();
        $landmark = Landmark::latest()->limit(5)->get();
        return view('admin.dashboard',compact('count','landmark'));
    }
    public function userCreateShow(){
        return view('admin.user-create');
    }
}
