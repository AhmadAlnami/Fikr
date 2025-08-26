<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    protected $fillable = [
        'content',
        'parent_tweet_id'
    ];
    protected $hidden = [
        'updated_at'
    ] ;

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    // التغريدة اللي قاعد ارد عليها
    public function parentTweet()
    {
        return $this->belongsTo(Tweet::class, 'parent_tweet_id');
    }

    // التغريدات اللي ردت عليا مباشرة
    public function childTweets()
    {
        return $this->hasMany(Tweet::class, 'parent_tweet_id');
    }

    // التغريدة الاساسية اللي بدات كل شي
    public function baseTweet()
    {
        return $this->belongsTo(Tweet::class, 'base_tweet_id');
    }

    // كل الردود تحت تغريدتي حتى اللي مو رد مباشر
    public function descendantTweets()
    {
        return $this->hasMany(Tweet::class, 'base_tweet_id');
    }

}
