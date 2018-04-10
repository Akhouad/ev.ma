@extends('../layouts.manager', compact('pending_events'))

@section('content')
@if(count($events) == 0)
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
    <h5><p>Mes événements (non validés)</p></h5>
    <div class="list-group">
        @foreach($events as $e)
        <a href="{{route('event', ['id' => $e->id])}}" class="list-group-item">
            <span class="badge badge-primary float-right">{{$e->attending_count}} <i class="fa fa-user"></i></span>

            @if(!\Carbon\Carbon::parse($e->start_timestamp)->isPast())
            <span class="badge badge-success">Prochain</span>
            @else
            <span class="badge badge-default">Passé</span>
            @endif

            @if($e->status == 'pending')
            <span class="badge badge-default float-right" style="margin-right:5px">En cours de validation</span>
            @endif
            {{$e->name}}
        </a>
        @endforeach
    </div>
</div>
@endif
@endsection