<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="Synergie Media" />
    <link href="{{asset('storage/images/favicon.ico')}}" type="image/x-icon" rel="icon" />
    <link href="{{asset('storage/images/favicon.ico')}}" type="image/x-icon" rel="shortcut icon" /> 
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ev: Event manager</title>

    <link rel="stylesheet" href="{{asset('css/manager/app.css')}}">
    @yield('styles')
</head>
<body class="light-gray-bg">
    <div class="docs-header header--noBackground">
        <nav class="navbar" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <a href="{{route('homepage')}}" target="_blank" class="navbar-brand"><img src="{{asset('storage/images/logo.png')}}" height="40" alt=""></a> 
                    <div class="header-nav">
                        <ul>
                            @if(Auth::user()->is_admin)
                            <li><a class="{{Route::current()->action['as'] == 'validation' ? 'active' : ''}}" href="{{route('validation')}}">Validation ({{count($pending_events)}})</a></li>
                            @endif
                            <li><a class="{{Route::current()->action['as'] == 'manager' ? 'active' : ''}}" href="{{route('manager')}}">Mes événements</a></li>
                            <li><a href="{{route('settings')}}">Mon compte</a></li>
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Déconnexion</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{csrf_field()}}
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>

    <div class="manager-hero">
        <div class="hero-heading">
            <div class="container">
                <h5 class="float-md-left">Bienvenue {{Auth::user()->fullname}}</h5>
                @if(Auth::user()->is_admin && isset($event))
                    @if($event->status == 'pending')
                    <a href="{{route('event-publish', $event->id)}}" class="btn btn-success float-md-right" style="margin-left:10px">Publier l'événement</a>
                    @else
                    <a href="{{route('event-unpublish', $event->id)}}" class="btn btn-light text-danger float-md-right" style="margin-left:10px">Unpublish</a>
                    @endif
                @endif
                @if(Route::current()->action['as'] != 'add-event')
                <a href="{{route('add-event')}}" class="btn btn-info float-md-right">Créer votre événement</a>
                @endif
            </div>
        </div>
    </div>

    @if(Session::has('alert-message'))
    <div class="container">
        <div class="alert {{Session::get('alert-class')}} alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{Session::get('alert-message')}}
        </div>
    </div>
    @endif

    <div id="app">
        @yield('content')
    </div>

    @yield('scripts')
</body>
</html>