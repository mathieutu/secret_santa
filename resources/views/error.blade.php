@extends('layout')
@section('content')
    <div class="message">
        <p>Ho ! Ho ! Ho !</p>
        <p class="mt-4">Désolé{{ $user ? ' '.$user->name : '' }}, je ne te trouve pas sur ma liste... <br>
        Mais rassure toi, si aujourd'hui je ne m'occupe que du Noël de {{ config('secret_santa.company_name') }},
            je pense à toi et te je te donne rendez vous le 24 au soir !<sup>*</sup><br>
            <em style="font-size: 0.75em"><sup>*</sup>Offre non contractuelle, soumise à conditions.</em>
        </p>
        <p class="mt-4">A bientôt !</p>
    </div>
    <div class="text-center mt-8">
        <a href="{{ route('register') }}" class="btn">
            <span class="icn-gift"></span>
            Réessayer !
        </a>
    </div>
@endsection
