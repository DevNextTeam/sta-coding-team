<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Subscription;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::where('role', 'user')->count();

        $totalDevelopers = User::where('role', 'developer')->count();

        $totalAdmins = User::where('role', 'admin')->count();

        $totalProjects = Project::count();

        $activeSubscriptions = Subscription::where('status', 'active')
            ->where('ends_at', '>', now())
            ->count();

        $premiumProjects = Project::where('is_premium', true)
            ->count();

        $freeProjects = Project::where('is_premium', false)
            ->count();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalDevelopers',
            'totalAdmins',
            'totalProjects',
            'activeSubscriptions',
            'premiumProjects',
            'freeProjects'
        ));
    }
}