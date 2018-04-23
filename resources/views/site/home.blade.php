@extends('../layouts.site', 
        [
            'title' => 'Evénements, bons plans, soirées, festivals, conférences et manifestations diverses au Maroc : Tous sont sur Ev.ma', 
            'categories' => $categories, 
            'footer_cities' => $footer_cities
        ])

@section('content')
<div id="app">
    <input type="hidden" value="{{Auth::user()->city->slug}}" ref="city">
    <div class="row">
        <div class="col-9">
            <div class="row">
                <div class="col-3" v-for="index in 7" v-if="events.length == 0">
                    <event-skeleton :index="index" />
                </div>
                <div class="col-3" v-for="e in events" v-if="events.length > 0">
                    <div href="" class="event-block">
                        <a href="">
                            <div class="event-image" data-toggle="tooltip" data-placement="bottom" :title="e.name" v-if="e.name.length >= 40">
                                <img :src="'/storage/images/manager/events/' + e.cover" alt="">
                            </div>
                            <div class="event-image" v-if="e.name.length < 40">
                                <img :src="'/storage/images/manager/events/' + e.cover" alt="">
                            </div>
                            <div class="event-info">
                                <p class="event-name">@{{e.name | truncate(40)}}</p>
                                <p class="event-date">
                                    <i class="fa fa-calendar"></i>
                                    @{{e.start_timestamp}}
                                </p>
                                <p class="event-location">
                                    <i class="fa fa-map-marker primary-color-text"></i>
                                    @{{e.city}}
                                </p>
                            </div>
                        </a>
                        <a href="" class="event-button">Ajouter à mon calendrier</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="sidebar-widget">
                <div class="sidebar-heading">utilisateurs prés de vous</div>
                <div v-if="users.length == 0"><user-skeleton v-for="index in 5" :index="index" /></div>
                <ul class="sidebar-users" v-if="users.length > 0">
                    <li v-for="u in users">
                        <div class="user-info">
                            <a href="">
                                <img :src="'/storage/images/avatars/' + u.avatar" alt="">
                                <p class="fullname" v-text="u.fullname"></p>
                                <p class="username" v-text="u.username"></p>
                            </a>
                        </div>
                        <div class="user-actions">
                            <a href="" class="btn btn-danger btn-sm">x</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{asset('js/site/home.js')}}"></script>
@endsection