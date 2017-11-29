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
<body class="container mx-auto px-2 bg-grey h-full">
<div class="mx-auto bg-white flex flex-wrap items-center justify-center md:my-6 my-2 p-4 pb-2" style="max-height: 70%">
    <div class="md:w-1/2 text-center">
        <img src="{{ asset('img/img-santa.png') }}" class="mx-auto my-2 max-w-full" style="max-height: 400px"
             alt="santa">
    </div>
    <div class="md:w-1/2 px-4">
        <h1 class="text-red-dark text-5xl xl:text-6xl sm:ml-9 md:ml-4">
            Secret <span class="ml-9">Santa</span>
        </h1>
        <div class="font-sans mt-4 text-xs">
            @yield('content')
        </div>
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
