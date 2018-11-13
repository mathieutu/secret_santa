<!DOCTYPE html>
<html class="md:h-full" lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <!-- Styles -->
</head>
<body class="container bg-grey h-full flex items-center md:px-4 px-2">
    <div class="mx-auto flex-1 bg-white flex flex-wrap items-center justify-center md:my-6 my-2 p-4 pb-2"
         style="max-width: 50rem">
        <div class="lg:w-1/2 px-4 flex justify-center flex-wrap justify-center">
            <h1 class="text-red-dark text-4xl xl:text-5xl sm:ml-9 md:ml-4">
                Secret <span class="ml-9">Santa</span>
            </h1>
            <div class="font-sans mt-4 text-xs">
                @yield('content')
            </div>
        </div>
        <div class="lg:w-1/2 text-center mt-6 lg:mt-0">
            <img src="{{ asset( 'img/hero-' . ($img ?? 'default.png')) }}" class="mx-auto my-2 max-w-full"
                 style="max-height: 400px"
                 alt="santa">
        </div>
        <footer class="mt-4 w-full flex flex-wrap items-center text-2xs font-sans italic">
            <div class="w-full sm:w-1/2 sm:text-left text-center">
                <a href="{{ config('secret_santa.company_url') }}">
                    <img style="max-width: 5rem;" src="{{ asset('img/img-company.png') }}"
                         alt="for {{ config('secret_santa.company_name') }}">
                </a>
            </div>
            <div class="w-full sm:w-1/2 sm:text-right text-center">
                <a class="text-red-dark no-underline" href="https://github.com/mathieutu/secret_santa">Made and Open
                    Sourced with love.</a>
            </div>
        </footer>
    </div>
</body>
</html>
