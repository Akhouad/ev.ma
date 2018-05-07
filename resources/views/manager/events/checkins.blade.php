@extends('layouts.manager', ['current_page' => 'Participants'])

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3 col-sm-2">
            @component('manager/events/components/sidebar', compact('event'))
            @endcomponent
        </div>
        <div class="col-md-9 col-sm-10">
            <div class="card bg-success">
                <div class="card-header">Participants</div>
                <div class="card-body">
                    @if(count($event->checkins->where('deleted_at', null)) > 0)
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <a href="{{route('export-checkins', ['id' => $event->id])}}" class="btn btn-outline-primary btn-sm float-md-right">Exporter la liste</a>
                        </div>
                    </div>
                    <ul class="users-list">
                        @foreach($event->checkins->where('deleted_at', null) as $checkin)
                        <li>
                            <a href="{{route('user', ['username' => $checkin->user->username])}}">
                                <img src="{{asset('storage/images/avatars/' . $checkin->user->avatar)}}" alt="">
                                {{title_case($checkin->user->fullname)}}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    @else
                    <p class="p-5 text-center text-muted">
                        Vous n'avez aucun participant.
                    </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection