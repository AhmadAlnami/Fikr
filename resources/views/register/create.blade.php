<x-layouts.auth>
    <form method="post" enctype="multipart/form-data" class="space-y-3">
        @csrf
        <div class="max-w-sm input-floating">
            <input type="file" required accept="image/*" class="input" id="avatar" name="avatar"/>
            <label class="input-floating-label" for="avatar">صورة المستخدم</label>
            @error('avatar')
                <div class="text-error helper-text ps-3 mb-2">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div>
            <x-input id="name" minLength="3" title="اسم المستخدم" icon="icon-[tabler--user]"/>
        </div>
        <div>
            <x-input id="email" title="البريد الإلكتروني" type="email" icon="icon-[tabler--mail]" placeholder="eg.example@gmail.com" />
        </div>
        <div>
            <x-input id="password" minLength="8" title="كلمة المرور" type="password" icon="icon-[tabler--lock-password]" placeholder="********"/>
        </div>
        <div>
            <x-input id="password_confirmation" minLength="8" title="تأكيد كلمة المرور" type="password" icon="icon-[tabler--lock-check]" placeholder="********"/>
        </div>
        <button type="submit" class="flex btn btn-primary w-86 mt-8">تسجيل حساب</button>
        <span>
            عندك حساب؟
            <a href="{{ route('login') }}" class="link link-animated">سجل دخول</a>
        </span>
</form>
</x-layouts.auth>