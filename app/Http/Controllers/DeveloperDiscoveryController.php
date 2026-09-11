<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class DeveloperDiscoveryController extends Controller
{
    public function index(Request $request)
    {
        $search = trim($request->input('search', ''));

        $profiles = Profile::with('user')
            ->whereHas('user', function ($query) {
                $query->where('role', 'user');
            })
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('username', 'like', "%{$search}%")
                        ->orWhere('headline', 'like', "%{$search}%")
                        ->orWhere('bio', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('developers.index', compact(
            'profiles',
            'search'
        ));
    }
}
