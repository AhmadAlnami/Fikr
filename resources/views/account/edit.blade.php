<x-layouts.account>
<div class="min-h-screen flex items-center justify-center">
    <div class="max-w-md mx-auto bg-white text-black p-6 rounded-2xl shadow-lg">
        <h2 class="text-xl font-bold mb-4">تعديل الحساب</h2>
        
        <form action="{{ route('account.update',Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="flex items-center space-x-4 mb-4">
                <img src="/storage/{{ Auth::user()->avatar ?? '/default-avatar.png' }}" 
                    class="w-16 h-16 rounded-full border border-gray-700" alt="avatar">
                <input type="file" accept="image/*" name="avatar" class="text-sm text-gray-300">
            </div>

            <div class="flex flex-col mb-4">
                <div class="input w-96">
                    <span class="icon-[tabler--user] text-base-content/80 my-auto size-5 shrink-0"></span>
                    <div class="input-floating grow">
                        <input required type="text" placeholder="" minlength="3" maxlength="255" class="ps-3 " name="name" value="{{ old('name', Auth::user()->name) }}"/>
                        <label class="input-floating-label" for="name">الاسم</label>
                    </div>
                </div>
                @error('name')
                <div class="text-error helper-text ps-3">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="textarea-floating sm:w-96 mb-4">
                <textarea class="textarea textarea-sm" name="bio" rows="2" placeholder="" maxlength="255" id="textareaFloatingSmall">{{ old('bio', Auth::user()->bio) }}</textarea>
                <label class="textarea-floating-label" for="textareaFloatingSmall">النبذة التعريفية</label>
            </div>

            <div class="flex justify-start">
                <button type="submit" 
                        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                    حفظ
                </button>
            </div>
        </form>
    </div>
</div>
</x-layouts.account>