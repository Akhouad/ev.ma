@extends('../layouts.manager', compact('pending_events'))

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"><a href="{{route('manager')}}">Accueil</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$event->name}}</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-3">
            @component('manager/events/components/sidebar', compact('event'))
            @endcomponent
        </div>
        <div class="col-9">
            @if($event->status == 'pending')
            <div class="alert alert-info" role="alert">
                Votre événement <strong>{{$event->name}}</strong> est en cours de validation par les administrateurs.
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{asset('js/manager/app.js')}}"></script>
@endsection