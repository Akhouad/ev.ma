@extends('../layouts.site', [
        'title' => 'Agadir', 
        'footer_cities' => $footer_cities, 
        'categories' => $categories
    ])

@section('content')
<div id="app">
    <div class="row">
        <div class="col-md-9">
            <div class="row">
                @foreach($events as $e)
                <div class="col-3">
                    <div href="" class="event-block">
                        <a href="">
                            @if(strlen($e->name) > 40)
                            <div class="event-image" data-toggle="tooltip" data-placement="bottom" title="{{$e->name}}">
                                <img src="{{asset('storage/images/manager/events/' . $e->cover)}}" alt="">
                            </div>
                            @else
                            <div class="event-image">
                                <img src="{{asset('storage/images/manager/events/' . $e->cover)}}" alt="">
                            </div>
                            @endif
                            <div class="event-info">
                                <p class="event-name">{{str_limit($e->name, 40, '...')}}</p>
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