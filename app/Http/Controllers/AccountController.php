<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller
{
    function view(User $account)
    {
        $tweets = $account->tweets()->orderByDesc('created_at')->get();
        return view('account.view',compact('account','tweets'));
    }
    function edit(User $account)
    {
        return view('account.edit',compact('account'));
    }
    function update(AccountUpdateRequest $request)
    {
        $data = $request->validated();
        $user = Auth::user();

        // لو فيه صورة مرفوعة
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');

            // نخزن الصورة باسم user_id.extension
            $path = Storage::disk('public')->putFileAs(
                'avatars',
                $file,
                $user->id . '.' . $file->getClientOriginalExtension()
            );

            $data['avatar'] = $path;
        } else {
            unset($data['avatar']);
        }

        $user->update($data);

        return redirect()->route('account',$user->id);
        
    }
}
