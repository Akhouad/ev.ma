@extends('layouts.manager')

@section('content')
<div class="container" id="email">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"><a href="{{route('manager')}}">Accueil</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{route('event', ['id' => $event->id])}}">{{str_limit($event->name, 50, '...')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Programme</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-3">
            @component('manager/events/components/sidebar', compact('event'))
            @endcomponent
        </div>
        <div class="col-9">
            <div class="card bg-success">
                <div class="card-header">Messages</div>
                <div class="card-body">
                    <div class="trumbowyg"></div>
                    <div class="row" v-if="add_campaign" v-cloak>
                        <div class="col-md-12 text-right">
                            <button @click="add_campaign = false" class="btn btn-sm btn-outline-primary">Retour</button>
                        </div>
                    </div>
                    <div class="row" v-if="!add_campaign">
                        <div class="col-md-12 text-right">
                            <a href="" class="btn btn-outline-primary btn-sm" @click="addCampaign($event)">Nouveau message</a>
                        </div>
                        <div class="col-md-12 mt-3">
                            @if(count($event->campaigns->where('deleted_at', null)) == 0)
                            <p class="p-5 text-center text-muted">
                                Vous n'avez aucune campagne.
                            </p>
                            @endif
                            <ul class="campaings-list">
                                @foreach($event->campaigns->where('deleted_at', null) as $campaign)
                                <li>
                                    <input type="hidden" ref="c-name-{{$campaign->id}}" value="{{$campaign->name}}">
                                    <input type="hidden" ref="c-subject-{{$campaign->id}}" value="{{$campaign->subject}}">
                                    <input type="hidden" ref="c-message-{{$campaign->id}}" value="{{$campaign->message}}">
                                    <input type="hidden" ref="c-to-{{$campaign->id}}" value="{{$campaign->send_to}}">
                                    <input type="hidden" ref="c-event-{{$campaign->id}}" value="{{$campaign->event_id}}">
                                    <input type="hidden" ref="c-organizer-{{$campaign->id}}" value="{{$campaign->organizer_id}}">
                                    <input type="hidden" ref="c-user-{{$campaign->id}}" value="{{$campaign->user_id}}">
                                    
                                    <div class="date">{{date('d/m/Y', strtotime($campaign->created_at))}}</div>
                                    <div class="name">{{$campaign->name}}</div>
                                    <div class="actions">
                                        <a href="{{route('delete-campaign', ['id' => $event->id, 'campaign_id' => $campaign->id])}}" class="btn btn-sm btn-outline-danger mr-1">Supprimer</a>
                                        <a href="" class="btn btn-sm btn-outline-primary mr-1" @click="editCampaign({{$campaign->id}}, $event)">Editer</a>
                                        <form action="{{route('send-email', ['id' => $event->id, 'campaign_id' => $campaign->id])}}" method="post" class="d-inline-block">
                                            {{csrf_field()}}
                                            <button type="submit" class="btn btn-sm btn-outline-secondary">Envoyer</button>
                                        </form>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <transition name="slide-fade">
                        <div class="add_message" v-cloak v-if="add_campaign">
                            <form action="{{route('event-campaigns', ['id' => $event->id])}}" method="post">
                                {{csrf_field()}}
                                <input type="hidden" name="campaign_id" ref="campaign_id">
                                <input type="hidden" name="event_id" ref="event_id" value="{{$event->id}}">
                                <input type="hidden" name="organizer_id" ref="organizer_id" value="{{$event->organizer_id}}">
                                <input type="hidden" name="user_id" ref="user_id" value="{{$event->organizer->user->id}}">
                                <div class="form-group">
                                    <label for=""><strong>Titre de la campagne *</strong></label>
                                    <input type="text" ref="name" name="campaign_title" class="form-control">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for=""><strong>Objet de l'email *</strong></label>
                                            <input type="text" ref="subject" name="subject" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for=""><strong>Envoyé à *</strong></label>
                                            <?php
                                                $count = 0; // compteur de tous les participants de tous les evenements de cet organisateur
                                                foreach($event->organizer->events as $e){ $count += count($e->checkins); }
                                            ?>
                                            <select name="send_to" ref="send_to" class="form-control">
                                                <option value="0">Participants ({{count($event->checkins)}})</option>
                                                <option value="1">Les participants de tous mes événements ({{$count}})</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for=""><strong>Message *</strong></label>
                                    <textarea name="message" ref="message" rows="5" style="display:none"></textarea>
                                    <div class="editor" ref="editor_message"></div>
                                </div>
                                <button type="submit" class="btn btn-block btn-primary">Enregistrer en brouillon</button>
                            </form>
                            <p class="mt-3 mb-0">Les informations suivies d'une * sont à saisir obligatoirement.</p>
                        </div>
                    </transition>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{asset('js/manager/email.js')}}"></script>
@endsection