@extends('layout')
@section('content')
    @component('components.home-title')
        As tu été sage&nbsp;?
    @endcomponent
    @component('components.button', ['route' => 'register'])
        Oui, et je veux participer&nbsp;!
    @endcomponent
@endsection
