@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-white/10 bg-black/50 text-gray-100 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm placeholder-gray-500']) !!}>