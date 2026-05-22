<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['route', 'icon', 'label', 'href' => null, 'badge' => null]));

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

foreach (array_filter((['route', 'icon', 'label', 'href' => null, 'badge' => null]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $href = $href ?? route($route);
    $active = request()->routeIs($route);
?>

<a href="<?php echo e($href); ?>"
   class="group flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all
   <?php echo e($active
        ? 'bg-senai-600 text-white shadow-senai'
        : 'text-ink-700 hover:bg-senai-50 hover:text-senai-700'); ?>">
    <i class="ph <?php echo e($icon); ?> text-xl <?php echo e($active ? 'text-white' : 'text-slate-400 group-hover:text-senai-600'); ?>"></i>
    <span class="flex-1"><?php echo e($label); ?></span>
    <?php if(!empty($badge)): ?>
        <span class="px-1.5 py-0.5 rounded-full text-[10px] font-bold <?php echo e($active ? 'bg-white/25 text-white' : 'bg-senai-100 text-senai-700'); ?>"><?php echo e($badge); ?></span>
    <?php endif; ?>
</a>
<?php /**PATH C:\laragon\www\doug\PBE\laragon\sistema_autorizacao_escolar\resources\views/components/nav-link.blade.php ENDPATH**/ ?>