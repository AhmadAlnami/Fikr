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
        {{-- إذا كانت التغريدة رد (يعني id != base_tweet_id) --}}
        @if ($tweet->id != $tweet->base_tweet_id)
            {{-- عرض التغريدة الأصلية اللي يرد عليها --}}
            <x-tweet :tweet="$tweet->baseTweet" />

            {{-- عرض رد المستخدم --}}
            <div class="space-y-5 ms-5 border-s-2 ps-2">
                <x-tweet :tweet="$tweet" />
            </div>
            @else
            {{-- لو التغريدة أصلية (مو رد) نعرضها مباشرة --}}
            <x-tweet :tweet="$tweet" />
        @endif
        
        @endforeach
    </div>
</x-layouts.account>