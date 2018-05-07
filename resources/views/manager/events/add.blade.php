@extends('../../layouts.manager', compact('pending_events'))

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
            <div class="col-8 offset-md-2">
                <div class="card bg-success add-event-card">
                    <div class="card-header">
                        Informations générales
                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="card-body">
                            <div class="form-group">
                                <label for=""><strong>Nom de l'événement *</strong></label><span title="Merci de mettre les majuscules uniquement en début de titre et aux noms propres SVP."> (?)</span>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div class="form-group add-event-categories">
                                <label for=""><strong>Catégories de l'événement *</strong> <small>Sélectionnez jusqu'à 3 catégories. Plus vous êtes spécifique mieux l'événement sera retrouvé.</small></label>
                                
                                <div class="row">
                                    @foreach($categories as $c)
                                    <div class="col-4">
                                        <div class="checkbox-fn">
                                            <label for="" class="label-control">
                                                <input type="checkbox" name="categories[]" value="{{$c->id}}">
                                                {{$c->name}}
                                            </label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group">
                                <label for=""><strong>Description *</strong></label>
                                <textarea rows="5" name="description" placeholder="Présentez ici l'événement. Décrivez pourquoi, selon vous, cet événement est l'Evénement à ne pas rater ! Ce paragraphe de résumé apparaîtra sur votre page événement." class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label for=""><strong>Url d'intégration Youtube</strong></label>
                                <input type="text" name="youtube_url" class="form-control" placeholder="https://www.youtube.com/embed/PKeUEKNnBQA">
                            </div>
                            <div class="form-group">
                                <label for=""><strong>Type d'événement</strong></label>
                                <select name="type_id" id="" class="form-control">
                                    <option value="" selected disabled>Choisissez un type</option>
                                    @foreach($types as $t)
                                    <option value="{{$t->id}}">{{$t->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for=""><strong>Type d'accès</strong></label>
                                <select name="access_type" class="form-control" id="EventAccessType">
                                    <option value="" disabled selected>Choisir le type d'accès</option>
                                    <option value="1">Gratuit</option>
                                    <option value="2">Payant</option>
                                    <option value="3">Sur Invitation</option>
                                    <option value="4">Sur Réservation</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for=""><strong>Lien pour la réservation des Tickets</strong></label>
                                <input type="text" name="tickets_url" class="form-control" placeholder="http://www.exemple.com/tickets">
                            </div>
                        </div>
                        <div v-if="dateFixe" class="card-footer">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for=""><strong>Date début *</strong></label>
                                        <input type="text" name="start_date" placeholder="jj/mm/aaaa" class="form-control datetimepicker" />
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for=""><strong>Heure début *</strong></label>
                                        <input type="time" class="form-control" placeholder="hh : mm" name="start_time">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for=""><strong>Date Fin *</strong></label>
                                        <input type="text" name="end_date" placeholder="jj/mm/aaaa" class="form-control datetimepicker"/>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for=""><strong>Heure Fin *</strong></label>
                                        <input type="time" class="form-control" placeholder="hh : mm" name="end_time">
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
                                    <!-- HEBDOMADAIRE -->
                                    <div class="form-group" v-if="eventType == 'Hebdomadaire'">
                                        <label for=""><strong>Tous les</strong></label>
                                        <select name="recurrent[weekly]" class="form-control" multiple>
                                            <option value="7">Dimanche</option>
                                            <option value="1">Lundi</option>
                                            <option value="2">Mardi</option>
                                            <option value="3">Mercredi</option>
                                            <option value="4">Jeudi</option>
                                            <option value="5">Vendredi</option>
                                            <option value="6">Samedi</option>
                                        </select>
                                    </div>
                                    <!-- MENSUEL -->
                                    <div class="form-group" v-if="eventType == 'Mensuel'">
                                        <label for=""><strong>Tous les</strong></label>
                                        <select v-if="!joursSemaine" name="recurrent[monthly][day_number]" class="form-control">
                                            <option value="1">1er</option>
                                            @for ($i = 2; $i <= 31; $i++)
                                            <option value="{{$i}}">{{$i}}e</option>
                                            @endfor
                                        </select>
                                        <p v-if="!joursSemaine"></p>
                                        <p v-if="!joursSemaine"><label for=""><strong>jour du mois.</strong></label></p>
                                        <select v-if="joursSemaine" name="recurrent[monthly][week_number]" class="form-control">
                                            <option value="1">Premier</option>
                                            <option value="2">Deuxième</option>
                                            <option value="3">Troisième</option>
                                            <option value="4">Quatrième</option>
                                        </select>
                                        <p v-if="joursSemaine"></p>
                                        <select v-if="joursSemaine" name="recurrent[monthly][day]" class="form-control" multiple="multiple">
                                            <option value="7">Dimanche</option>
                                            <option value="1">Lundi</option>
                                            <option value="2">Mardi</option>
                                            <option value="3">Mercredi</option>
                                            <option value="4">Jeudi</option>
                                            <option value="5">Vendredi</option>
                                            <option value="6">Samedi</option>
                                        </select>
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
                                        <input type="time" class="form-control" name="recurrent[time][from]">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for=""><strong>À:</strong></label>
                                        <input type="time" class="form-control" name="recurrent[time][to]">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for=""><strong>Répéter à partir du:</strong></label>
                                        <input type="text" class="form-control datetimepicker" name="recurrent[date][from]">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for=""><strong>Au:</strong></label>
                                        <input type="text" class="form-control datetimepicker" name="recurrent[date][to]">
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
                                <input type="file" name="cover_original" class="form-control">
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="form-group">
                                <label for=""><strong>Ville *</strong></label>
                                <select name="venue[city_id]" class="form-control" id="VenueCityId" v-model="city_id">
                                    <option value="-1" selected disabled>Choisissez une ville</option>
                                    @foreach($cities as $c)
                                    <option value="{{$c->id}}">{{$c->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for=""><strong>Lieu *</strong></label>
                                <input type="text" autocomplete="off" @keydown="searchVenues()" class="form-control" name="venue[name]" placeholder="Exemple : Théâtre Mohammed V">
                                <input type="hidden" name="city[lat]" id="CityLat" /> 
                                <input type="hidden" name="city[lng]" id="CityLng" /> 
                                <input type="hidden" name="venue[lat]" id="VenueLat" /> 
                                <input type="hidden" name="venue[lng]" id="VenueLng" /> 
                                <input type="hidden" name="venue[id]" id="VenueId" /> 
                                <input type="hidden" name="venue[foursquare_id]" id="VenueFoursquareId" />
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
                            <div id="map" :class="{'not_displayed': !showMap}"></div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for=""><strong>Adresse postale</strong></label>
                                        <input type="text" class="form-control" name="venue[adress_1]">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for=""><strong>Disciplines</strong><small> Si nécessaire, ajoutez quelques mots descriptifs à votre événement. Si votre événement traite d'une thématique spécifique, par exemple un festival de jazz, ajoutez le mot JAZZ ici. Séparez les mots par des virgules.</small></label>
                                <div class="tags_area">
                                    <input type="tags" placeholder="separés par virgules." name="tags">
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
                                        <input type="text" class="form-control" name="website" placeholder="http://www.exemple.com">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""><strong>Page Facebook</strong></label>
                                        <input type="text" class="form-control" name="facebook" placeholder="http://facebook.com/exemple">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""><strong>Compte Twitter</strong></label>
                                        <input type="text" class="form-control" name="twitter" placeholder="http://twitter.com/exemple">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""><strong>Chaine Youtube</strong></label>
                                        <input type="text" class="form-control" name="youtube" placeholder="http://youtube.com/channel/exemple">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for=""><strong>Planifier la publication</strong><small> Programmer la publication de l'événement à une date précise.</small></label>
                                <div class="row">
                                    <div class="col-6">
                                        <input type="text" class="form-control datetimepicker" name="plan[date]" placeholder="Ex: 10/05/2015">
                                    </div>
                                    <div class="col-6">
                                        <input type="time" class="form-control" name="plan[time]" placeholder="Ex: 20:30">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <button type="submit" name="submit" value="Enregistrer en brouillon" class="btn btn-primary btn-block">ENREGISTRER EN BROUILLON</button>
                                </div>
                                <div class="col-6">
                                    <button type="submit" name="submit" value="Publier" class="btn btn-success btn-block">PUBLIER</button>
                                </div>
                            </div>
                            
                            <p></p>
                            <p>En partageant cet événement, vous confirmer que vous avez lu et que vous acceptez nos <a href="http://ev.ma/ajoutez-votre-evenement" target="_blank">nos conditions d'ajout d'un événement</a></p>
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