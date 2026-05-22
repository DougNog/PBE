<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['variant' => 'gray', 'icon' => null]));

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

foreach (array_filter((['variant' => 'gray', 'icon' => null]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
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
?>

<span <?php echo e($attributes->merge(['class' => "inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-semibold {$variants[$variant]}"])); ?>>
    <?php if($icon): ?><i class="ph <?php echo e($icon); ?>"></i><?php endif; ?>
    <?php echo e($slot); ?>

</span>
<?php /**PATH C:\laragon\www\doug\PBE\laragon\sistema_autorizacao_escolar\projeto\resources\views/components/badge.blade.php ENDPATH**/ ?>