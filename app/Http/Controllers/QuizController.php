<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Question, Answer, Team, Tableau, Result};
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    // 1. Démarrer le quiz
    public function start() {
        session()->forget(['answers', 'winning_team', 'quiz_order']);
        
        // On récupère les ID des questions générales (celles qui n'ont pas de team_id)
        $questionIds = Question::whereNull('team_id')->pluck('id')->toArray();
        
        // On mélange les ID
        shuffle($questionIds);
        
        // On stocke cet ordre aléatoire en session
        session(['quiz_order' => $questionIds]);

        return redirect()->route('quiz.show', 1);
    }

    // 2. Afficher une question
    public function show($step)
    {
        // --- PHASE 1 : Questions Générales (1 à 11) ---
        if ($step <= 11) {
            // On récupère la liste mélangée
            $order = session('quiz_order');
            
            // Si pas d'ordre (bug session), on redémarre
            if (!$order) { return redirect()->route('quiz.start'); }

            // On prend l'ID correspondant à l'étape (step - 1 car tableau commence à 0)
            // On vérifie que l'étape existe dans le tableau
            if (!isset($order[$step - 1])) {
                abort(404, "Question introuvable");
            }

            $questionId = $order[$step - 1];

            $question = Question::with('answers')->findOrFail($questionId);
            
            return view('quiz', compact('question', 'step'));
        }

        // --- PHASE 2 : Question Personnalisée (12) ---
        if ($step == 12) {
            
            if (!session()->has('winning_team')) {
                $answers = session('answers', []);
                if (empty($answers)) { return redirect('/'); } 

                $counts = array_count_values($answers);
                arsort($counts);
                $winningTeamId = array_key_first($counts);
                
                session(['winning_team' => $winningTeamId]);
            }

            $teamId = session('winning_team');

            $question = Question::where('position', 12)
                                ->where('team_id', $teamId)
                                ->with('answers')
                                ->firstOrFail();

            return view('quiz', compact('question', 'step'));
        }

        abort(404);
    }

    // 3. Sauvegarder la réponse
    public function store(Request $request, $step)
    {
        $request->validate(['answer_id' => 'required|exists:answers,id']);
        $answer = Answer::find($request->answer_id);

        if ($step <= 11) {
            session()->push('answers', $answer->team_id);
            return redirect()->route('quiz.show', $step + 1);
        }

        if ($step == 12) {
            $tableauId = $answer->tableau_id;
            $teamId = session('winning_team');

            Result::create([
                'team_id' => $teamId,
                'tableau_id' => $tableauId
            ]);

            return redirect()->route('quiz.search', $tableauId);
        }
    }

    // 4. Page de Recherche
    public function search($tableauId)
    {
        $tableau = Tableau::findOrFail($tableauId);
        return view('search', compact('tableau'));
    }

    // 5. Vérif Code
    public function checkCode(Request $request, $tableauId)
    {
        $tableau = Tableau::findOrFail($tableauId);
        if (strtolower(trim($request->code)) === strtolower(trim($tableau->secret_code))) {
            return redirect()->route('quiz.result', $tableauId);
        } else {
            return back()->with('error', 'Code incorrect.');
        }
    }

    // 6. Résultat & Stats
    public function result($tableauId)
    {
        $tableau = Tableau::with('team')->findOrFail($tableauId);
        
        // 1. On récupère TOUTES les équipes
        $allTeams = Team::all();

        // 2. On récupère les comptes réels
        $counts = Result::select('team_id', DB::raw('count(*) as total'))
                       ->groupBy('team_id')
                       ->pluck('total', 'team_id') // Crée un tableau [team_id => total]
                       ->toArray();

        // 3. On fusionne pour que chaque équipe ait un count (même 0)
        foreach ($allTeams as $team) {
            $team->member_count = $counts[$team->id] ?? 0;
        }

        // On trie par nombre de membres décroissant pour l'affichage
        $stats = $allTeams->sortByDesc('member_count');

        return view('result', compact('tableau', 'stats'));
    }
}