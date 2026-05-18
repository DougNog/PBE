@props(['variant' => 'gray', 'icon' => null])

@php
    $variants = [
        'gray'    => 'bg-slate-100 text-slate-600',
        'green'   => 'bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200/50',
        'red'     => 'bg-senai-50 text-senai-700 ring-1 ring-senai-200/50',
        'rose'    => 'bg-senai-50 text-senai-700 ring-1 ring-senai-200/50',
        'senai'   => 'bg-senai-50 text-senai-700 ring-1 ring-senai-200/50',
        'orange'  => 'bg-orange-50 text-orange-700 ring-1 ring-orange-200/50',
        'amber'   => 'bg-amber-50 text-amber-700 ring-1 ring-amber-200/50',
        'yellow'  => 'bg-amber-50 text-amber-700 ring-1 ring-amber-200/50',
        'blue'    => 'bg-blue-50 text-blue-700 ring-1 ring-blue-200/50',
        'purple'  => 'bg-purple-50 text-purple-700 ring-1 ring-purple-200/50',
        'brand'   => 'bg-senai-50 text-senai-700 ring-1 ring-senai-200/50',
        'emerald' => 'bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200/50',
        'cyan'    => 'bg-cyan-50 text-cyan-700 ring-1 ring-cyan-200/50',
        'dark'    => 'bg-ink-900 text-white',
    ];
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-semibold {$variants[$variant]}"]) }}>
    @if($icon)<i class="ph {{ $icon }}"></i>@endif
    {{ $slot }}
</span>
