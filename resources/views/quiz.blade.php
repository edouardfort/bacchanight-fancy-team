@extends('layout')

@section('content')

    <h2 class="text-4xl titre-fancy mb-2 relative inline-block drop-shadow-lg">
        @if($step <= 4) INTROSPECTION
        @elseif($step <= 8) OBSERVATION
        @else DÉDUCTION
        @endif
    </h2>

    <div class="text-2xl my-4 opacity-70 ornament-text">~ ❦ ~</div>

    <p class="text-xl mb-10 font-cinzel font-bold leading-relaxed px-4 drop-shadow-md">
        “{{ $question->text }}”
    </p>

    <form action="{{ route('quiz.store', $step) }}" method="POST">
        @csrf
        
        <div class="flex flex-col gap-5">
            @foreach($question->answers->shuffle() as $answer)
                <label class="cursor-pointer group relative">
                    <input type="radio" name="answer_id" value="{{ $answer->id }}" class="hidden" onchange="this.form.submit()">
                    
                    <div class="w-full p-5 rounded-2xl border border-[#1a5746] bg-gradient-to-r from-[#0a3a2e] to-[#062c22] shadow-md transition-all duration-300 group-hover:scale-[1.02] group-hover:border-[#2d7a67] group-hover:shadow-xl flex items-center justify-center min-h-[80px]">
                        
                        <span class="text-lg font-cinzel font-bold tracking-wide text-white group-hover:text-green-100 transition-colors">
                            {{ $answer->text }}
                        </span>

                    </div>
                </label>
            @endforeach
        </div>
    </form>

    <div class="mt-10 text-xs opacity-40 font-cinzel tracking-[0.2em]">
        — QUESTION {{ $step }} —
    </div>

@endsection