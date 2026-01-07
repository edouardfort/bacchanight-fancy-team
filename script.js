// --- CONFIGURATION ---

// Les 4 tableaux possibles (Profils)
const paintings = {
    A: { title: "La Chasse aux Lions (Delacroix)", img: "url_image_A.jpg", count: 0 },
    B: { title: "Rolla (Gervex)", img: "url_image_B.jpg", count: 0 },
    C: { title: "Martyre de Saint Georges (Rubens)", img: "url_image_C.jpg", count: 0 },
    D: { title: "Portrait de Mme de Sorquainville", img: "url_image_D.jpg", count: 0 }
};


// script.js - Configuration
const paintings = {
    A: { 
        title: "La Chasse aux Lions", 
        img: "images/delacroix.jpg", 
        clue: "Je suis une scène violente et tourbillonnante. Cherchez des fauves et des turbans.",
        code: "CHASSE24" // Le code affiché physiquement à côté du tableau
    },
    B: { 
        title: "Rolla", 
        img: "images/gervex.jpg", 
        clue: "Cherchez un balcon, une lumière blanche et une scène intime au saut du lit.",
        code: "ROLLA33" 
    },
    // ... C et D
};

let calculatedResult = null; // On stocke le résultat ici en attendant la validation

// Les questions
// Chaque réponse donne 1 point à un tableau (A, B, C ou D)
const questions = [
    {
        text: "Dans une soirée, vous êtes plutôt...",
        options: [
            { text: "Au centre de l'attention, bruyant", type: "A" }, // Delacroix (Action)
            { text: "En train de discuter philosophie dans un coin", type: "D" }, // Calme
            { text: "Dramatique, vous vivez tout intensément", type: "B" }, // Romantique
            { text: "Héroïque, prêt à défendre vos amis", type: "C" } // Rubens
        ]
    },
    // ... Ajoutez vos 10 questions ici
    {
        text: "Votre couleur préférée parmi celles-ci ?",
        options: [
            { text: "Rouge sang", type: "A" },
            { text: "Bleu pastel", type: "D" },
            { text: "Blanc immaculé", type: "B" },
            { text: "Or éclatant", type: "C" }
        ]
    }
];

let currentQuestion = 0;
let scores = { A: 0, B: 0, C: 0, D: 0 };

// --- FONCTIONS ---

function startQuiz() {
    document.getElementById('intro').classList.remove('active');
    document.getElementById('quiz').classList.add('active');
    showQuestion();
}

function showQuestion() {
    let q = questions[currentQuestion];
    document.getElementById('question-text').textContent = q.text;
    document.getElementById('current-q').textContent = currentQuestion + 1;
    
    let optsDiv = document.getElementById('options');
    optsDiv.innerHTML = ""; // Vider les anciennes options
    
    q.options.forEach(opt => {
        let btn = document.createElement('button');
        btn.textContent = opt.text;
        btn.onclick = () => selectOption(opt.type);
        optsDiv.appendChild(btn);
    });
}

function selectOption(type) {
    scores[type]++; // Ajouter 1 point au tableau correspondant
    currentQuestion++;
    
    if (currentQuestion < questions.length) {
        showQuestion();
    } else {
        showResult();
    }
}

function showResult() {
    // 1. Calculer le gagnant
    let winnerKey = Object.keys(scores).reduce((a, b) => scores[a] > scores[b] ? a : b);
    calculatedResult = winnerKey; // On sauvegarde le résultat (ex: "A")
    
    // 2. Afficher l'écran d'indice (PAS ENCORE le résultat final)
    document.getElementById('quiz').classList.remove('active');
    document.getElementById('clue-screen').classList.add('active');
    
    // 3. Remplir l'indice
    document.getElementById('clue-text').textContent = paintings[winnerKey].clue;
}

function updateStats(winnerKey) {
    // Simulation pour l'instant (car pas de Backend connecté)
    console.log("Gagnant : " + winnerKey);
    // TODO: Connecter Firebase ici pour incrémenter le compteur du tableau gagnant
    
    // Exemple d'affichage simulé
    document.getElementById('global-stats').innerHTML = `
        <li>Tableau A : 12 joueurs</li>
        <li>Tableau B : 8 joueurs</li>
        <li>Tableau C : <b>${winnerKey === 'C' ? '(Vous) ' : ''}</b> 5 joueurs</li>
        <li>Tableau D : 20 joueurs</li>
    `;
}

function checkCode() {
    let input = document.getElementById('player-code').value.toUpperCase().trim();
    let correctCode = paintings[calculatedResult].code;

    if (input === correctCode) {
        // C'est gagné !
        revealFinalScreen();
    } else {
        // Erreur
        document.getElementById('error-msg').style.display = 'block';
        document.getElementById('error-msg').textContent = "Code incorrect. Avez-vous trouvé le bon tableau ?";
    }
}

function revealFinalScreen() {
    let resultData = paintings[calculatedResult];
    
    document.getElementById('clue-screen').classList.remove('active');
    document.getElementById('result').classList.add('active');
    
    document.getElementById('result-title').textContent = resultData.title;
    // document.getElementById('result-img').src = resultData.img;

    // C'est SEULEMENT maintenant qu'on envoie la stat à la base de données
    updateFirebaseStats(calculatedResult);
}

function updateFirebaseStats(paintingID) {
    const statsRef = db.ref('stats');
    
    // 1. Incrémenter le compteur du tableau gagnant de manière atomique (sécurisé)
    // Cela évite les bugs si 2 personnes finissent en même temps
    statsRef.child(paintingID).set(firebase.database.ServerValue.increment(1));

    // 2. Écouter les mises à jour pour afficher les stats globales
    // .once('value') lit une seule fois. .on('value') mettrait à jour en temps réel si d'autres jouent.
    statsRef.once('value').then((snapshot) => {
        const data = snapshot.val() || { A:0, B:0, C:0, D:0 }; // Valeurs par défaut
        
        // Calcul du total de joueurs
        let total = (data.A || 0) + (data.B || 0) + (data.C || 0) + (data.D || 0);
        
        // Affichage dans le HTML
        let htmlContent = "";
        
        // On boucle sur nos tableaux (A, B, C, D)
        for (let key in paintings) {
            let count = data[key] || 0;
            let percent = total > 0 ? Math.round((count / total) * 100) : 0;
            
            // Mise en forme
            let isUser = (key === paintingID) ? "style='font-weight:bold; color:#d4af37;'" : "";
            htmlContent += `<li ${isUser}>${paintings[key].title} : ${count} joueurs (${percent}%)</li>`;
        }
        
        document.getElementById('global-stats').innerHTML = htmlContent;
    });
}
