@extends('../layouts.manager', ['current_page' => 'Information générales'])

@section('content')
<div class="container">
    @if ($errors->any())
    <div class="alert alert-danger">
        <div class="alert-body">
            <p><strong>Veuillez corriger les erreurs suivantes: </strong></p>
            <ul style="margin:0;padding:0">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>  
    @endif

    <div class="row">
        <div class="col-md-3 col-sm-2">
            @component('manager/events/components/sidebar', compact('event'))
            @endcomponent
        </div>
        <div class="col-md-9 col-sm-10">
            <div class="card bg-success add-event-card">
                <div class="card-header">
                    Informations générales
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="card-body">
                        <div class="form-group">
                            <label for=""><strong>Nom de l'événement *</strong></label><span title="Merci de mettre les majuscules uniquement en début de titre et aux noms propres SVP."> (?)</span>
                            <input type="text" name="name" class="form-control" value="{{$event->name}}">
                        </div>
                        <div class="form-group">
                            <label for=""><strong>Permalien *</strong></label>
                            <div class="input-group">
                                <span class="input-group-addon">http://ev.ma/e/</span>
                                <input type="text" class="form-control" name="slug" value="{{$event->slug}}">
                            </div>
                        </div>
                        <div class="form-group add-event-categories">
                            <label for=""><strong>Catégories de l'événement *</strong> <small>Sélectionnez jusqu'à 3 catégories. Plus vous êtes spécifique mieux l'événement sera retrouvé.</small></label>
                            
                            <div class="row">
                                @foreach($categories as $c)
                                <div class="col-md-4">
                                    <div class="checkbox-fn {{( in_array($c->id, $event_categories) ) ? 'checked' : ''}}">
                                        <label for="" class="label-control">
                                            @if( in_array($c->id, $event_categories) )
                                            <input type="checkbox" name="categories[]" value="{{$c->id}}" checked>
                                            @else
                                            <input type="checkbox" name="categories[]" value="{{$c->id}}">
                                            @endif
                                            {{$c->name}}
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group">
                            <label for=""><strong>Description *</strong></label>
                            <textarea rows="5" name="description" placeholder="Présentez ici l'événement. Décrivez pourquoi, selon vous, cet événement est l'Evénement à ne pas rater ! Ce paragraphe de résumé apparaîtra sur votre page événement." class="form-control">{{$event->description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for=""><strong>Url d'intégration Youtube</strong></label>
                            <input type="text" value="{{$event->youtube_url}}" name="youtube_url" class="form-control" placeholder="https://www.youtube.com/embed/PKeUEKNnBQA">
                        </div>
                        <div class="form-group">
                            <label for=""><strong>Type d'événement</strong></label>
                            <select name="type_id" id="" class="form-control">
                                <option value="" selected disabled>Choisissez un type</option>
                                @foreach($types as $t)
                                @if($event->type_id == $t->id)
                                <option value="{{$t->id}}" selected>{{$t->name}}</option>
                                @else
                                <option value="{{$t->id}}">{{$t->name}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for=""><strong>Type d'accès</strong></label>
                            <select name="access_type" class="form-control" id="EventAccessType" required="required">
                                <option value="" disabled selected>Choisir le type d'accès</option>
                                @if($event->access_type == 1)
                                <option value="1" selected>Gratuit</option>
                                @else
                                <option value="1">Gratuit</option>
                                @endif
                                @if($event->access_type == 2)
                                <option value="2" selected>Payant</option>
                                @else
                                <option value="2">Payant</option>
                                @endif
                                @if($event->access_type == 3)
                                <option value="3" selected>Sur Invitation</option>
                                @else
                                <option value="3">Sur Invitation</option>
                                @endif
                                @if($event->access_type == 4)
                                <option value="4" selected>Sur Réservation</option>
                                @else
                                <option value="4">Sur Réservation</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for=""><strong>Lien pour la réservation des Tickets</strong></label>
                            <input type="text" value="{{$event->tickets_url}}" name="tickets_url" class="form-control" placeholder="http://www.exemple.com/tickets">
                        </div>
                    </div>
                    <input type="hidden" value="{{ ($event_options == null) ? 'null' : json_encode(unserialize($event_options->value)) }}" class="event_options">
                    <div v-if="dateFixe" class="card-footer">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for=""><strong>Date début *</strong></label>
                                    <input type="text" value="{{date('m/d/Y', strtotime(explode(" ", $event->start_timestamp)[0]))}}" name="start_date" placeholder="jj/mm/aaaa" class="form-control datetimepicker"/>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for=""><strong>Heure début *</strong></label>
                                    <input type="time" value="{{date('H:i', strtotime(explode(" ", $event->start_timestamp)[1]))}}" class="form-control" placeholder="hh : mm" name="start_time">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for=""><strong>Date Fin *</strong></label>
                                    <input type="text" value="{{date('m/d/Y', strtotime(explode(" ", $event->end_timestamp)[0]))}}" name="end_date" placeholder="jj/mm/aaaa" class="form-control datetimepicker"/>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for=""><strong>Heure Fin *</strong></label>
                                    <input type="time" value="{{ date('H:i', strtotime(explode(" ", $event->end_timestamp)[1])) }}" class="form-control" placeholder="hh : mm" name="end_time">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <a class="primary-color" href="" @click="toggleEvents($event)">Evénement récurrent ?</a>
                            </div>
                        </div>
                    </div>
                    <div v-if="eventRecurrent" class="card-footer">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for=""><strong>Événement récurrent</strong></label>
                                    <select name="" name="period[type]" v-model="eventType" class="form-control" @change="eventTypeChanged()">
                                        <option value="Quotidien">Quotidien</option>
                                        <option value="Hebdomadaire">Hebdomadaire</option>
                                        <option value="Mensuel">Mensuel</option>
                                    </select>
                                </div>
                                <div class="form-group" v-if="eventType == 'Hebdomadaire'">
                                    <label for=""><strong>Tous les</strong></label>
                                    @if($event_options != null && isset( (unserialize($event_options->value))['weekday'] ) )
                                    <select name="recurrent[weekly][day]" class="form-control" multiple value="{{(unserialize($event_options->value))['weekday']}}">
                                        @if( (unserialize($event_options->value))['weekday'] == 7 )
                                        <option value="7" selected>Dimanche</option>
                                        @else
                                        <option value="7">Dimanche</option>
                                        @endif
                                        @if( (unserialize($event_options->value))['weekday'] == 1 )
                                        <option value="1" selected>Lundi</option>
                                        @else
                                        <option value="1">Lundi</option>
                                        @endif
                                        @if( (unserialize($event_options->value))['weekday'] == 2 )
                                        <option value="2" selected>Mardi</option>
                                        @else
                                        <option value="2">Mardi</option>
                                        @endif
                                        @if( (unserialize($event_options->value))['weekday'] == 3 )
                                        <option value="3" selected>Mercredi</option>
                                        @else
                                        <option value="3">Mercredi</option>
                                        @endif
                                        @if( (unserialize($event_options->value))['weekday'] == 4 )
                                        <option value="4" selected>Jeudi</option>
                                        @else
                                        <option value="4">Jeudi</option>
                                        @endif
                                        @if( (unserialize($event_options->value))['weekday'] == 5 )
                                        <option value="5" selected>Vendredi</option>
                                        @else
                                        <option value="5">Vendredi</option>
                                        @endif
                                        @if( (unserialize($event_options->value))['weekday'] == 6 )
                                        <option value="6" selected>Samedi</option>
                                        @else
                                        <option value="6">Samedi</option>
                                        @endif
                                    </select>
                                    @else
                                    <select name="recurrent[weekly][day]" class="form-control" multiple="multiple">
                                        <option value="7">Dimanche</option>
                                        <option value="1">Lundi</option>
                                        <option value="2">Mardi</option>
                                        <option value="3">Mercredi</option>
                                        <option value="4">Jeudi</option>
                                        <option value="5">Vendredi</option>
                                        <option value="6">Samedi</option>
                                    </select>
                                    @endif
                                </div>
                                <div class="form-group" v-if="eventType == 'Mensuel'">
                                    <label for=""><strong>Tous les</strong></label>
                                    @if($event_options != null && isset(unserialize($event_options->value)['monthly']['day_number']))
                                    <select v-if="!joursSemaine" name="recurrent[monthly][day_number]" class="form-control">
                                        <option value="1">1er</option>
                                        @for ($i = 2; $i <= 31; $i++)
                                        @if($i == unserialize($event_options->value)['monthly']['day_number'])
                                        <option value="{{$i}}" selected>{{$i}}e</option>
                                        @else
                                        <option value="{{$i}}">{{$i}}e</option>
                                        @endif
                                        @endfor
                                    </select>
                                    @else
                                    <select v-if="!joursSemaine" name="recurrent[monthly][day_number]" class="form-control">
                                        <option value="1">1er</option>
                                        @for ($i = 2; $i <= 31; $i++)
                                        <option value="{{$i}}">{{$i}}e</option>
                                        @endfor
                                    </select>
                                    @endif
                                    <p v-if="!joursSemaine"></p> <!-- to add space -->
                                    <p v-if="!joursSemaine"><label for=""><strong>jour du mois.</strong></label></p>
                                    @if($event_options != null && isset( (unserialize($event_options->value))['monthly']['week_number'] ) )
                                    <select v-if="joursSemaine" name="recurrent[monthly][week_number]" class="form-control" value="{{(unserialize($event_options->value))['monthly']['week_number']}}">
                                        @if( (unserialize($event_options->value))['monthly']['week_number'] == 1 )
                                        <option value="1" selected>Premier</option>
                                        @else
                                        <option value="1">Premier</option>
                                        @endif
                                        @if( (unserialize($event_options->value))['monthly']['week_number'] == 2 )
                                        <option value="2" selected>Deuxième</option>
                                        @else
                                        <option value="2">Deuxième</option>
                                        @endif
                                        @if( (unserialize($event_options->value))['monthly']['week_number'] == 3 )
                                        <option value="3" selected>Troisième</option>
                                        @else
                                        <option value="3">Troisième</option>
                                        @endif
                                        @if( (unserialize($event_options->value))['monthly']['week_number'] == 4 )
                                        <option value="4" selected>Quatrième</option>
                                        @else
                                        <option value="4">Quatrième</option>
                                        @endif
                                    </select>
                                    @else
                                    <select v-if="joursSemaine" name="recurrent[monthly][week_number]" class="form-control">
                                        <option value="1">Premier</option>
                                        <option value="2">Deuxième</option>
                                        <option value="3">Troisième</option>
                                        <option value="4">Quatrième</option>
                                    </select>
                                    @endif
                                    <p v-if="joursSemaine"></p> <!-- to add space -->
                                    @if($event_options != null && isset( (unserialize($event_options->value))['monthly']['day'] ) )
                                    <select v-if="joursSemaine" name="recurrent[monthly][day]" class="form-control" multiple value="{{(unserialize($event_options->value))['monthly']['day'][0]}}">
                                        @if( (unserialize($event_options->value))['monthly']['day'] == 7 )
                                        <option value="7" selected>Dimanche</option>
                                        @else
                                        <option value="7">Dimanche</option>
                                        @endif
                                        @if( (unserialize($event_options->value))['monthly']['day'] == 1 )
                                        <option value="1" selected>Lundi</option>
                                        @else
                                        <option value="1">Lundi</option>
                                        @endif
                                        @if( (unserialize($event_options->value))['monthly']['day'] == 2 )
                                        <option value="2" selected>Mardi</option>
                                        @else
                                        <option value="2">Mardi</option>
                                        @endif
                                        @if( (unserialize($event_options->value))['monthly']['day'] == 3 )
                                        <option value="3" selected>Mercredi</option>
                                        @else
                                        <option value="3">Mercredi</option>
                                        @endif
                                        @if( (unserialize($event_options->value))['monthly']['day'] == 4 )
                                        <option value="4" selected>Jeudi</option>
                                        @else
                                        <option value="4">Jeudi</option>
                                        @endif
                                        @if( (unserialize($event_options->value))['monthly']['day'] == 5 )
                                        <option value="5" selected>Vendredi</option>
                                        @else
                                        <option value="5">Vendredi</option>
                                        @endif
                                        @if( (unserialize($event_options->value))['monthly']['day'] == 6 )
                                        <option value="6" selected>Samedi</option>
                                        @else
                                        <option value="6">Samedi</option>
                                        @endif
                                    </select>
                                    @else
                                    <select v-if="joursSemaine" name="recurrent[monthly][day]" class="form-control" multiple>
                                        <option value="7">Dimanche</option>
                                        <option value="1">Lundi</option>
                                        <option value="2">Mardi</option>
                                        <option value="3">Mercredi</option>
                                        <option value="4">Jeudi</option>
                                        <option value="5">Vendredi</option>
                                        <option value="6">Samedi</option>
                                    </select>
                                    @endif
                                    <p></p>
                                    <a class="primary-color" v-if="!joursSemaine" href="" onclick="" @click="toggleJoursSemaine($event)">Choisir par jour de la semaine</a>
                                    <a class="primary-color" v-if="joursSemaine" href="" @click="toggleJoursSemaine($event)">Choisir en fonction du jour du mois</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-if="eventRecurrent" class="card-footer">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for=""><strong>De:</strong></label>
                                    @if( $event_options != null )
                                    <input type="time" class="form-control" value="{{(unserialize($event_options->value))['time_from']}}" name="recurrent[time][from]">
                                    @else
                                    <input type="time" class="form-control" name="recurrent[time][from]">
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for=""><strong>À:</strong></label>
                                    @if( $event_options != null )
                                    <input type="time" class="form-control" value="{{(unserialize($event_options->value))['time_to']}}" name="recurrent[time][to]">
                                    @else
                                    <input type="time" class="form-control" name="recurrent[time][to]">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for=""><strong>Répéter à partir du:</strong></label>
                                    @if( $event_options != null )
                                    <input type="text" class="form-control" value="{{(unserialize($event_options->value))['date_from']}}" name="recurrent[date][from]">
                                    @else
                                    <input type="text" class="form-control" name="recurrent[date][from]">
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for=""><strong>Au:</strong></label>
                                    @if( $event_options != null )
                                    <input type="text" class="form-control" value="{{(unserialize($event_options->value))['date_to']}}" name="recurrent[date][to]">
                                    @else
                                    <input type="text" class="form-control" name="recurrent[date][to]">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <a class="primary-color" href="" @click="toggleEvents($event)">Evénement avec dates fixes ?</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for=""><strong>Photo de couverture</strong></label>
                            <div class="event_cover">
                                <img src="{{asset('storage/images/manager/events/' . $event->cover )}}" alt="">
                            </div>
                            <input type="file" name="cover_original" class="form-control">
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="form-group">
                            <label for=""><strong>Ville *</strong></label>
                            <select name="venue[city_id]" class="form-control" id="VenueCityId" required="required">
                                <option value="-1" disabled>Choisissez une ville</option>
                                @foreach($cities as $c)
                                @if($c->id == $venue->city_id)
                                <option value="{{$c->id}}" selected>{{$c->name}}</option>
                                @else
                                <option value="{{$c->id}}">{{$c->name}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for=""><strong>Lieu *</strong></label>
                            <input type="text" autocomplete="off" @keyup="searchVenues()" class="form-control" name="venue[name]" placeholder="Exemple : Théâtre Mohammed V" value="{{$venue->name}}">
                            <input type="hidden" name="city[lat]" id="CityLat" value="{{$venue->city->lat}}" /> 
                            <input type="hidden" name="city[lng]" id="CityLng" value="{{$venue->city->lng}}" /> 
                            <input type="hidden" name="venue[lat]" id="VenueLat" value="{{$venue->lat}}" /> 
                            <input type="hidden" name="venue[lng]" id="VenueLng" value="{{$venue->lng}}" /> 
                            <input type="hidden" name="venue[id]" id="VenueId" value="{{$venue->id}}" /> 
                            <input type="hidden" name="venue[foursquare_id]" id="VenueFoursquareId" value="{{$venue->foursquare_id}}" />
                        </div>
                        <ul class="suggested_venues" v-if="suggestedVenues.length > 0 || addNewPlace">
                            <li v-for="(s, index) in suggestedVenues" 
                                class="suggested_venue" 
                                :data-lat="s.lat" 
                                :data-lng="s.lng" 
                                @click="chooseSuggestedVenue(index)">
                                @{{s.name}}
                            </li>
                            <li @click="addPlace()"><strong>Ajouter un endroit</strong></li>
                        </ul>
                        <div id="map" data-lat="{{$venue->lat}}" data-lng="{{$venue->lng}}"></div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for=""><strong>Adresse postale</strong></label>
                                    <input type="text" class="form-control" name="venue[adress_1]" value="{{$venue->adress_1}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for=""><strong>Disciplines</strong><small> Si nécessaire, ajoutez quelques mots descriptifs à votre événement. Si votre événement traite d'une thématique spécifique, par exemple un festival de jazz, ajoutez le mot JAZZ ici. Séparez les mots par des virgules.</small></label>
                            <div class="tags_area">
                                @php foreach($event->tags as $tag){ $tags[] = $tag->tag->name; } @endphp
                                <input value="{{implode(',', $tags)}}" type="tags" placeholder="separés par virgules." name="tags">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><strong>Email</strong></label>
                                    <input type="text" class="form-control" name="email" placeholder="contact@ev.ma">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><strong>Téléphone</strong></label>
                                    <input type="text" class="form-control" name="phone" placeholder="0528123456">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><strong>Site web</strong></label>
                                    <input value="{{$event->website}}" type="text" class="form-control" name="website" placeholder="http://www.exemple.com">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><strong>Page Facebook</strong></label>
                                    <input value="{{$event->facebook}}" type="text" class="form-control" name="facebook" placeholder="http://facebook.com/exemple">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><strong>Compte Twitter</strong></label>
                                    <input value="{{$event->twitter}}" type="text" class="form-control" name="twitter" placeholder="http://twitter.com/exemple">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><strong>Chaine Youtube</strong></label>
                                    <input value="{{$event->youtube}}" type="text" class="form-control" name="youtube" placeholder="http://youtube.com/channel/exemple">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" name="submit" value="modifier" class="btn btn-primary btn-block">enregistrer</button>
                            </div>
                        </div>
                        
                        <p></p>
                        <p>Les informations suivies d'une * sont à saisir obligatoirement.</p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZiXnM5_gvDsGeTvWDYMxYV9lftXvEPpQ" async defer></script>
@endsection

@section('scripts')
<script src="{{asset('js/manager/app.js')}}"></script>
@endsection