@props([
    'tweet',    
    ])

<div class="card">
    <div class="card-body p-4">
        <p class="mb-4 px-3">{{ $tweet->content }}</p>
        <div class="card-actions flex justify-between">
            @if (request()->routeIs('home') || request()->routeIs('account'))
                <button 
                @if ($tweet->id == request()->tweet?->id)
                    disabled
                @endif
                onclick="window.location='{{ route('view.tweet',$tweet->baseTweet->id) }}'" class="btn btn-text btn-square">
                    <span class="icon-[tabler--message] size-5.5"></span>
                </button>
            @else
                <button 
                onclick="document.querySelector(`input[name='parent_tweet_id']`).value = {{ $tweet->id }}" class="btn btn-text btn-square">
                    <span class="icon-[tabler--message] size-5.5"></span>
                </button>
            @endif
            
            <button onclick="window.location='{{ route('account', $tweet->user_id) }}'" class="btn btn-text">
                <div class="avatar items-center">
                    <a class="mx-3">{{ $tweet->user->name }}</a>
                    <div class="size-8 rounded-full">
                        <img src="/storage/{{ $tweet->user->avatar }}" alt="avatar" />
                    </div>
                </div>
            </button>
        </div>
    </div>
</div>

@if (request()->routeIs('view.tweet'))
    <div class="space-y-5 ms-5 border-s-2 ps-2">
        @foreach ($tweet->childTweets as $childTweet)
                <x-tweet :tweet="$childTweet"/>
        @endforeach
    </div>
@endif