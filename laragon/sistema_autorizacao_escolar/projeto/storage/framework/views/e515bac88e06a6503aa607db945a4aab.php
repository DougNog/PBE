
<?php $__env->startSection('title', 'Portaria'); ?>
<?php $__env->startSection('subtitle', 'Registro de entrada e saída de alunos'); ?>

<?php $__env->startSection('content'); ?>

<div x-data="portaria()" class="space-y-6">

    
    <div class="bg-gradient-to-br from-white to-slate-50 rounded-2xl shadow-soft border border-slate-100/80 p-6 lg:p-8">
        <div class="text-center mb-5">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-gradient-to-br from-senai-500 to-senai-700 shadow-lg shadow-senai-600/30 mb-3">
                <i class="ph-fill ph-magnifying-glass text-white text-2xl"></i>
            </div>
            <h2 class="text-xl font-bold text-slate-900">Buscar aluno</h2>
            <p class="text-sm text-slate-500">Digite o nome ou matrícula para localizar</p>
        </div>

        <div class="relative max-w-2xl mx-auto">
            <i class="ph ph-magnifying-glass absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 text-xl"></i>
            <input type="text" x-model="query" @input.debounce.300ms="buscar()"
                   placeholder="Nome ou matrícula do aluno..."
                   autofocus
                   class="w-full pl-14 pr-14 py-4 text-base bg-white border-2 border-slate-200 rounded-2xl focus:outline-none focus:border-senai-500 focus:ring-4 focus:ring-senai-100 transition-all">
            <div x-show="carregando" x-cloak class="absolute right-5 top-1/2 -translate-y-1/2">
                <svg class="animate-spin w-5 h-5 text-senai-500" fill="none" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3" class="opacity-25"/>
                    <path fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z" class="opacity-75"/>
                </svg>
            </div>
            <button x-show="query.length" @click="limpar()" x-cloak class="absolute right-5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600">
                <i class="ph ph-x-circle text-xl"></i>
            </button>
        </div>

        
        <div class="mt-5 flex items-center justify-center gap-2 text-xs text-slate-500">
            <span class="flex items-center gap-1"><i class="ph-fill ph-check-circle text-emerald-500"></i> Autorização ativa</span>
            <span class="text-slate-300">·</span>
            <span class="flex items-center gap-1"><i class="ph-fill ph-lock-key text-slate-400"></i> Saída bloqueada</span>
        </div>
    </div>

    
    <div x-show="query.length >= 2" x-cloak class="space-y-3 animate-fade-in">
        <template x-if="resultados.length === 0 && !carregando">
            <div class="bg-white rounded-2xl p-8 text-center text-slate-400 border border-slate-100 shadow-soft">
                <i class="ph ph-binoculars text-5xl text-slate-300"></i>
                <p class="mt-2 text-sm">Nenhum aluno encontrado para <strong x-text="`'${query}'`" class="text-slate-600"></strong></p>
            </div>
        </template>

        <template x-for="aluno in resultados" :key="aluno.id">
            <div class="bg-white rounded-2xl p-5 shadow-soft hover:shadow-lg border border-slate-100/80 transition-all flex items-center gap-4 animate-slide-up">
                
                <template x-if="aluno.foto">
                    <img :src="aluno.foto" :alt="aluno.nome" class="w-14 h-14 rounded-full object-cover ring-2 ring-white shadow-md">
                </template>
                <template x-if="!aluno.foto">
                    <div class="w-14 h-14 rounded-full text-white font-bold flex items-center justify-center shadow-md ring-2 ring-white bg-gradient-to-br"
                         :class="aluno.cor">
                        <span x-text="aluno.iniciais"></span>
                    </div>
                </template>

                
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2">
                        <p class="font-bold text-slate-900 text-base truncate" x-text="aluno.nome"></p>
                        <template x-if="aluno.tem_autorizacao">
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200">
                                <i class="ph-fill ph-check-circle"></i> Autorizado
                            </span>
                        </template>
                    </div>
                    <p class="text-xs text-slate-500">
                        <span x-text="aluno.matricula"></span> ·
                        <span x-text="aluno.turma"></span>
                    </p>
                    <p class="text-[11px] text-slate-400 mt-0.5 truncate" x-show="aluno.responsaveis"
                       x-text="`Resp.: ${aluno.responsaveis}`"></p>
                </div>

                
                <div class="flex gap-2 shrink-0">
                    <a :href="aluno.url_entrada"
                       class="px-4 py-2.5 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 font-semibold rounded-xl text-sm flex items-center gap-1.5 transition-colors">
                        <i class="ph-fill ph-sign-in"></i> Entrada
                    </a>
                    <template x-if="aluno.tem_autorizacao">
                        <a :href="aluno.url_saida"
                           class="px-4 py-2.5 bg-orange-50 hover:bg-orange-100 text-orange-700 font-semibold rounded-xl text-sm flex items-center gap-1.5 transition-colors">
                            <i class="ph-fill ph-sign-out"></i> Saída
                        </a>
                    </template>
                    <template x-if="!aluno.tem_autorizacao">
                        <span class="px-4 py-2.5 bg-slate-100 text-slate-400 font-semibold rounded-xl text-sm flex items-center gap-1.5 cursor-not-allowed" title="Sem autorização ativa">
                            <i class="ph-fill ph-lock-key"></i> Saída
                        </span>
                    </template>
                </div>
            </div>
        </template>
    </div>

    
    <div x-show="query.length < 2" x-cloak>
        <div class="bg-white rounded-2xl shadow-soft border border-slate-100/80 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <h3 class="font-bold text-slate-800">Movimentações de hoje</h3>
                    <p class="text-xs text-slate-500"><?php echo e(now()->isoFormat('dddd, D [de] MMMM')); ?></p>
                </div>
                <a href="<?php echo e(route('movimentacoes.index')); ?>" class="text-xs font-semibold text-senai-600 hover:text-senai-700 flex items-center gap-1">
                    Ver tudo <i class="ph ph-arrow-right"></i>
                </a>
            </div>

            <?php if($recentes->isEmpty()): ?>
                <div class="text-center py-12 text-slate-400">
                    <i class="ph ph-empty text-5xl"></i>
                    <p class="mt-2 text-sm">Nenhuma movimentação registrada hoje ainda.</p>
                </div>
            <?php else: ?>
                <div class="divide-y divide-slate-50">
                <?php $__currentLoopData = $recentes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mov): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="px-6 py-3.5 flex items-center gap-3 hover:bg-slate-50/50">
                        <?php if (isset($component)) { $__componentOriginal8ca5b43b8fff8bb34ab2ba4eb4bdd67b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8ca5b43b8fff8bb34ab2ba4eb4bdd67b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.avatar','data' => ['nome' => $mov->aluno->nome,'size' => '10']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('avatar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['nome' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($mov->aluno->nome),'size' => '10']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8ca5b43b8fff8bb34ab2ba4eb4bdd67b)): ?>
<?php $attributes = $__attributesOriginal8ca5b43b8fff8bb34ab2ba4eb4bdd67b; ?>
<?php unset($__attributesOriginal8ca5b43b8fff8bb34ab2ba4eb4bdd67b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8ca5b43b8fff8bb34ab2ba4eb4bdd67b)): ?>
<?php $component = $__componentOriginal8ca5b43b8fff8bb34ab2ba4eb4bdd67b; ?>
<?php unset($__componentOriginal8ca5b43b8fff8bb34ab2ba4eb4bdd67b); ?>
<?php endif; ?>
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-slate-800"><?php echo e($mov->aluno->nome); ?></p>
                            <p class="text-xs text-slate-500"><?php echo e($mov->aluno->turma); ?></p>
                        </div>
                        <?php if (isset($component)) { $__componentOriginal2ddbc40e602c342e508ac696e52f8719 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2ddbc40e602c342e508ac696e52f8719 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.badge','data' => ['variant' => $mov->tipo === 'saida' ? 'orange' : 'green','icon' => $mov->tipo === 'saida' ? 'ph-sign-out' : 'ph-sign-in']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($mov->tipo === 'saida' ? 'orange' : 'green'),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($mov->tipo === 'saida' ? 'ph-sign-out' : 'ph-sign-in')]); ?>
                            <?php echo e($mov->tipo_label); ?>

                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $attributes = $__attributesOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $component = $__componentOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__componentOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
                        <p class="text-xs text-slate-400 w-12 text-right"><?php echo e($mov->created_at->format('H:i')); ?></p>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
function portaria() {
    return {
        query: '',
        resultados: [],
        carregando: false,
        async buscar() {
            if (this.query.length < 2) { this.resultados = []; return; }
            this.carregando = true;
            try {
                const res = await fetch(`<?php echo e(route('portaria.buscar.json')); ?>?q=${encodeURIComponent(this.query)}`, {
                    headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
                });
                const data = await res.json();
                this.resultados = data.alunos;
            } finally {
                this.carregando = false;
            }
        },
        limpar() { this.query = ''; this.resultados = []; }
    }
}
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\doug\PBE\laragon\sistema_autorizacao_escolar\projeto\resources\views/portaria/index.blade.php ENDPATH**/ ?>