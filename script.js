/* =========================================
   1. DONNÉES ET CONFIGURATION
   ========================================= */

   const paintings = {
    A: { 
        title: "La Chasse aux Lions (Delacroix)", 
        img: "images/delacroix.jpg", 
        clue: "Je suis une scène violente et tourbillonnante. Cherchez des fauves et des turbans.",
        code: "CHASSE24" 
    },
    B: { 
        title: "Rolla (Gervex)", 
        img: "images/gervex.jpg", 
        clue: "Cherchez un balcon, une lumière blanche et une scène intime au saut du lit.",
        code: "ROLLA33" 
    },
    C: { 
        title: "Martyre de Saint Georges (Rubens)", 
        img: "images/rubens.jpg", 
        clue: "Cherchez un cheval blanc, un dragon et une scène héroïque.",
        code: "RUBENS10"
    },
    D: { 
        title: "Portrait de Mme de Sorquainville", 
        img: "images/sorquainville.jpg", 
        clue: "Cherchez le calme, une robe soyeuse et un regard mystérieux.",
        code: "MME78"
    }
};

const questions = [
    {
        text: "Dans une soirée, vous êtes plutôt...",
        options: [
            { text: "Au centre de l'attention, bruyant", type: "A" },
            { text: "En train de discuter philosophie", type: "D" },
            { text: "Dramatique, tout est intense", type: "B" },
            { text: "Héroïque, protecteur", type: "C" }
        ]
    },
    {
        text: "Votre couleur préférée ?",
        options: [
            { text: "Rouge sang", type: "A" },
            { text: "Bleu pastel", type: "D" },
            { text: "Blanc immaculé", type: "B" },
            { text: "Or éclatant", type: "C" }
        ]
    }
    // Ajoutez vos autres questions ici...
];

// --- VARIABLES D'ÉTAT ---
let currentQuestion = 0;
let scores = { A: 0, B: 0, C: 0, D: 0 };
let calculatedResult = null; // Stocke la lettre gagnante (ex: "A")

/* =========================================
   2. LOGIQUE DU QUIZ
   ========================================= */

function startQuiz() {
    switchScreen('intro', 'quiz');
    showQuestion();
}

function showQuestion() {
    // Sécurité : si on dépasse le nombre de questions
    if (currentQuestion >= questions.length) {
        calculateAndShowClue();
        return;
    }

    let q = questions[currentQuestion];
    document.getElementById('question-text').textContent = q.text;
    document.getElementById('current-q').textContent = currentQuestion + 1;
    
    let optsDiv = document.getElementById('options');
    optsDiv.innerHTML = ""; // Nettoyage
    
    q.options.forEach(opt => {
        let btn = document.createElement('button');
        btn.textContent = opt.text;
        // Animation au clic
        btn.onclick = () => {
            selectOption(opt.type);
        };
        optsDiv.appendChild(btn);
    });
}

function selectOption(type) {
    if (scores[type] !== undefined) {
        scores[type]++;
    }
    currentQuestion++;
    
    if (currentQuestion < questions.length) {
        showQuestion();
    } else {
        calculateAndShowClue();
    }
}

function switchScreen(fromId, toId) {
    document.getElementById(fromId).classList.remove('active');
    document.getElementById(toId).classList.add('active');
}

/* =========================================
   3. RÉSULTATS ET INDICES
   ========================================= */

function calculateAndShowClue() {
    // Trouve le score le plus élevé
    // En cas d'égalité, le premier trouvé gagne (A > B > C > D)
    let winnerKey = Object.keys(scores).reduce((a, b) => scores[a] >= scores[b] ? a : b);
    
    // SÉCURITÉ : Vérifie que le gagnant existe bien dans la liste 'paintings'
    if (!paintings[winnerKey]) {
        console.error("Erreur critique : Gagnant " + winnerKey + " non trouvé.");
        winnerKey = "A"; // Fallback par défaut pour éviter le crash
    }

    calculatedResult = winnerKey;
    
    // Affichage de l'indice
    switchScreen('quiz', 'clue-screen');
    document.getElementById('clue-text').textContent = paintings[winnerKey].clue;
}

function checkCode() {
    const input = document.getElementById('player-code');
    const errorMsg = document.getElementById('error-msg');
    const userCode = input.value.toUpperCase().trim();
    const correctCode = paintings[calculatedResult].code;

    if (userCode === correctCode) {
        revealFinalScreen();
    } else {
        errorMsg.style.display = 'block';
        input.classList.add('shake'); // Ajoute un petit effet visuel si vous le mettez en CSS
        setTimeout(() => input.classList.remove('shake'), 500);
    }
}

function revealFinalScreen() {
    let resultData = paintings[calculatedResult];
    
    switchScreen('clue-screen', 'result');
    
    document.getElementById('result-title').textContent = resultData.title;
    // document.getElementById('result-img').src = resultData.img; // Activer si image dispo

    // Envoi à la base de données
    updateFirebaseStats(calculatedResult);
}

/* =========================================
   4. INTERACTION FIREBASE
   ========================================= */

function updateFirebaseStats(paintingID) {
    if (!db) return; // Sécurité si Firebase n'a pas chargé

    const statsRef = db.ref('stats');
    
    // 1. Incrémenter le compteur
    statsRef.child(paintingID).set(firebase.database.ServerValue.increment(1));

    // 2. Lire les stats pour affichage
    statsRef.once('value').then((snapshot) => {
        const data = snapshot.val() || { A:0, B:0, C:0, D:0 };
        let total = (data.A || 0) + (data.B || 0) + (data.C || 0) + (data.D || 0);
        
        let htmlContent = "";
        
        for (let key in paintings) {
            let count = data[key] || 0;
            let percent = total > 0 ? Math.round((count / total) * 100) : 0;
            
            let highlight = (key === paintingID) ? "style='font-weight:bold; color:#d4af37;'" : "";
            
            htmlContent += `
                <li ${highlight}>
                    ${paintings[key].title} : ${percent}% 
                    <small>(${count})</small>
                </li>`;
        }
        
        document.getElementById('global-stats').innerHTML = htmlContent;
    });
}

// GESTION "EN LIGNE" (Présence)
// S'exécute automatiquement au chargement du script
if (db) {
    const connectedRef = db.ref(".info/connected");
    const conListRef = db.ref("connections");
    const myConRef = conListRef.push();

    connectedRef.on("value", (snap) => {
        if (snap.val() === true) {
            myConRef.set(true);
            myConRef.onDisconnect().remove();
        }
    });
}