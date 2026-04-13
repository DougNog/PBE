<x-app-layout>
    <x-slot name="header"></x-slot>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap');
        :root{--ink:#0a0a0f;--surface:#f5f4f0;--card:#fff;--muted:#888;--border:#e8e6e1;--accent:#0ea87e;--red:#ff4c4c;}
        *{box-sizing:border-box;margin:0;padding:0;}
        .root{font-family:'DM Sans',sans-serif;background:var(--surface);min-height:100vh;color:var(--ink);}
        .hero{position:relative;overflow:hidden;background:var(--ink);padding:2.5rem 2.5rem 2rem;}
        .hero::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 60% 80% at 85% -10%,rgba(14,168,126,.45) 0%,transparent 65%),radial-gradient(ellipse 35% 55% at -5% 110%,rgba(14,168,126,.25) 0%,transparent 60%);pointer-events:none;}
        .hero-inner{position:relative;z-index:1;max-width:720px;margin:0 auto;display:flex;align-items:center;gap:1rem;}
        .back{display:inline-flex;align-items:center;gap:.4rem;color:rgba(255,255,255,.5);font-size:.82rem;font-weight:500;text-decoration:none;transition:color .2s;flex-shrink:0;}
        .back:hover{color:#fff;}
        .divider{width:1px;height:28px;background:rgba(255,255,255,.15);flex-shrink:0;}
        .hero-title{font-family:'Syne',sans-serif;font-size:clamp(1.3rem,3vw,1.9rem);font-weight:800;color:#fff;letter-spacing:-.03em;}
        .body{max-width:720px;margin:0 auto;padding:2.5rem 2rem 4rem;}
        .card{background:var(--card);border:1px solid var(--border);border-radius:24px;overflow:hidden;box-shadow:0 4px 24px rgba(0,0,0,.04);animation:up .45s ease both;}
        @keyframes up{from{opacity:0;transform:translateY(16px)}to{opacity:1;transform:translateY(0)}}
        .card-head{padding:1.5rem 2rem;border-bottom:1px solid var(--border);display:flex;align-items:center;gap:.75rem;}
        .icon{width:40px;height:40px;border-radius:12px;background:#d9fff3;display:flex;align-items:center;justify-content:center;font-size:1.1rem;}
        .card-title{font-family:'Syne',sans-serif;font-size:1rem;font-weight:700;}
        .card-sub{font-size:.8rem;color:var(--muted);margin-top:.1rem;}
        .card-body{padding:2rem;}
        .fg{display:grid;gap:1.25rem;}
        .fg.c2{grid-template-columns:1fr 1fr;}
        .field{display:flex;flex-direction:column;gap:.45rem;}
        .field label{font-size:.78rem;font-weight:600;text-transform:uppercase;letter-spacing:.07em;color:var(--muted);}
        .field input{width:100%;background:var(--surface);border:1.5px solid var(--border);border-radius:12px;padding:.8rem 1rem;font-family:'DM Sans',sans-serif;font-size:.92rem;color:var(--ink);outline:none;transition:border-color .2s,box-shadow .2s,background .2s;}
        .field input:focus{border-color:var(--accent);box-shadow:0 0 0 3px rgba(14,168,126,.12);background:#fff;}
        .field input::placeholder{color:#bbb;}
        .ferr{font-size:.78rem;color:var(--red);font-weight:500;}
        .flash-error{display:flex;align-items:flex-start;gap:.75rem;background:#fff3f3;border:1px solid #fbc4c4;border-left:4px solid var(--red);color:#9b0000;border-radius:14px;padding:1rem 1.25rem;font-size:.88rem;margin-bottom:1.5rem;}
        .flash-error ul{margin-left:1rem;margin-top:.25rem;}
        .card-foot{padding:1.5rem 2rem;border-top:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;gap:1rem;flex-wrap:wrap;}
        .btn-cancel{display:inline-flex;align-items:center;gap:.4rem;background:transparent;border:1.5px solid var(--border);color:var(--muted);font-family:'Syne',sans-serif;font-weight:700;font-size:.82rem;letter-spacing:.04em;text-transform:uppercase;padding:.75rem 1.5rem;border-radius:100px;text-decoration:none;cursor:pointer;transition:all .2s;}
        .btn-cancel:hover{border-color:var(--ink);color:var(--ink);}
        .btn-save{display:inline-flex;align-items:center;gap:.5rem;background:var(--accent);color:#fff;font-family:'Syne',sans-serif;font-weight:700;font-size:.82rem;letter-spacing:.04em;text-transform:uppercase;padding:.75rem 1.75rem;border-radius:100px;border:none;cursor:pointer;transition:transform .2s,box-shadow .2s,filter .2s;}
        .btn-save:hover{filter:brightness(1.1);transform:translateY(-2px);box-shadow:0 10px 28px rgba(14,168,126,.35);}
        .btn-delete{display:inline-flex;align-items:center;gap:.4rem;background:transparent;border:1.5px solid #fbc4c4;color:var(--red);font-family:'Syne',sans-serif;font-weight:700;font-size:.78rem;letter-spacing:.04em;text-transform:uppercase;padding:.65rem 1.2rem;border-radius:100px;cursor:pointer;transition:all .2s;}
        .btn-delete:hover{background:#fff3f3;}
        @media(max-width:600px){.body{padding:1.5rem 1rem 3rem}.fg.c2{grid-template-columns:1fr}.hero{padding:1.75rem 1.25rem 1.5rem}.card-body{padding:1.25rem}.card-foot{padding:1.25rem;flex-direction:column-reverse}.btn-cancel,.btn-save,.btn-delete{width:100%;justify-content:center}}
    </style>
    <div class="root">
        <div class="hero">
            <div class="hero-inner">
                <a href="{{ route('clientes.index') }}" class="back">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
                    Clientes
                </a>
                <div class="divider"></div>
                <span class="hero-title">Editar Cliente</span>
            </div>
        </div>
        <div class="body">
            @if($errors->any())
                <div class="flash-error">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                </div>
            @endif
            <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
                @csrf @method('PUT')
                <div class="card">
                    <div class="card-head">
                        <div class="icon">👥</div>
                        <div><div class="card-title">Editar dados do cliente</div><div class="card-sub">#{{ $cliente->id }} · {{ $cliente->nome }}</div></div>
                    </div>
                    <div class="card-body">
                        <div class="fg">
                            <div class="field">
                                <label for="nome">Nome *</label>
                                <input type="text" id="nome" name="nome" value="{{ old('nome', $cliente->nome) }}" placeholder="Nome completo" required>
                                @error('nome')<span class="ferr">{{ $message }}</span>@enderror
                            </div>
                            <div class="fg c2">
                                <div class="field">
                                    <label for="cpf">CPF</label>
                                    <input type="text" id="cpf" name="cpf" value="{{ old('cpf', $cliente->cpf) }}" placeholder="000.000.000-00" maxlength="14" oninput="maskCpf(this)">
                                    @error('cpf')<span class="ferr">{{ $message }}</span>@enderror
                                </div>
                                <div class="field">
                                    <label for="telefone">Telefone</label>
                                    <input type="text" id="telefone" name="telefone" value="{{ old('telefone', $cliente->telefone) }}" placeholder="(00) 00000-0000" maxlength="15" oninput="maskTel(this)">
                                    @error('telefone')<span class="ferr">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-foot">
                        <div style="display:flex;gap:.6rem;align-items:center;justify-content:flex-end;width:100%;">
                            <a href="{{ route('clientes.index') }}" class="btn-cancel">Cancelar</a>
                            <button type="submit" class="btn-save">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                                Salvar alterações
                            </button>
                        </div>
                    </div>
                </div>
            </form>

            {{-- Excluir FORA do form de edição --}}
            <div style="margin-top:.75rem;">
                <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" onsubmit="return confirm('Excluir {{ $cliente->nome }}?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-delete">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/></svg>
                        Excluir cliente
                    </button>
                </form>
            </div>
        </div>
    </div>
    <script>
        function maskCpf(el){let v=el.value.replace(/\D/g,'').slice(0,11);v=v.replace(/(\d{3})(\d)/,'$1.$2');v=v.replace(/(\d{3})(\d)/,'$1.$2');v=v.replace(/(\d{3})(\d{1,2})$/,'$1-$2');el.value=v;}
        function maskTel(el){let v=el.value.replace(/\D/g,'').slice(0,11);if(v.length<=10)v=v.replace(/(\d{2})(\d{4})(\d{0,4})/,'($1) $2-$3');else v=v.replace(/(\d{2})(\d{5})(\d{0,4})/,'($1) $2-$3');el.value=v;}
    </script>
</x-app-layout>