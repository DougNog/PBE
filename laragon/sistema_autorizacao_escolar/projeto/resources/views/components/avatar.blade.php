@props(['nome' => '', 'foto' => null, 'size' => '10'])

@php
    $iniciais = collect(explode(' ', trim($nome)))
        ->filter()
        ->take(2)
        ->map(fn($w) => mb_strtoupper(mb_substr($w, 0, 1)))
        ->join('');

    $palette = [
        'from-pink-500 to-rose-500',
        'from-blue-500 to-indigo-600',
        'from-emerald-500 to-teal-600',
        'from-amber-500 to-orange-600',
        'from-purple-500 to-violet-600',
        'from-cyan-500 to-sky-600',
        'from-fuchsia-500 to-pink-600',
        'from-lime-500 to-green-600',
    ];
    $gradient = $palette[abs(crc32($nome)) % count($palette)];

    $sizeClasses = [
        '6'  => 'w-6 h-6 text-[10px]',
        '8'  => 'w-8 h-8 text-xs',
        '9'  => 'w-9 h-9 text-xs',
        '10' => 'w-10 h-10 text-sm',
        '12' => 'w-12 h-12 text-base',
        '14' => 'w-14 h-14 text-lg',
        '16' => 'w-16 h-16 text-xl',
        '20' => 'w-20 h-20 text-2xl',
    ];
    $klass = $sizeClasses[$size] ?? $sizeClasses['10'];
@endphp

@if($foto)
    <img src="{{ asset('storage/' . $foto) }}" alt="{{ $nome }}"
         class="{{ $klass }} rounded-full object-cover shadow-md ring-2 ring-white">
@else
    <div class="{{ $klass }} rounded-full bg-gradient-to-br {{ $gradient }} text-white font-bold flex items-center justify-center shadow-md ring-2 ring-white">
        {{ $iniciais ?: '?' }}
    </div>
@endif
