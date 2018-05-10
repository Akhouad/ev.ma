@extends('../layouts.manager', compact('pending_events'))

@section('content')
@if(count($events) == 0 && !isset($search_key))
<div class="manager-hero">
    <div class="hero-content">
        <div class="container">
            <h1>Bienvenue {{Auth::user()->fullname}}</h1>
            <p>
                Merci de nous avoir rejoint en tant qu'organisateur. Nous mettons à votre disposition une suite de formulaires pour vous permettre de présenter facilement et rapidement vos événements.
            </p>
            <a href="" class="btn btn-success btn-lg">Créez la page de votre événement ici</a>
        </div>
    </div>
</div>
@else
<div class="container">
    @if ($errors->any())
    <div class="alert alert-danger">
        <div class="alert-body">
            <p><strong>Veuillez corriger les erreurs suivantes: </strong></p>
            <ul style="margin:0;padding:0">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>  
    @endif
    
    <div class="row">
        <div class="col-md-4">
            <form action="{{route('manager')}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control" name="recherche" placeholder="Recherche...">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <h5>
        <p>
            @if(!isset($search_key))
                Mes événements
            @else
                Résultats de la recherche: {{$search_key}}
            @endif
        </p>
    </h5>
    <div class="list-group">
        @foreach($events as $e)
        <a href="{{route('event', ['id' => $e->id])}}" class="list-group-item">
            <span class="badge badge-{{(count($e->attendings) > 0) ? 'primary' : 'default'}} float-right">{{count($e->attendings)}} <i class="fa fa-user"></i></span>

            @if(!\Carbon\Carbon::parse($e->start_timestamp)->isPast())
            <span class="badge badge-success">Prochain</span>
            @else
            <span class="badge badge-default">Passé</span>
            @endif

            @if($e->status == 'pending')
            <span class="badge badge-default float-right" style="margin-right:5px">En cours de validation</span>
            @endif
            <span class="event-name">{{$e->name}}</span>
        </a>
        @endforeach
    </div>
    {{$events->links()}}
</div>
@endif
@endsection