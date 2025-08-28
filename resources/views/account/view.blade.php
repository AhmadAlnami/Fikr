<x-layouts.account>
    <div class="space-y-4">
        <div>
            <div class="card max-w-full max-h-100">
                <div class="flex justify-between">
                    <div class="avatar">
                        <div class="size-16 rounded-full m-7 mb-0">
                            <img src="/storage/{{ $account->avatar }}" alt="avatar" />
                        </div>
                    </div>
                    <div class="m-6">
                        <button onclick="window.location='{{ route('home') }}'" >
                            <span class="btn btn-square icon-[tabler--arrow-left] size-8"></span>
                        </button>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="flex justify-between">
                        <h5 class="card-title">{{ $account->name }}</h5>
                        @if (Auth::user()?->id === $account->id)
                            <div class="card-actions">
                                <button onclick="window.location='{{ route('account.edit',Auth::user()->id) }}'" class="btn btn-text">تعديل الحساب</button>
                            </div>
                        @endif
                    </div>
                    <span class="break-words whitespace-pre-line">
                        {{ $account->bio }}
                    </span>
                </div>
            </div>
        </div>
        @foreach ($tweets as $tweet)
        <!-- لو كانت رد على تغريدة نعرض اسم الشخص اللي راد عليه-->
        @if ($tweet->parent_tweet_id != null)
            <div>
                <div class="card drop-shadow-xl mx-1.5 mb-0.5">
                    <a href="{{ route('view.tweet',$tweet->parent_tweet_id)}}" class="mx-3">رد على {{ $tweet->parentTweet->user->name }}</a>
                </div>
                <x-tweet :tweet="$tweet" />
            </div>
            @else
            {{-- لو التغريدة أصلية (مو رد) نعرضها مباشرة --}}
            <x-tweet :tweet="$tweet" />
        @endif
        
        @endforeach
    </div>
</x-layouts.account>