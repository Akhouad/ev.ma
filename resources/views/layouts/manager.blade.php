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

    @yield('styles')
    <link rel="stylesheet" href="{{asset('css/manager/app.css')}}">
</head>
<body class="light-gray-bg">
    <div class="docs-header header--noBackground">
        <nav class="navbar" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <a href="{{route('homepage')}}" target="_blank" class="navbar-brand"><img src="{{asset('storage/images/logo.png')}}" height="40" alt=""></a> 
                    <div class="mobile-menu"><i class="fa fa-bars"></i></div>
                    <div class="header-nav">
                        <ul>
                            @if(Auth::user()->is_admin)
                            <li><a class="{{Route::current()->action['as'] == 'validation' ? 'active' : ''}}" href="{{route('validation')}}">Validation ({{count($pending_events)}})</a></li>
                            @endif
                            <li><a class="{{Route::current()->action['as'] == 'manager' ? 'active' : ''}}" href="{{route('manager')}}">Mes événements</a></li>
                            <li><a class="{{Route::current()->action['as'] == 'collections' ? 'active' : ''}}" href="{{route('collections')}}">Mes collections</a></li>
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
                <h5 class="float-sm-left">Bienvenue {{Auth::user()->fullname}}</h5>
                @if(Auth::user()->is_admin && isset($event))
                    @if($event->status == 'pending')
                    <a href="{{route('event-publish', $event->id)}}" class="btn btn-success float-sm-right" style="margin-left:10px">Publier l'événement</a>
                    @else
                    <a href="{{route('event-unpublish', $event->id)}}" class="btn btn-light text-danger float-sm-right" style="margin-left:10px">Unpublish</a>
                    @endif
                @endif
                @if(Route::current()->action['as'] != 'add-event')
                <a href="{{route('add-event')}}" class="btn btn-primary float-sm-right">Créer votre événement</a>
                @endif
            </div>
        </div>
    </div>

    @if(Session::has('alert-message'))
    <div class="container">
        <div class="alert {{Session::get('alert-class')}} alert-dismissible fade show" role="alert">
            {{Session::get('alert-message')}}
        </div>
    </div>
    @endif
    
    @if( !in_array(Route::current()->getName(), ['manager', 'validation', 'add-event']) )
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page"><a href="{{route('manager')}}">Accueil</a></li>
                @if(isset($event))
                <li class="breadcrumb-item active" aria-current="page">
                    @if(isset($current_page))
                        <a href="{{route('event', ['id' => $event->id])}}">{{title_case($event->name)}}</a>
                    @else
                        {{title_case($event->name)}}
                    @endif
                    <a href="{{route('event-page', ['id' => $event->id, 'slug' => $event->slug])}}" class="ml-2" target="_blank"><i class="fa fa-external-link"></i></a>
                </li>
                @endif
                @if(isset($collection))
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="{{route('collections')}}">Collections</a>
                </li>
                @endif
                @if(isset($current_page))
                <li class="breadcrumb-item active" aria-current="page">{{$current_page}}</li>
                @endif
            </ol>
        </nav>
    </div>
    @endif

    <div id="app">
        @yield('content')
    </div>

    <script src="{{asset('js/manager/common.js')}}"></script>
    @yield('scripts')
</body>
</html>