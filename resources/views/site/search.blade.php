@extends('../layouts.site', [
        'title' => "Recherche Avancée", 
        'categories' => $categories, 
        'footer_cities' => $footer_cities
        ])

@section('content')
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
<form action="{{route('homepage')}}">
    <div class="row" id="search">
        @if(Auth::user() !== null)
        <input type="hidden" value="{{Auth::user()->city->slug}}" ref="city">
        @endif
        <div class="col-md-8">
            <h6 class="paragraph-title">Recherche avancée</h6>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="form-group">
                        <label for=""><strong>Mot clé</strong></label>
                        <input type="text" class="form-control" name="search">
                    </div>
                    <div class="form-group">
                        <div class="radio-search active" data-type="event">
                            <input type="radio" checked name="search-type" id="event" value="event">
                            <label for="event">Evenement</label>
                        </div>
                        <div class="radio-search" data-type="user">
                            <input type="radio" name="search-type" id="user" value="user">
                            <label for="user">Utilisateur</label>
                        </div>
                        <div class="radio-search" data-type="organizer">
                            <input type="radio" name="search-type" id="organizer" value="organizer">
                            <label for="organizer">Organisateur</label>
                        </div>
                    </div>
                    <button type="submit" name="advanced" value="true" class="btn btn-primary">
                        Rechercher
                    </button>
                </div>
                <transition name="slide-fade">
                    <div class="col-md-6" v-if="search_type == 'event'">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><strong>Catégorie</strong></label>
                                    <select class="selectpicker form-control" data-live-search="true" data-style="btn-default" name="category">
                                        <!-- <option value="all" selected>Toutes les categories</option> -->
                                        @foreach($categories as $c)
                                            <option data-tokens="{{$c->name}}" value="{{$c->id}}">{{$c->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><strong>Ville</strong></label>
                                    <select class="selectpicker form-control" data-live-search="true" data-style="btn-default" name="city">
                                        @foreach($cities as $city)
                                            @if($city->id == 109)
                                                <option data-tokens="{{$city->name}}" value="{{$city->id}}" selected="selected">{{$city->name}}</option>
                                            @else
                                                <option data-tokens="{{$city->name}}" value="{{$city->id}}">{{$city->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>  
                        </div>

                        <div class="form-group">
                            <label for=""><strong>Date Début</strong></label>
                            <input type="text" name="start_date" placeholder="jj-mm-aaaa" class="form-control datetimepicker"/>
                        </div>
                        <div class="form-group">
                            <label for=""><strong>Date Fin</strong></label>
                            <input type="text" name="end_date" placeholder="jj-mm-aaaa" class="form-control datetimepicker"/>
                        </div>
                    </div>
                </transition>   
            </div>
        </div>
        <div class="col-md-3 offset-md-1">
            <div class="sidebar-widget">
                <latest-events></latest-events>
                @if(Auth::user() !== null)
                <near-events city="{{Auth::user()->city->slug}}"></near-events>
                @endif
            </div>
        </div>
    </div>
</form>
@endsection

@section('scripts')
<script src="{{asset('js/site/search.js')}}"></script>
@endsection