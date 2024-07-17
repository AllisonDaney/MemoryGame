@extends('layout')
@section('title', 'Memory Game - Home')

@section('content')
    <main id="mainContent" class="relative h-screen grid place-content-center">
        <p id="error" class="hidden text-red-500">Veuillez rentrer votre pseudo</p>
        <form id='formPlay'class="max-w-sm mx-auto border border-genoa-300 rounded-md shadow-md p-6">
            <div class="mb-5">
                <label for="pseudo" class="block mb-2 text-sm font-medium text-genoa-950 ">Votre pseudo</label>
                <input type="text" id="pseudo"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-genoa-950 focus:border-genoa-950 block w-full p-2.5 "
                    placeholder="pseudo" required />
            </div>
            <button type="submit" id="toggleForm"
                class="  text-masala-50 bg-genoa-600 hover:bg-genoa-950 focus:ring-4 focus:ring-genoa-950 font-medium rounded-lg text-m flex items-center justify-center p-2">Play</button>
        </form>
        <h1 id="displayPseudo" class="hidden"></h1>
        <div id="resultat" class="flex-col items-center justify-center gap-4 hidden"></div>
        <div id="winner" class="text-3xl hidden">
            <p>Bravo <span id="winnerPseudo"></span></p> <br>
            <p>Vous avez gagné : <span id="winnerPoints"></span> points</p>
            <br>
            <button id="playAgain"
                class="text-masala-50 bg-genoa-600 hover:bg-genoa-950 focus:ring-4 focus:ring-genoa-950 font-medium rounded-lg text-m items-center justify-center p-2">Play
                again</button>
        </div>
    </main>
    <script>
        //Sélection des élements du DOM
        const toggleFormEl = document.querySelector("#toggleForm")
        const formPlayEl = document.querySelector("#formPlay")
        const resultatEl = document.querySelector("#resultat")
        const pseudoEl = document.querySelector("#pseudo")
        const errorEl = document.querySelector("#error")
        const displayPseudoEl = document.querySelector("#displayPseudo")
        const playAgainEl = document.querySelector("#playAgain")
        const winnerEl = document.querySelector("#winner")
        const winnerPseudoEl = document.querySelector("#winnerPseudo")
        const winnerPointsEl = document.querySelector("#winnerPoints")

        // Validation du formulaire 
        toggleFormEl.addEventListener('click', (e) => {
            e.preventDefault()

            // Si pseudo est rempli      
            if (pseudo.value) {
                localStorage.setItem('pseudo', pseudo.value) //stockage du pseudo
                formPlay.classList.add('hidden') //masque le formulaire
                error.classList.add('hidden') //masque le message d'erreur

                resultat.classList.add('flex')
                resultat.classList.remove('hidden')

                displayPseudo.classList.remove('hidden')
                displayPseudo.innerHTML = pseudo.value //Affiche le pseudo
            } else { // Sinon
                error.classList.remove('hidden') //message erreur
                pseudo.classList.add('!border-red-500')
            }
        })

        // Initialisation des images 
        // Liste des images avec chemin + compteur d'utilisation
        let images = [{
                key: 1,
                imagePath: '/img/girafe.jpg',
                count: 0
            },
            {
                key: 2,
                imagePath: '/img/gorille.jpg',
                count: 0
            },
            {
                key: 3,
                imagePath: '/img/hyene.jpg',
                count: 0
            },
            {
                key: 4,
                imagePath: '/img/lion.jpg',
                count: 0
            },
            {
                key: 5,
                imagePath: '/img/rhinoceros.jpg',
                count: 0
            },
            {
                key: 6,
                imagePath: '/img/singe.jpg',
                count: 0
            },
            {
                key: 7,
                imagePath: '/img/zebre.jpg',
                count: 0
            },
            {
                key: 8,
                imagePath: '/img/elephant.jpg',
                count: 0
            }
        ]

        // Initialisation de la grille de jeu 
        let game = [
            [0, 0, 0, 0],
            [0, 0, 0, 0],
            [0, 0, 0, 0],
            [0, 0, 0, 0]
        ]

        //Génération d'un tableau avec des paires d'images aléatoires
        const generateResult = () => {
            const result = []

            for (let rowIndex in game) {
                // Une ligne
                let row = []

                for (let colIndex in game[rowIndex]) {
                    // Une colonne
                    // Une carte = game[rowIndex][colIndex]
                    let end = false;

                    while (!end) { //répétition jusqu'à une image disponible
                        let index = Math.floor(Math.random() * images.length) //choix image aléatoire
                        let imageIndex = images.findIndex((obj) => obj.key === index + 1)

                        if (images[imageIndex].count < 2) { // si l'image n'est pas utilisé deux fois
                            row.push(index + 1) //ajouter image a la ligne
                            images[imageIndex].count++ //incrémenter le compteur de l'image
                            end = true
                        }
                    }
                }

                result.push(row) //ajouter la ligne au résultat
            }

            return result
        }

        // GameResult contient les résultats du tableau généré
        let gameResult = generateResult()
        let oldSelection = []
        let oldGame = []
        let isReady = true

        // Réinitialisation du jeu    
        const resetGame = () => {
            oldSelection = []
            oldGame = []
            isReady = true
            game = [
                [0, 0, 0, 0],
                [0, 0, 0, 0],
                [0, 0, 0, 0],
                [0, 0, 0, 0]
            ]
            images.forEach((image) => {
                image.count = 0
            })
        }

        // Déclaration du gagnant
        const setWinner = () => {
            const currentPoint = localStorage.getItem('point')

            resultatEl.classList.add('hidden') //masquer résultats 
            displayPseudo.classList.add('hidden') // masquer pseudo
            winnerEl.classList.remove('hidden')
            winnerPseudoEl.innerHTML = localStorage.getItem('pseudo')
            winnerPointsEl.innerHTML = 10

            // Envoyer score au serveur      
            fetch('/score', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    pseudo: localStorage.getItem('pseudo'),
                    points: 10
                })
            })
        }

        // Affichage du jeu
        const displayGame = () => { //Initialisation du résultat à afficher
            let result = ''

            for (let rowIndex in game) { // Pour chaque ligne 
                result += '<div class="flex items-center justify-center gap-4">' //ajouter un conteneur

                for (let colIndex in game[rowIndex]) { // pour chaque colonne de la ligne
                    const image = images.find((obj) => obj.key === gameResult[rowIndex][
                        colIndex]) //trouve l'image correspondante

                    //ajouter bouton ou image selon l'etat de la grille

                    result += `
                    <button 
                        class='game-card ${game[rowIndex][colIndex] !== 0 ? 'hidden' : ''} text-masala-50 text-4xl bg-genoa-600 hover:bg-genoa-950 focus:ring-4 focus:ring-genoa-950 font-medium rounded-lg'
                        style='width:100px;height:100px'
                        data-row="${rowIndex}"
                        data-col="${colIndex}"
                    >
                        ?
                    </button>
                    <img class="${game[rowIndex][colIndex] === 0 ? 'hidden' : ''}" src="${image.imagePath}" style="width:100px;height:100px" />
                    `
                }

                result += '</div>'
            }
            //Mettre a jour le resultat
            resultatEl.innerHTML = result

            const gameCardsEl = document.querySelectorAll(".game-card")
            // clic carte
            gameCardsEl.forEach((card) => {
                card.addEventListener('click', () => {
                    if (isReady) { //si jeu pret
                        const row = card.getAttribute('data-row')
                        const col = card.getAttribute('data-col')

                        game[row][col] = gameResult[row][col] //révéler l'image

                        displayGame()

                        oldSelection.push({ //ajouter la séléctions
                            row,
                            col,
                            value: game[row][col]
                        })

                        if (oldSelection.length === 2) { //si deux cartes sont séléctionnées
                            if (oldSelection[0].value !== oldSelection[1].value) { // si les cartes ne correspondent pas
                                isReady = false

                                game[oldSelection[0].row][oldSelection[0].col] = 0
                                game[oldSelection[1].row][oldSelection[1].col] = 0

                                const timeout = setTimeout(() => { //masquer les cartes après délai
                                    isReady = true
                                    displayGame()
                                    clearTimeout(timeout)
                                }, 800)
                            }

                            oldSelection = [] //réinitialiser les séléctions
                        }
    // Déclaration du gagnant si toutes les cartes sont trouvées
                        if (!game.flat().includes(0)) {
                            setWinner()
                        }
                    }
                })
            })
        }
        // Met à jour l'affichage du jeu en fonction de l'état de la grille  
        displayGame()

        // Jeu réinitialisé lorsque l'on clique sur rejouer
        playAgainEl.addEventListener('click', () => {
            resetGame()

            winnerEl.classList.add('hidden') //masquer écran gagnant

            resultat.classList.add('flex') 
            resultat.classList.remove('hidden')

            gameResult = generateResult() //générer un nouveau résultat de jeu
            displayGame()
        })
    </script>
@endsection
