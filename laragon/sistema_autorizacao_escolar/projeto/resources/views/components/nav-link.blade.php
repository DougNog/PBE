@props(['route', 'icon', 'label', 'href' => null, 'badge' => null])

@php
    $href = $href ?? route($route);
    $active = request()->routeIs($route);
@endphp

<a href="{{ $href }}"
   class="group flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all
   {{ $active
        ? 'bg-senai-600 text-white shadow-senai'
        : 'text-ink-700 hover:bg-senai-50 hover:text-senai-700' }}">
    <i class="ph {{ $icon }} text-xl {{ $active ? 'text-white' : 'text-slate-400 group-hover:text-senai-600' }}"></i>
    <span class="flex-1">{{ $label }}</span>
    @if(!empty($badge))
        <span class="px-1.5 py-0.5 rounded-full text-[10px] font-bold {{ $active ? 'bg-white/25 text-white' : 'bg-senai-100 text-senai-700' }}">{{ $badge }}</span>
    @endif
</a>
