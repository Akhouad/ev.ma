@extends('../layouts.manager', ['current_page' => 'Intervenants'])

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
            <div class="card bg-success">
                <div class="card-header">Intervenants</div>
                <div class="card-body">
                    <ul class="deletable-list">
                        <li v-for="(i, index) in intervenants">
                            <img :src="'/storage/images/avatars/' + i['avatar']" width="20" alt="">
                            <span v-text="i.fullname"></span>
                            <i class="fa fa-close close-icon" @click="removeIntervenant(index)"></i>
                        </li>
                        <li class="loader"><loader-component v-if="show_loader"></loader-component></li>
                    </ul>
                </div>
                <hr class="no-margin">
                <div class="card-body">
                    <form action="">
                        <div class="form-group add-intervenant-form">
                            <label for=""><strong>Ajouter des intervenants</strong></label>
                            <loader-component v-if="users_loader"></loader-component>
                            <input type="text" autocomplete="off" class="form-control" name="user[name]" @keydown="searchUsers()" placeholder="Nom de l'utilisateur">
                            <input type="hidden" name="user[id]">
                            <input type="hidden" name="current_user_id" value="{{Auth::user()->id}}">
                            <input type="hidden" name="event_id" value="{{$event->id}}">
                        </div>
                        <ul class="suggested_users" v-cloak v-if="suggestedUsers.length > 0 || add_new_intervenant">
                            <li v-for="(s, index) in suggestedUsers" 
                                class="suggested_user"
                                @click="chooseSuggestedUser(index)">
                                <img :src="'/storage/images/avatars/' + s['avatar']" width="20" class="rounded">
                                @{{s.fullname}}
                            </li>
                            <li @click="addUser()"><strong>+ Ajouter</strong></li>
                        </ul>
                        <a href="" class="btn btn-success pull-right" @click="addIntervenant($event)" v-cloak v-if="!add_new_intervenant_form">Ajouter</a>
                    </form>
                </div>
                <hr v-if="add_new_intervenant_form" class="no-margin" v-cloak>
                <div class="card-body" v-if="add_new_intervenant_form" v-cloak>
                    <!-- <form action="/register/intervenant/{{$event->id}}" method="post" enctype="multipart/form-data"> -->
                    <form action="" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="hidden" name="event_id" value="{{$event->id}}">
                        <div class="form-group">
                            <label for=""><strong>Nom de l'intervenant *</strong></label>
                            <input type="text" class="form-control" name="fullname">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><strong>Email *</strong></label>
                                    <input type="text" class="form-control" name="email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""><strong>Photo du profil</strong></label>
                                    <input type="file" class="form-control" name="avatar">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success pull-right">Ajouter</button>
                    </form>
                    <label>Les informations suivies d'une * sont à saisir obligatoirement.</label>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{asset('js/manager/intervenants.js')}}"></script>
@endsection