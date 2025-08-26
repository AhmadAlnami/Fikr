@props([
    'title',
    'icon',
    'type'=>'text',
    'placeholder'=>'',
    'id',
    'w'=>'w-86'
    ])
@php
$isPassword = $type==='password';
@endphp

<div>
  <div class="input {{ $w }}">
    <span class="{{$icon}} text-base-content/80 my-auto size-5 shrink-0"></span>
    <div class="input-floating grow">
      <input required type="{{$type}}" placeholder="{{$placeholder}}" class="ps-3" id="{{$id}}" name="{{$id}}" value="{{ old($id) }}" {{$attributes}}/>
      <label class="input-floating-label" for="{{$id}}">{{$title}}</label>
    </div>

    @if ($isPassword)
      <button type="button" data-toggle-password='{ "target": "#{{$id}}" }' class="block cursor-pointer" aria-label="password toggle">
        <span class="icon-[tabler--eye] text-base-content/80 password-active:block hidden size-5 shrink-0"></span>
        <span class="icon-[tabler--eye-off] text-base-content/80 password-active:hidden block size-5 shrink-0"></span>
      </button>
    @endif
  </div>

  @error($id)
  <div class="text-error helper-text ps-3 mb-2">
    {{ $message }}
  </div>
  @enderror
</div>