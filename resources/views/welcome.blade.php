@extends('layout')

@section('content')
    
    <div class="mb-8 text-sm tracking-[0.3em] opacity-60 uppercase font-cinzel">
        Bacchanight 2026
    </div>

    <div class="opacity-70 ornament-text text-xl">~ ❦ ~</div>

    <h1 class="text-5xl md:text-7xl my-8 leading-tight drop-shadow-xl font-cinzel">
        QUEL<br>
        <span class="text-green-100">TABLEAU</span><br>
        ES-TU ?
    </h1>

    <div class="opacity-70 ornament-text text-xl mb-12">~ ❦ ~</div>

    <div>
        <a href="{{ route('quiz.start') }}" class="btn-baccha group block w-full py-4 rounded-full flex flex-col items-center justify-center text-white">
            <span class="ornament-text text-xs opacity-50 -mb-1 group-hover:opacity-80 transition-opacity">~ ❦ ~</span>
            <span class="text-xl uppercase tracking-[0.15em] font-cinzel font-bold drop-shadow-sm">Commencer</span>
            <span class="ornament-text text-xs opacity-50 -mt-1 group-hover:opacity-80 transition-opacity transform rotate-180">~ ❦ ~</span>
        </a>
    </div>

@endsection