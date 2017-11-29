<?php

return [
    'registration' => [
        'provider'      => env('SOCIALITE_PROVIDER'), // Your wanted socialite provider. ex: github
        'domain'        => env('ALLOWED_DOMAIN'), // The email domains allowed to connect (regexp). ex:mycompany.(fr|com)
        'user_name_key' => 'firstName', // Key for the name of the User. ex for a first name in google: givenName
        'closing_date'  => env('CLOSING_DATE'),
    ],
    'company_name' => env('COMPANY_NAME'),
    'company_url' => env('COMPANY_URL'),
];
