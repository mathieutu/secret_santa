@extends('layout')
@section('content')
    <div class="message">
        <p>Ho ! Ho ! Ho !</p>
        <p class="mt-4">Merci de ton inscription jeune {{ $user->first_name }} ! <br>
        Tu recevras très prochainement un mail t'indiquant les prochaines étapes du jeu ! <br>
        </p>
        <p class="mt-4">A bientôt </p>
    </div>
    <div class="text-center mt-8">
        <a href="http://www.latlmes.com/science/secret-santa-1" class="btn">
            <span class="icn-gift"></span>
            Continuer !
        </a>
    </div>
@endsection

