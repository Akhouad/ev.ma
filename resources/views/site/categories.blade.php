@extends('../layouts.site', [
        'title' => 'Catégories',
        'categories' => $categories,
        'footer_cities' => $footer_cities
    ])

@section('content')
    <div class="row">
        <div class="col-md-9">
            <h6 class="paragraph-title">Les catégories</h6>
            <div class="row">
                @foreach($cats as $c)
                <div class="col-md-3">
                    <a href="{{route('category', ['category' => $c->slug])}}" class="list-item">
                        {{$c->name}} ({{count( $c->events )}})
                    </a>
                </div>
                @endforeach
            </div>
            <h6 class="paragraph-title mt-4" id="types">Les types</h6>
            <div class="row">
                @foreach($types as $t)
                    <div class="col-md-3">
                        <a href="{{route('type', ['type' => $t->slug])}}" class="list-item">
                            {{$t->name}} ({{count($t->events)}})
                        </a>
                    </div>
                @endforeach
            </div>
            <h6 class="paragraph-title mt-4" id="tags">Les top tags</h6>
            <div class="row">
                @foreach($tags as $t)
                    <div class="col-md-3">
                        <a href="{{route('tag', ['tag' => $t->name])}}" class="list-item">
                            {{$t->name}} ({{count($t->events)}})
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-3">
            <div id="app">
                <div class="sidebar-widget">
                    <latest-events></latest-events>
                    @if(Auth::user() !== null)
                    <near-events city="{{Auth::user()->city->slug}}"></near-events>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection