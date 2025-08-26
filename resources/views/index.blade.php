<x-layouts.defualt>
    <div class="space-y-5">
        @foreach ($tweets as $tweet)
            <x-tweet :tweet="$tweet"/>
        @endforeach
    </div>

</x-layouts.defualt>