<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    function create()
    {
        return view('register.create');
    }
    function store(RegisterRequest $request)
    {
        //save user data in database
        $user = User::create($request->validated());

        //Store Avatar and link Avatar with database
        $file = $request->file('avatar');
        $path = Storage::disk('public')->putFileAs('avatars',$file, $user->id . '.' . $file->getClientOriginalExtension());
        $user->avatar = $path;
        $user->save();

        //user login
        Auth::login($user,true);

        return redirect()->route('home');
    }
}
