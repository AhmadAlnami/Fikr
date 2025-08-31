<!DOCTYPE html>
<html lang="ar" dir="rtl" data-theme="corporate">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فِكر</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="max-w-4xl mx-auto px-4 min-h-screen flex flex-col">
    <div class="flex justify-center">
        @if(session('success') || session('error'))
            <div 
                id="toast-message" 
                class="fixed top-21 mx-auto z-10 px-4 py-3 rounded-lg shadow-lg text-white
                {{ session('success') ? 'bg-green-600' : 'bg-red-500' }}">
                {{ session('success') ?? session('error') }}
            </div>

            <script>
                setTimeout(() => {
                    let toast = document.getElementById('toast-message');
                    if (toast) {
                        toast.style.transition = "opacity 0.5s";
                        toast.style.opacity = "0";
                        setTimeout(() => toast.remove(), 500);
                    }
                }, 3000); // يختفي بعد 3 ثواني
            </script>
        @endif
    </div>
    <div class="mt-8 flex-1">
        {{ $slot }}
    </div>
</body>

</html>