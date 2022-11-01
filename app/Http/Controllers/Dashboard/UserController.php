<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::filter()
            ->search(request()->q)
            ->latest()
            ->paginate(10);

        return Inertia::render('Users/Index',[
            'users' => UserResource::collection($users),
            'status' => User::STATUS,
            'roles' => User::ROLES,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = User::ROLES;
        return Inertia::render('Users/Create',[
            'roles' => $roles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();

        if($request->hasFile('avatar')) {
            $data['avatar'] = Storage::disk('custome')->put('images/avatars',$request->file('avatar'));
        }

        User::create($data);

        return redirect(route('users.index'))
            ->with('message', config('app.alert_messages.success'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user->load(['posts' => fn($q) => $q->latest()->take(10)]);

        $roles = User::ROLES;

        return Inertia::render('Users/Edit',[
            'user' => UserResource::make($user),
            'roles' => $roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();

        /* if (is_null($data['password'])) {
            unset($data['password']);
        } */

        $data['is_blocked']  = $request->is_blocked == 'on';

        if($request->hasFile('avatar')) {
            $data['avatar'] = Storage::disk('custome')->put('images/avatars',$request->file('avatar'));
        }

        $user->update($data);

        return redirect(route('users.index'))
            ->with('message', config('app.alert_messages.success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect(route('users.index'))
            ->with('message', config('app.alert_messages.success'));
    }
}
