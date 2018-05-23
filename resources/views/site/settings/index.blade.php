@extends('../../layouts.site', [
        'title' => 'Parametres',
        'categories' => $categories,
        'footer_cities' => $footer_cities
    ])

    
@section('content')
<div class="row">
    <div class="col-md-3">
        @component('site/components/settings-sidebar')
        @endcomponent
    </div>
    <div class="col-md-9">
        @if(Session::has('alert-message'))
            <div class="alert {{Session::get('alert-class')}} alert-dismissible fade show" role="alert">
                {{Session::get('alert-message')}}
            </div>
        @endif
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
        
        <h6 class="paragraph-title">Compte</h6>
        <p class="text-muted">Changez les paramètres de base de votre compte et vos paramètres.</p>

        <div class="row">
            <form action="{{route('settings')}}" method="post" class="col-md-6" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group">
                    <label for=""><strong>Nom *</strong></label>
                    <input type="text" name="fullname" class="form-control" palceholder="Votre nom complet" value="{{Auth::user()->fullname}}">
                </div>
                <div class="form-group">
                    <label for=""><strong>Email *</strong></label>
                    <input type="text" name="email" class="form-control" palceholder="Votre email" value="{{Auth::user()->email}}">
                </div>
                <div class="form-group">
                    <label for=""><strong>Nom d'utilisateur *</strong></label>
                    <input type="text" name="username" class="form-control" palceholder="http://ev.ma/u/{votre_nom_dutilisateur}" value="{{Auth::user()->username}}">
                </div>
                <div class="form-group">
                    <label for=""><strong>Date de naissance</strong></label>
                    <input type="text" name="birthday" class="form-control birthday-datetimepicker" palceholder="aaaa-mm-jj" value="{{Auth::user()->birthday}}">
                </div>
                <div class="form-group">
                    <label for=""><strong>Ville actuelle</strong></label>
                    <select name="city" class="form-control selectpicker" data-live-search="true" data-style="btn-default">
                        @foreach($cities as $c)
                            @if(Auth::user()->city_id == $c->id)
                            <option value="{{$c->id}}" selected>{{$c->name}}</option>
                            @else
                            <option value="{{$c->id}}">{{$c->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for=""><strong>Photo de profil</strong></label>
                    <div class="mb-2">
                        <img src="{{asset('storage/images/avatars/' . Auth::user()->avatar)}}" alt="" class="avatar">
                    </div>
                    <input type="file" name="avatar" class="form-control">
                </div>
                <button class="btn btn-primary" type="submit">Enregistrer les modifications</button>
            </form>
        </div>
    </div>
</div>
@endsection