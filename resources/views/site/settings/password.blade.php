@extends('../../layouts.site', [
        'title' => 'Modifier le mot de passe',
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
        
        <h6 class="paragraph-title">Mot de passe</h6>
        <p class="text-muted">Changez vos paramètres de sécurité et de confidentialité.</p>

        <div class="row">
            <form action="{{route('password-settings')}}" method="post" class="col-md-6">
                {{csrf_field()}}
                <div class="form-group">
                    <label for=""><strong>Actuel</strong></label>
                    <input type="password" name="current" class="form-control">
                </div>
                <div class="form-group">
                    <label for=""><strong>Nouveau mot de passe</strong></label>
                    <input type="password" name="new" class="form-control">
                </div>
                <div class="form-group">
                    <label for=""><strong>Confirmer le nouveau mot de passe</strong></label>
                    <input type="password" name="confirm" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
            </form>
        </div>
    </div>
</div>
@endsection