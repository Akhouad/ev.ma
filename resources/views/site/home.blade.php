@extends('../layouts.site', 
        [
            'title' => 'Evénements, bons plans, soirées, festivals, conférences et manifestations diverses au Maroc : Tous sont sur Ev.ma', 
            'categories' => $categories, 
            'footer_cities' => $footer_cities
        ])

@section('content')
<div id="app">
    <div class="row">
        <div class="col-md-9">
            <div class="row">
                @if(isset($results))

                    {{-- SEARCH RESULTS --}}
                    @if(isset($results) && count($results) > 0)
                        @if( isset($results['events']) && count($results['events']) > 0 )
                            <div class="col-md-12">
                                <h6 class="paragraph-title">Evenements trouvés:</h6>
                            </div>

                            @foreach($results['events'] as $e)
                                <div class="col-3">
                                    <div class="event-block">
                                        <a href="{{route('event-page', ['id' => $e->id, 'slug' => $e->slug])}}">
                                            <div class="event-image">
                                                <img src="{{asset('storage/images/manager/events/' . $e->cover)}}" alt="">
                                            </div>
                                            <div class="event-info">
                                                @if(strlen($e->name) > 40)
                                                <p class="event-name" data-toggle="tooltip" data-placement="bottom" title="{{$e->name}}">
                                                    {{str_limit($e->name, 40, '...')}}
                                                </p>
                                                @else
                                                <p class="event-name">{{$e->name}}</p>
                                                @endif
                                                <p class="event-date">
                                                    <i class="fa fa-calendar"></i>
                                                    {{$e->start_timestamp}}
                                                </p>
                                                <p class="event-location">
                                                    <i class="fa fa-map-marker primary-color-text"></i>
                                                    {{$e->city}}
                                                </p>
                                            </div>
                                        </a>
                                        <a href="" class="event-button">Ajouter à mon calendrier</a>
                                    </div>
                                </div>
                            @endforeach
                        @elseif( isset($results['users']) && count($results['users']) > 0 )
                            @foreach($results['users'] as $u)
                                <div class="col-md-12">
                                    <h6 class="paragraph-title">Utilisateurs trouvés:</h6>
                                </div>
                                <div class="col-md-2">{{$u->fullname}}</div>
                            @endforeach
                        @elseif( isset($results['organizers']) && count($results['organizers']) > 0 )
                            @foreach($results['organizers'] as $o)
                                <div class="col-md-12">
                                    <h6 class="paragraph-title">Organisateurs trouvés:</h6>
                                </div>
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
            </div>
            <div class="row">
                @else
                    {{-- DEFAULT RESULTS --}}
                    <events-list></events-list>
                @endif
            </div>
        </div>
        <div class="col-md-3">
            @if(Auth::user() !== null)
            <div class="sidebar-widget">
                <users-sidebar city="{{Auth::user()->city->slug}}"></users-sidebar>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{asset('js/site/home.js')}}"></script>
@endsection