<div class="event_sidebar" id="sticker">
    <ul>
        <li><a href="{{route('event', ['id'=> $event->id])}}" class="btn btn-lg {{(Route::current()->getName() == 'event') ? 'btn-primary' : 'btn-default'}} btn-block">Table de bord</a></li>
        <li><a href="{{route('edit-event', ['id' => $event->id])}}" class="btn btn-lg {{(Route::current()->getName() == 'edit-event') ? 'btn-primary' : 'btn-default'}} btn-block">Informations générales</a></li>
        <li><a href="{{route('event-intervenants', ['id' => $event->id])}}" class="btn btn-lg {{(Route::current()->getName() == 'event-intervenants') ? 'btn-primary' : 'btn-default'}} btn-block">Intervenants</a></li>
        <li><a href="{{route('event-images', ['id' => $event->id])}}" class="btn btn-lg {{(Route::current()->getName() == 'event-images') ? 'btn-primary' : 'btn-default'}} btn-block">Album photo</a></li>
        <li><a href="{{route('event-programme', ['id' => $event->id])}}" class="btn btn-lg {{(Route::current()->getName() == 'event-programme') ? 'btn-primary' : 'btn-default'}} btn-block">Programme</a></li>
        <li><a href="" class="btn btn-lg {{(Route::current()->getName() == 'event-emails') ? 'btn-primary' : 'btn-default'}} btn-block">E-mails aux participants</a></li>
        <li><a href="{{route('event-attendings', ['id' => $event->id])}}" class="btn btn-lg {{(Route::current()->getName() == 'event-attendings') ? 'btn-primary' : 'btn-default'}} btn-block">Attendings ({{count($event->attendings)}})</a></li>
        <li><a href="{{route('event-checkins', ['id' => $event->id])}}" class="btn btn-lg {{(Route::current()->getName() == 'event-checkins') ? 'btn-primary' : 'btn-default'}} btn-block">Participants ({{count($event->checkins)}})</a></li>
        <li><a href="{{route('event-comments', ['id' => $event->id])}}" class="btn btn-lg {{(Route::current()->getName() == 'event-comments') ? 'btn-primary' : 'btn-default'}} btn-block">Commentaires ({{count($event->comments)}})</a></li>
    </ul>
</div>