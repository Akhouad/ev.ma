@extends('../layouts.site', [
        'title' => 'Agadir', 
        'footer_cities' => $footer_cities, 
        'categories' => $categories
    ])

@section('content')
<div id="app">
    <input type="hidden" value="{{Auth::user()->city->slug}}" ref="city">
    <div class="row">
        <div class="col-9">
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
        <div class="col-3">
            @if(Auth::user() !== null)
            <div class="sidebar-widget">
                <users-sidebar city="{{Auth::user()->city->slug}}" />
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{asset('js/site/home.js')}}"></script>
@endsection