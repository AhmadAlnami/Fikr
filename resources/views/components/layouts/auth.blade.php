<!DOCTYPE html>
<html lang="ar" dir="rtl" data-theme="corporate">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فِكر</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="max-w-4xl mx-auto px-4 min-h-screen flex flex-col">
    <div class="my-auto card py-16 px-14 max-w-120 self-center">
        <div class="mb-20 flex justify-center">
            <a class="flex flex-row" href="{{ route('home') }}">
                <h1 class="font-bold text-5xl text-gray-700">فِكر</h1>
                <span class="icon-[tabler--brand-twitter] size-13 mx-3 mt-2 text-gray-700"></span>
            </a> 
        </div>

        <div>
            {{  $slot }}
        </div>
    </div>
</body>

</html>