<x-layouts.auth>
    <form method="post" class="space-y-3">
        @csrf
        <div>
            <x-input id="email" title="البريد الإلكتروني" type="email" icon="icon-[tabler--mail]" placeholder="eg.example@gmail.com" />
        </div>
        <div>
            <x-input id="password" minLength="8" title="كلمة المرور" type="password" icon="icon-[tabler--lock-password]" placeholder="********" eye="true"/>
        </div>
        <button type="submit" class="flex btn btn-primary w-86 mt-8">تسجيل دخول</button>
        <span>
            ما عندك حساب؟
            <a href="{{route('register')}}" class="link link-animated">سجل حساب</a>
        </span>
</form>
</x-layouts.auth>