{{-- Container global de toasts (Alpine) --}}
<div x-data="alpineToasts"
     class="fixed top-20 right-4 z-50 space-y-2 max-w-sm">
    <template x-for="i in items" :key="i.id">
        <div x-show="true" x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-x-4"
             x-transition:enter-end="opacity-100 translate-x-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-end="opacity-0"
             :class="{
                 'bg-emerald-50 border-emerald-200 text-emerald-800': i.type === 'success',
                 'bg-amber-50 border-amber-200 text-amber-800': i.type === 'warning',
                 'bg-rose-50 border-rose-200 text-rose-800': i.type === 'error'
             }"
             class="flex items-start gap-3 px-4 py-3 rounded-xl shadow-lg border backdrop-blur-sm">
            <i class="ph-fill text-lg shrink-0" :class="{
                'ph-check-circle text-emerald-600': i.type === 'success',
                'ph-warning text-amber-600': i.type === 'warning',
                'ph-warning-circle text-rose-600': i.type === 'error'
            }"></i>
            <p class="text-sm font-medium flex-1" x-text="i.msg"></p>
            <button @click="items = items.filter(it => it.id !== i.id)" class="text-slate-400 hover:text-slate-600 text-sm">
                <i class="ph ph-x"></i>
            </button>
        </div>
    </template>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('alpineToasts', () => ({
            items: [],
            init() {
                window.toast = (msg, type = 'success') => {
                    const id = Date.now();
                    this.items.push({ id, type, msg });
                    setTimeout(() => { this.items = this.items.filter(i => i.id !== id); }, 5000);
                };
                @if(session('success'))
                    window.toast(@json(session('success')), 'success');
                @endif
                @if(session('error'))
                    window.toast(@json(session('error')), 'error');
                @endif
                @if(session('warning'))
                    window.toast(@json(session('warning')), 'warning');
                @endif
            }
        }));
    });
</script>

{{-- Erros de validação --}}
@if($errors->any())
<div class="mb-5 bg-rose-50 border border-rose-200 rounded-xl px-4 py-3 animate-slide-up">
    <div class="flex items-start gap-3">
        <i class="ph-fill ph-warning-circle text-rose-600 text-xl mt-0.5"></i>
        <div class="flex-1">
            <p class="font-semibold text-rose-800 text-sm mb-1">Corrija os erros abaixo:</p>
            <ul class="list-disc list-inside text-sm text-rose-700 space-y-0.5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endif
