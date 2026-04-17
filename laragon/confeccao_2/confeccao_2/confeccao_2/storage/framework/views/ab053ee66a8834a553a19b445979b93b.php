<?php if (isset($component)) { $__componentOriginal166a02a7c5ef5a9331faf66fa665c256 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal166a02a7c5ef5a9331faf66fa665c256 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-panels::components.page.index','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament-panels::page'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>


    
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

        <div class="rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 p-5 flex items-center gap-4 shadow-sm">
            <div class="rounded-full bg-blue-100 dark:bg-blue-900 p-3">
                <svg class="w-6 h-6 text-blue-600 dark:text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H4v-2a4 4 0 015-3.87m6-4a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Clientes</p>
                <p class="text-2xl font-bold text-gray-800 dark:text-white"><?php echo e($totalClientes); ?></p>
            </div>
        </div>

        <div class="rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 p-5 flex items-center gap-4 shadow-sm">
            <div class="rounded-full bg-green-100 dark:bg-green-900 p-3">
                <svg class="w-6 h-6 text-green-600 dark:text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.5 6h13M7 13L5.4 5M10 21a1 1 0 100-2 1 1 0 000 2zm7 0a1 1 0 100-2 1 1 0 000 2z"/>
                </svg>
            </div>
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Pedidos</p>
                <p class="text-2xl font-bold text-gray-800 dark:text-white"><?php echo e($totalPedidos); ?></p>
            </div>
        </div>

        <div class="rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 p-5 flex items-center gap-4 shadow-sm">
            <div class="rounded-full bg-purple-100 dark:bg-purple-900 p-3">
                <svg class="w-6 h-6 text-purple-600 dark:text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
            </div>
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Produtos</p>
                <p class="text-2xl font-bold text-gray-800 dark:text-white"><?php echo e($totalProdutos); ?></p>
            </div>
        </div>

        <div class="rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 p-5 flex items-center gap-4 shadow-sm">
            <div class="rounded-full bg-yellow-100 dark:bg-yellow-900 p-3">
                <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a5 5 0 00-10 0v2M3 9h18v11a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                </svg>
            </div>
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Valor em Pedidos</p>
                <p class="text-xl font-bold text-gray-800 dark:text-white"><?php echo e($valorTotalPedidos); ?></p>
            </div>
        </div>

    </div>

    
    <div class="mt-6 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 shadow-sm">
        <div class="px-5 py-4 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-base font-semibold text-gray-800 dark:text-white">Pedidos Recentes</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs uppercase text-gray-500 dark:text-gray-400 bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-5 py-3">#</th>
                        <th class="px-5 py-3">Cliente</th>
                        <th class="px-5 py-3">Status</th>
                        <th class="px-5 py-3">Valor</th>
                        <th class="px-5 py-3">Data</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $pedidosRecentes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pedido): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <td class="px-5 py-3 font-medium text-gray-800 dark:text-white"><?php echo e($pedido['id']); ?></td>
                            <td class="px-5 py-3 text-gray-700 dark:text-gray-300"><?php echo e($pedido['cliente']); ?></td>
                            <td class="px-5 py-3">
                                <?php
                                    $cores = [
                                        'pendente'    => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200',
                                        'em_producao' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200',
                                        'finalizado'  => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
                                        'cancelado'   => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
                                    ];
                                    $labels = [
                                        'pendente'    => 'Pendente',
                                        'em_producao' => 'Em Produção',
                                        'finalizado'  => 'Finalizado',
                                        'cancelado'   => 'Cancelado',
                                    ];
                                ?>
                                <span class="px-2 py-1 rounded-full text-xs font-medium <?php echo e($cores[$pedido['status']] ?? ''); ?>">
                                    <?php echo e($labels[$pedido['status']] ?? $pedido['status']); ?>

                                </span>
                            </td>
                            <td class="px-5 py-3 text-gray-700 dark:text-gray-300"><?php echo e($pedido['valor_total']); ?></td>
                            <td class="px-5 py-3 text-gray-500 dark:text-gray-400"><?php echo e($pedido['data']); ?></td>
                        </tr>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <tr>
                            <td colspan="5" class="px-5 py-6 text-center text-gray-400">Nenhum pedido encontrado.</td>
                        </tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal166a02a7c5ef5a9331faf66fa665c256)): ?>
<?php $attributes = $__attributesOriginal166a02a7c5ef5a9331faf66fa665c256; ?>
<?php unset($__attributesOriginal166a02a7c5ef5a9331faf66fa665c256); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal166a02a7c5ef5a9331faf66fa665c256)): ?>
<?php $component = $__componentOriginal166a02a7c5ef5a9331faf66fa665c256; ?>
<?php unset($__componentOriginal166a02a7c5ef5a9331faf66fa665c256); ?>
<?php endif; ?><?php /**PATH C:\laragon\www\doug\confeccao_2\confeccao_2\resources\views/filament/pages/dashboard.blade.php ENDPATH**/ ?>