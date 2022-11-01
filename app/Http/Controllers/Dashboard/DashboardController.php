<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Carbon\Carbon;
use CyrildeWit\EloquentViewable\Support\Period;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $traffic = $this->getLastSevenDaysView();

        $posts_count = Post::count();

        $authors_count = User::where('user_type', User::ROLE_AUTHOR)->count();
        $users_count = User::where('user_type', User::ROLE_USER)->count();
        $admins_count = User::where('user_type', User::ROLE_ADMIN)->count();

        $latest_posts = Post::withCount('views')
            ->with('user:id,name')
            ->latest()
            ->limit(7)
            ->get();

        $active_authors = User::withCount('posts')
            ->orderByDesc('posts_count')
            ->latest()
            ->limit(8)
            ->get();

        return Inertia::render('Index', [
            'traffic' => $traffic,
            'latestPosts' => PostResource::collection($latest_posts),
            'activeAuthors' => UserResource::collection($active_authors),
            'postsCount' => $posts_count,
            'authorsCount' => $authors_count,
            'usersCount' => $users_count,
            'adminsCount' => $admins_count,
        ]);
    }

    public function getLastSevenDaysView()
    {
        $periods = [];
        for ($i = 0; $i < 7; $i++) {
            $periods[Carbon::today()->subDays($i)->format('l')] =  views(Post::class)
                ->period(Period::create(Carbon::today()->subDays($i), Carbon::today()->subDays($i - 1)))
                ->count();
        }
        return $periods;
    }
}
