@extends('layout')
@section('title', 'Memory Game - Home')

@section('content')
    <main id="mainContent" class="relative h-screen grid place-content-center">

        <a href="{{ route('game') }}" class=" h-20 w-40 text-masala-50 bg-genoa-600 hover:bg-genoa-950 focus:ring-4 focus:ring-genoa-950 font-medium rounded-lg text-2xl flex items-center justify-center">Play</a>

        <img id="myLittleLion" src="lion.svg" alt=""
            class="transition-all duration-[2000ms] absolute w-32 h-32 top-0 left-0">
    </main>
@endsection

<script>
    //fonction générant des nombres aléatoires
    const randomNumber = (max) => {
        return Math.floor(Math.random() * max);
    }

    document.addEventListener('DOMContentLoaded', () => { //execute le code une fois la page chargée
        const lion = document.querySelector('#myLittleLion') // Séléctionne l'élément et le stock dans "lion"
        const mainContent = document.querySelector('#mainContent') // Séléctionne l'élément et le stock dans "mainConten"
        let rotate = false //Génére l'état de la rotation

    //déplacement du lion    
        setInterval(() => { //appelle la fonction toutes les 2 secondes
            lion.style.setProperty("top",
                `${randomNumber(mainContent.clientHeight + 1 - lion.clientHeight)}px`); // nouvelle position top est un nombre aléatoire 
            lion.style.setProperty("left",
                `${randomNumber(mainContent.clientWidth + 1 - lion.clientWidth)}px`); // nouvelle position left est un nombre aléatoire
        }, 2000);

    //rotation du lion
        setInterval(() => { //appelle la fonction toutes les 2.5 secondes
            if (rotate) {
                lion.style.setProperty("transform", `rotate(0deg)`); //Pivotage du lion de 0 à 1000 degrés 
                rotate = false //la variable alterne entre true et false pour gérer l'état de rotation
            } else {
                lion.style.setProperty("transform", `rotate(1000deg)`);
                rotate = true
            }
        }, 2500)
    }, false)
</script>
