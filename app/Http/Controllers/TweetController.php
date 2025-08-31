<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTweetRequest;
use App\Models\Tweet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TweetController extends Controller
{
    function index() 
    {
        $tweets = Tweet::query()->where('parent_tweet_id',null)->orderByDesc('created_at')->limit(20)->get();
        return view('index',compact('tweets'));
    }
    function view(Tweet $tweet)
    {
        return view('tweet.view', compact('tweet'));
    }
    function store(StoreTweetRequest $request)
    {
        $tweet = Auth::user()->tweets()->create($request->validated());
        if ($tweet->parentTweet()->exists()) {
             $tweet->baseTweet()->associate($tweet->parentTweet->baseTweet->id)->save();
        }else {
            $tweet->baseTweet()->associate($tweet)->save();
        }
        return redirect()->back();
    }
    
    public function like(Tweet $tweet)
    {
        if (!auth()->check()) {
            return redirect()->back()->with('error', 'يجب تسجيل الدخول لتستطيع الإعجاب بالتغريدة');
        }

        $user = auth()->user();

        if ($tweet->likes()->where('user_id', $user->id)->exists()) {
            // إذا مسوي لايك قبل نحذفه (يعني "إلغاء لايك")
            $tweet->likes()->where('user_id', $user->id)->delete();

            return back()->with('success', 'تم إلغاء الإعجاب');
        } else {
            // إذا أول مرة يسوي لايك
            $tweet->likes()->create([
                'user_id' => $user->id,
            ]);

            return back()->with('success', 'تم تسجيل إعجابك بالتغريدة');
        }

    }
    public function delete(Tweet $tweet)
    {
        // السماح فقط لصاحب التغريدة أو الأدمن يحذفها
        if ($tweet->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'لا يمكن حذف التغريدة');
        }

        $tweet->delete();

        // إذا المستخدم داخل صفحة التغريدة نفسها
        if (url()->previous() === route('view.tweet', $tweet->id)) {
            return redirect()->route('home')->with('success', 'تم حذف التغريدة بنجاح');
        }

        // إذا جاي من أي مكان ثاني
        return redirect()->back()->with('success', 'تم حذف التغريدة بنجاح');
    }


}
