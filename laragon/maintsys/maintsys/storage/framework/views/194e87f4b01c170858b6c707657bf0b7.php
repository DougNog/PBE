

<?php $__env->startSection('title', $maquina->modelo); ?>
<?php $__env->startSection('breadcrumb', '<a href="'.route('maquinas.index').'" style="color:var(--muted);text-decoration:none">máquinas</a> <span class="sep">/</span> <span>'.e($maquina->modelo).'</span>'); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header">
    <div class="page-title">
        <small>// equipamento — <?php echo e($maquina->numero_serie); ?></small>
        <?php echo e($maquina->modelo); ?>

    </div>
    <div style="display:flex;gap:8px">
        <a href="<?php echo e(route('historico.por-maquina', $maquina)); ?>" class="btn btn-secondary">◎ Histórico</a>
        <a href="<?php echo e(route('ordens.create')); ?>?maquina_id=<?php echo e($maquina->id); ?>" class="btn btn-secondary">+ O.S.</a>
        <a href="<?php echo e(route('maquinas.edit', $maquina)); ?>" class="btn btn-primary">Editar</a>
    </div>
</div>

<div style="display:grid;grid-template-columns:320px 1fr;gap:20px">

    
    <div>
        <div class="table-wrap" style="padding:20px">
            <?php $sc = match($maquina->status){
                'operacional'=>'green','em_manutencao'=>'yellow',
                'parada_critica'=>'red',default=>'gray'
            }; ?>
            <div style="margin-bottom:20px">
                <span class="badge badge-<?php echo e($sc); ?>" style="font-size:12px;padding:4px 12px">
                    <?php echo e($maquina->status_label); ?>

                </span>
            </div>

            <?php $__currentLoopData = [
                ['Nº Série',     $maquina->numero_serie],
                ['Modelo',       $maquina->modelo],
                ['Fabricante',   $maquina->fabricante ?? '—'],
                ['Localização',  $maquina->localizacao],
                ['Instalação',   $maquina->data_instalacao?->format('d/m/Y') ?? '—'],
                ['Total O.S.',   $maquina->ordens->count()],
            ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$label, $value]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div style="display:flex;justify-content:space-between;padding:8px 0;border-bottom:1px solid var(--border)">
                <span style="font-family:var(--mono);font-size:10px;color:var(--muted);letter-spacing:1px"><?php echo e($label); ?></span>
                <span style="font-family:var(--cond);font-size:14px;font-weight:500"><?php echo e($value); ?></span>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php if($maquina->descricao): ?>
            <div style="margin-top:16px">
                <div style="font-family:var(--mono);font-size:10px;color:var(--muted);letter-spacing:1px;margin-bottom:6px">DESCRIÇÃO</div>
                <p style="font-size:13px;color:var(--muted);line-height:1.5"><?php echo e($maquina->descricao); ?></p>
            </div>
            <?php endif; ?>
        </div>
    </div>

    
    <div>
        <div style="font-family:var(--mono);font-size:10px;color:var(--muted);letter-spacing:2px;margin-bottom:10px">
            // ORDENS DE SERVIÇO
        </div>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Número</th>
                        <th>Tipo</th>
                        <th>Prioridade</th>
                        <th>Técnico</th>
                        <th>Status</th>
                        <th>Abertura</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $maquina->ordens->sortByDesc('created_at'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $os): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="mono" style="font-size:11px;color:var(--accent)">
                            <a href="<?php echo e(route('ordens.show', $os)); ?>" style="color:var(--accent)"><?php echo e($os->numero); ?></a>
                        </td>
                        <td><span class="badge <?php echo e($os->tipo==='corretiva'?'badge-orange':'badge-blue'); ?>"><?php echo e($os->tipo_label); ?></span></td>
                        <td>
                            <?php $pc = match($os->prioridade){'critica'=>'red','alta'=>'orange','media'=>'yellow',default=>'gray'}; ?>
                            <span class="badge badge-<?php echo e($pc); ?>"><?php echo e($os->prioridade_label); ?></span>
                        </td>
                        <td style="color:var(--muted)"><?php echo e($os->tecnico->nome ?? '—'); ?></td>
                        <td>
                            <?php $sc2 = match($os->status){'aberta'=>'blue','em_andamento'=>'yellow','concluida'=>'green',default=>'gray'}; ?>
                            <span class="badge badge-<?php echo e($sc2); ?>"><?php echo e($os->status_label); ?></span>
                        </td>
                        <td class="mono" style="font-size:11px;color:var(--muted)"><?php echo e($os->data_abertura->format('d/m/Y')); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="6" style="color:var(--muted);font-family:var(--mono);font-size:11px;padding:20px">— sem ordens de serviço —</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\maintsys\resources\views/maquinas/show.blade.php ENDPATH**/ ?>