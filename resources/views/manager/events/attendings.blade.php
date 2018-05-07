@extends('layouts.manager')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"><a href="{{route('manager')}}">Accueil</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{route('event', ['id' => $event->id])}}">{{str_limit($event->name, 50, '...')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Attendings</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-3">
            @component('manager/events/components/sidebar', compact('event'))
            @endcomponent
        </div>
        <div class="col-md-9">
            <div class="card bg-success">
                <div class="card-header">Attendings</div>
                <div class="card-body">
                    @if(count($event->attendings->where('deleted_at', null)) > 0)
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <a href="{{route('export-attendings', ['id' => $event->id])}}" class="btn btn-outline-primary btn-sm float-md-right">Exporter la liste</a>
                        </div>
                    </div>
                    <ul class="users-list">
                        @foreach($event->attendings->where('deleted_at', null) as $attending)
                        <li>
                            <a href="{{route('user', ['username' => $attending->user->username])}}">
                                <img src="{{asset('storage/images/avatars/' . $attending->user->avatar)}}" alt="">
                                {{title_case($attending->user->fullname)}}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    @else
                    <p class="p-5 text-center text-muted">
                        Vous n'avez aucun attending.
                    </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection