<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\BlockUserRequest;
use App\Http\Requests\Admin\User\EmailVerifiedUserRequest;
use App\Http\Requests\Admin\User\StoreUserRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\Http\Resources\Admin\User\EditUserResource;
use App\Http\Resources\Admin\User\UserResource;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Inertia\Inertia;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $users  = UserResource::collection( User::whereNot('is_admin', '1')->orderBy('id', 'desc')->paginate(20));
        return Inertia::render('Admin/User/Index', [
            'title' => 'Користувачі',
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/User/Create', ['title' => 'Додати користувача']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'email_verified_at' => now()
        ]);
        return redirect(route('users.index'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {

        return Inertia::render('Admin/User/Edit', [
            'title' => "Редагувати користувача {$user->name}",
            'user' => new EditUserResource($user)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->all();
        $user->update(Arr::except($data, ['password']));

        return to_route('users.index');
    }

    public function change_email_verified(EmailVerifiedUserRequest $request, User $user)
    {

        if($request->email_verified_at) {
            $user->email_verified_at = now();
            $user->save();
        }

        return to_route('users.index');

    }

    public function change_block(BlockUserRequest $request, User $user)
    {
        $user->blocked_until = $request->blocked_until
            ? Carbon::parse($request->blocked_until)->timezone('Europe/Kyiv')->format('Y-m-d H:i:s')
            : null;
        $user->save();

        return to_route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return to_route('users.index');
    }

    public function search(Request $request)
    {
        $search = trim($request->search);

       $users  = UserResource::collection( User::search($search)->where('is_admin', '!=' ,'1')->orderBy('id', 'desc')->paginate(20));
        return Inertia::render('Admin/User/Index', [
            'title' => "Пошук за '$search'" ,
            'users' => $users,
        ]);

    }
}
