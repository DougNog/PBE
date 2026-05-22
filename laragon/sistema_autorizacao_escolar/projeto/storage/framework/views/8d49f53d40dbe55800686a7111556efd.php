<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['nome' => '', 'foto' => null, 'size' => '10']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['nome' => '', 'foto' => null, 'size' => '10']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
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
?>

<?php if($foto): ?>
    <img src="<?php echo e(asset('storage/' . $foto)); ?>" alt="<?php echo e($nome); ?>"
         class="<?php echo e($klass); ?> rounded-full object-cover shadow-md ring-2 ring-white">
<?php else: ?>
    <div class="<?php echo e($klass); ?> rounded-full bg-gradient-to-br <?php echo e($gradient); ?> text-white font-bold flex items-center justify-center shadow-md ring-2 ring-white">
        <?php echo e($iniciais ?: '?'); ?>

    </div>
<?php endif; ?>
<?php /**PATH C:\laragon\www\doug\PBE\laragon\sistema_autorizacao_escolar\projeto\resources\views/components/avatar.blade.php ENDPATH**/ ?>