<?php $__env->startSection('title', 'Máquinas'); ?>
<?php $__env->startSection('breadcrumb', '<span>máquinas</span>'); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header">
    <div class="page-title">
        <small>// inventário de equipamentos</small>
        Máquinas
    </div>
    <a href="<?php echo e(route('maquinas.create')); ?>" class="btn btn-primary">+ Nova Máquina</a>
</div>

<div class="stats-grid" style="grid-template-columns: repeat(4,1fr)">
    <div class="stat-card"><div class="stat-label">Total</div><div class="stat-value"><?php echo e($stats['total']); ?></div></div>
    <div class="stat-card green"><div class="stat-label">Operacionais</div><div class="stat-value" style="color:var(--green)"><?php echo e($stats['operacional']); ?></div></div>
    <div class="stat-card yellow"><div class="stat-label">Em Manutenção</div><div class="stat-value" style="color:var(--yellow)"><?php echo e($stats['em_manutencao']); ?></div></div>
    <div class="stat-card red"><div class="stat-label">Parada Crítica</div><div class="stat-value" style="color:var(--red)"><?php echo e($stats['parada_critica']); ?></div></div>
</div>

<div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th>#</th><th>Nº Série</th><th>Modelo</th><th>Fabricante</th>
                <th>Localização</th><th>Instalação</th><th>Status</th><th>O.S.</th><th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $maquinas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td class="mono" style="color:var(--muted);font-size:11px"><?php echo e($m->id); ?></td>
                <td class="mono" style="font-size:11px;color:var(--accent)"><?php echo e($m->numero_serie); ?></td>
                <td style="font-weight:500"><?php echo e($m->modelo); ?></td>
                <td style="color:var(--muted)"><?php echo e($m->fabricante ?? '—'); ?></td>
                <td><?php echo e($m->localizacao); ?></td>
                <td class="mono" style="font-size:11px;color:var(--muted)">
                    <?php echo e($m->data_instalacao ? $m->data_instalacao->format('d/m/Y') : '—'); ?>

                </td>
                <td>
                    <?php $sc = match($m->status){
                        'operacional'=>'green','em_manutencao'=>'yellow',
                        'parada_critica'=>'red',default=>'gray'
                    }; ?>
                    <span class="badge badge-<?php echo e($sc); ?>"><?php echo e($m->status_label); ?></span>
                </td>
                <td class="mono" style="text-align:center"><?php echo e($m->ordens_count); ?></td>
                <td>
                    <div class="actions">
                        <a href="<?php echo e(route('maquinas.show', $m)); ?>" class="btn btn-secondary btn-sm">Ver</a>
                        <a href="<?php echo e(route('maquinas.edit', $m)); ?>" class="btn btn-secondary btn-sm">Editar</a>
                        <form method="POST" action="<?php echo e(route('maquinas.destroy', $m)); ?>"
                              onsubmit="confirmDelete(this, 'Excluir a máquina <?php echo e($m->modelo); ?>?'); return false;">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger btn-sm">Del</button>
                        </form>
                    </div>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="9" style="text-align:center;color:var(--muted);font-family:var(--mono);padding:32px">
                    — nenhuma máquina cadastrada —
                </td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <div class="pagination"><?php echo e($maquinas->links()); ?></div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\maintsys\resources\views/maquinas/index.blade.php ENDPATH**/ ?>