<?php $__env->startSection('title', 'Acessar Sistema'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen flex">
    
    <div class="hidden lg:flex lg:w-1/2 relative bg-gradient-to-br from-senai-700 via-senai-600 to-senai-800 p-12 flex-col justify-between overflow-hidden">
        <div class="absolute inset-0 opacity-15">
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-white rounded-full blur-3xl"></div>
            <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-senai-300 rounded-full blur-3xl"></div>
            <div class="absolute top-1/2 left-1/2 w-72 h-72 bg-senai-400 rounded-full blur-3xl"></div>
        </div>

        <div class="relative z-10">
            <div class="flex items-center gap-3 mb-12">
                <div class="w-14 h-14 rounded-xl bg-white flex items-center justify-center shadow-xl">
                    <i class="ph-fill ph-shield-check text-senai-600 text-3xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-extrabold text-white tracking-tight">SAFE</h1>
                    <p class="text-xs text-senai-100 uppercase tracking-widest font-bold">SENAI · Fluxo Escolar</p>
                </div>
            </div>

            <h2 class="text-4xl lg:text-5xl font-bold text-white leading-tight mb-4">
                Segurança e <br>controle na <br>portaria escolar.
            </h2>
            <p class="text-senai-50 max-w-md text-lg leading-relaxed">
                Pré-autorize, valide e notifique. Tudo em um único sistema, em tempo real.
            </p>

            <div class="mt-12 space-y-3">
                <div class="flex items-center gap-3 text-white">
                    <div class="w-8 h-8 rounded-lg bg-white/15 flex items-center justify-center">
                        <i class="ph-bold ph-check text-white"></i>
                    </div>
                    <span>Autorização prévia por AQV e responsável</span>
                </div>
                <div class="flex items-center gap-3 text-white">
                    <div class="w-8 h-8 rounded-lg bg-white/15 flex items-center justify-center">
                        <i class="ph-bold ph-check text-white"></i>
                    </div>
                    <span>Validação digital na portaria</span>
                </div>
                <div class="flex items-center gap-3 text-white">
                    <div class="w-8 h-8 rounded-lg bg-white/15 flex items-center justify-center">
                        <i class="ph-bold ph-check text-white"></i>
                    </div>
                    <span>Notificações automáticas para responsáveis</span>
                </div>
            </div>
        </div>

        <div class="relative z-10 flex items-center justify-between text-xs text-senai-100">
            <p>© <?php echo e(date('Y')); ?> SAFE · Protótipo Funcional</p>
            <div class="flex items-center gap-1.5 font-bold uppercase tracking-widest">
                <i class="ph-fill ph-graduation-cap"></i>
                <span>SENAI</span>
            </div>
        </div>
    </div>

    
    <div class="w-full lg:w-1/2 flex items-center justify-center p-6 lg:p-12 bg-white">
        <div class="w-full max-w-md">
            <div class="lg:hidden flex items-center gap-3 mb-8">
                <div class="w-12 h-12 rounded-xl bg-senai-600 flex items-center justify-center shadow-lg">
                    <i class="ph-fill ph-shield-check text-white text-2xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-ink-900">SAFE</h1>
                    <p class="text-[10px] text-senai-600 uppercase tracking-widest font-bold">SENAI</p>
                </div>
            </div>

            <div class="mb-8">
                <h2 class="text-3xl font-bold text-ink-900 mb-2">Bem-vindo de volta</h2>
                <p class="text-slate-500">Acesse com suas credenciais institucionais.</p>
            </div>

            <?php if($errors->any()): ?>
            <div class="mb-5 bg-senai-50 border border-senai-200 text-senai-700 rounded-xl px-4 py-3 text-sm flex items-center gap-2">
                <i class="ph-fill ph-warning-circle text-senai-600"></i>
                <?php echo e($errors->first('email')); ?>

            </div>
            <?php endif; ?>

            <form method="POST" action="/login" class="space-y-5">
                <?php echo csrf_field(); ?>
                <div>
                    <label class="block text-sm font-semibold text-ink-700 mb-1.5">E-mail</label>
                    <div class="relative">
                        <i class="ph ph-envelope absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-lg"></i>
                        <input type="email" name="email" value="<?php echo e(old('email')); ?>" required autofocus
                            placeholder="seu@email.com.br"
                            class="w-full pl-11 pr-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-4 focus:ring-senai-100 focus:border-senai-500 transition-all bg-slate-50 focus:bg-white">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-ink-700 mb-1.5">Senha</label>
                    <div class="relative" x-data="{ show: false }">
                        <i class="ph ph-lock-key absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-lg"></i>
                        <input :type="show ? 'text' : 'password'" name="password" required
                            class="w-full pl-11 pr-11 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-4 focus:ring-senai-100 focus:border-senai-500 transition-all bg-slate-50 focus:bg-white">
                        <button type="button" @click="show=!show" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600">
                            <i class="ph" :class="show ? 'ph-eye-slash' : 'ph-eye'"></i>
                        </button>
                    </div>
                </div>

                <label class="flex items-center gap-2 text-sm text-slate-600 cursor-pointer">
                    <input type="checkbox" name="remember" class="rounded text-senai-600 focus:ring-senai-500">
                    Mantenha-me conectado
                </label>

                <button type="submit"
                    class="w-full bg-gradient-to-br from-senai-600 to-senai-700 hover:from-senai-700 hover:to-senai-800 text-white font-bold py-3.5 rounded-xl transition-all shadow-lg shadow-senai-600/30 hover:shadow-xl hover:shadow-senai-600/40 hover:-translate-y-0.5 flex items-center justify-center gap-2">
                    Entrar
                    <i class="ph-bold ph-arrow-right"></i>
                </button>
            </form>

            <div class="mt-8 p-4 bg-slate-50 rounded-xl border border-slate-200">
                <p class="text-xs uppercase tracking-wider text-slate-500 font-bold mb-2 flex items-center gap-1">
                    <i class="ph ph-key"></i>
                    Credenciais de demonstração
                </p>
                <div class="space-y-1.5 text-xs">
                    <div class="flex items-center justify-between">
                        <span class="text-slate-500">Admin</span>
                        <code class="text-ink-800 bg-white px-2 py-0.5 rounded border border-slate-200">admin@safe.edu.br</code>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-slate-500">Porteiro</span>
                        <code class="text-ink-800 bg-white px-2 py-0.5 rounded border border-slate-200">porteiro@safe.edu.br</code>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-slate-500">Professor</span>
                        <code class="text-ink-800 bg-white px-2 py-0.5 rounded border border-slate-200">professor@safe.edu.br</code>
                    </div>
                    <div class="flex items-center justify-between pt-1 mt-1 border-t border-slate-200">
                        <span class="text-slate-500">Senha (todos)</span>
                        <code class="text-ink-800 bg-white px-2 py-0.5 rounded border border-slate-200">password</code>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guest', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\doug\PBE\laragon\sistema_autorizacao_escolar\resources\views/auth/login.blade.php ENDPATH**/ ?>