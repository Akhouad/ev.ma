<div class="event_sidebar">
    <ul>
        <li><a href="{{route('event', ['id'=> $event->id])}}" class="btn btn-lg {{(Route::current()->getName() == 'event') ? 'btn-primary' : 'btn-default'}} btn-block">Table de bord</a></li>
        <li><a href="{{route('edit-event', ['id' => $event->id])}}" class="btn btn-lg {{(Route::current()->getName() == 'edit-event') ? 'btn-primary' : 'btn-default'}} btn-block">Informations générales</a></li>
        <li><a href="{{route('event-intervenants', ['id' => $event->id])}}" class="btn btn-lg {{(Route::current()->getName() == 'event-intervenants') ? 'btn-primary' : 'btn-default'}} btn-block">Intervenants</a></li>
        <li><a href="" class="btn btn-lg {{(Route::current()->getName() == 'event-photos') ? 'btn-primary' : 'btn-default'}} btn-block">Album photo</a></li>
        <li><a href="" class="btn btn-lg {{(Route::current()->getName() == 'event-program') ? 'btn-primary' : 'btn-default'}} btn-block">Programme</a></li>
        <li><a href="" class="btn btn-lg {{(Route::current()->getName() == 'event-emails') ? 'btn-primary' : 'btn-default'}} btn-block">E-mails aux participants</a></li>
        <li><a href="" class="btn btn-lg {{(Route::current()->getName() == 'event-attendings') ? 'btn-primary' : 'btn-default'}} btn-block">Attendings (0)</a></li>
        <li><a href="" class="btn btn-lg {{(Route::current()->getName() == 'event-participants') ? 'btn-primary' : 'btn-default'}} btn-block">Participants (0)</a></li>
        <li><a href="" class="btn btn-lg {{(Route::current()->getName() == 'event-comments') ? 'btn-primary' : 'btn-default'}} btn-block">Commentaires</a></li>
    </ul>
</div>