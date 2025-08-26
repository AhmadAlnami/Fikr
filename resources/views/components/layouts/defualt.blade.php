<!DOCTYPE html>
<html lang="ar" dir="rtl" data-theme="corporate">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فِكر</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="max-w-4xl mx-auto px-4 min-h-screen flex flex-col">
    <nav class="navbar bg-base-100 rounded-box shadow-base-300/20 shadow-sm sticky top-4 z-50 border-b-2">
        <div class="flex flex-1 items-center">
            <a class="link text-base-content link-neutral text-xl font-bold no-underline" href="{{route('home')}}">
                فِكر
            </a>
        </div>
        <div class="navbar-end flex items-center gap-4">
            <div class="dropdown-menu dropdown-open:opacity-100 hidden" role="menu" aria-orientation="vertical"
                aria-labelledby="dropdown-scrollable">
                <div class="dropdown-header justify-center">
                    <h6 class="text-base-content text-base">Notifications</h6>
                </div>
                <div class="overflow-auto text-base-content/80 max-h-56 max-md:max-w-60">
                    <div class="dropdown-item">
                        <div class="avatar avatar-away-bottom">
                            <div class="w-10 rounded-full">
                                <img src="https://cdn.flyonui.com/fy-assets/avatar/avatar-1.png" alt="avatar 1" />
                            </div>
                        </div>
                        <div class="w-60">
                            <h6 class="truncate text-base">Charles Franklin</h6>
                            <small class="text-base-content/50 truncate">Accepted your connection</small>
                        </div>
                    </div>
                    <div class="dropdown-item">
                        <div class="avatar">
                            <div class="w-10 rounded-full">
                                <img src="https://cdn.flyonui.com/fy-assets/avatar/avatar-2.png" alt="avatar 2" />
                            </div>
                        </div>
                        <div class="w-60">
                            <h6 class="truncate text-base">Martian added moved Charts & Maps task to the done board.
                            </h6>
                            <small class="text-base-content/50 truncate">Today 10:00 AM</small>
                        </div>
                    </div>
                    <div class="dropdown-item">
                        <div class="avatar avatar-online-bottom">
                            <div class="w-10 rounded-full">
                                <img src="https://cdn.flyonui.com/fy-assets/avatar/avatar-8.png" alt="avatar 8" />
                            </div>
                        </div>
                        <div class="w-60">
                            <h6 class="truncate text-base">New Message</h6>
                            <small class="text-base-content/50 truncate">You have new message from Natalie</small>
                        </div>
                    </div>
                    <div class="dropdown-item">
                        <div class="avatar avatar-placeholder">
                            <div class="bg-neutral text-neutral-content w-10 rounded-full p-2">
                                <span class="icon-[tabler--user] size-full"></span>
                            </div>
                        </div>
                        <div class="w-60">
                            <h6 class="truncate text-base">Application has been approved 🚀</h6>
                            <small class="text-base-content/50 text-wrap">Your ABC project application has been
                                approved.</small>
                        </div>
                    </div>
                    <div class="dropdown-item">
                        <div class="avatar">
                            <div class="w-10 rounded-full">
                                <img src="https://cdn.flyonui.com/fy-assets/avatar/avatar-10.png" alt="avatar 10" />
                            </div>
                        </div>
                        <div class="w-60">
                            <h6 class="truncate text-base">New message from Jane</h6>
                            <small class="text-base-content/50 text-wrap">Your have new message from Jane</small>
                        </div>
                    </div>
                    <div class="dropdown-item">
                        <div class="avatar">
                            <div class="w-10 rounded-full">
                                <img src="https://cdn.flyonui.com/fy-assets/avatar/avatar-3.png" alt="avatar 3" />
                            </div>
                        </div>
                        <div class="w-60">
                            <h6 class="truncate text-base">Barry Commented on App review task.</h6>
                            <small class="text-base-content/50 truncate">Today 8:32 AM</small>
                        </div>
                    </div>
                </div>
                <a href="#" class="dropdown-footer justify-center gap-1">
                    <span class="icon-[tabler--eye] size-4"></span>
                    View all
                </a>
            </div>
        </div>
        @if (Auth::check())
            <div class="dropdown relative inline-flex [--auto-close:inside] [--offset:8] [--placement:bottom-end]">
                <button id="dropdown-scrollable" type="button" class="dropdown-toggle flex items-center"
                    aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                    <div class="avatar">
                        <div class="size-9.5 rounded-full">
                            <img src="/storage/{{ Auth::user()->avatar }}"
                                alt="avatar 1" />
                        </div>
                    </div>
                </button>
                <ul class="dropdown-menu dropdown-open:opacity-100 hidden min-w-60" role="menu" aria-orientation="vertical"
                    aria-labelledby="dropdown-avatar">
                    <li>
                        <a class="dropdown-item" href="{{ route('account',Auth::user()->id) }}">
                            <span class="icon-[tabler--user]"></span>
                            حسابي الشخصي
                        </a>
                    </li>
                    <li class="dropdown-footer gap-2">
                        <form method="post" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <button type="submit" class="btn btn-error btn-soft btn-block">
                                <span class="icon-[tabler--logout]"></span>
                                تسجيل خروج
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        @else
            <a href="{{ route('login') }}">
                <button class="btn btn-text btn-square">
                    <span class="icon-[tabler--login] size-5.5"></span>
                </button>
            </a>

        @endif

        </div>
    </nav>
    <div class="mt-8 flex-1">
        {{ $slot }}
    </div>

    <form method="post" action="{{ route('tweet.create') }}"
        class="border border-base-300 border-t-2 border-t-primary rounded-field sticky bottom-2 drop-shadow-2xl bg-base-100 mt-5">
        @csrf
        <input type="hidden" name="parent_tweet_id" value="{{ request()->tweet?->id }}">
        <div class="textarea-floating">
            <textarea class="textarea border-0 resize-none" placeholder="ماذا يحدث؟" id="content" name="content"></textarea>
            <label class="textarea-floating-label" for="content">اكتب تغريدة</label>
        </div>
        <div class="px-2 text-error helper-text">
            @error('content')
                {{ $message }}
            @enderror
        </div>
        <div class="p-2">
            <button type="submit" class="btn btn-soft btn-primary">تغريد</button>
        </div>
</form>
</body>

</html>