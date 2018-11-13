<div class="message">
    <p>
        Salut à toi, mon·a jeune ami·e ! <br>
        Pour ce Noël {{ config('secret_santa.registration.closing_date')->year }},
        tes dévoué·e·s collègues ont décidé de te faire un petit cadeau bien spécial... <br>
        Te donner la possibilité d'en offrir !
    </p>
    <p class="mt-4">
        {!! $slot !!}
    </p>
</div>
