@extends('../layouts.manager', [
        'pending_events' => $pending_events,
        'current_page' => title_case($collection->name)
    ])

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="collection-sidebar">
                <div class="image">
                    @if($collection->image != null)
                    <img src="{{asset('storage/images/manager/collections/' . $collection->image)}}" alt="">
                    @else
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" xmlns:xlink="http://www.w3.org/1999/xlink" height="512px" version="1.1" viewBox="0 0 32 32" width="512px"><title/><desc/><defs/><g fill="none" fill-rule="evenodd" id="Page-1" stroke="none" stroke-width="1"><g fill="#929292" id="icon-65-document-image"><path d="M22,24.0457281 L22,18 L11,18 L11,25 L11,25 L13.5,23 L14.9579388,24.2496618 L18.5930302,21 L22,24.0457281 L22,24.0457281 L22,24.0457281 Z M19,3 L9.0085302,3 C7.8992496,3 7,3.89833832 7,5.00732994 L7,27.9926701 C7,29.1012878 7.89092539,30 8.99742191,30 L24.0025781,30 C25.1057238,30 26,29.1090746 26,28.0025781 L26,11 L21.0059191,11 C19.8980806,11 19,10.1132936 19,9.00189865 L19,3 L19,3 Z M20,3 L20,8.99707067 C20,9.55097324 20.4509752,10 20.990778,10 L26,10 L20,3 L20,3 Z M10,17 L10,27 L23,27 L23,17 L10,17 L10,17 Z M14,21 C14.5522848,21 15,20.5522848 15,20 C15,19.4477152 14.5522848,19 14,19 C13.4477152,19 13,19.4477152 13,20 C13,20.5522848 13.4477152,21 14,21 L14,21 Z" id="document-image"/></g></g></svg>
                    @endif
                </div>
                <div class="name">{{title_case($collection->name)}}</div>
                <p class="description">{{$collection->description}}</p>
                <form action="{{route('delete-collection', ['id' => $collection->id])}}" method="post" class="m-2">
                    {{csrf_field()}}
                    <button class="btn btn-sm btn-danger">Supprimer</button>
                </form>
            </div>
        </div>
        <div class="col-md-8">
            <div class="list-group">
                @foreach($events as $e)
                <div class="list-group-item">
                    <span class="badge badge-{{(count($e->attendings) > 0) ? 'primary' : 'default'}} float-right">{{count($e->attendings)}} <i class="fa fa-user"></i></span>

                    @if(!\Carbon\Carbon::parse($e->start_timestamp)->isPast())
                    <span class="badge badge-success">Prochain</span>
                    @else
                    <span class="badge badge-default">Passé</span>
                    @endif

                    @if($e->status == 'pending')
                    <span class="badge badge-default float-right" style="margin-right:5px">En cours de validation</span>
                    @endif
                    <a href="{{route('event', ['id' => $e->id])}}"><span class="event-name">{{title_case($e->name)}}</span></a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection