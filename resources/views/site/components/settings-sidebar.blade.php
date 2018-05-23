<ul class="settings-sidebar">
    <li>
        <a href="{{route('settings')}}" class="{{(Route::current()->getName() == 'settings') ? 'active' : ''}}">
            Compte 
            <i class="fa fa-angle-right"></i>
        </a>
    </li>
    <li>
        <a href="{{route('password-settings')}}" class="{{(Route::current()->getName() == 'password-settings') ? 'active' : ''}}">
            Mot de passe 
            <i class="fa fa-angle-right"></i>
        </a>
    </li>
</ul>