<?php

use Carbon\Carbon;

return [
    'registration' => [
        'provider'      => env('SOCIALITE_PROVIDER'), // Your wanted socialite provider. ex: github
        'domain'        => env('ALLOWED_DOMAIN'), // The email domains allowed to connect (regexp). ex:mycompany.(fr|com)
        'closing_date'  => Carbon::parse(env('CLOSING_DATE')),
    ],
    'company_name' => env('COMPANY_NAME'),
    'company_url' => env('COMPANY_URL'),
];
