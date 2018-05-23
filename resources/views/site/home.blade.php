@extends('../layouts.site', 
        [
            'title' => 'Evénements, bons plans, soirées, festivals, conférences et manifestations diverses au Maroc : Tous sont sur Ev.ma', 
            'categories' => $categories, 
            'footer_cities' => $footer_cities,
            'category' => (isset($category)) ? $category : null
        ])

@section('content')
<div id="app">
    @if(!isset($results))
    <div class="filter-bar">
        <ul>
            <li>
                <a href="" @click="toggle_event_type(undefined, $event)" class="active"><i class="fa fa-fire"></i> Nouveautés</a>
            </li>
            @if(Auth::check())
            <li>
                <a href="" @click="toggle_event_type('hi', $event)"><i class="fa fa-heart"></i> Coups de coeur</a>
            </li>
            @endif
            <li>
                <a href="" @click="toggle_event_type('now', $event)"><span class="circle"></span> En ce moment</a>
            </li>
            <li>
                <a href="" @click="toggle_event_type('coming', $event)"><i class="fa fa-calendar"></i> Prochainement</a>
            </li>
            @if(Auth::check())
            <li>
                <a href="" @click="toggle_event_type('near', $event)"><i class="fa fa-map-marker"></i> À proximité</a>
            </li>
            <li class="add-event">
                <a href="{{route('add-event')}}"><i class="fa fa-plus-square"></i> Ajouter un événement</a>
            </li>
            @endif
        </ul>
    </div>
    @endif
    <div class="row">
        <div class="col-md-9">
            @if(isset($results))
                <div class="row">
                    {{-- SEARCH RESULTS --}}
                    @if(isset($results) && count($results) > 0)
                        @if( isset($results['events']) && count($results['events']) > 0 )
                            <div class="col-md-12">
                                <h6 class="paragraph-title">Evenements trouvés:</h6>
                            </div>
                            @foreach($results['events'] as $e)
                                <div class="col-md-3 col-sm-4">
                                    <div class="event-block">
                                        <a href="{{route('event-page', ['id' => $e->id, 'slug' => $e->slug])}}">
                                            <div class="event-image">
                                                <img src="{{asset('storage/images/manager/events/' . $e['cover'])}}" alt="">
                                            </div>
                                            <div class="event-info">
                                                @if(strlen($e['name']) > 40)
                                                <p class="event-name" data-toggle="tooltip" data-placement="bottom" title="{{$e->name}}">
                                                    {{str_limit($e['name'], 40, '...')}}
                                                </p>
                                                @else
                                                <p class="event-name">{{$e['name']}}</p>
                                                @endif
                                                <p class="event-date">
                                                    <i class="fa fa-calendar"></i>
                                                    {{\App\Http\Controllers\Site\HomeController::formatDate($e['start_timestamp'])}}
                                                </p>
                                                <p class="event-location">
                                                    <i class="fa fa-map-marker primary-color-text"></i>
                                                    {{$e['city']}}
                                                </p>
                                            </div>
                                        </a>
                                        <a href="" class="event-button">Ajouter à mon calendrier</a>
                                    </div>
                                </div>
                            @endforeach
                        @elseif( isset($results['users']) && count($results['users']) > 0 )
                            <div class="col-md-12">
                                <h6 class="paragraph-title">Utilisateurs trouvés:</h6>
                            </div>
                            @foreach($results['users'] as $u)
                                <div class="col-md-2">{{$u->fullname}}</div>
                            @endforeach
                        @elseif( isset($results['organizers']) && count($results['organizers']) > 0 )
                            <div class="col-md-12">
                                <h6 class="paragraph-title">Organisateurs trouvés:</h6>
                            </div>
                            @foreach($results['organizers'] as $o)
                                <div class="col-md-2">{{$o->name}}</div>
                            @endforeach
                        @endif
                        
                        <?php
                            $sum = 0;
                            foreach($results as $r){ $sum += count($r); }
                        ?>
                        @if( $sum == 0 )
                            <div class="col-md-12">
                                <p style="text-align:center;padding:50px;">
                                    Aucun résulat trouvé.
                                </p>
                            </div>
                        @endif
                    @endif
                <!-- </div> -->
            @else
                <div class="row">
                {{-- DEFAULT RESULTS --}}
                <events-list :type="events_type"></events-list>
            @endif
            </div>
        </div>
        <div class="col-md-3">
            <div class="sidebar-widget">
                @if(Auth::user() !== null)
                <near-events city="{{Auth::user()->city->slug}}"></near-events>
                @endif
                <div class="sidebar-heading">Populaires</div>
                <ul class="nav nav-tabs mt-2" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#cats">Catégories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#types">Types</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tags">Tags</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="cats">
                        <most-used type="categories"></most-used>
                    </div>
                    <div class="tab-pane fade show" id="types">
                        <most-used type="types"></most-used>
                    </div>
                    <div class="tab-pane fade show" id="tags">
                        <most-used type="tags"></most-used>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{asset('js/site/home.js')}}"></script>
@endsection