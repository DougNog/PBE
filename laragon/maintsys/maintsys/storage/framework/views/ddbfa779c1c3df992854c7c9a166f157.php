

<?php $__env->startSection('title', 'Editar O.S.'); ?>
<?php $__env->startSection('breadcrumb', '<a href="'.route('ordens.index').'" style="color:var(--muted);text-decoration:none">ordens</a> <span class="sep">/</span> <span>'.e($ordem->numero).'</span>'); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header">
    <div class="page-title">
        <small>// edição de ordem</small>
        <?php echo e($ordem->numero); ?>

    </div>
    <a href="<?php echo e(route('ordens.show', $ordem)); ?>" class="btn btn-secondary">← Voltar</a>
</div>

<div class="form-card">
    <form method="POST" action="<?php echo e(route('ordens.update', $ordem)); ?>">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="form-row">
            <div class="form-group">
                <label>Máquina *</label>
                <select name="maquina_id" class="form-control" required>
                    <?php $__currentLoopData = $maquinas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($m->id); ?>" <?php echo e(old('maquina_id',$ordem->maquina_id)==$m->id?'selected':''); ?>>
                        <?php echo e($m->modelo); ?> — <?php echo e($m->numero_serie); ?>

                    </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="form-group">
                <label>Técnico Responsável *</label>
                <select name="tecnico_id" class="form-control" required>
                    <?php $__currentLoopData = $tecnicos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($t->id); ?>" <?php echo e(old('tecnico_id',$ordem->tecnico_id)==$t->id?'selected':''); ?>>
                        <?php echo e($t->nome); ?> — <?php echo e($t->especialidade ?? 'Geral'); ?>

                    </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Tipo *</label>
                <select name="tipo" class="form-control" required>
                    <option value="preventiva" <?php echo e(old('tipo',$ordem->tipo)=='preventiva'?'selected':''); ?>>Preventiva</option>
                    <option value="corretiva"  <?php echo e(old('tipo',$ordem->tipo)=='corretiva'?'selected':''); ?>>Corretiva</option>
                </select>
            </div>
            <div class="form-group">
                <label>Prioridade *</label>
                <select name="prioridade" class="form-control" required>
                    <option value="baixa"   <?php echo e(old('prioridade',$ordem->prioridade)=='baixa'?'selected':''); ?>>Baixa</option>
                    <option value="media"   <?php echo e(old('prioridade',$ordem->prioridade)=='media'?'selected':''); ?>>Média</option>
                    <option value="alta"    <?php echo e(old('prioridade',$ordem->prioridade)=='alta'?'selected':''); ?>>Alta</option>
                    <option value="critica" <?php echo e(old('prioridade',$ordem->prioridade)=='critica'?'selected':''); ?>>🚨 Crítica</option>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Status *</label>
                <select name="status" id="status-select" class="form-control" required>
                    <option value="aberta"       <?php echo e(old('status',$ordem->status)=='aberta'?'selected':''); ?>>Aberta</option>
                    <option value="em_andamento" <?php echo e(old('status',$ordem->status)=='em_andamento'?'selected':''); ?>>Em Andamento</option>
                    <option value="concluida"    <?php echo e(old('status',$ordem->status)=='concluida'?'selected':''); ?>>Concluída</option>
                    <option value="cancelada"    <?php echo e(old('status',$ordem->status)=='cancelada'?'selected':''); ?>>Cancelada</option>
                </select>
            </div>
            <div class="form-group">
                <label>Data Prevista</label>
                <input type="date" name="data_prevista" class="form-control"
                       value="<?php echo e(old('data_prevista', $ordem->data_prevista?->format('Y-m-d'))); ?>">
            </div>
        </div>

        <div class="form-group">
            <label>Descrição *</label>
            <textarea name="descricao" class="form-control" rows="3" required><?php echo e(old('descricao', $ordem->descricao)); ?></textarea>
        </div>

        <div class="form-group">
            <label>Solução Aplicada</label>
            <textarea name="solucao" class="form-control" rows="3"
                      placeholder="Descreva a solução aplicada ao concluir a O.S..."><?php echo e(old('solucao', $ordem->solucao)); ?></textarea>
        </div>

        
        <div id="campos-conclusao" style="display:none; border-top:1px solid var(--border); padding-top:18px; margin-top:4px;">
            <div style="font-family:var(--mono);font-size:10px;color:var(--green);letter-spacing:2px;margin-bottom:14px;">
                ✓ // DADOS DE CONCLUSÃO
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Tempo de Parada (horas)</label>
                    <input type="number" name="tempo_parada_horas" class="form-control"
                           step="0.5" min="0" value="<?php echo e(old('tempo_parada_horas', 0)); ?>"
                           placeholder="ex: 2.5">
                </div>
                <div class="form-group">
                    <label>Custo Total (R$)</label>
                    <input type="number" name="custo" class="form-control"
                           step="0.01" min="0" value="<?php echo e(old('custo', 0)); ?>"
                           placeholder="ex: 350.00">
                </div>
            </div>
            <div class="form-group">
                <label>Peças Utilizadas</label>
                <textarea name="pecas_utilizadas" class="form-control" rows="2"
                          placeholder="ex: Rolamento 6205, Correia B-52..."><?php echo e(old('pecas_utilizadas')); ?></textarea>
            </div>
        </div>

        <div style="display:flex;gap:10px;margin-top:18px">
            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            <a href="<?php echo e(route('ordens.show', $ordem)); ?>" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    const statusSelect = document.getElementById('status-select');
    const camposConclusao = document.getElementById('campos-conclusao');

    function toggleConclusao() {
        camposConclusao.style.display = statusSelect.value === 'concluida' ? 'block' : 'none';
    }

    statusSelect.addEventListener('change', toggleConclusao);
    toggleConclusao();
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\maintsys\resources\views/ordens/edit.blade.php ENDPATH**/ ?>