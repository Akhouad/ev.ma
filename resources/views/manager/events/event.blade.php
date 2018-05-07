@extends('../layouts.manager', compact('pending_events'))

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3 col-xs-2">
            @component('manager/events/components/sidebar', compact('event'))
            @endcomponent
        </div>
        <div class="col-md-9 col-xs-10">
            @if($event->status == 'pending')
            <div class="alert alert-info" role="alert">
                Votre événement <strong>{{$event->name}}</strong> est en cours de validation par les administrateurs.
            </div>
            @endif

            <div class="row">
                <div class="col-md-6">
                    <div class="card bg-success">
                        <div class="card-header">Réseaux sociaux</div>
                        <div class="card-body">
                            s
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card bg-success">
                        <div class="card-header">Intéractions</div>
                        <div class="card-body">
                            s
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" style="margin-top:30px">
                <div class="col-md-12">
                    <div class="card bg-success">
                        <div class="card-header">Visites par semaine</div>
                        <div class="card-body">
                            s
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" style="margin-top:30px">
                <div class="col-md-6">
                    <div class="card bg-primary">
                        <div class="card-header">Localisation des visiteurs</div>
                        <div class="card-body">
                            s
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card bg-primary">
                        <div class="card-header">Avis</div>
                        <div class="card-body">
                            s
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection