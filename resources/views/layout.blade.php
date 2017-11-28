<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{config('app.name')}}</title>

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <!-- Styles -->
</head>
<body class="container mx-auto px-4 bg-grey h-full">
<div class="mx-auto bg-white flex flex-wrap md:my-9 my-4" style="max-height: 70%">
    <div class="md:w-1/2 flex flex-wrap content-center">
        <img src="{{ asset('img/img-santa.png') }}" class="mx-auto my-4 max-w-full" style="max-height: 70%" alt="santa">
    </div>
    <div class="md:w-1/2 px-8">
        <h1 class="text-red-dark">
            Secret <span>Santa</span>
        </h1>
        <div class="font-sans text-2xl mt-9">
            @yield('content')
        </div>
    </div>
    <footer>
{{--        <img src="{{ asset('img/img-company.png') }}" alt="for {{ config('secret-santa.company_name) }}">--}}
    </footer>
</div>
{{--<a class="credit" href="https://github.com/mathieutu/secret_santa">Powered with love.</a>--}}
</body>
</html>
