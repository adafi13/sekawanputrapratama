<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class AboutController extends Controller
{
    public function index(): View
    {
        $teamMembers = Cache::remember('about_team_members', now()->addMinutes(30), function () {
            return TeamMember::with('media')
                ->where('is_active', true)
                ->orderBy('order')
                ->get();
        });

        return view('frontend.about', compact('teamMembers'));
    }
}

