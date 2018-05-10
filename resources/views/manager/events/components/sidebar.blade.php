<div class="event_sidebar" id="sticker">
    <div class="sidebar_mobile_menu"><i class="fa fa-list"></i></div>
    <ul>
        <li>
            <a href="{{route('event', ['id'=> $event->id])}}" class="{{(Route::current()->getName() == 'event') ? 'active' : ''}} btn-block">
                <span>Table de bord</span>
            </a>
        </li>
        <li>
            <a href="{{route('edit-event', ['id' => $event->id])}}" class="{{(Route::current()->getName() == 'edit-event') ? 'active' : ''}} btn-block">
                <span>Informations générales</span>
            </a>
        </li>
        <li>
            <a href="{{route('event-intervenants', ['id' => $event->id])}}" class="{{(Route::current()->getName() == 'event-intervenants') ? 'active' : ''}} btn-block">
                <span>Intervenants</span>
                <div class="badge badge-primary float-md-right">{{count($event->interventions->where('deleted_at', null))}}</div>
            </a>
        </li>
        <li>
            <a href="{{route('event-images', ['id' => $event->id])}}" class="{{(Route::current()->getName() == 'event-images') ? 'active' : ''}} btn-block">
                <span>Album photo</span>
            </a>
        </li>
        <li>
            <a href="{{route('event-programme', ['id' => $event->id])}}" class="{{(Route::current()->getName() == 'event-programme') ? 'active' : ''}} btn-block">
                <span>Programme</span>
            </a>
        </li>
        <li>
            <a href="{{route('event-campaigns', ['id' => $event->id])}}" class="{{(Route::current()->getName() == 'event-campaigns') ? 'active' : ''}} btn-block">
                <span>E-mails aux participants</span>
            </a>
        </li>
        <li>
            <a href="{{route('event-attendings', ['id' => $event->id])}}" class="{{(Route::current()->getName() == 'event-attendings') ? 'active' : ''}} btn-block">
                <span>Attendings <div class="badge badge-primary float-md-right">{{count($event->attendings)}}</div></span>
            </a>
        </li>
        <li>
            <a href="{{route('event-checkins', ['id' => $event->id])}}" class="{{(Route::current()->getName() == 'event-checkins') ? 'active' : ''}} btn-block">
                <span>Participants</span>
                <div class="badge badge-primary float-md-right">{{count($event->checkins)}}</div>
            </a>
        </li>
        <li>
            <a href="{{route('event-comments', ['id' => $event->id])}}" class="{{(Route::current()->getName() == 'event-comments') ? 'active' : ''}} btn-block">
                <span>Commentaires</span>
                <div class="badge badge-primary float-md-right">{{count($event->comments)}}</div>
            </a>
        </li>
    </ul>
</div>