@extends('../layouts.site', 
        [
            'title' => 'Se connecter', 
            'categories' => $categories, 
            'footer_cities' => $footer_cities,
            'category' => (isset($category)) ? $category : null
        ])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-4 mb-4">
            <h6 class="paragraph-title centered">Se Connecter</h6>
            <form method="POST" action="{{ route('login') }}">
                {{csrf_field()}}

                <div class="form-group row">
                    <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __("Nom d'utilisateur / Email") }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Mot de passe') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6 offset-md-4">
                        <div class="checkbox-fn">
                            <label class="label-control">
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> 
                                {{ __('Se souvenir de moi') }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Se connecter') }}
                        </button>

                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Mot de passe oublié?') }}
                        </a>
                    </div>
                </div>
            </form>
            <p class="mt-5 text-center">
                Vous n'êtes pas encore inscrit? <a href="{{route('register')}}">S'inscrire</a>
            </p>
        </div>
    </div>
</div>
@endsection
