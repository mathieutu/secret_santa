@extends('layout')
@section('content')
    <div class="message">
        <p>
            Salut à toi, mon jeune ami ! <br>
            Pour ce Noël {{ now()->year }}, ta toute dévouée team Web t'a fait un petit cadeau bien spécial... <br>
            Te donner la possibilité d'en recevoir !
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
