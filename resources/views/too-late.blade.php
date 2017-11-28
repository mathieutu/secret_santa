@extends('layout')
@section('content')
    <div class="message">
        <p>
            Salut à toi, mon jeune ami ! <br>
            Pour ce Noël {{ now()->year }}, ta toute dévouée team Web t'a fait un petit cadeau bien spécial... <br>
            Te donner la possibilité d'en recevoir !
        </p>
        <p class="mt-4">Malheureusement, tu arrives bien trop tard. Mais ne t'en fais pas, tu peux toujours revenir l'année prochaine !</p>
    </div>
@endsection
