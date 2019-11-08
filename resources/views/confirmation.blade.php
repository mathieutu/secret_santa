@extends('layout')
@section('content')
    <div class="message">
        <p>Ho&nbsp;! Ho&nbsp;! Ho&nbsp;!</p>
        <p class="mt-4">
            @if(!$alreadyKnown)
                Merci de ton inscription jeune {{ $user->name }}&nbsp;! <br>
                Tu es inscrit·e en tant que Secret Santa sur la soirée de Noël de <strong>{{ $user->city }}</strong>.<br>
                Tu recevras très prochainement un courriel t'indiquant les prochaines étapes&nbsp;! <br>
                S'il y a des changements te concernant, n'hésite pas à tenir au courant la team HOM&nbsp;! 😉 <br>
            @else
                Bonjour {{ $user->name }}&nbsp;! <br>
                Je te reconnais, tu t'es déjà inscrit·e en tant que Secret Santa sur la soirée de Noël de
                <strong>{{ $user->city }}</strong> {{ $user->created_at->diffForHumans() }}&nbsp;!<br>
                S'il y a des changements te concernant, n'hésite pas à tenir au courant la team HOM&nbsp;! 😉
            @endif
        </p>
        <p class="mt-4">A très vite&nbsp;!</p>
    </div>
    @component('components.button', ['route' => 'logout'])
        Continuer&nbsp;!
    @endcomponent
@endsection

