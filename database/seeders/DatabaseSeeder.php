<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// Ajoute bien Result ici vvv
use App\Models\{Team, Tableau, Question, Answer, Result}; 
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Nettoyage complet
        DB::statement('PRAGMA foreign_keys = OFF');
        Team::truncate();
        Tableau::truncate();
        Question::truncate();
        Answer::truncate();
        Result::truncate();
        DB::statement('PRAGMA foreign_keys = ON');

        // ==========================================
        // 1. CRÉATION DES ÉQUIPES
        // ==========================================
        
        $vp = Team::create(['name' => 'Les Ventre-Plein', 'color_code' => 'bg-orange-500']);
        $mbd = Team::create(['name' => 'Les métros boulot dodo', 'color_code' => 'bg-gray-600']);
        $fash = Team::create(['name' => 'Les fashions', 'color_code' => 'bg-pink-500']);
        $gard = Team::create(['name' => 'La garderie', 'color_code' => 'bg-blue-400']);
        $nat = Team::create(['name' => 'Les naturistes', 'color_code' => 'bg-green-600']);

        // ==========================================
        // 2. CRÉATION DES TABLEAUX (INDICES & CODES)
        // ==========================================
        
        // --- Tableaux Ventre-Plein ---
        $tab_vp_1 = Tableau::create([
            'team_id' => $vp->id, 
            'title' => 'Les Fraises (Renoir)', 
            'description' => "C’est le seul tableau qui donne envie de les croquer.",
            'image_path' => 'img/renoir_fraises.jpg',
            'secret_code' => '2963'
        ]);
        $tab_vp_2 = Tableau::create([
            'team_id' => $vp->id, 
            'title' => 'Un coin des halles (Gilbert)', 
            'description' => "C'est le paradis des carnivores avec assez de viande pendue pour nourrir tout le quartier.",
            'image_path' => 'img/gilbert_halles.jpg',
            'secret_code' => '2356'
        ]);

        // --- Tableaux Fashions ---
        $tab_fash_1 = Tableau::create([
            'team_id' => $fash->id, 
            'title' => 'Femme se coiffant (Tournes)', 
            'description' => "Elle cherche désespérément à dompter son épi du matin.",
            'image_path' => 'img/tournes_coiffant.jpg',
            'secret_code' => '6767'
        ]);
        $tab_fash_2 = Tableau::create([
            'team_id' => $fash->id, 
            'title' => 'Le Miroir (Gervex)', 
            'description' => "Elle vérifie son reflet sous tous les angles pour être sûre que son profil est bien son meilleur côté.",
            'image_path' => 'img/gervex_miroir.jpg',
            'secret_code' => '5839'
        ]);
        $tab_fash_3 = Tableau::create([
            'team_id' => $fash->id, 
            'title' => 'La Houppe (Tournes)', 
            'description' => "Elle se tamponne comme si elle effaçait une preuve de crime.",
            'image_path' => 'img/tournes_houppe.jpg',
            'secret_code' => '1239'
        ]);

        // --- Tableaux Naturistes ---
        $tab_nat_1 = Tableau::create([
            'team_id' => $nat->id, 
            'title' => 'Matinée d’hiver (Smith)', 
            'description' => "C'est le tableau préféré des Bordelais qui adorent se geler devant la cathédrale en attendant un tram qui est sûrement en panne.",
            'image_path' => 'img/smith_hiver.jpg',
            'secret_code' => '1495'
        ]);
        $tab_nat_2 = Tableau::create([
            'team_id' => $nat->id, 
            'title' => 'Maison à Cagnes (Smith)', 
            'description' => "Le spot idéal pour se mettre en 'mode avion' définitif et regarder l'herbe pousser sous le soleil.",
            'image_path' => 'img/smith_cagnes.jpg',
            'secret_code' => '8648'
        ]);
        // Le Vieux Carrier est partagé, on utilise le même code et description
        $tab_nat_3 = Tableau::create([
            'team_id' => $nat->id, 
            'title' => 'Le Vieux Carrier (Roll)', 
            'description' => "Il te fixe avec l'air de celui qui est en train d'écrire ta lettre de licenciement.",
            'image_path' => 'img/roll_carrier.jpg',
            'secret_code' => '1212'
        ]);

        // --- Tableaux Garderie ---
        $tab_gard_1 = Tableau::create([
            'team_id' => $gard->id, 
            'title' => 'Portrait de fillette (Cassatt)', 
            'description' => "La petite a clairement épuisé son quota de patience et attend juste qu'on lui rende son doudou.",
            'image_path' => 'img/cassatt_fillette.jpg',
            'secret_code' => '7758'
        ]);
        $tab_gard_2 = Tableau::create([
            'team_id' => $gard->id, 
            'title' => 'Le neveu (Morisot)', 
            'description' => "Le regard d’un petit qui prépare une bêtise dès que vous aurez le dos tourné.",
            'image_path' => 'img/morisot_neveu.jpg',
            'secret_code' => '3482'
        ]);
        $tab_gard_3 = Tableau::create([
            'team_id' => $gard->id, 
            'title' => 'Mlle Picard (Zuloaga)', 
            'description' => "Le chic absolu qui vous juge en silence parce que votre tenue manque de panache.",
            'image_path' => 'img/zuloaga_picard.jpg',
            'secret_code' => '6484'
        ]);

        // --- Tableaux Métro Boulot Dodo ---
        $tab_mbd_1 = Tableau::create([
            'team_id' => $mbd->id, 
            'title' => 'Les Héritiers (Buland)', 
            'description' => "On dirait que tout le monde retient sa respiration dans la pièce. C'est le sommet du silence pesant.",
            'image_path' => 'img/buland_heritiers.jpg',
            'secret_code' => '9938'
        ]);
        $tab_mbd_2 = Tableau::create([
            'team_id' => $mbd->id, 
            'title' => 'Le Joaillier (Gilbert)', 
            'description' => "Il est tellement absorbé par sa petite création qu'il ne remarque même pas l'insecte.",
            'image_path' => 'img/gilbert_joaillier.jpg',
            'secret_code' => '3535'
        ]);
        // Le Vieux Carrier (version MBD)
        $tab_mbd_3 = Tableau::create([
            'team_id' => $mbd->id, 
            'title' => 'Le Vieux Carrier (Roll)', 
            'description' => "Il te fixe avec l'air de celui qui est en train d'écrire ta lettre de licenciement.",
            'image_path' => 'img/roll_carrier.jpg',
            'secret_code' => '1212'
        ]);


        // ==========================================
        // 3. PHASE 1 : LES 11 QUESTIONS GÉNÉRALES
        // ==========================================
        
        $questionsData = [
            1 => [
                'text' => "On te propose de tester une nouvelle activité, quelle est ta condition ?",
                'answers' => [
                    ['text' => "Est-ce qu'on peut s'arrêter en chemin si on voit un truc sympa ?", 'team' => $vp],
                    ['text' => "Est-ce que c'est utile pour mon futur ?", 'team' => $mbd],
                    ['text' => "Je peux voir à quoi ça ressemble d'abord ?", 'team' => $fash],
                    ['text' => "Est-ce que c'est fatigant physiquement ?", 'team' => $gard],
                    ['text' => "C'est possible de le faire loin de la ville ?", 'team' => $nat],
                ]
            ],
            2 => [
                'text' => "Qu'est-ce qui te rend le plus fier chez toi ?",
                'answers' => [
                    ['text' => "Mon sens du flair.", 'team' => $vp],
                    ['text' => "Mon efficacité à toute épreuve.", 'team' => $mbd],
                    ['text' => "Mon souci du détail.", 'team' => $fash],
                    ['text' => "Ma capacité à dire ce que je pense.", 'team' => $gard],
                    ['text' => "Mon besoin d'indépendance.", 'team' => $nat],
                ]
            ],
            3 => [
                'text' => "Ton comportement lors d'une fête ?",
                'answers' => [
                    ['text' => "Je fais le tour des buffets pour comparer.", 'team' => $vp],
                    ['text' => "Je vérifie que tout se passe selon le plan.", 'team' => $mbd],
                    ['text' => "Je cherche l'endroit où la lumière est la meilleure.", 'team' => $fash],
                    ['text' => "Je m'installe dans le coin le plus mou du canapé.", 'team' => $gard],
                    ['text' => "Je finis par discuter avec les plantes ou le chat.", 'team' => $nat],
                ]
            ],
            4 => [
                'text' => "Ta réaction quand ton téléphone tombe en panne ?",
                'answers' => [
                    ['text' => "Pas grave, ce soir je mange du poulet crousty.", 'team' => $vp],
                    ['text' => "C'est la panique, j'ai tous mes travaux dedans.", 'team' => $mbd],
                    ['text' => "Mais comment je vérifie mon allure ?", 'team' => $fash],
                    ['text' => "Tant mieux, plus personne ne peut me déranger.", 'team' => $gard],
                    ['text' => "Une libération, je me sens enfin libre.", 'team' => $nat],
                ]
            ],
            5 => [
                'text' => "Quel super-pouvoir aimerais-tu avoir ?",
                'answers' => [
                    ['text' => "Faire de l’argent à l’infini", 'team' => $vp],
                    ['text' => "Pouvoir figer le temps", 'team' => $mbd],
                    ['text' => "La transformation", 'team' => $fash],
                    ['text' => "Me téléporter", 'team' => $gard],
                    ['text' => "Devenir invisible", 'team' => $nat],
                ]
            ],
            6 => [
                'text' => "Ton type de vidéo préférée sur Internet ?",
                'answers' => [
                    ['text' => "Des recettes de cuisine ou des tests de restos.", 'team' => $vp],
                    ['text' => "Des tutos pour être plus organisé.", 'team' => $mbd],
                    ['text' => "Des conseils de style ou de coiffure.", 'team' => $fash],
                    ['text' => "Des vidéos de gens qui font des bêtises.", 'team' => $gard],
                    ['text' => "Des vidéos sur la nature et les animaux.", 'team' => $nat],
                ]
            ],
            7 => [
                'text' => "On te demande ton avis sur quelque chose, tu...",
                'answers' => [
                    ['text' => "J'attends de voir si ça a l'air 'appétissant'.", 'team' => $vp],
                    ['text' => "Je pèse le pour et le contre sérieusement.", 'team' => $mbd],
                    ['text' => "Je regarde si ça me met en valeur.", 'team' => $fash],
                    ['text' => "Je râle un peu, par habitude.", 'team' => $gard],
                    ['text' => "Je préfère ne pas me prononcer et rester discret.", 'team' => $nat],
                ]
            ],
            8 => [
                'text' => "Ton accessoire indispensable en vacances ?",
                'answers' => [
                    ['text' => "Une glacière pleine.", 'team' => $vp],
                    ['text' => "Une montre de sport connectée.", 'team' => $mbd],
                    ['text' => "Mes lunettes de soleil les plus chics.", 'team' => $fash],
                    ['text' => "Un doudou ou un coussin de voyage.", 'team' => $gard],
                    ['text' => "Une crème solaire", 'team' => $nat],
                ]
            ],
            9 => [
                'text' => "Ton idée d'une soirée parfaite ?",
                'answers' => [
                    ['text' => "Aller à un très bon restaurant", 'team' => $vp],
                    ['text' => "Avoir terminé tout ce que j'avais prévu.", 'team' => $mbd],
                    ['text' => "Une soirée où je suis le centre de l'attention.", 'team' => $fash],
                    ['text' => "Une soirée pyjama devant un film.", 'team' => $gard],
                    ['text' => "Une balade nocturne sous les étoiles.", 'team' => $nat],
                ]
            ],
            10 => [
                'text' => "Si tu étais un animal ?",
                'answers' => [
                    ['text' => "Un ours", 'team' => $vp],
                    ['text' => "Une fourmi travailleuse.", 'team' => $mbd],
                    ['text' => "Un paon majestueux.", 'team' => $fash],
                    ['text' => "Un chat grincheux qui dort 20h par jour.", 'team' => $gard],
                    ['text' => "Un caméléon qui se cache dans le décor.", 'team' => $nat],
                ]
            ],
            11 => [
                'text' => "C’est dimanche, 18h, tu es dans quel état ?",
                'answers' => [
                    ['text' => "En cuisine ou devant un site de livraison, l'important c'est le menu du soir.", 'team' => $vp],
                    ['text' => "En train de préparer mon sac et ma 'to-do list' pour attaquer la semaine.", 'team' => $mbd],
                    ['text' => "Devant mon miroir ou mon dressing pour tester des nouveaux combos.", 'team' => $fash],
                    ['text' => "En pyjama, en train de traîner sur mon téléphone ou de faire une sieste.", 'team' => $gard],
                    ['text' => "Dehors, n'importe où, tant que je suis loin du bruit et des gens.", 'team' => $nat],
                ]
            ],
        ];

        // Création boucle 1 à 11
        foreach ($questionsData as $i => $data) {
            $q = Question::create([
                'text' => $data['text'],
                'position' => $i,
                'team_id' => null
            ]);

            foreach ($data['answers'] as $ans) {
                Answer::create([
                    'question_id' => $q->id,
                    'text' => $ans['text'],
                    'team_id' => $ans['team']->id
                ]);
            }
        }


        // ==========================================
        // 4. PHASE 2 : QUESTIONS PERSONNALISÉES (Question 12)
        // ==========================================

        // --- Question Spécifique : VENTRE-PLEIN ---
        $q_vp = Question::create([
            'text' => "Qu'est-ce qui te fait le plus envie ?",
            'position' => 12,
            'team_id' => $vp->id
        ]);
        Answer::create(['question_id' => $q_vp->id, 'text' => "Un bon dessert avec des fruits frais et rien d'autre", 'tableau_id' => $tab_vp_1->id]);
        Answer::create(['question_id' => $q_vp->id, 'text' => "L'ambiance d'un marché avec du monde et de l'animation", 'tableau_id' => $tab_vp_2->id]);

        // --- Question Spécifique : FASHIONS ---
        $q_fash = Question::create([
            'text' => "C'est quoi ton rituel beauté ?",
            'position' => 12,
            'team_id' => $fash->id
        ]);
        Answer::create(['question_id' => $q_fash->id, 'text' => "Passer du temps à se coiffer pour que tout soit parfait", 'tableau_id' => $tab_fash_1->id]);
        Answer::create(['question_id' => $q_fash->id, 'text' => "Faire un dernier tour devant le miroir avant de partir", 'tableau_id' => $tab_fash_2->id]);
        Answer::create(['question_id' => $q_fash->id, 'text' => "Soigner les petits détails de maquillage ou de soin", 'tableau_id' => $tab_fash_3->id]);

        // --- Question Spécifique : NATURISTES ---
        $q_nat = Question::create([
            'text' => "C'est quoi ton plan pour être au calme ?",
            'position' => 12,
            'team_id' => $nat->id
        ]);
        Answer::create(['question_id' => $q_nat->id, 'text' => "Une balade en ville très tôt le matin quand il n'y a personne", 'tableau_id' => $tab_nat_1->id]);
        Answer::create(['question_id' => $q_nat->id, 'text' => "Partir dans une maison de vacances isolée au soleil", 'tableau_id' => $tab_nat_2->id]);
        Answer::create(['question_id' => $q_nat->id, 'text' => "Rester seul chez soi pour lire ou écrire tranquillement", 'tableau_id' => $tab_nat_3->id]);

        // --- Question Spécifique : LA GARDERIE ---
        $q_gard = Question::create([
            'text' => "Comment tu te comportes avec les autres ?",
            'position' => 12,
            'team_id' => $gard->id
        ]);
        Answer::create(['question_id' => $q_gard->id, 'text' => "Je suis expressif∙ve et ça se voit quand je ne suis pas bien", 'tableau_id' => $tab_gard_1->id]);
        Answer::create(['question_id' => $q_gard->id, 'text' => "J'ai besoin de bouger tout le temps, je ne tiens pas en place", 'tableau_id' => $tab_gard_2->id]);
        Answer::create(['question_id' => $q_gard->id, 'text' => "Je reste discret∙e et j'observe ce qui se passe autour de moi", 'tableau_id' => $tab_gard_3->id]);

        // --- Question Spécifique : MÉTROS BOULOT DODO ---
        $q_mbd = Question::create([
            'text' => "Quel est ton rapport au travail et aux responsabilités ?",
            'position' => 12,
            'team_id' => $mbd->id
        ]);
        Answer::create(['question_id' => $q_mbd->id, 'text' => "Tu es celui qu'on appelle pour régler les problèmes administratifs.", 'tableau_id' => $tab_mbd_1->id]);
        Answer::create(['question_id' => $q_mbd->id, 'text' => "Tu es un∙e passionné∙e, capable de rester concentré des heures.", 'tableau_id' => $tab_mbd_2->id]);
        Answer::create(['question_id' => $q_mbd->id, 'text' => "Tu es le bosseur de l'ombre, celui qui ne lâche rien.", 'tableau_id' => $tab_mbd_3->id]);
    }
}