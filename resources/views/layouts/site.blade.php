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
    <title>[DEV] - {{$title}}</title>

    @yield('styles')
    <link rel="stylesheet" href="{{asset('css/site/app.css')}}">
</head>
<body>
    <header class="main-header">
        <div class="top-bar">
            <div class="container">
                @if(Auth::user() !== null)
                <span>Vous êtes localisé à : {{Auth::user()->city->name}}</span>
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
                                    <div class="col"><a href="">Paramètres</a></div>
                                    <div class="col"><a href="" class="profile">Mon profil</a></div>
                                </div>
                            </div>
                        </div>
                        <nav class="dropdown-nav">
                            <ul>
                                <li><a href=""><i class="fa fa-cog"></i> Gérer mes événements</a></li>
                                <li><a href=""><i class="fa fa-cog"></i> Gérer mes collections</a></li>
                            </ul>
                        </nav>
                        <div class="dropdown-footer">
                            <div class="row">
                                <div class="col-md-10">
                                    <a href="{{route('manager')}}" class="btn btn-block btn-sm btn-primary">
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
        <div class="bottom-bar">
            <div class="container">
                <nav class="categories">
                    <ul>
                        @foreach($categories as $key => $c)
                        @if($key < 10)
                        <li>
                            <a href="{{route('category', ['category' => $c->slug])}}">
                                {{$c->name}}
                            </a>
                        </li>
                        @endif
                        @endforeach
                        <li><a href="">Plus</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <div class="container" id="wrapper">
        @yield('content')
    </div>

    <footer class="main-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <p>
                        Ev.ma est le site pour trouver les bons plans, les activités, les idées insolites au Maroc. Retrouver les meilleurs événements de culture, divertissement, professionnels, technologies et sports. Tout pour profiter de votre ville.
                    </p>
                    <p>
                        <a href=""><img src="{{asset('storage/images/google-play.png')}}" alt=""></a>
                    </p>
                    <p class="text-left">
                        Copyright &copy; 2015-{{date('Y')}} Ev.ma - Tous droits réservés
                    </p>
                </div>
                <div class="col-md-5 offset-md-2">
                    <ul class="cities">
                        @foreach($footer_cities as $c)
                        <li><a href="{{route('city', ['city' => $c->slug])}}">{{$c->name}}</a></li>
                        @endforeach
                    </ul>
                    <h3 class="footer-heading">a propos</h3>
                    <ul class="footer-links">
                        <li><a href="">Conditions</a></li>
                        <li><a href="">Notre politique</a></li>
                        <li><a href="">Vos données</a></li>
                        <li><a href="">Média</a></li>
                        <li><a href="">Photo de couverture</a></li>
                        <li><a href="">Cookies</a></li>
                        <li><a href="">Blog</a></li>
                    </ul>
                    <h3 class="footer-heading">aide</h3>
                    <ul class="footer-links">
                        <li><a href="">Ajoutez votre événement</a></li>
                        <li><a href="">Compte organisateur professionnel</a></li>
                        <li><a href="">Application mobile</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <script src="{{asset('js/site/common.js')}}"></script>
    @yield('scripts')
</body>
</html>