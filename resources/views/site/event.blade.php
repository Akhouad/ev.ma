@extends('layouts.site', [
            'title' => $event->name, 
            'footer_cities' => $footer_cities, 
            'categories' => $categories,
            'category' => null,
            'event' => $event
        ])

@section('content')
<div class="row event-page">
    <div class="col-md-9">
        @if(\Carbon\Carbon::parse($event->start_timestamp)->isPast())
        <div class="alert alert-warning text-center">
            CET ÉVÉNEMENT EST PASSÉ
        </div>
        @endif
        <div class="row">
            <div class="col-md-10">
                <div class="event-cover">
                    <img src="{{asset('storage/images/manager/events/' . $event->cover)}}" alt="">
                </div>
            </div>
        </div>
        <h1 class="event-title mt-3">{{title_case($event->name)}}</h1>
        <div class="event-rate">
            <span class="float-md-left mr-2 mb-2">Donnez votre avis:</span>
            <div class="rating" data-rate-value=6></div>
        </div>
        <div class="row mt-2">
            <div class="col-md-6">
                <div class="event-date">
                    <i class="fa fa-calendar"></i>
                    <span>
                        Du {{date('d/m', strtotime($event->start_timestamp))}} <br> 
                        Au {{date('d/m', strtotime($event->end_timestamp))}}
                    </span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="access-type d-inline-block w-100">
                    Type d'acces: 
                    {{ ($event->access_type == 1) ? 'Gratuit' : (($event->accessType == 2) ? 'Payant' : (($event->accessType == 3) ? 'Sur Invitation' : 'Sur Réservation')) }}
                    <a href="" class="btn btn-primary btn-sm float-md-right">Réserver</a>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-6">
                <a href="">{{title_case($event->venue->name)}}</a>
                 - 
                <a href="{{route('city', ['id' => $event->venue->city->slug])}}">{{$event->venue->city->name}}</a>
            </div>
            <div class="col-md-6">
                <form action="{{route('attend-event', ['id' => $event->id, 'slug' => $event->slug])}}" method="post">
                    {{csrf_field()}}
                    <input type="hidden" name="event_id" value="{{$event->id}}">
                    <input type="hidden" name="user_id" value="{{Auth::id()}}">
                    @if(\Carbon\Carbon::parse($event->start_timestamp)->isPast())
                    <button type="submit" name="attend-type" value="was-present" class="btn btn-danger btn-sm float-md-right">J'étais présent à cet événement</a>                
                    @else
                    <p>Comptez-vous assister à cet événement ?</p>
                    <div class="row">
                        <div class="col-md-6">
                            <button type="submit" name="attend-type" value="accept" class="btn btn-block btn-sm btn-danger">Oui</a>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" name="attend-type" value="maybe" class="btn btn-block btn-sm btn-danger">Peut-être</a>
                        </div>
                    </div>
                    @endif
                </form>
            </div>
        </div>
        <div class="about">
            <div class="panel panel-success mt-4">
                <div class="card-header">
                    A propos
                    <a class="float-md-right" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <i class="fa fa-sort-down"></i>
                    </a>
                </div>
                <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne">
                    <div class="card-body">
                        {{$event->description}}
                        <div class="social-icons">
                            @if(isset($event->facebook))
                            <a href="{{$event->facebook}}" target="_blank" class="fb"><i class="fa fa-facebook"></i></a>
                            @endif
                            @if(isset($event->twitter))
                            <a href="{{$event->twitter}}" target="_blank" class="tw"><i class="fa fa-twitter"></i></a>
                            @endif
                            @if(isset($event->youtube))
                            <a href="{{$event->youtube}}" target="_blank" class="yt"><i class="fa fa-youtube"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>  
        @if(count($event->interventions) > 0)
        <div class="intervenants">
            <div class="panel panel-success mt-4">
                <div class="card-header">
                    Intervenants
                    <a class="float-md-right" data-toggle="collapse" href="#collapseIntervenants" aria-expanded="true" aria-controls="collapseIntervenants">
                        <i class="fa fa-sort-down"></i>
                    </a>
                </div>
                <div id="collapseIntervenants" class="collapse" role="tabpanel" aria-labelledby="headingOne">
                    <div class="card-body">
                        <ul class="intervenants">
                            @foreach($event->interventions->where('deleted_at', null) as $intervenant)
                            <li>
                                <a href="">
                                    <div class="intervenant-image">
                                        <img src="{{asset('storage/images/avatars/' . $intervenant->user->avatar)}}" alt="">
                                    </div>
                                    <div class="name">
                                        {{explode(' ', $intervenant->user->fullname)[0]}}
                                    </div>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div> 
        @endif
        @if(count($event->schedules) > 0)
        <div class="schedule">
            <div class="panel panel-success mt-4">
                <div class="card-header">
                    Programme
                    <a class="float-md-right" data-toggle="collapse" href="#collapseSchedule" aria-expanded="true" aria-controls="collapseSchedule">
                        <i class="fa fa-sort-down"></i>
                    </a>
                </div>
                <div id="collapseSchedule" class="collapse" role="tabpanel" aria-labelledby="headingOne">
                    <div class="card-body">
                        <ul class="schedule-timeline">
                        <?php $currentDate = date("d M Y", strtotime($event->schedules->sortBy('time')->first()->time)) ?>
                        <h5 class="day">{{date('d-m', strtotime($event->schedules->sortBy('time')->first()->time))}}</h5>
                        @foreach($event->schedules->sortBy('time') as $schedule)
                            <?php $date = date("d M Y",strtotime($schedule->time)); ?>
                            @if($currentDate != $date)
                            <h5 class="day">{{date('d-m', strtotime($schedule->time))}}</h5>
                            <?php $currentDate = $date; ?>
                            @endif
                            <li>
                                <strong>{{date('H:i', strtotime($schedule->time))}}</strong>
                                <span>
                                    {{$schedule->title}}
                                    <small> / 
                                        @if($schedule->intervention != null) 
                                        <a href="{{route('user', ['username' => $schedule->intervention->user->username])}}">{{$schedule->intervention->user->fullname}}</a> 
                                        @endif
                                    </small>
                                </span>
                                @if(strlen($schedule->description) > 0)
                                <p>
                                    <i class="fa fa-level-up"></i>
                                    {{$schedule->description}}</p>
                                @endif
                            </li>
                        @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div> 
        @endif
        @if(count($event->images) > 0)
        <div class="event-images">
            <div class="panel panel-success mt-4">
                <div class="card-header">
                    Photo
                    <a class="float-md-right" data-toggle="collapse" href="#collapseImages" aria-expanded="true" aria-controls="collapseImages">
                        <i class="fa fa-sort-down"></i>
                    </a>
                </div>
                <div id="collapseImages" class="collapse" role="tabpanel" aria-labelledby="headingOne">
                    <div class="card-body">
                        @foreach($event->images->where('deleted_at', null) as $key => $image)
                        <a href="{{asset('storage/images/manager/events/' . $image->file)}}" data-lightbox="images-{{$event->id}}" data-title="{{title_case($event->name)}}">
                            <img src="{{asset('storage/images/manager/events/' . $image->file)}}" alt="{{$event->name}} - Ev.ma">
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="rate-comment">
            <div class="panel panel-success mt-4">
                <div class="card-header">
                    Donnez votre avis
                    <a class="float-md-right" data-toggle="collapse" href="#collapseRate" aria-expanded="true" aria-controls="collapseRate">
                        <i class="fa fa-sort-down"></i>
                    </a>
                </div>
                <div id="collapseRate" class="collapse" role="tabpanel" aria-labelledby="headingOne">
                    <div class="card-body">
                        <div class="rate">
                            <span>Décerner une note :</span>
                            <div class="rating" data-rate-value=6></div>
                        </div> 
                        
                        <div class="comment">
                            <form action="{{route('event-page', ['slug' => $event->slug, 'id' => $event->id])}}" method="post">
                                {{csrf_field()}}
                                <input type="hidden" name="user_id" value="{{Auth::id()}}">
                                <input type="hidden" name="event_id" value="{{$event->id}}">
                                <input type="hidden" name="rating">
                                <div class="form-group">
                                    <label for="">Laisser un commentaire</label>
                                    <textarea name="comment" id="" cols="30" rows="5" class="form-control" placeholder="Publiez votre commentaire en moins de 250 caractères."></textarea>
                                </div>
                                <div class="text-right">
                                    <button class="btn btn-primary">Publier</button>
                                </div>
                            </form>
                        </div>
                        @if(count($event->comments) > 0)
                        <div class="comments">
                            <div class="comments-heading">les avis des internautes</div>
                            @foreach($event->comments as $comment)
                            <div class="comment">
                                <a href="{{route('user', ['username' => $comment->user->username])}}" class="author-image">
                                    <img src="{{asset('storage/images/avatars/' . $comment->user->avatar)}}" alt="">
                                </a>
                                <div class="author-info">
                                    <a href="{{route('user', ['username' => $comment->user->username])}}" class="author-name">
                                        {{title_case($comment->user->fullname)}}
                                    </a>
                                    <div class="date-rating">
                                        <div class="comment-date">
                                            {{date('d-m-Y', strtotime($comment->created_at))}}
                                        </div>
                                        @if($comment->rating != null)
                                        <div class="comment-rating">
                                            @for($i = 0 ; $i < floor($comment->rating->rating) ; $i++)
                                            <i class="fa fa-star"></i>
                                            @endfor
                                            @if($comment->rating->rating > floor($comment->rating->rating) && $comment->rating->rating < ceil($comment->rating->rating))
                                            <i class="fa fa-star-half-empty"></i>
                                            @endif
                                            @for($i = 5 ; $i > ceil($comment->rating->rating) ; $i--)
                                            <i class="fa fa-star-o"></i>
                                            @endfor
                                        </div>
                                        @endif
                                    </div>
                                    <p class="comment-text">
                                        {{$comment->comment}}
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="event-sidebar">
            <div class="event-author">
                <p>Partagé sur Ev par</p>
                <a href="{{route('user', ['username' => $event->organizer->user->username])}}" class="author">
                    <img src="{{asset('storage/images/avatars/' . $event->organizer->user->avatar)}}" alt="">
                    <p>{{$event->organizer->user->fullname}}</p>
                </a>
            </div>
            <div class="event-categories">
                <ul>
                    @foreach($event->categories as $category)
                    <li>
                        <a href="{{route('category', ['category' => $category->category->slug])}}">
                            {{$category->category->name}}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{asset('js/site/event.js')}}"></script>
@endsection