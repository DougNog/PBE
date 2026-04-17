

<?php $__env->startSection('title', $ordem->numero); ?>
<?php $__env->startSection('breadcrumb', '<a href="'.route('ordens.index').'" style="color:var(--muted);text-decoration:none">ordens</a> <span class="sep">/</span> <span>'.e($ordem->numero).'</span>'); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header">
    <div class="page-title">
        <small>// ordem de serviço</small>
        <?php echo e($ordem->numero); ?>

    </div>
    <div style="display:flex;gap:8px">
        <a href="<?php echo e(route('ordens.edit', $ordem)); ?>" class="btn btn-primary">Editar O.S.</a>
    </div>
</div>

<div style="display:grid;grid-template-columns:300px 1fr;gap:20px">

    
    <div class="table-wrap" style="padding:20px;height:fit-content">
        <?php
            $pc = match($ordem->prioridade){'critica'=>'red','alta'=>'orange','media'=>'yellow',default=>'gray'};
            $sc = match($ordem->status){'aberta'=>'blue','em_andamento'=>'yellow','concluida'=>'green',default=>'gray'};
        ?>
        <div style="display:flex;gap:8px;margin-bottom:16px;flex-wrap:wrap">
            <span class="badge badge-<?php echo e($sc); ?>" style="font-size:12px"><?php echo e($ordem->status_label); ?></span>
            <span class="badge badge-<?php echo e($pc); ?>" style="font-size:12px"><?php echo e($ordem->prioridade_label); ?></span>
            <span class="badge <?php echo e($ordem->tipo==='corretiva'?'badge-orange':'badge-blue'); ?>" style="font-size:12px"><?php echo e($ordem->tipo_label); ?></span>
        </div>

        <?php $__currentLoopData = [
            ['Número',    $ordem->numero],
            ['Máquina',   $ordem->maquina->modelo ?? '—'],
            ['Nº Série',  $ordem->maquina->numero_serie ?? '—'],
            ['Local',     $ordem->maquina->localizacao ?? '—'],
            ['Técnico',   $ordem->tecnico->nome ?? '—'],
            ['Abertura',  $ordem->data_abertura->format('d/m/Y H:i')],
            ['Prevista',  $ordem->data_prevista ? $ordem->data_prevista->format('d/m/Y') : '—'],
            ['Conclusão', $ordem->data_conclusao ? $ordem->data_conclusao->format('d/m/Y H:i') : '—'],
        ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$label, $value]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div style="display:flex;justify-content:space-between;padding:8px 0;border-bottom:1px solid var(--border)">
            <span style="font-family:var(--mono);font-size:10px;color:var(--muted);letter-spacing:1px"><?php echo e($label); ?></span>
            <span style="font-family:var(--cond);font-size:13px;font-weight:500;max-width:160px;text-align:right"><?php echo e($value); ?></span>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    
    <div style="display:flex;flex-direction:column;gap:16px">

        <div class="table-wrap" style="padding:20px">
            <div style="font-family:var(--mono);font-size:10px;color:var(--muted);letter-spacing:2px;margin-bottom:10px">
                // DESCRIÇÃO DO PROBLEMA / SERVIÇO
            </div>
            <p style="font-size:14px;line-height:1.7;color:var(--text)"><?php echo e($ordem->descricao); ?></p>
        </div>

        <?php if($ordem->solucao): ?>
        <div class="table-wrap" style="padding:20px;border-color:rgba(63,185,80,.3)">
            <div style="font-family:var(--mono);font-size:10px;color:var(--green);letter-spacing:2px;margin-bottom:10px">
                ✓ // SOLUÇÃO APLICADA
            </div>
            <p style="font-size:14px;line-height:1.7;color:var(--text)"><?php echo e($ordem->solucao); ?></p>
        </div>
        <?php endif; ?>

        <?php if($ordem->historico): ?>
        <div class="table-wrap" style="padding:20px">
            <div style="font-family:var(--mono);font-size:10px;color:var(--muted);letter-spacing:2px;margin-bottom:12px">
                // REGISTRO NO HISTÓRICO
            </div>
            <div style="display:flex;gap:24px;flex-wrap:wrap">
                <div>
                    <div style="font-family:var(--mono);font-size:10px;color:var(--muted)">INÍCIO</div>
                    <div style="font-family:var(--cond);font-size:15px;font-weight:600">
                        <?php echo e($ordem->historico->data_inicio?->format('d/m/Y H:i') ?? '—'); ?>

                    </div>
                </div>
                <div>
                    <div style="font-family:var(--mono);font-size:10px;color:var(--muted)">FIM</div>
                    <div style="font-family:var(--cond);font-size:15px;font-weight:600">
                        <?php echo e($ordem->historico->data_fim?->format('d/m/Y H:i') ?? '—'); ?>

                    </div>
                </div>
                <?php if($ordem->historico->custo): ?>
                <div>
                    <div style="font-family:var(--mono);font-size:10px;color:var(--muted)">CUSTO</div>
                    <div style="font-family:var(--cond);font-size:15px;font-weight:600;color:var(--accent)">
                        R$ <?php echo e(number_format($ordem->historico->custo, 2, ',', '.')); ?>

                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>

    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\maintsys\resources\views/ordens/show.blade.php ENDPATH**/ ?>