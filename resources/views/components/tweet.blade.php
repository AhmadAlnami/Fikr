@props([
    'tweet',    
    ])

<div class="card drop-shadow-md relative">
    <div class="card-body p-4">

        {{-- العنوان: صورة + اسم + وقت + زر حذف --}}
        <div class="flex items-center justify-between mb-2">
            <div class="flex items-center gap-2">
                <div class="avatar">
                    <div class="size-9.5 rounded-full">
                        <img src="/storage/{{ $tweet->user->avatar }}" alt="avatar" />
                    </div>
                </div>
                <a href="{{ route('account', $tweet->user_id) }}" class="font-medium text-primary">
                    {{ $tweet->user->name }}
                </a>
                <span class="text-xs text-gray-500">
                    {{ $tweet->created_at->diffForHumans() }}
                </span>
            </div>

            {{-- قائمة جانبية --}}
            <div class="dropdown relative inline-flex [--auto-close:inside] [--offset:8] [--placement:bottom-end]">
                <button id="dropdown-scrollable" type="button" class="dropdown-toggle flex items-center" aria-haspopup="menu" aria-label="Dropdown">
                    <span class="icon-[tabler--dots] size-4.5"></span>
                </button>
                <ul class="dropdown-menu dropdown-open:opacity-100 hidden min-w-40" role="menu" aria-orientation="vertical" aria-labelledby="dropdown-menu">
                    <li>
                        <button onclick="window.location='{{ route('account',$tweet->user_id) }}'" class="btn btn-text">
                            <span class="icon-[tabler--user]"></span>
                            <p>{{ $tweet->user->name }}</p>
                        </button>
                    </li>
                    <li>
                        @if (auth()->id() === $tweet->user_id)
                            <form method="post" action="{{ route('tweet.delete', $tweet->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-text text-red-500">
                                    <span class="icon-[tabler--trash]"></span>
                                    <p>حذف المنشور</p>
                                </button>
                            </form>
                        @endif
                    </li>
                </ul>
            </div>
        </div>

        {{-- نص التغريدة --}}
        <p class="mb-4 px-3">{{ $tweet->content }}</p>

        {{-- أزرار التفاعل (رد، ..) --}}
        <div class="card-actions flex justify-between">
            @if (request()->routeIs('home') || request()->routeIs('account'))
                <button
                    @if ($tweet->id == request()->tweet?->id) disabled @endif
                    onclick="window.location='{{ route('view.tweet',$tweet->base_tweet_id ?? $tweet->id) }}'"
                    class="btn btn-text btn-square">
                    <span class="icon-[tabler--message-circle] size-4.5"></span>
                </button>
            @else
                <button 
                    onclick="document.querySelector(`input[name='parent_tweet_id']`).value = {{ $tweet->id }}"
                    class="btn btn-text btn-square">
                    <span class="icon-[tabler--message-circle] size-4.5"></span>
                </button>
            @endif
            <div class="flex flex-row">
                <form action="{{ route('tweets.like', $tweet->id) }}" method="POST">
                @csrf
                    <button
                     type="submit" class="btn btn-text btn-secondary">
                        <span class="ml-1 text-xs">{{ $tweet->likes->count() }}</span>
                        @if($tweet->likes->contains('user_id', auth()->id()))
                            <span class="icon-[tabler--heart-filled] size-4.5 text-red-500"></span>
                        @else
                            <span class="icon-[tabler--heart] size-4.5"></span>
                        @endif
                    </button>
                </form>
                <button
                onclick="copyTweetLink('{{ route('view.tweet', $tweet->id) }}')" 
                 class="btn btn-text btn-square btn-secondary">
                    <span class="icon-[tabler--share-3] size-4.5 shrink-0"></span>
                </button>
            </div>
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

<script>
function copyTweetLink(url) {
    navigator.clipboard.writeText(url).then(() => {
        alert("تم نسخ رابط التغريدة ✅");
    }).catch(err => {
        console.error("فشل النسخ: ", err);
    });
}
</script>
