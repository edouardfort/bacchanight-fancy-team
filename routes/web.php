<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. Page d'accueil
Route::get('/', function () {
    return view('welcome');
});

// 2. Démarrage du Quiz (Reset des sessions) -> C'est ici qu'il manquait le name('quiz.start')
Route::get('/start', [QuizController::class, 'start'])->name('quiz.start');

// 3. Affichage d'une question
Route::get('/quiz/{step}', [QuizController::class, 'show'])->name('quiz.show');

// 4. Enregistrement d'une réponse
Route::post('/quiz/{step}', [QuizController::class, 'store'])->name('quiz.store');

// 5. Page de Recherche (Indice + Input Code)
Route::get('/search/{tableauId}', [QuizController::class, 'search'])->name('quiz.search');

// 6. Vérification du Code Secret
Route::post('/check/{tableauId}', [QuizController::class, 'checkCode'])->name('quiz.check');

// 7. Page de Résultat Final
Route::get('/result/{tableauId}', [QuizController::class, 'result'])->name('quiz.result');