@extends('../layouts.site', 
        [
            'title' => 'Villes | Ev.ma', 
            'categories' => $categories, 
            'cities' => $cities
        ])

@section('content')
<div class="row">
    <div class="col-md-10 offset-md-1">
        <h3 class="section-title">Top Villes</h3>
        <div class="row">
        @foreach($cities as $c)
        @if($c->prior == 1)
        <div class="col-md-4">
            <a href="{{route('city', ['city' => $c->slug])}}" class="city"><img src="{{asset('storage/images/cities/' . $c->cover)}}" alt=""></a>
        </div>
        @endif
        @endforeach
        </div>
        <h3 class="section-title">Autres Villes</h3>
        <div class="row">
            @foreach($cities as $c)
            @if($c->prior != 1)
            <div class="col-md-4 mt-1 mb-1 text-center">
                <a href="{{route('city', ['city' => $c->slug])}}">{{$c->name}}</a>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('scripts')
@endsection