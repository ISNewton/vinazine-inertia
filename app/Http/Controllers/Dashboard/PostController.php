<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class PostController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::filter()
        ->when(auth()->user()->user_type !== User::ROLE_ADMIN, fn ($query) => $query->where('user_id', auth()->id()))
            ->with('user:id,name')
            ->withoutGlobalScopes()
            ->search(request()->q)
            ->latest()
            ->paginate(20);

        $categories = Category::pluck('name', 'id');

        $status = Post::STATUS;

        return Inertia::render('Posts/Index',[
            'posts' => PostResource::collection($posts),
            'categories' => $categories,
            'status' => $status,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id');

        $status = Post::STATUS;

        return Inertia::render('Posts/Create',[
            'categories' => $categories,
            'status' => $status,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        // dd($request->validated());
        $data = $request->validated();

        $data['user_id'] = Auth::id();

        if($request->hasFile('thumbnail')) {
            $data['thumbnail'] = Storage::disk('custome')->put('images/thumbnails',$request->thumbnail);
        }

        Post::create($data);

        return redirect(route('posts.index'))
            ->with('message', config('app.alert_messages.success'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $post = Post::where('slug', $slug)->withoutGlobalScopes()->first();

        $this->authorize($post, 'update');

        $categories = Category::pluck('name', 'id');

        $status = Post::STATUS;

        return Inertia::render('Posts/Edit',[
            'post' => PostResource::make($post),
            'categories' => $categories,
            'status' => $status,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, $slug)
    {
        $post = Post::where('slug', $slug)->withoutGlobalScopes()->first();

        $this->authorize($post, 'update');

        $data = $request->validated();

        if($request->hasFile('thumbnail')) {
            $data['thumbnail'] = Storage::disk('custome')->put('images/thumbnails',$request->thumbnail);
        } else {
            unset($data['thumbnail']);
        }
        
        $post->update($data);

        return redirect(route('posts.index'))
            ->with('message', config('app.alert_messages.success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $post = Post::where('slug', $slug)->withoutGlobalScopes()->first();

        $this->authorize('delete', $post);

        Storage::disk('custome')->delete($post->thumbnail);

        $post->delete();

        return redirect(route('posts.index'))
            ->with('message', config('app.alert_messages.success'));
    }
}
