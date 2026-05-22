@props(['label', 'value', 'icon', 'color' => 'senai', 'trend' => null, 'trendUp' => true])

@php
    $colors = [
        'senai'   => ['bg' => 'bg-senai-50',   'text' => 'text-senai-600',   'gradient' => 'from-senai-600 to-senai-700'],
        'brand'   => ['bg' => 'bg-senai-50',   'text' => 'text-senai-600',   'gradient' => 'from-senai-600 to-senai-700'],
        'green'   => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-600', 'gradient' => 'from-emerald-500 to-teal-600'],
        'orange'  => ['bg' => 'bg-orange-50',  'text' => 'text-orange-600',  'gradient' => 'from-orange-500 to-amber-600'],
        'purple'  => ['bg' => 'bg-purple-50',  'text' => 'text-purple-600',  'gradient' => 'from-purple-500 to-violet-600'],
        'rose'    => ['bg' => 'bg-senai-50',   'text' => 'text-senai-600',   'gradient' => 'from-senai-500 to-senai-700'],
        'cyan'    => ['bg' => 'bg-cyan-50',    'text' => 'text-cyan-600',    'gradient' => 'from-cyan-500 to-sky-600'],
        'dark'    => ['bg' => 'bg-slate-100',  'text' => 'text-ink-900',     'gradient' => 'from-ink-800 to-ink-900'],
    ];
    $c = $colors[$color] ?? $colors['senai'];
@endphp

<div class="bg-white rounded-2xl p-5 shadow-soft hover:shadow-lg transition-shadow border border-slate-100 relative overflow-hidden animate-slide-up">
    <div class="absolute -top-6 -right-6 w-24 h-24 bg-gradient-to-br {{ $c['gradient'] }} opacity-5 rounded-full"></div>

    <div class="flex items-start justify-between mb-3">
        <div class="w-11 h-11 rounded-xl {{ $c['bg'] }} flex items-center justify-center">
            <i class="ph-fill {{ $icon }} {{ $c['text'] }} text-xl"></i>
        </div>
        @if($trend !== null)
        <span class="flex items-center gap-1 text-xs font-semibold {{ $trendUp ? 'text-emerald-600' : 'text-senai-600' }}">
            <i class="ph-bold {{ $trendUp ? 'ph-trend-up' : 'ph-trend-down' }}"></i>
            {{ $trend }}
        </span>
        @endif
    </div>

    <p class="text-xs uppercase tracking-wider text-slate-500 font-semibold mb-1">{{ $label }}</p>
    <p class="text-3xl font-bold text-ink-900">{{ $value }}</p>
</div>
