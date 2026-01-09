@extends('layout')

@section('content')

    <div id="loading-screen" class="fixed inset-0 z-50 flex flex-col items-center justify-center bg-[#052e23] text-center p-6">
        <h2 class="text-5xl titre-fancy mb-4">ANALYSE</h2>
        <div class="ornament text-white">~ ❦ ~</div>
        
        <p class="text-lg italic mb-8">Tu es plus du genre ?</p> <p class="text-sm opacity-80 mb-8 max-w-xs mx-auto">
            Le système interroge les portraits et parcourt les siècles (il y a du dossier)...
        </p>

        <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-b-4 border-white mx-auto mb-6"></div>
    </div>

    <div id="search-content" class="hidden animate-fade-in">
        
        <h2 class="text-5xl titre-fancy mb-2">INSPECTION</h2>
        <div class="ornament text-2xl">~ ❦ ~</div>

        <h3 class="text-xl font-bold mt-4 mb-2">Votre tableau a été défini !</h3>
        <p class="text-sm opacity-80 mb-6">
            D'après vos réponses, votre tableau totem se cache dans la salle...
        </p>

        <div class="my-6">
            <h4 class="font-bold text-lg mb-2">Votre Indice :</h4>
            <div class="bg-[#0f3d30] border border-green-700 p-4 rounded-xl shadow-inner italic">
                "{{ $tableau->description }}"
            </div>
            <button class="mt-2 text-xs text-green-300 underline">Le super Indice</button>
        </div>

        <div class="ornament text-xl">~ ❦ ~</div>

        <p class="uppercase text-xs tracking-widest mb-2 font-bold">Trouvez le tableau et entrez le code inscrit sur son cartel :</p>

        @if(session('error'))
            <div class="text-red-400 font-bold mb-2 animate-pulse">{{ session('error') }}</div>
        @endif

        <form action="{{ route('quiz.check', $tableau->id) }}" method="POST" class="mt-4">
            @csrf
            
            <input type="text" name="code" placeholder="CODE" required
                   class="w-full p-4 rounded-xl bg-[#0a3a2e]/50 text-white placeholder-white/30 text-center text-2xl font-cinzel font-bold uppercase tracking-[0.2em] outline-none border-2 border-[#1a5746] focus:border-[#2d7a67] focus:bg-[#0a3a2e] shadow-inner mb-8 transition-all">

            <button type="submit" class="btn-baccha group w-full py-4 rounded-full flex flex-col items-center justify-center text-white">
                <span class="ornament-text text-xs opacity-50 -mb-1 group-hover:opacity-80 transition-opacity">~ ❦ ~</span>
                <span class="text-xl uppercase tracking-[0.15em] font-cinzel font-bold drop-shadow-sm">Valider</span>
                <span class="ornament-text text-xs opacity-50 -mt-1 group-hover:opacity-80 transition-opacity transform rotate-180">~ ❦ ~</span>
            </button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                document.getElementById('loading-screen').style.display = 'none';
                document.getElementById('search-content').classList.remove('hidden');
            }, 3000); 
        });
    </script>

@endsection