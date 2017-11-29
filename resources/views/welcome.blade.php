@extends('layout')
@section('content')
    <div class="message">
        <p>
            Salut à toi, mon jeune ami ! <br>
            Pour ce Noël {{ now()->year }}, tes dévoués collègues ont décidé de te faire un petit cadeau bien spécial... <br>
            Te donner la possibilité d'en offrir !
        </p>
        <p class="mt-4">As tu été sage ?</p>
    </div>

    <div class="text-center mt-8">
        <a href="{{ route('register') }}" class="btn">
            <span class="icn-gift"></span>
            Oui, et je veux participer !
        </a>
    </div>
@endsection
