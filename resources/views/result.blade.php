@extends('layout')

@section('content')

    {{-- 
       CONFIGURATION DES TEXTES PERSONNALISÉS 
       On définit ici les descriptions en fonction des mots-clés du titre du tableau.
    --}}
    @php
        $descriptions = [
            'coiffant' => [
                'why' => "Parce que ton reflet est ton meilleur coach, mais aussi ton pire patron.",
                'profile' => "Tu es la personne qui \"vérifie juste un détail\" et qu'on ne revoit plus pendant vingt minutes. Que ce soit pour dompter un épi, ajuster une mèche ou simplement t'assurer que ta tête est compatible avec l'extérieur, tu ne lâches pas l'affaire. Pour toi, sortir avec un cheveu de travers, c'est la cata.",
                'motto' => "Je n'ai pas de retard, je peaufine mon charisme."
            ],
            'Houppe' => [
                'why' => "Tu es le maître de la finition. Tu sais que la vraie classe réside dans le détail subtil que personne ne voit, mais qui change tout.",
                'profile' => "Tu incarnes l'élégance douce. Tu te tamponnes le visage avec autant de conviction que si tu effaçais des preuves après un crime. Tout est dans la nuance et le geste parfait.",
                'motto' => "La beauté est dans le dernier coup de poudre."
            ],
            'fraises' => [
                'why' => "Tu es l'incarnation de la spontanéité. Tu vis dans l'instant présent et tu ne sais pas résister à une bonne tentation.",
                'profile' => "Tu as ce côté solaire qui attire les gens, mais on sait que ta loyauté va d'abord à ce qu'il y a dans ton assiette. Tu es la personne qui organise sa journée en fonction de ce qu'elle va manger le soir.",
                'motto' => "Le bonheur ne s'achète pas, il se déguste."
            ],
            'halles' => [
                'why' => "Tu es un aimant social. Pour toi, la nourriture n'est qu'un prétexte pour te plonger dans le chaos joyeux de la foule et des potins.",
                'profile' => "Tu es l'expert des rencontres de comptoir. Tu connais la vie de la boulangère et du livreur de kebab. Ton habitat naturel, c'est là où ça parle fort et où ça sent bon le graillon.",
                'motto' => "S'il n'y a pas de bruit, c'est que la bouffe est mauvaise."
            ],
            'Pey-Berland' => [
                'why' => "Tu es un poète urbain. Tu trouves ta sérénité dans le froid et le silence d'un monde qui n'a pas encore allumé son téléphone.",
                'profile' => "Tu as un jardin secret immense. Tu préfères marcher seul dans le brouillard avec tes écouteurs plutôt que de subir une conversation sur la météo. Tu es physiquement là, mais ton esprit est déjà loin.",
                'motto' => "Le silence est mon luxe préféré."
            ],
            'Cagnes' => [
                'why' => "Tu es un chercheur de \"Mode Avion\". Ton idéal est de te construire une bulle de lumière loin des notifications et du stress.",
                'profile' => "Tu as une sainte horreur du bruit inutile. Ta maison (ou ta chambre) est ton sanctuaire. Tu sais apprécier le silence mieux que n'importe quelle soirée branchée.",
                'motto' => "Vivre caché pour vivre mieux."
            ],
            'Carrier' => [
                'why' => "Tu es la force brute. Tu es celui qui ne lâche rien, même quand la tâche est ingrate ou que tout le monde a déjà abandonné.",
                'profile' => "Tu ne te plains jamais, tu avances. Tu as l'air de celui qui pourrait écrire une lettre de licenciement avec un calme olympien. On sait que si tu commences un truc, tu le finiras, par pur principe.",
                'motto' => "Moins de parlotte, plus de résultats."
            ],
            'fillette' => [
                'why' => "Tu es l'intégrité pure (et un peu têtue). Ton visage est un livre ouvert et tu refuses de sourire si tu n'as pas envie.",
                'profile' => "Si l'ambiance ne te plaît pas, tu boudes avec une classe monumentale. On t'apprécie pour ton honnêteté radicale : avec toi, c'est \"vrai\" ou c'est rien du tout.",
                'motto' => "Mon regard dit ce que ma bouche retient."
            ],
            'neveu' => [
                'why' => "Tu es l'explorateur né. Tu as gardé cette curiosité qui te pousse à toucher à tout, surtout à ce qui est interdit.",
                'profile' => "Tu es l'étincelle du groupe. Tu ne tiens pas en place, tu poses les questions qui gênent et tu transformes n'importe quelle sortie calme en aventure un peu chaotique.",
                'motto' => "Pourquoi rester sage quand on peut tester ?"
            ],
            'miroir' => [
                'why' => "Parce que tu sais que le look est une affaire de stratégie et de précision.",
                'profile' => "Tu es le maniaque du détail. Avant de sortir avec la famille, il te faut ce tête-à-tête avec ton reflet pour être sûr que tout est bon. Tu es ton propre coach et ta propre critique.",
                'motto' => "Une dernière vérification, au cas où, je vais les choquer."
            ],
            'Picard' => [
                'why' => "Parce que tu es la force tranquille qui n'a pas besoin de crier pour se faire respecter.",
                'profile' => "Tu as ce côté \"chef de famille\" avant l'heure. Tu observes tout, tu analyses tout, et tu repères les bêtises avant même qu’elles ne soient faites. Ton calme est ton super-pouvoir (et parfois ta meilleure menace).",
                'motto' => "Je ne juge pas, j’observe… mais je juge un peu quand même."
            ],
            'héritiers' => [
                'why' => "Tu es le garant du sérieux. Tu as une maturité qui dépasse souvent celle de ton âge.",
                'profile' => "Tu es le \"notaire\" du groupe. Quand il faut diviser l'addition ou lire les petites lignes d'un contrat, c'est vers toi qu'on se tourne car tu es le seul à ne pas paniquer devant un formulaire.",
                'motto' => "On rigolera quand les comptes seront bons."
            ],
            'Joaillier' => [
                'why' => "Tu es le maniaque de la bande. Tu as une capacité de concentration qui fait peur.",
                'profile' => "Tu as l’œil d’un expert. Pendant que les autres bâclent, toi tu vérifies Bienngg. Tu es tellement focus que personne peut te distraire.",
                'motto' => "La précision est une forme de politesse (et une obsession)."
            ],
        ];

        // Logique de récupération du texte
        $currentDetail = null;
        foreach ($descriptions as $key => $detail) {
            // On cherche si un mot clé (ex: 'fraises') est dans le titre du tableau
            if (stripos($tableau->title, $key) !== false) {
                $currentDetail = $detail;
                break;
            }
        }
        
        // Fallback si pas trouvé (sécurité)
        if (!$currentDetail) {
            $currentDetail = [
                'why' => "Tu es un mystère complet.",
                'profile' => "Ton profil est aussi unique que ce tableau. Une personnalité rare qui mérite d'être étudiée davantage.",
                'motto' => "L'art est un mystère, et moi aussi."
            ];
        }
    @endphp


    <div id="resultat-screen" class="flex flex-col items-center justify-center py-6 w-full animate-fade-in-up">
        
        <h2 class="text-4xl md:text-5xl titre-fancy mb-6 relative drop-shadow-lg text-white">
            RÉSULTAT
            <span class="absolute -right-4 -top-2 text-xl opacity-80">✨</span>
        </h2>
        
        <div class="ornament-text text-2xl text-white/60 mb-6">~ ❦ ~</div>

        <div class="mb-8 w-full max-w-sm px-4">
            <p class="text-xs uppercase tracking-widest mb-2 opacity-80 font-cinzel text-center">Vous appartenez à la maison</p>
            
            <div class="bg-gradient-to-br from-[#0d352b] to-[#041812] p-6 rounded-2xl border border-[#2d7a67] shadow-2xl relative overflow-hidden group text-center flex flex-col items-center">
                <div class="absolute top-0 right-0 w-32 h-32 bg-green-500/10 rounded-full blur-3xl -mr-10 -mt-10"></div>
                
                <div class="h-28 w-28 mb-4 relative drop-shadow-[0_0_15px_rgba(255,255,255,0.2)] hover:scale-105 transition-transform duration-500">
                    <img src="{{ asset('img/teams/' . $tableau->team->id . '.png') }}" 
                         alt="Blason {{ $tableau->team->name }}" 
                         class="w-full h-full object-contain"
                         onerror="this.style.display='none'">
                </div>

                <h3 class="text-3xl font-cinzel font-bold text-green-100 mb-2 drop-shadow-md">
                    {{ $tableau->team->name }}
                </h3>
                <div class="h-1 w-24 bg-[#2d7a67] mx-auto rounded-full mb-4"></div>
                <p class="italic opacity-80 text-sm font-serif">
                    "Une lignée d'esprit et de caractère."
                </p>
            </div>
        </div>

        <div class="bg-[#08241b]/90 p-6 rounded-3xl shadow-xl border border-green-800/50 w-full max-w-lg backdrop-blur-sm mx-4">
            
            <p class="text-sm uppercase tracking-widest mb-4 font-bold text-[#2d7a67] text-center">Votre âme sœur picturale</p>

            <h3 class="font-cinzel text-2xl leading-relaxed text-white drop-shadow-md text-center mb-6">
                {{ $tableau->title }}
            </h3>

            <div class="ornament-text text-xl text-white/40 mb-6 text-center">~ ❦ ~</div>

            <div class="text-left space-y-6 bg-[#051f18] p-5 rounded-xl border border-[#1a5746] shadow-inner">
                
                <div>
                    <h4 class="font-cinzel font-bold text-[#4ade80] text-sm uppercase tracking-widest mb-1">
                        Pourquoi toi ?
                    </h4>
                    <p class="text-green-50 text-sm leading-relaxed opacity-90">
                        {{ $currentDetail['why'] }}
                    </p>
                </div>

                <div>
                    <h4 class="font-cinzel font-bold text-[#4ade80] text-sm uppercase tracking-widest mb-1">
                        Ton profil
                    </h4>
                    <p class="text-green-50 text-sm leading-relaxed opacity-90">
                        {{ $currentDetail['profile'] }}
                    </p>
                </div>

                <div class="pt-2 border-t border-white/10 mt-4">
                    <p class="font-cinzel italic text-lg text-white text-center">
                        « {{ $currentDetail['motto'] }} »
                    </p>
                </div>

            </div>

        </div>

        <div class="mt-8 animate-bounce opacity-50 cursor-pointer text-white" onclick="document.getElementById('stats-screen').scrollIntoView({behavior: 'smooth'})">
            <svg class="w-8 h-8 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
        </div>
    </div>


    <div id="stats-screen" class="w-full max-w-md mt-16 pt-10 border-t border-white/10 px-4">
        
        <h2 class="text-3xl titre-fancy mb-8 text-center leading-tight text-white">
            LES AUTRES MAISONS
        </h2>

        <div class="space-y-4 w-full">
            
            @foreach($stats as $team)
                <div class="relative flex items-center justify-between bg-[#0a2e24] p-4 rounded-xl border border-[#1a5746] shadow-lg overflow-hidden group hover:border-[#2d7a67] transition-colors">
                    
                    <div class="absolute left-0 top-0 bottom-0 w-2 {{ $team->color_code }} opacity-80"></div>

                    <div class="flex items-center pl-4">
                        
                        <div class="h-12 w-12 mr-4 flex-shrink-0 drop-shadow-md">
                            <img src="{{ asset('img/teams/' . $team->id . '.png') }}" 
                                 alt="{{ $team->name }}" 
                                 class="w-full h-full object-contain"
                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
                            
                            <div class="hidden h-full w-full rounded-full bg-white/5 border border-white/10 items-center justify-center font-cinzel font-bold text-lg text-white">
                                {{ substr($team->name, 0, 1) }}
                            </div>
                        </div>

                        <div class="text-left">
                            <h4 class="font-bold text-lg font-cinzel text-green-50">{{ $team->name }}</h4>
                        </div>
                    </div>

                    <div class="text-right pr-2 text-white">
                        <span class="text-2xl font-bold block leading-none">{{ $team->member_count }}</span>
                        <span class="text-[10px] uppercase tracking-wider opacity-50">Membres</span>
                    </div>
                </div>
            @endforeach

        </div>

        <div class="mt-12 mb-8">
            <a href="{{ route('quiz.start') }}" class="btn-baccha group block w-full py-4 rounded-full flex flex-col items-center justify-center text-white opacity-90 hover:opacity-100">
                 <span class="ornament-text text-xs opacity-50 -mb-1">~ ❦ ~</span>
                <span class="text-base uppercase tracking-[0.1em] font-cinzel font-bold">Menu Principal</span>
                 <span class="ornament-text text-xs opacity-50 -mt-1 transform rotate-180">~ ❦ ~</span>
            </a>
        </div>
    </div>

@endsection