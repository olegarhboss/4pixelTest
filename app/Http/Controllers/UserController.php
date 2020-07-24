<?php

namespace App\Http\Controllers;

use App\User;
//use Illuminate\Http\Request;
use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateUser;

class UserController// extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.index', ['users' => User::orderByDesc('id')->paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreUser  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {
        // Создание нового Пользователя
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        // Перенаправление на индексную страницу с уведомление об успешном добавлении
        return redirect()->route('users.index')->with('create-user', $user->name);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('user.form', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\UpdateUser  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request, User $user)
    {
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = !empty($request->password) ? bcrypt($request->password) : $user->password;
        $user->save();

        // Перенаправление на индексную страницу с уведомление об успешном добавлении
        return redirect()->route('users.index')->with('update-user', $user->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        // Перенаправление на индексную страницу с уведомление об успешном добавлении
        return redirect()->route('users.index')->with('delete-user', $user->name);
    }
}
