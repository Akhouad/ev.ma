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
    <title>{{$title}}</title>

    @yield('styles')
    <link rel="stylesheet" href="{{asset('css/site/app.css')}}">
</head>
<body>
    <header class="main-header">
        <div class="top-bar">
            <div class="container">
                @if(Auth::user() !== null)
                <span class="user-city">Vous êtes localisé à : {{Auth::user()->city->name}}</span>
                @endif
                <nav class="top-nav">
                    <ul>
                        <li><a href="{{route('cities')}}">Villes</a></li>
                        <li><a href="">Blog</a></li>
                        <li><a href="">Contactez-nous</a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="middle-bar">
            <div class="container">
                <a href="{{route('homepage')}}" class="logo"><img src="{{asset('storage/images/logo.png')}}" alt=""></a> 
                <div class="header-search">
                    <form action="{{route('homepage')}}" method="get">
                        <input type="text" name="search" placeholder="Chercher des événements, des personnes ...">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
                <a href="{{route('advanced-search')}}" class="advanced-search">recherche avancée</a>
                @if(Auth::user() !== null)
                <div class="header-profile dropdown">
                    <a href="" class="avatar dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{asset('storage/images/avatars/' . Auth::user()->avatar)}}" alt="">
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <div class="dropdown-profile">
                            <div class="dropdown-avatar">
                                <img src="{{asset('storage/images/avatars/' . Auth::user()->avatar)}}" alt="">
                            </div>
                            <div class="profile-info">
                                <p class="fullname">{{Auth::user()->fullname}}</p>
                                <p class="username">{{Auth::user()->username}}</p>
                                <div class="row">
                                    <div class="col"><a href="{{route('settings')}}">Paramètres</a></div>
                                    <div class="col"><a href="" class="profile">Mon profil</a></div>
                                </div>
                            </div>
                        </div>
                        <nav class="dropdown-nav">
                            <ul>
                                <li><a href="{{route('manager')}}"><i class="fa fa-cog"></i> Gérer mes événements</a></li>
                                <li><a href="{{route('collections')}}"><i class="fa fa-cog"></i> Gérer mes collections</a></li>
                            </ul>
                        </nav>
                        <div class="dropdown-footer">
                            <div class="row">
                                <div class="col-md-10">
                                    <a href="{{route('add-event')}}" class="btn btn-block btn-sm btn-primary">
                                        <i class="fa fa-plus mr-2"></i>
                                        Ajouter un événement
                                    </a>
                                </div>
                                <div class="col-md-2 text-right">
                                    <a href="{{ route('logout') }}" class="btn btn-danger btn-sm" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out"></i>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{csrf_field()}}
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="float-md-right">
                    <a href="{{route('login')}}" class="btn btn-sm">Se connecter</a>
                    <a href="{{route('register')}}" class="btn btn-secondary btn-sm">S'inscrire</a>
                </div>
                @endif
            </div>
        </div>
    </header>

    <div class="container" id="wrapper">
        @yield('content')
    </div>

    <script src="{{asset('js/site/common.js')}}"></script>
    @yield('scripts')
</body>
</html>